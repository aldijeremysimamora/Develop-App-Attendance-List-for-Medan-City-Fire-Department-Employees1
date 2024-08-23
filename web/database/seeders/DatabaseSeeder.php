<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            OfficeSeeder::class,
            UserSeeder::class,
            AttendanceSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
