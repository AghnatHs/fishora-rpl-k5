<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Air Tawar Tropis',
            'Air Laut Karang',
            'Aquascape Natural',
            'Kolam Taman',
            'Kompetisi',
            'Mini',
            'Predator (Agresif)',
            'Unik dan Langka',
            'Pemula',
            'Kolektor Serius',
            'Ramah Anak',
            'Professional',
            'Aktif dan Lincah',
            'Tenang dan Kalem',
            'Suka Bersembunyi'
        ];

        foreach ($categories as $name) {
            \App\Models\Category::updateOrCreate(['name' => $name]);
        }
    }
}
