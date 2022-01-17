<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
    protected $table = 'berkas';
    protected $guarded = [
        'id',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'username_berkas', 'username_siswa');
    }
}
