<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
  
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'nama_mobil' => 'Toyoda',
            'category_id' => '1',
            'tahun' => 2024,
            'harga_sewa' => '2000',
            'image' => 'png',
        ]);
    }
}