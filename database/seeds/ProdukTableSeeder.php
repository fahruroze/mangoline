<?php

use App\Produk;
use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'nama'=>'Juice Mangga',
            'slug' => 'Juice',
            'detail'=>'Juice Mangga khas Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ])->categories()->attach(1);

        $produk = Produk::find(1);
        $produk->categories()->attach(2);


        Produk::create([
            'nama'=>'Juice Mangga2',
            'slug' => 'Juice2',
            'detail'=>'Juice Mangga khas Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ]);

        Produk::create([
            'nama'=>'Sirup Mangga',
            'slug' => 'Sirup',
            'detail'=>'Sirup Mangga Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ])->categories()->attach(2);
        
        Produk::create([
            'nama'=>'Sirup Mangga2',
            'slug' => 'Sirup2',
            'detail'=>'Sirup Mangga Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ]);

        Produk::create([
            'nama'=>'Dodol Mangga',
            'slug' => 'Dodol',
            'detail'=>'DodolMangga Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ])->categories()->attach(3);

        Produk::create([
            'nama'=>'Dodol2',
            'slug' => 'Dodol mangga2',
            'detail'=>'Mangga gedong Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ]);

        Produk::create([
            'nama'=>'Manisan Mangga',
            'slug' => 'Manisan',
            'detail'=>'Mangga gedong Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ])->categories()->attach(4);

        Produk::create([
            'nama'=>'Manisan Mangga2',
            'slug' => 'Manisan2',
            'detail'=>'Mangga gedong Indramayu',
            'harga'=>10000,
            'deskripsi'=>'mangga khas indramayu',
        ]);

        
           
    }
}
