<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin123..'),
            'status' => '1',
            'id_usuario' => '0'
        ])->assignRole('Admin');
    }
}
