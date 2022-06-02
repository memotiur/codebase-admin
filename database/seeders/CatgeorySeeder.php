<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatgeorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
           'category_title'=>"বাংলাদেশ"
        ]);
        Category::create([
           'category_title'=>"আমেরিকা"
        ]);
        Category::create([
           'category_title'=>"অর্থনীতি"
        ]);
        Category::create([
           'category_title'=>"বিনোদন"
        ]);
    }
}
