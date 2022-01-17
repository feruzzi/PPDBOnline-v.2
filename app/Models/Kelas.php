<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function detailsKelas()
    {
        return $this->hasMany(DetailPendaftaran::class, 'kode_kelas', 'detail_kode_kelas');
    }
}
