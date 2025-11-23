<?php

namespace Database\Seeders;

use App\Models\MsClass;
use Illuminate\Database\Seeder;

class MsClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (MsClass::count() === 0) {
            MsClass::create([
                'name' => 'Desain Grafis',
                'description' => 'Pelatihan desain grafis menggunakan Adobe Photoshop, Illustrator, dan CorelDraw',
                'instructor' => 'Pak Agus Wijaya'
            ]);

            MsClass::create([
                'name' => 'Pemrograman Dasar',
                'description' => 'Belajar dasar-dasar pemrograman menggunakan Python dan JavaScript',
                'instructor' => 'Bu Sari Indrawati'
            ]);

            MsClass::create([
                'name' => 'Editing Video',
                'description' => 'Pelatihan editing video menggunakan Adobe Premiere Pro dan After Effects',
                'instructor' => 'Pak Budi Santoso'
            ]);

            MsClass::create([
                'name' => 'Public Speaking',
                'description' => 'Meningkatkan kemampuan berbicara di depan umum dan presentasi',
                'instructor' => 'Bu Maya Sari'
            ]);

            MsClass::create([
                'name' => 'Digital Marketing',
                'description' => 'Strategi pemasaran digital menggunakan social media dan SEO',
                'instructor' => 'Pak Rudi Hartono'
            ]);

            MsClass::create([
                'name' => 'Web Development',
                'description' => 'Membangun website menggunakan HTML, CSS, JavaScript, dan PHP',
                'instructor' => 'Bu Dewi Lestari'
            ]);
        }
    }
}
