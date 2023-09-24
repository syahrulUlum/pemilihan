<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    use HasFactory;
    protected $fillable = [
        "siswa_id",
        "staff_id",
        "jadwal_id",
        "calon_id",
    ];
}
