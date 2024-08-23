<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Office;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= Office::count(); $i++) {
            Announcement::create([
                'title' => 'Office Closure',
                'slug' => 'office-closure' . $i,
                'content' => 'The office will be closed on July 4th for Independence Day.',
                'office_id' => $i
            ]);

            Announcement::create([
                'title' => 'New Policy Update',
                'slug' => 'new-policy-update' . $i,
                'content' => 'Please review the new company policies updated on the HR portal.',
                'office_id' => $i
            ]);

            Announcement::create([
                'title' => 'Team Meeting',
                'slug' => 'team-meeting' . $i,
                'content' => 'There will be a team meeting on Friday at 10 AM in the conference room.',
                'office_id' => $i
            ]);

            Announcement::create([
                'title' => 'Holiday Schedule',
                'slug' => 'holiday-schedule' . $i,
                'content' => 'The holiday schedule for the upcoming year has been posted on the intranet.',
                'office_id' => $i
            ]);

            Announcement::create([
                'title' => 'Office Maintenance',
                'slug' => 'office-maintenance' . $i,
                'content' => 'Office maintenance will occur this weekend. Please ensure your desks are cleared.',
                'office_id' => $i
            ]);
        }
    }
}
