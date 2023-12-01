<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
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
        ]);

        // Check if a Pembimbing with the same nip already exists
        $existingPembimbing = Pembimbing::where('nip', $validatedData['nip'])->first();

        if ($existingPembimbing) {
            // Handle the case where a Pembimbing with the same nip already exists
            Alert::error('Error', 'Nip sudah ada');
            return redirect()->route('pembimbing.create')->with('error', 'Failed to add Pembimbing');
        } else {
            // Create a new Pembimbing instance and save it to the database
            $pembimbing = Pembimbing::create([
                'nama' => $validatedData['nama'],
                'nip' => $validatedData['nip'],
                'password' => bcrypt($validatedData['password']), // Hash the password before saving
            ]);

            Alert::success('Success', 'Akun Pembimbing berhasil dibuat');
            return redirect()->route('pembimbing.index')->with('success', 'Pembimbing added successfully!');
        }
    }


    public function destroy($id)
    {
        // Temukan Pembimbing berdasarkan ID
        $pembimbing = Pembimbing::findOrFail($id);

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
        ]);

        // Check if a Pembimbing with the same nip already exists
        $existingPembimbing = Pembimbing::where('nip', $validatedData['nip'])->first();

        if ($existingPembimbing && $existingPembimbing->id != $id) {
            // Handle the case where a Pembimbing with the same nip already exists
            Alert::error('Error', 'Nip sudah ada');
            return redirect()->route('pembimbing.edit', $id)->with('error', 'Failed to update Pembimbing');
        } else {
            // Find the Pembimbing by ID
            $pembimbing = Pembimbing::findOrFail($id);

            // Update Pembimbing details
            $pembimbing->update([
                'nama' => $validatedData['nama'],
                'nip' => $validatedData['nip'],
                'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $pembimbing->password,
            ]);

            // Redirect back with a success message
            Alert::success('Success', 'Akun Pembimbing berhasil di Update');
            return redirect()->route('pembimbing.index')->with('success', 'Pembimbing updated successfully!');
        }
    }
}
