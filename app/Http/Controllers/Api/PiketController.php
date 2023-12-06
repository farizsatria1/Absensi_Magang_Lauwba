<?php

namespace App\Http\Controllers\Api;

use App\Models\Piket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PiketController extends Controller
{
    public function piket(Request $request)
    {
        $piket = Piket::with('pembimbing', 'peserta')->get();
        return response()->json($piket);
    }

    public function piketPeserta(Request $request, $id_peserta)
    {
        // Assuming you have a Piket model with a relationship to Peserta model
        $piket = Piket::with('peserta')->where('id_peserta', $id_peserta)->first();

        return response()->json($piket);
    }
}
