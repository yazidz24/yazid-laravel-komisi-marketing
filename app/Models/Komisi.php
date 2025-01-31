<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komisi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'komisi';
    protected $guarded = ['id'];
}
