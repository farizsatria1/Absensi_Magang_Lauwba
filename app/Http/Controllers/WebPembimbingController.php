<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WebPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika kata kunci pencarian diberikan, cari Pembimbing berdasarkan nama
        if ($search) {
            $pembimbing = Pembimbing::where('nama', 'like', '%' . $search . '%')->latest()->paginate(10);
        } else {
            // Jika tidak, dapatkan semua Pembimbing
            $pembimbing = Pembimbing::latest()->paginate(10);
        }

        return view('pembimbing.pembimbing', [
            'pembimbing' => $pembimbing,
        ]);
    }


    public function create()
    {

        return view('pembimbing.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'ttd' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'ttd.required' => 'Kolom gambar harus di isi',
            'ttd.image' => 'File yang diunggah harus berupa gambar',
            'ttd.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'ttd.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        // Check if a Pembimbing with the same nip already exists
        $existingPembimbing = Pembimbing::where('nip', $validatedData['nip'])->first();

        if ($existingPembimbing) {
            // Handle the case where a Pembimbing with the same nip already exists
            Alert::error('Error', 'Nip sudah ada');
            return redirect()->route('pembimbing.create')->with('error', 'Failed to add Pembimbing');
        } else {
            // Store the image in the storage/app/public directory
            $image = $request->file('ttd');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $namafile);

            // Create a new Pembimbing instance and save it to the database
            $pembimbing = Pembimbing::create([
                'nama' => $validatedData['nama'],
                'nip' => $validatedData['nip'],
                'password' => bcrypt($validatedData['password']), // Hash the password before saving
                'ttd' => $namafile, // Save the filename in the database
            ]);

            Alert::success('Success', 'Akun Pembimbing berhasil dibuat');
            return redirect()->route('pembimbing.index')->with('success', 'Pembimbing added successfully!');
        }
    }

    public function edit($id)
    {
        $pembimbing = Pembimbing::findOrFail($id);
        return view('pembimbing.update', ['pembimbing' => $pembimbing]);
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'password' => 'sometimes|string|min:8', // Allow password to be empty
            'ttd' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'ttd.image' => 'File yang diunggah harus berupa gambar',
            'ttd.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'ttd.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        // Check if a Pembimbing with the same nip already exists
        $existingPembimbing = Pembimbing::where('nip', $validatedData['nip'])->where('id', '!=', $id)->first();

        if ($existingPembimbing) {
            // Handle the case where a Pembimbing with the same nip already exists
            Alert::error('Error', 'Nip sudah ada');
            return redirect()->route('pembimbing.edit', $id)->with('error', 'Failed to update Pembimbing');
        } else {
            // Find the Pembimbing by ID
            $pembimbing = Pembimbing::findOrFail($id);

            if ($request->hasFile('ttd')) {
                // Delete the old image if it exists
                Storage::delete("public/images/{$pembimbing->ttd}");

                // Upload and store the new image
                $image = $request->file('ttd');
                $namafile = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/images', $namafile);
            } else {
                // If no new image is provided, keep the existing image
                $namafile = $pembimbing->ttd;
            }

            // Update Pembimbing details
            $pembimbing->update([
                'nama' => $validatedData['nama'],
                'nip' => $validatedData['nip'],
                'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $pembimbing->password,
                'ttd' => $namafile,
            ]);

            // Redirect back with a success message
            Alert::success('Success', 'Akun Pembimbing berhasil di Update');
            return redirect()->route('pembimbing.index')->with('success', 'Pembimbing updated successfully!');
        }
    }


    public function destroy($id)
    {
        // Temukan Pembimbing berdasarkan ID
        $pembimbing = Pembimbing::findOrFail($id);

        if (Storage::disk('public')->exists('images/' . $pembimbing->ttd)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete('images/' . $pembimbing->ttd);
        }

        // Loop through each Peserta and delete related Keterangan
        foreach ($pembimbing->peserta as $peserta) {
            // Hapus catatan terkait Keterangan
            Keterangan::where('id_peserta', $peserta->id)->delete();
        }

        $pembimbing->delete();

        // Redirect kembali dengan pesan sukses
        Alert::success('Success', 'Akun Pembimbing berhasil dihapus');
        return redirect()->route('pembimbing.index')->with('success', 'Pembimbing berhasil dihapus!');
    }
}
