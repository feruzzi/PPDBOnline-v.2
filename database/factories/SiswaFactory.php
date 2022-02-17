<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Siswa;
use App\Models\SetPendaftaran;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $x = Siswa::pluck('username_siswa');
        for ($i = 0; $i < count($x); $i++) {
            $y[$i] = $x[$i];
        }
        $username_siswa = User::where('level', 2)->whereNotIn('username', $y)->get()->random();
        $formatid = SetPendaftaran::where('id', 1)->pluck('set_kode_pendaftaran')->first();
        $id_pendaftaran = IdGenerator::generate(['table' => 'siswa', 'field' => 'id_pendaftaran', 'length' => strlen($formatid) + 3, 'prefix' => $formatid, 'reset_on_prefix_change' => true]);

        return [
            'username_siswa' => $username_siswa->username,
            'id_pendaftaran' => $id_pendaftaran,
            'nisn' => $this->faker->numberBetween(1000000000, 9000000000),
            'nama_siswa' => $this->faker->name(),
            'j_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            't_lahir' => $this->faker->city(),
            'tgl_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katholik', 'Budda']),
            'alamat' => $this->faker->address,
            'no_hp' => $this->faker->numberBetween(1000000000, 9000000000),
            'asal_sekolah' => $this->faker->randomElement(['SMP', 'MTs']),
            'nama_sekolah' => $this->faker->company(),
            'nama_ayah' => $this->faker->name(),
            'hp_ayah' => $this->faker->numberBetween(1000000000, 9000000000),
            'pendidikan_ayah' => $this->faker->randomElement(['S1', 'S2', 'S3']),
            'pekerjaan_ayah' => $this->faker->randomElement(['PNS', 'Buruh', 'Tani']),
            'penghasilan_ayah' => $this->faker->randomElement(['1jt-3jt', '5jt-10jt']),
            'nama_ibu' => $this->faker->name(),
            'hp_ibu' => $this->faker->numberBetween(1000000000, 9000000000),
            'pendidikan_ibu' => $this->faker->randomElement(['S1', 'S2', 'S3']),
            'pekerjaan_ibu' => $this->faker->randomElement(['PNS', 'Buruh', 'Tani']),
            'penghasilan_ibu' => $this->faker->randomElement(['1jt-3jt', '5jt-10jt']),
            'nilai_bindo' => $this->faker->numberBetween(0, 100),
            'nilai_matematika' => $this->faker->numberBetween(0, 100),
            'nilai_ipa' => $this->faker->numberBetween(0, 100),
            'rapot_bindo' => $this->faker->numberBetween(0, 100),
            'rapot_matematika' => $this->faker->numberBetween(0, 100),
            'rapot_ipa' => $this->faker->numberBetween(0, 100),
            'rapot_bing' => $this->faker->numberBetween(0, 100),
            'total_nilai_berkas' => $this->faker->numberBetween(0, 500),
            'pilihan_1' => $this->faker->randomElement(['10-A1', '10-A2', '10-AG']),
            'pilihan_2' => $this->faker->randomElement(['10-A1', '10-A2', '10-AG']),
            'foto' => "img/foto" . $id_pendaftaran . ".jpg",
            'jalur' => $formatid,
            'status_seleksi' => "Seleksi",
        ];
    }
}
