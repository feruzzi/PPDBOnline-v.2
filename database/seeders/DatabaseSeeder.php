<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::factory(120)->create();
        for ($i = 0; $i < 120; $i++) {

            Siswa::factory(1)->create();
        }
    }
}
