<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $jalur;

    function __construct($jalur)
    {
        $this->jalur = $jalur;
    }
    public function collection()
    {
        return Siswa::where('jalur', $this->jalur)->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'username_siswa',
            'id_pendaftaran',
            'nisn',
            'nama_siswa',
            'j_kelamin',
            't_lahir',
            'tgl_lahir',
            'agama',
            'alamat',
            'no_hp',
            'asal_sekolah',
            'nama_sekolah',
            'nama_ayah',
            'hp_ayah',
            'pendidikan_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'nama_ibu',
            'hp_ibu',
            'pendidikan_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'nilai_bindo',
            'nilai_matematika',
            'nilai_ipa',
            'rapot_bindo',
            'rapot_matematika',
            'rapot_ipa',
            'rapot_bing',
            'total_nilai_berkas',
            'pilihan_1',
            'pilihan_2',
            'foto',
            'jalur',
            'status_seleksi',
            'username_admin',
            'created_at',
            'updated_at',
            'status_du',
            'nik',
            'npsn',
        ];
    }
}
