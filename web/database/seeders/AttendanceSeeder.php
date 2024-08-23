<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $types = ['in', 'out'];
        $startDate = Carbon::now()->subDays(10);

        foreach ($users as $user) {
            foreach ($types as $type) {
                for ($i = 0; $i < 10; $i++) {
                    $office = $user->office;
                    $start = $office->start_open;
                    $end = $office->end_open;

                    if ($type == 'out') {
                        $start = $office->start_close;
                        $end = $office->end_close;
                    }

                    $now = date('H:i:s');

                    $startTime = strtotime($start) - strtotime('today');
                    $endTime = strtotime($end) - strtotime('today');
                    $nowTime = strtotime($now) - strtotime('today');

                    if ($nowTime <= $startTime) {
                        $time_deviation = $nowTime - $startTime;
                    } elseif ($nowTime >= $endTime) {
                        $time_deviation = $nowTime - $endTime;
                    } else {
                        $time_deviation = 0;
                    }
                    Attendance::create([
                        'user_id' => $user->id,
                        'type' => $type,
                        'image' => 'default_image.png',
                        'time_deviation' => $time_deviation,
                        'latitude' => '0.123456',
                        'longitude' => '0.123456',
                        'created_at' => $startDate->copy()->addDays($i)->toDateTimeString(),
                        'updated_at' => $startDate->copy()->addDays($i)->toDateTimeString(),
                    ]);
                }
            }
        }
    }
}
