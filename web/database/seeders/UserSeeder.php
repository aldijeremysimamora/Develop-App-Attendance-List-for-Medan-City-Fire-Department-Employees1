<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'office_id' => 1,
            'name' => 'John Doe',
            'nip' => '1234567890',
            'photo' => '1.png',
            'rank' => 'Manager',
            'password' => Hash::make('password1'),
        ]);

        User::create([
            'office_id' => 2,
            'name' => 'Jane Smith',
            'nip' => '2345678901',
            'photo' => '1.png',
            'rank' => 'Assistant Manager',
            'password' => Hash::make('password2'),
        ]);

        User::create([
            'office_id' => 3,
            'name' => 'Alice Johnson',
            'nip' => '3456789012',
            'photo' => '1.png',
            'rank' => 'Senior Developer',
            'password' => Hash::make('password3'),
        ]);

        User::create([
            'office_id' => 4,
            'name' => 'Bob Brown',
            'nip' => '4567890123',
            'photo' => '1.png',
            'rank' => 'Developer',
            'password' => Hash::make('password4'),
        ]);

        User::create([
            'office_id' => 5,
            'name' => 'Charlie Davis',
            'nip' => '5678901234',
            'photo' => '1.png',
            'rank' => 'Intern',
            'password' => Hash::make('password5'),
        ]);

        User::create([
            'office_id' => 6,
            'name' => 'David Harris',
            'nip' => '6789012345',
            'photo' => '1.png',
            'rank' => 'Lead Developer',
            'password' => Hash::make('password6'),
        ]);

        User::create([
            'office_id' => 7,
            'name' => 'Eve Clark',
            'nip' => '7890123456',
            'photo' => '1.png',
            'rank' => 'Project Manager',
            'password' => Hash::make('password7'),
        ]);

        User::create([
            'office_id' => 8,
            'name' => 'Frank White',
            'nip' => '8901234567',
            'photo' => '1.png',
            'rank' => 'System Analyst',
            'password' => Hash::make('password8'),
        ]);

        User::create([
            'office_id' => 9,
            'name' => 'Grace Lewis',
            'nip' => '9012345678',
            'photo' => '1.png',
            'rank' => 'UX Designer',
            'password' => Hash::make('password9'),
        ]);

        User::create([
            'office_id' => 10,
            'name' => 'Henry Walker',
            'nip' => '0123456789',
            'photo' => '1.png',
            'rank' => 'QA Engineer',
            'password' => Hash::make('password10'),
        ]);

        User::create([
            'office_id' => Office::where('slug', 'administrator')->first()->id,
            'name' => 'Jangan Hapus (Admin)',
            'nip' => 'admin',
            'photo' => '1.png',
            'rank' => 'Manager',
            'password' => Hash::make('damkar1admin2pemko3medan4'),
            'role' => 'admin',
        ]);
    }
}
