<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Joseph',
            'last_name' => 'Makram',
            'email' => 'jojo@test.com',
            'address' => 'Egypt, 10th of ramadan',
            'age' => '20',
            'gender' => 'male',
            'password' => bCrypt('12345678')
        ])->attachRole('admin');

        $this->command->info("{$user->fullName()} Account created successfully");
    }
}
