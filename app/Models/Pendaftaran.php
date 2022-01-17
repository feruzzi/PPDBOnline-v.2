<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    // ! Cara Ganti agar nama tabel agar tidak Plural
    protected $table = 'pendaftaran';
    // !END
    protected $guarded = [
        'id',
    ];
    public function details()
    {
        return $this->hasMany(DetailPendaftaran::class, 'detail_kode_pendaftaran', 'kode_pendaftaran');
    }
}
