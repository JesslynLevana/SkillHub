<?php

namespace Database\Seeders;

use App\Models\MsMember;
use App\Models\MsClass;
use Illuminate\Database\Seeder;

class TrClassMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only seed if no enrollments exist
        if (\App\Models\TrClassMember::count() === 0) {
            // Get members and classes
            $members = MsMember::all();
            $classes = MsClass::all();

            if ($members->count() > 0 && $classes->count() > 0) {
                // Member 1 enrolls in multiple classes
                if (isset($members[0]) && isset($classes[0], $classes[1], $classes[2])) {
                    $members[0]->classes()->attach([$classes[0]->id, $classes[1]->id, $classes[2]->id]);
                }

                // Member 2 enrolls in classes
                if (isset($members[1]) && isset($classes[0], $classes[3])) {
                    $members[1]->classes()->attach([$classes[0]->id, $classes[3]->id]);
                }

                // Member 3 enrolls in classes
                if (isset($members[2]) && isset($classes[1], $classes[4])) {
                    $members[2]->classes()->attach([$classes[1]->id, $classes[4]->id]);
                }

                // Member 4 enrolls in classes
                if (isset($members[3]) && isset($classes[2], $classes[5])) {
                    $members[3]->classes()->attach([$classes[2]->id, $classes[5]->id]);
                }

                // Member 5 enrolls in classes
                if (isset($members[4]) && isset($classes[3], $classes[4])) {
                    $members[4]->classes()->attach([$classes[3]->id, $classes[4]->id]);
                }

                // Member 6 enrolls in classes
                if (isset($members[5]) && isset($classes[0], $classes[1], $classes[5])) {
                    $members[5]->classes()->attach([$classes[0]->id, $classes[1]->id, $classes[5]->id]);
                }

                // Member 7 enrolls in classes
                if (isset($members[6]) && isset($classes[2], $classes[3])) {
                    $members[6]->classes()->attach([$classes[2]->id, $classes[3]->id]);
                }

                // Member 8 enrolls in classes
                if (isset($members[7]) && isset($classes[4], $classes[5])) {
                    $members[7]->classes()->attach([$classes[4]->id, $classes[5]->id]);
                }

                // Member 9 enrolls in classes
                if (isset($members[8]) && isset($classes[0], $classes[4])) {
                    $members[8]->classes()->attach([$classes[0]->id, $classes[4]->id]);
                }

                // Member 10 enrolls in classes
                if (isset($members[9]) && isset($classes[1], $classes[3], $classes[5])) {
                    $members[9]->classes()->attach([$classes[1]->id, $classes[3]->id, $classes[5]->id]);
                }
            }
        }
    }
}
