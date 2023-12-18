<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use App\Models\Peserta;
use App\Models\Piket;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WebPiketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        if ($filter == 'pembimbing') {
            $piket = Piket::whereNotNull('id_pembimbing')->with('pembimbing');
        } elseif ($filter == 'peserta') {
            $piket = Piket::whereNotNull('id_peserta')->with('peserta');
        } else {
            $piket = new Piket;
        }

        if ($search) {
            // Assuming 'nama' is a field in the related models (Pembimbing or Peserta)
            $piket = $piket->whereHas('pembimbing', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            })->orWhereHas('peserta', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            });
        }

        $piket = $piket->latest()->paginate(10);

        return view('piket.piket', [
            'piket' => $piket,
        ]);
    }



    public function create()
    {
        $pembimbingList = Pembimbing::pluck('nama', 'id');
        $pesertaList = Peserta::pluck('nama', 'id');
        return view('piket.create', compact(['pembimbingList', 'pesertaList']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hari' => ['required'],
            'id_pembimbing' => ['nullable'],
            'id_peserta' => ['nullable'],
        ]);

        // Create a new instance of YourModel with the validated data
        $piket = new Piket();
        $piket->hari = $request->hari;
        $piket->id_pembimbing = $request->id_pembimbing;
        $piket->id_peserta = $request->id_peserta;

        // Try to save the model to the database
        if ($piket->save()) {
            // If save was successful
            Alert::success('Success', 'Jadwal Piket berhasil dibuat');
            return redirect()->route('piket.index')->with('success', 'Piket added successfully!');
        } else {
            // If save failed
            Alert::error('Error', 'Ada kesalahan saat membuat jadwal Piket. Silakan coba lagi.');
            return redirect()->route('piket.create')->with('error', 'Failed to add Piket');
        }
    }

    public function edit($id)
    {
        $piket = Piket::find($id);
        $pembimbingList = Pembimbing::pluck('nama', 'id');
        $pesertaList = Peserta::pluck('nama', 'id');
        return view('piket.update', compact(['piket', 'pembimbingList', 'pesertaList']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hari' => ['required'],
            'id_pembimbing' => ['nullable'],
            'id_peserta' => ['nullable'],
        ]);

        // Find the Peserta by ID
        $piket = Piket::findOrFail($id);

        // Update the Peserta with the validated data
        $piket->hari = $request->hari;
        $piket->id_pembimbing = $request->id_pembimbing;
        $piket->id_peserta = $request->id_peserta;

        // Save the updated model to the database
        $piket->save();

        // Redirect back or to a specific route
        Alert::success('Success', 'Jadwal Piket berhasil di Update');
        return redirect()->route('piket.index');
    }

    public function destroy(Request $request, $id)
    {
        $piket = Piket::findOrFail($id);
        $piket->delete();
        // Redirect back or to a specific route
        Alert::success('Success', 'Jadwal Piket berhasil di Hapus');
        return redirect()->route('piket.index');
    }
}
