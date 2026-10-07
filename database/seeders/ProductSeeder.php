<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name'        => 'iPhone 16 Pro Max',
                'description' => 'Smartphone flagship Apple dengan chip A18 Pro, kamera 48MP triple system, layar Super Retina XDR 6.9 inci, dan titanium design.',
                'price'       => 24999000,
                'stock'       => 25,
                'category'    => 'Smartphone',
            ],
            [
                'name'        => 'Samsung Galaxy S25 Ultra',
                'description' => 'Smartphone Android flagship dengan S Pen terintegrasi, kamera 200MP, Snapdragon 8 Elite, dan baterai 5000mAh.',
                'price'       => 22499000,
                'stock'       => 18,
                'category'    => 'Smartphone',
            ],
            [
                'name'        => 'MacBook Pro 16" M4 Pro',
                'description' => 'Laptop profesional Apple dengan chip M4 Pro, layar Liquid Retina XDR 16 inci, RAM 24GB, SSD 512GB, dan baterai hingga 22 jam.',
                'price'       => 42999000,
                'stock'       => 10,
                'category'    => 'Laptop',
            ],
            [
                'name'        => 'ASUS ROG Zephyrus G16',
                'description' => 'Gaming laptop premium dengan NVIDIA RTX 4090, AMD Ryzen 9, layar OLED 240Hz 16 inci, RAM 32GB DDR5.',
                'price'       => 38500000,
                'stock'       => 7,
                'category'    => 'Laptop',
            ],
            [
                'name'        => 'iPad Pro 13" M4',
                'description' => 'Tablet profesional Apple dengan chip M4, layar Ultra Retina XDR OLED 13 inci, Apple Pencil Pro support, RAM 16GB.',
                'price'       => 19999000,
                'stock'       => 15,
                'category'    => 'Tablet',
            ],
            [
                'name'        => 'Sony WH-1000XM6',
                'description' => 'Headphone over-ear dengan Active Noise Cancellation terbaik di kelasnya, baterai 40 jam, dan suara Hi-Res Audio.',
                'price'       => 5499000,
                'stock'       => 30,
                'category'    => 'Audio',
            ],
            [
                'name'        => 'AirPods Pro 3',
                'description' => 'True wireless earbuds dengan Active Noise Cancellation generasi terbaru, Transparency mode, dan chip H2.',
                'price'       => 4299000,
                'stock'       => 45,
                'category'    => 'Audio',
            ],
            [
                'name'        => 'Sony A7R VI',
                'description' => 'Mirrorless full-frame 61MP dengan IBIS 8 stop, AI tracking subject, dan video 8K.',
                'price'       => 55000000,
                'stock'       => 5,
                'category'    => 'Kamera',
            ],
            [
                'name'        => 'PlayStation 5 Pro',
                'description' => 'Konsol gaming generasi terbaru Sony dengan GPU yang ditingkatkan, PS5 ray tracing enhanced, dan 2TB SSD.',
                'price'       => 9999000,
                'stock'       => 12,
                'category'    => 'Gaming',
            ],
            [
                'name'        => 'Apple Watch Ultra 3',
                'description' => 'Smartwatch paling tangguh dari Apple dengan titanium case 49mm, baterai 72 jam, dan dual frekuensi GPS.',
                'price'       => 13999000,
                'stock'       => 8,
                'category'    => 'Aksesoris',
            ],
            [
                'name'        => 'Anker MagSafe Charger 3-in-1',
                'description' => 'Wireless charger multi-device untuk iPhone, Apple Watch, dan AirPods secara bersamaan. Output hingga 15W.',
                'price'       => 899000,
                'stock'       => 0,
                'category'    => 'Aksesoris',
            ],
            [
                'name'        => 'Samsung 65" QLED 8K TV',
                'description' => 'Smart TV 8K dengan quantum dot display, Neo QLED technology, 120Hz, dan Dolby Atmos sound system 70W.',
                'price'       => 29999000,
                'stock'       => 3,
                'category'    => 'Smart Home',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
