<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_matrix extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_matrix';

    protected $fillable = ['id', 'panjang', 'tinggi'];
}
