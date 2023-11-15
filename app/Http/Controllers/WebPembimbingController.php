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
        $pembimbing = Pembimbing::latest()->paginate(10);

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

        // Create a new Pembimbing instance and save it to the database
        Pembimbing::create([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'password' => bcrypt($validatedData['password']), // Hash the password before saving
        ]);
        Alert::success('Berhasil!', 'Akun Pembimbing Berhasil dibuat');

        // Redirect back with a success message
        return redirect()->route('pembimbing.index')->with('success', 'Pembimbing added successfully!');
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

        // Soft delete Pembimbing
        $pembimbing->delete();

        // Redirect kembali dengan pesan sukses
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

        // Find the Pembimbing by ID
        $pembimbing = Pembimbing::findOrFail($id);

        // Update Pembimbing details
        $pembimbing->update([
            'nama' => $validatedData['nama'],
            'nip' => $validatedData['nip'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $pembimbing->password,
        ]);

        // Redirect back with a success message
        return redirect()->route('pembimbing.index')->with('success', 'Pembimbing updated successfully!');
    }
}
