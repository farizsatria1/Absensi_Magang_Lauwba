<?php

namespace App\Http\Controllers;

use App\Exports\ExportProgress;
use App\Models\Pekerjaan;
use App\Models\Peserta;
use App\Models\ProgressMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class WebProgressController extends Controller
{
    public function index(Request $request)
    {
        $progress = ProgressMagang::latest()->paginate(10);
        return view('peserta.progress.progress', ['progress' => $progress]);
    }

    public function cetakProgressAll(Request $request, $id_peserta)
    {
        $progress = ProgressMagang::whereHas('pekerjaan', function ($query) use ($id_peserta) {
            $query->where('id_peserta', $id_peserta);
        })->with(['peserta', 'pembimbing'])->get();

        $tanggal = ProgressMagang::select(DB::raw('DATE(created_at) as tgl'))->whereHas('pekerjaan', function ($query) use ($id_peserta) {
            $query->where('id_peserta', $id_peserta);
        })->groupBy('tgl')->get();

        if ($progress->isEmpty()) {
            return view('cetak.notfound.404_progress');
        }

      
        $data = [];
        foreach ($tanggal as $index => $value) {
            $data[$index] = $value->tgl;
        }


        $res = [];
        
        foreach($data as $idxData => $valData){
            $no = 0;
            foreach ($progress as $idxProgress => $valProgress) {
                
                if ($valData != ($valProgress->created_at)->format('Y-m-d')) {
                    continue;
                }
                $no++;
                $res[$idxData][$valData][(int) $no] = $valProgress;
            }
        }
       

        return view('cetak.cetak_progress', ['progress' => $progress]);
    }

    public function export_excel($id_peserta)
    {
        return Excel::download(new ExportProgress($id_peserta),"progress.xlsx");
    }

    public function cetakProgressBulanan(Request $request, $id_peserta)
    {
        $bulan = $request->input('bulan'); // misalnya kita ingin data dari bulan tertentu

        $progress = ProgressMagang::whereHas('pekerjaan', function ($query) use ($id_peserta) {
            $query->where('id_peserta', $id_peserta);
        })->whereMonth('created_at', $bulan)->with(['peserta', 'pembimbing'])->get();

        if ($progress->isEmpty()) {
            return view('cetak.notfound.404_progress');
        }

        return view('cetak.cetak_progress', ['progress' => $progress]);
    }

    public function filter(Request $request)
    {
        // Ambil peserta yang dipilih dari permintaan
        $participantId = $request->input('participant');

        // Filter data progres berdasarkan peserta dengan join ke Pekerjaan
        $progress = ProgressMagang::join('pekerjaan', 'progress.id_pekerjaan', '=', 'pekerjaan.id')
            ->where('pekerjaan.id_peserta', $participantId)
            ->get();

        // Ambil daftar peserta
        $pesertaList = Peserta::pluck('nama', 'id');
        // dd($pesertaList);

        return view('peserta.progress.progress', [
            'progress' => $progress,
            'pesertaList' => $pesertaList,
        ]);
    }
}
