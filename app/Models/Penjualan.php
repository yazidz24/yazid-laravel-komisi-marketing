<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marketing;

class Penjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'penjualan';
    protected $guarded = ['id'];

    public static function generateTransactionNumber()
    {
        // Ambil transaksi terakhir
        $lastTransaction = self::orderBy('id', 'desc')->first();

        // Jika tidak ada transaksi, mulai dari TRX001
        if (!$lastTransaction) {
            return 'TRX001';
        }

        $lastNumber = (int) substr($lastTransaction->transaction_number, 3);

        $newNumber = $lastNumber + 1;

        return 'TRX' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
    public function marketing(){
        return $this->belongsTo(Marketing::class,'marketing_id');
    }
}
