<?php

namespace App\Exports;

use App\Models\ProgressMagang;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProgress implements FromCollection, WithHeadings
{
    protected $id_peserta;

    public function __construct($id_peserta)
    {
        $this->id_peserta = $id_peserta;
    }

    public function collection()
    {
        Carbon::setLocale('id'); // Set the locale to Bahasa Indonesia

        $data = ProgressMagang::selectRaw('DATE_FORMAT(progress.created_at, "%W, %e %M %Y") as created_at_formatted, pekerjaan.judul as project, progress.catatan as catatan, progress.foto_dokumentasi as foto_dokumentasi, IF(progress.trainer_peserta, peserta.nama, IF(progress.trainer_pembimbing, pembimbing.nama, "Tanda tangan tidak tersedia")) as trainer')
            ->join('pekerjaan', 'progress.id_pekerjaan', '=', 'pekerjaan.id')
            ->leftJoin('peserta', 'progress.trainer_peserta', '=', 'peserta.id')
            ->leftJoin('pembimbing', 'progress.trainer_pembimbing', '=', 'pembimbing.id')
            ->where('pekerjaan.id_peserta', $this->id_peserta)
            ->with(['peserta', 'pembimbing'])
            ->get()
            ->map(function ($item) {
                $item->created_at_formatted = Carbon::parse($item->created_at_formatted)->translatedFormat('l, d F Y');
                $item->foto_dokumentasi = url('storage/images/') . '/' . $item->foto_dokumentasi; // Ubah menjadi URL lengkap
                return $item;
            });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Project',
            'Catatan',
            'Dokumentasi',
            'Trainer'
        ];
    }
}
