<?php

namespace Database\Seeders;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($i=1; $i <=6 ; $i++) { 
            MenuItem::create([
                'title' => 'link '.$i,
                'name' => 'link '.$i,
                'slug' => Str::slug('link '. $i),
                'parent_id' => $i - 1,
                'position' => rand(1,10),
                'type' => 'custom',
                'target' => null,
                'menu_id' => 1,
            ]);
        }
        
    }
}
