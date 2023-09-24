<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Jurusan;
use App\Models\Kelas;

class Siswa extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        "name",
        "username",
        "password",
        "kelas_id",
        "jurusan_id",
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
