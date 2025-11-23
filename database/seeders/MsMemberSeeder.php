<?php

namespace Database\Seeders;

use App\Models\MsMember;
use Illuminate\Database\Seeder;

class MsMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (MsMember::count() === 0) {
            MsMember::create(['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567890', 'address' => 'Jakarta']);
            MsMember::create(['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'phone' => '081234567891', 'address' => 'Bandung']);
            MsMember::create(['name' => 'Ahmad Fauzi', 'email' => 'ahmad@example.com', 'phone' => '081234567892', 'address' => 'Surabaya']);
            MsMember::create(['name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'phone' => '081234567893', 'address' => 'Yogyakarta']);
            MsMember::create(['name' => 'Rudi Hartono', 'email' => 'rudi@example.com', 'phone' => '081234567894', 'address' => 'Medan']);
            MsMember::create(['name' => 'Maya Sari', 'email' => 'maya@example.com', 'phone' => '081234567895', 'address' => 'Semarang']);
            MsMember::create(['name' => 'Indra Gunawan', 'email' => 'indra@example.com', 'phone' => '081234567896', 'address' => 'Makassar']);
            MsMember::create(['name' => 'Lina Wijaya', 'email' => 'lina@example.com', 'phone' => '081234567897', 'address' => 'Palembang']);
            MsMember::create(['name' => 'Eko Prasetyo', 'email' => 'eko@example.com', 'phone' => '081234567898', 'address' => 'Denpasar']);
            MsMember::create(['name' => 'Rina Kartika', 'email' => 'rina@example.com', 'phone' => '081234567899', 'address' => 'Malang']);
        }
    }
}
