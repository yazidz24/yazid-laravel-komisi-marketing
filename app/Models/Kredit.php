<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penjualan;

class Kredit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'kredit';
    protected $guarded = ['id'];

    public function penjualan(){
        return $this->belongsTo(Penjualan::class,'penjualan_id');
    }
}
