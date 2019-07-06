<?php

use App\Category;
use Illuminate\Support\Carbon;
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
        $now =  Carbon::now()->toDateTimeString();

        Category::insert([
            ['nama' => 'Juice Mangga', 'slug' => 'Juice', 'created_at' =>$now, 'updated_at' => $now],
            ['nama' => 'Sirup Mangga', 'slug' => 'Sirup', 'created_at' =>$now, 'updated_at' => $now],
            ['nama' => 'Dodol Mangga', 'slug' => 'Dodol', 'created_at' =>$now, 'updated_at' => $now],
            ['nama' => 'Manisan Mangga', 'slug' => 'Manisan', 'created_at' =>$now, 'updated_at' => $now]
        ]);
    }
}
