<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //eccezioni alla regola
        //utente founder
        User::create([
            'name' => 'Vale Found',
            'email' => 'ValeFounder@app.com',
            'password' => Hash::make('123456789'),
            'role' => 'founder',
        ]);
        

        //utente normale per test
        User::create([
            'name' => 'Mario User',
            'email' => 'user@app.com',
            'password' => Hash::make('1234567890'),
            'role' => 'user',
        ]);
        
        //editor per test
        User::create([
            'name' => 'Ugo Editor',
            'email' => 'editor@app.com',
            'password' => Hash::make('1234567890'),
            'role' => 'editor',
        ]);
    }
}
