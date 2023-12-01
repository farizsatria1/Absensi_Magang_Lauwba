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
}
