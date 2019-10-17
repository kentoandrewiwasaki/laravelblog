<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'rockiwasaki1984@gmail.com')->first();

        if(!$user) {
            User::create([
                'name' => 'Andrew',
                'email' => 'rockiwasaki1984@gmail.com',
                'password' => Hash::make('ivankov1984'), 
                'role' => 'admin'
            ]);
        }
    }
}
