<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPendaftaran extends Model
{
    use HasFactory;
    protected $table = 'set_pendaftaran';
    protected $guarded = [
        'id',
    ];
    public function dtl_pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'set_kode_pendaftaran', 'kode_pendaftaran');
    }
}
