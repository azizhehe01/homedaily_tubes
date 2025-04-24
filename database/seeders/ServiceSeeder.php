<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('service')->insert([
            [
                'name' => 'Bersih Rumah',
                'description' => 'Pembersihan rumah lengkap dengan layanan profesional.',
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci Mobil',
                'description' => 'Layanan cuci mobil dengan perawatan terbaik.',
                'price' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perbaikan AC',
                'description' => 'Servis dan perbaikan AC untuk kenyamanan Anda.',
                'price' => 200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
