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
            ['name_en' => 'Light Blue', 'name_ar' => 'ازرق فاتح', 'code' => '#448AFF'],
            ['name_en' => 'Light Green', 'name_ar' => 'اخضر فاتح', 'code' => '#8BC34A'],
            ['name_en' => 'Yellow', 'name_ar' => 'اصفر', 'code' => '#FFEB3B'],
            ['name_en' => 'Gray', 'name_ar' => 'رمادى', 'code' => '#757575'],
            ['name_en' => 'White', 'name_ar' => 'ابيض', 'code' => '#FFFFFF'],
            ['name_en' => 'Black', 'name_ar' => 'اسود', 'code' => '#000000'],
            ['name_en' => 'Purple', 'name_ar' => 'بنفسجى', 'code' => '#7B1FA2'],
            ['name_en' => 'Bink', 'name_ar' => 'وردى', 'code' => '#E91E63'],
            ['name_en' => 'Orange', 'name_ar' => 'برتقالى', 'code' => '#FF9800'],
            ['name_en' => 'Gold', 'name_ar' => 'ذهبى', 'code' => '#ffd700'],
            ['name_en' => 'Silver', 'name_ar' => 'فضى', 'code' => '#c0c0c0'],
            ['name_en' => 'Bronze', 'name_ar' => 'برونزى', 'code' => '#cd7f32'],
            ['name_en' => 'Brown', 'name_ar' => 'بنى', 'code' => '#a52a2a'],
            ['name_en' => 'Crimson', 'name_ar' => 'نبيتى', 'code' => '#dc143c'],
            ['name_en' => 'Dark Green', 'name_ar' => 'اخضر غامق', 'code' => '#4CAF50'],
            ['name_en' => 'Dark Blue', 'name_ar' => 'ازرق غامق', 'code' => '#00041d'],
            ['name_en' => 'Oil Color', 'name_ar' => 'زيتى', 'code' => '#003100'],
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
