<?php

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
         'admin', 'divisi pembeli', 'divisi produksi'
        ];

        for ($i=0; $i < count($roles); $i++){
            Role::create([
                'role' => $roles[$i]
            ]);
        }


        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => '1',
            'password' => Hash::make('adminadmin')
        ]);

        User::create([
            'name' => 'pembeli',
            'email' => 'pembeli@gmail.com',
            'role_id' => '2',
            'password' => Hash::make('pembelipembeli')
        ]);

        User::create([
            'name' => 'produksi',
            'email' => 'produksi@gmail.com',
            'role_id' => '3',
            'password' => Hash::make('produksiproduksi')
        ]);



    }
}
