<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\Pembimbing;
use App\Models\Peserta;
use App\Models\ProgressMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WebPesertaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // If a search term is provided, search for Peserta by name
        if ($search) {
            $peserta = Peserta::where('nama', 'like', '%' . $search . '%')->latest()->paginate(10);
        } else {
            // Otherwise, get all Peserta
            $peserta = Peserta::latest()->paginate(10);
        }

        return view('peserta.register.peserta', [
            'peserta' => $peserta,
        ]);
    }


    public function create()
    {
        $pembimbingList = Pembimbing::pluck('nama', 'id');
        return view('peserta.register.create', compact('pembimbingList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'asal' => ['required'],
            'asal_sekolah' => ['required'],
            'nama_pgl' => ['required'],
            'id_pembimbing' => ['required'],
            'tgl_mulai' => ['required'],
            'username' => ['required', 'unique:peserta'], // Ensure the username is unique
            'password' => ['required'],
            'status' => ['required'],
            'ttd' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'ttd.required' => 'Kolom gambar harus di isi',
            'ttd.image' => 'File yang diunggah harus berupa gambar',
            'ttd.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'ttd.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        // Create a new instance of YourModel with the validated data
        $peserta = new Peserta();
        $peserta->nama = $request->nama;
        $peserta->asal = $request->asal;
        $peserta->asal_sekolah = $request->asal_sekolah;
        $peserta->nama_pgl = $request->nama_pgl;
        $peserta->id_pembimbing = $request->id_pembimbing;
        $peserta->tgl_mulai = $request->tgl_mulai;
        $peserta->username = $request->username;
        $peserta->password = bcrypt($request->password); // Hash the password
        $peserta->status = $request->status;

        if ($request->hasFile('ttd')) {
            $ttd = $request->file('ttd');
            $ttdName = time() . '.' . $ttd->getClientOriginalExtension();
            $ttdPath = $ttd->storeAs('public/images', $ttdName);

            // Save the image filename to the database
            $peserta->ttd = $ttdName;
        }

        // Try to save the model to the database
        if ($peserta->save()) {
            // If save was successful
            Alert::success('Success', 'Akun Peserta berhasil dibuat');
            return redirect()->route('peserta.index')->with('success', 'Peserta added successfully!');
        } else {
            // If save failed
            Alert::error('Error', 'Ada kesalahan saat membuat akun Peserta. Silakan coba lagi.');
            return redirect()->route('peserta.create')->with('error', 'Failed to add Peserta');
        }
    }

    public function destroy(Request $request, $id)
    {
        // Find the Peserta by ID
        $peserta = Peserta::findOrFail($id);

        if (Storage::disk('public')->exists('images/' . $peserta->ttd)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete('images/' . $peserta->ttd);
        }
        $peserta->delete();
        // Redirect back or to a specific route
        Alert::success('Success', 'Akun Peserta berhasil di Hapus');
        return redirect()->route('peserta.index');
    }

    public function edit($id)
    {
        $peserta = Peserta::find($id);
        $pembimbingList = Pembimbing::pluck('nama', 'id'); // Adjust this based on your actual model

        return view('peserta.register.update', compact('peserta', 'pembimbingList'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'asal' => ['required'],
            'asal_sekolah' => ['required'],
            'nama_pgl' => ['required'],
            'id_pembimbing' => ['required'],
            'tgl_mulai' => ['required'],
            'username' => ['required'],
            'status' => ['required'],
            'ttd' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'ttd.image' => 'File yang diunggah harus berupa gambar',
            'ttd.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'ttd.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        // Find the Peserta by ID
        $peserta = Peserta::findOrFail($id);

        // Update the Peserta with the validated data
        $peserta->nama = $request->nama;
        $peserta->asal = $request->asal;
        $peserta->asal_sekolah = $request->asal_sekolah;
        $peserta->nama_pgl = $request->nama_pgl;
        $peserta->id_pembimbing = $request->id_pembimbing;
        $peserta->tgl_mulai = $request->tgl_mulai;
        $peserta->username = $request->username;
        $peserta->status = $request->status;

        // Check if a new password is provided and update it
        if ($request->has('password')) {
            $this->validate($request, [
                'password' => ['required'],
            ]);

            $peserta->password = bcrypt($request->password); // Hash the new password
        }

        // Check if a new image is provided and update it
        if ($request->hasFile('ttd')) {
            $this->validate($request, [
                'ttd' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);

            // Delete the old image
            Storage::delete('public/images/' . $peserta->ttd);

            // Store the new image
            $image = $request->file('ttd');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);

            // Save the image filename to the database
            $peserta->ttd = $imageName;
        }

        // Save the updated model to the database
        $peserta->save();

        // Redirect back or to a specific route
        Alert::success('Success', 'Akun Peserta berhasil di Update');
        return redirect()->route('peserta.index');
    }
}
