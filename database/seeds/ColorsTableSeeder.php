<?php

use App\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['name_en' => 'Red', 'name_ar' => 'احمر', 'code' => '#D32F2F'],
            ['name_en' => 'Blue', 'name_ar' => 'ازرق', 'code' => '#448AFF'],
            ['name_en' => 'Green', 'name_ar' => 'اخضر', 'code' => '#388E3C'],
            ['name_en' => 'Yellow', 'name_ar' => 'اصفر', 'code' => '#FFEB3B'],
            ['name_en' => 'Gray', 'name_ar' => 'رمادى', 'code' => '#757575'],
            ['name_en' => 'White', 'name_ar' => 'ابيض', 'code' => '#FFFFFF'],
            ['name_en' => 'Black', 'name_ar' => 'اسود', 'code' => '#000000'],
            ['name_en' => 'Purple', 'name_ar' => 'بنفسجى', 'code' => '#7B1FA2'],
            ['name_en' => 'Bink', 'name_ar' => 'وردى', 'code' => '#E91E63'],
            ['name_en' => 'Orange', 'name_ar' => 'برتقالى', 'code' => '#FF9800'],
        ];

        foreach($colors  as $color){
            Color::create([
                'name_en' => $color['name_en'],
                'name_ar' => $color['name_ar'],
                'code' => $color['code'],
            ]);
        }
    }
}
