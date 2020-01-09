<?php

use App\Store;
use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'المكتبة',
            'address' => 'العاشر من رمضان',
            'user_id' => User::first()->id
        ]);
    }
}
