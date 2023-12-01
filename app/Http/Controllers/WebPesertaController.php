<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\Pembimbing;
use App\Models\Peserta;
use App\Models\ProgressMagang;
use Illuminate\Http\Request;
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

        // Check if a new password is provided and update it
        if ($request->has('password')) {
            $this->validate($request, [
                'password' => ['required'],
            ]);

            $peserta->password = bcrypt($request->password); // Hash the new password
        }

        // Save the updated model to the database
        $peserta->save();

        // Redirect back or to a specific route
        Alert::success('Success', 'Akun Peserta berhasil di Update');
        return redirect()->route('peserta.index');
    }
}
