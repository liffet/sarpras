<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;
class Pengembalian extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'keterangan',
        'status',
        'foto',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}


