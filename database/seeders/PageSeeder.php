<?php

namespace Database\Seeders;

use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=12 ; $i++) { 
            Page::create([
                'title' => 'Test page '.$i,
                'slug' => Str::slug('Test page'. $i),
                'position' => rand(1,10),
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            ]);
        }
    }
}

