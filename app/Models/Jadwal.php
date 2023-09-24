<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        "kategori_id",
        "mulai",
        "selesai"
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
