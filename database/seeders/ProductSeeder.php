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
        $products = [
            [
                'nama_produk' => 'Kaos Polos',
                'sku' => 'SKU001',
                'harga' => 75000,
                'stok' => 100
            ],
            [
                'nama_produk' => 'Topi Trucker',
                'sku' => 'SKU002',
                'harga' => 45000,
                'stok' => 50
            ],
            [
                'nama_produk' => 'Celana Jeans',
                'sku' => 'SKU003',
                'harga' => 150000,
                'stok' => 30
            ],
            [
                'nama_produk' => 'Hoodie Hitam',
                'sku' => 'SKU004',
                'harga' => 120000,
                'stok' => 20
            ],
            [
                'nama_produk' => 'Kemeja Flanel',
                'sku' => 'SKU005',
                'harga' => 95000,
                'stok' => 40
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
