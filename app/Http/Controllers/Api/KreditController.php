<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kredit;

class KreditController extends Controller
{
    public function index(){
        $kredit = Kredit::with('penjualan')->get();

        return response()->json([
            'success'=>true,
            'message'=>'Data kredit',
            'data'=>$kredit
        ],200);
    }

    public function store(Request $request){

        $cek = Kredit::where('penjualan_id',$request->penjualan_id);

        if ($cek->count() > 0) {
            if ($request->total_amount < $cek->first()->grand_total) {
                $cek->update([
                    'total_amount'=>$request->total_amount,
                    'status'=>'Belum lunas'
                ]);

                return response()->json([
                    'success'=>true,
                    'message'=>'Berhasil bayar kredit'
                ],200);
            }
            elseif ($request->total_amount >= $cek->first()->grand_total) {
                $cek->update([
                    'total_amount'=>$request->total_amount,
                    'status'=>'Sudah lunas'
                ]);
                return response()->json([
                    'success'=>true,
                    'message'=>'Berhasil bayar kredit'
                ],200);
            }
        }else{

            Kredit::create([
                'penjualan_id'=>$request->penjualan_id,
                'grand_total'=>$request->grand_total,
                'total_amount'=>$request->total_amount,
                'status'=>'Belum lunas'
            ]);

            return response()->json([
                'success'=>true,
                'message'=>'Berhasil bayar kredit'
            ],200);
        }
    }
}
