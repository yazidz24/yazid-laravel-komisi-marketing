<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Komisi;
use App\Models\Marketing;
use Illuminate\Support\Carbon;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::all();

        return response()->json([
            'success'=>true,
            'message'=>'Data penjualan',
            'data'=>$penjualan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $transactionNumber = Penjualan::generateTransactionNumber();
            $grandTotal = $request->cargo_fee + $request->total_balance;

            $penjualan = Penjualan::create([
                'transaction_number'=> $transactionNumber,
                'marketing_id'=>$request->marketing_id,
                'date'=>$request->date,
                'cargo_fee'=>$request->cargo_fee,
                'total_balance'=>$request->total_balance,
                'grand_total'=>$grandTotal
            ]);

            $komisi = $this->komisi($request->date,$request->marketing_id);
            if ($penjualan) {
                return response()->json([
                    'success'=>true,
                    'message'=>'Berhasil input data penjualan',
                    'data'=>$penjualan
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Gagal input data penjualan',
                ],500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function komisi($date,$id){
        $conversionM = Carbon::parse($date)->format('m');
        $name = Marketing::findOrFail($id)->name;
        $cekOmset = Penjualan::whereMonth('date',$conversionM)->orderBy('created_at','desc')
        ->sum('total_balance');

        if($cekOmset >= 0 && $cekOmset <= 100000000){
            $komisiNasional = (0 * $cekOmset) / 100;
            $komisiPersen = '0%';

        }elseif($cekOmset >= 100000000 && $cekOmset <= 200000000){
            $komisiNasional = (2.5 * $cekOmset) / 100;
            $komisiPersen = '2.5%';

        }elseif($cekOmset >= 200000000 && $cekOmset <= 500000000){
            $komisiNasional = (5 * $cekOmset) / 100;
            $komisiPersen = '5%';
        }else{
            $komisiNasional = (10 * $cekOmset) / 100;
            $komisiPersen = '10%';
        }

        $komisi = Komisi::where('bulan',$conversionM)->where('marketing',$name);

        if ($komisi->count() > 0) {

            $komisi = $komisi->first();
            $komisi->update([
                'omset'=>$cekOmset,
                'komisi'=>$komisiPersen,
                'komisi_nasional'=>$komisiNasional,
            ]);
        }else{
            $komisi = Komisi::create([
                'marketing'=>$name,
                'bulan'=>$conversionM,
                'omset'=>$cekOmset,
                'komisi'=>$komisiPersen,
                'komisi_nasional'=>$komisiNasional,
            ]);
        }

        return response()->json([
            'success'=>true,
            'message'=>'Komisi telah ditambahkan',
            'marketing'=>$komisi->marketing,
            'komisi %'=>$komisi->komisi,
            'komisi nasional'=>$komisi->komisi_nasional,
        ]);

        // Komisi::create([
        //     'komisi'=>$komisiQuantity
        // ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penjualan = Penjualan::where('id',$id)->first();

        return response()->json([
            'status'=>true,
            'message'=>'data ditemukan',
            'penjualan'=>$penjualan,
            'marketings'=>$penjualan->marketing()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $grandTotal = $request->cargo_fee + $request->total_balance;

            $penjualan = Penjualan::findOrFail($id)->update([
                'marketing_id'=>$request->marketing_id,
                'date'=>$request->date,
                'cargo_fee'=>$request->cargo_fee,
                'total_balance'=>$request->total_balance,
                'grand_total'=>$grandTotal
            ]);

            $komisi = $this->komisi($request->date,$request->marketing_id);
            if ($penjualan) {
                return response()->json([
                    'success'=>true,
                    'message'=>'Berhasil update data penjualan',
                    'data'=>$penjualan
                ]);
            }else{
                return response()->json([
                    'success'=>false,
                    'message'=>'Gagal update data penjualan',
                ],500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
