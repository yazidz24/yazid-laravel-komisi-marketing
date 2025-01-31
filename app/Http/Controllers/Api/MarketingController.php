<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marketing;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketing = Marketing::all();

        if ($marketing) {
            # code...
            return response()->json([
                'success'=>true,
                'message'=>'Data marketing',
                'data'=> $marketing
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Data tidak ditemukan',
                'data'=> $marketing
            ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $marketing = Marketing::create([
            'name'=>$request->name
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Data Marketing berhasil disimpan',
            'data'=> $marketing
        ],200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $marketing = Marketing::findOrfail($id)->update([
            'name'=>$request->name
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Data Marketing berhasil diupdate',
            'data'=> $marketing
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marketing = Marketing::findOrfail($id)->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Data Marketing berhasil dihapus',
            'data'=> $marketing
        ],200);
    }
}
