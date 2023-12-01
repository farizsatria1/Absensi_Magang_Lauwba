<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class WebCarouselController extends Controller
{
    public function index(Request $request)
    {
        $carousel = Carousel::latest()->paginate(10);
        return view('carousel.carousel', [
            'carousel' => $carousel,
        ]);
    }

    public function create()
    {
        return view('carousel.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'image.required' => 'Kolom gambar harus di isi',
                'image.image' => 'File yang diunggah harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ]
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $namafile);

            $carousel = new Carousel();
            $carousel->image = $namafile; // Simpan hanya nama file gambar

            $carousel->save();

            Alert::success('Success', 'Gambar berhasil dibuat');
            return redirect()->route('carousel.index')->with('success', 'Gambar berhasil ditambahkan');
        } else {
            Alert::error('Error', 'Ada kesalahan saat menambahkan gambar. Silakan coba lagi.');
            return back()->with('error', 'Gagal Menambah Gambar.');
        }
    }



    public function edit($id)
    {
        $carousel = Carousel::find($id);
        return view('carousel.update', [
            'carousel' => $carousel,
        ]);
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $this->validate(
            $request,
            [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'image.required' => 'Kolom gambar harus di isi',
                'image.image' => 'File yang diunggah harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ]
        );

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($carousel->image && Storage::disk('public')->exists('images/' . $carousel->image)) {
                Storage::disk('public')->delete('images/' . $carousel->image);
            }

            // Simpan gambar baru
            $image = $request->file('image');
            $namafile = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $namafile);

            // Simpan hanya nama file gambar
            $carousel->image = $namafile;
            $carousel->save();

            Alert::success('Success', 'Gambar berhasil diperbarui');
            return redirect()->route('carousel.index')->with('success', 'Gambar berhasil diperbarui');
        } else {
            Alert::error('Error', 'Ada kesalahan saat memperbarui gambar. Silakan coba lagi.');
            return back()->with('error', 'Gagal Memperbarui Gambar.');
        }
    }

    public function destroy(Request $request, $id)
    {
        // Find the Carousel by ID
        $carousel = Carousel::findOrFail($id);

        if (Storage::disk('public')->exists('images/' . $carousel->image)) {
            // Hapus gambar dari penyimpanan jika ada
            Storage::disk('public')->delete('images/' . $carousel->image);
        }

        $carousel->delete();
        // Redirect back or to a specific route
        Alert::success('Success', 'Gambar berhasil di Hapus');
        return redirect()->route('carousel.index');
    }
}
