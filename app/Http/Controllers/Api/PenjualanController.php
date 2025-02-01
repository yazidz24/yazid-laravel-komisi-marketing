<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Komisi;
use App\Models\Marketing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        // Validasi input
        $transactionNumber = Penjualan::generateTransactionNumber();
        $validated = [
            'transaction_number' => $transactionNumber,
            'marketing_id' => $request->marketing_id,
            'date' => $request->date,
            'cargo_fee' => $request->cargo_fee,
            'total_balance' => $request->total_balance,
            'grand_total' => $request->cargo_fee + $request->total_balance
        ];

        DB::beginTransaction();
        try {
            // Step 1: Insert ke tabel penjualan
            $penjualan = Penjualan::create($validated);

            // Ambil data marketing
            $marketing = Marketing::find($request->marketing_id);

            // Ambil bulan dan tahun dari input date
            $date = Carbon::parse($request->date);
            $bulan = $date->locale('id')->monthName;
            $month = $date->month;
            $year = $date->year;

            // Hitung total omzet untuk marketing tersebut di bulan yang sama
            $totalOmzet = Penjualan::where('marketing_id', $request->marketing_id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->sum('total_balance');

            // Hitung persentase komisi berdasarkan total omzet
            if ($totalOmzet >= 500000000) {
                $persentase = 10;
            } elseif ($totalOmzet >= 200000000) {
                $persentase = 5;
            } elseif ($totalOmzet >= 100000000) {
                $persentase = 2.5;
            } else {
                $persentase = 0;
            }

            // Hitung nominal komisi
            $jml_komisi = $totalOmzet * ($persentase / 100);

            // Cek apakah sudah ada data komisi untuk marketing dan bulan tersebut
            $existingKomisi = Komisi::where('marketing', $marketing->name)
                ->where('bulan', $bulan)
                ->first();

            if ($existingKomisi) {
                // Update data komisi yang sudah ada
                $existingKomisi->update([
                    'omset' => $totalOmzet,
                    'komisi' => $persentase . '%',
                    'komisi_nasional' => $jml_komisi
                ]);
            } else {
                // Insert data komisi baru
                Komisi::create([
                    'marketing' => $marketing->name,
                    'bulan' => $bulan,
                    'omset' => $totalOmzet,
                    'komisi' => $persentase . '%',
                    'komisi_nasional' => $jml_komisi
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penjualan dan komisi berhasil disimpan',
                'data' => [
                    'penjualan' => $penjualan,
                    'komisi' => $existingKomisi ?? Komisi::where('marketing', $marketing->name)
                        ->where('bulan', $bulan)
                        ->first()
                ]
            ],200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
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
    public function update(Request $request, $id)
    {
        $transactionNumber = Penjualan::generateTransactionNumber();
        $validated = [
            'marketing_id' => $request->marketing_id,
            'date' => $request->date,
            'cargo_fee' => $request->cargo_fee,
            'total_balance' => $request->total_balance,
            'grand_total' => $request->cargo_fee + $request->total_balance
        ];

        DB::beginTransaction();
        try {
            // Step 1: Update data penjualan
            $penjualan = Penjualan::findOrFail($id)->update($validated);

            // Ambil data marketing
            $marketing = Marketing::find($request->marketing_id);

            // Ambil bulan dan tahun dari input date
            $date = Carbon::parse($request->date);
            $bulan = $date->locale('id')->monthName;
            $month = $date->month;
            $year = $date->year;

            // Hitung total omzet untuk marketing tersebut di bulan yang sama
            $totalOmzet = Penjualan::where('marketing_id', $request->marketing_id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->sum('total_balance');

            // Ketentuan komisi
            if ($totalOmzet >= 500000000) {
                $persentase = 10;
            } elseif ($totalOmzet >= 200000000) {
                $persentase = 5;
            } elseif ($totalOmzet >= 100000000) {
                $persentase = 2.5;
            } else {
                $persentase = 0;
            }

            // Hitung nominal komisi
            $jml_komisi = $totalOmzet * ($persentase / 100);

            // Cek apakah sudah ada data komisi untuk marketing dan bulan tersebut
            $existingKomisi = Komisi::where('marketing', $marketing->name)
                ->where('bulan', $bulan)
                ->first();

            if ($existingKomisi) {
                // Update data komisi yang sudah ada
                $existingKomisi->update([
                    'omset' => $totalOmzet,
                    'komisi' => $persentase . '%',
                    'komisi_nasional' => $jml_komisi
                ]);
            } else {
                // Insert data komisi baru
                Komisi::create([
                    'marketing' => $marketing->name,
                    'bulan' => $bulan,
                    'omset' => $totalOmzet,
                    'komisi' => $persentase . '%',
                    'komisi_nasional' => $jml_komisi
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data penjualan dan komisi berhasil diupdate',
                'data' => [
                    'penjualan' => $penjualan,
                    'komisi' => $existingKomisi ?? Komisi::where('marketing', $marketing->name)
                        ->where('bulan', $bulan)
                        ->first()
                ]
            ],200);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
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
