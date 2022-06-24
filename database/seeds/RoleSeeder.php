<?php

use App\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['nama' => 'Admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Dokter', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nama' => 'Pasien', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
