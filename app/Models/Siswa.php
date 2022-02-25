<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $guarded = [
        'id',
    ];
    public function berkas()
    {
        return $this->hasMany(Berkas::class, 'id_pendaftaran_berkas', 'id_pendaftaran');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'username_siswa', 'username');
    }
}
