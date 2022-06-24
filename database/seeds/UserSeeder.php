<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'nama' => 'Admin',
                'no_hp' => '081234567890',
                'email' => 'admin@email.com',
                'password' => Hash::make('123'),
                'role_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Dr. John',
                'no_hp' => '081234567879',
                'email' => 'john@email.com',
                'password' => Hash::make('123'),
                'role_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Pasien 1',
                'no_hp' => '081234567899',
                'email' => 'pasien1@email.com',
                'password' => Hash::make('321'),
                'role_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        User::find(2)->dokter()->create();

        User::find(3)->pasien()->create([
            'tanggal_lahir' => Carbon::create(1999, 10, 15),
            'alamat' => 'Jl. Jalan No. 8'
        ]);
    }
}
