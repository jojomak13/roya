<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = Category::create([
            'name_en' => 'Smart Phones',
            'name_ar' => 'الهواتف الذكية',
            'parent_id' => '0'
        ]);

        Category::create([
            'name_en' => 'IPhones',
            'name_ar' => 'أيفون',
            'parent_id' => $cat->id
        ]);

        $cat = Category::create([
            'name_en' => 'Audio Devices',
            'name_ar' => 'أجهزة الصوت',
            'parent_id' => '0'
        ]);

        Category::create([
            'name_en' => 'Speakers',
            'name_ar' => 'السماعات',
            'parent_id' => $cat->id
        ]);

        $cat = Category::create([
            'name_en' => 'Computers',
            'name_ar' => 'أجهزة كمبيوتر',
            'parent_id' => '0'
        ]);

        Category::create([
            'name_en' => 'Laptops',
            'name_ar' => 'لابتوب',
            'parent_id' => $cat->id
        ]);
    }
}
