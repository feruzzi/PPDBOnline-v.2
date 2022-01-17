<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPendaftaran extends Model
{
    use HasFactory;
    // ! Cara Ganti agar nama tabel agar tidak Plural
    protected $table = 'detail_pendaftaran';
    // !END
    protected $guarded = [
        'id',
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'detail_kode_kelas', 'kode_kelas');
    }
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'detail_kode_pendaftaran', 'kode_pendaftaran');
    }
}
