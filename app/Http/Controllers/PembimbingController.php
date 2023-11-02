<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListPembimbingResource;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public $table = "pembimbing";

    public function index()
    {
        $pembimbings = Pembimbing::all();
        return ListPembimbingResource::collection($pembimbings);
    }

    public function login(Request $request)
    {
        try {
            $nip = $request->nip;
            $password = $request->password;
            $pembimbing = Pembimbing::where('nip', $nip)->where('password', $password)->first();
            if ($pembimbing) {
                return response()->json([
                    'id' => $pembimbing->id,
                    'nama' => $pembimbing->nama,
                    'nip' => $pembimbing->nip,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Login failed'], 401);
    }
}
