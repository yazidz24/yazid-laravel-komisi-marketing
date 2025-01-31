<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penjualan;

class Marketing extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'marketing';
    protected $guarded = ['id'];

    public function penjualan(){
        return $this->hasMany(Penjualan::class,'marketing_id');
    }
}
