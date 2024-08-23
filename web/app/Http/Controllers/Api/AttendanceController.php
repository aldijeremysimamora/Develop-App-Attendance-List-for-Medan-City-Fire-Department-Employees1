<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils;
use App\Models\Attendance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function validateAttendance(Request $request)
    {
        // Contoh JSON
        // {
        //     "latitude": "2.383212446907558",
        //     "longitude": "99.14864718342184",
        //     "type": "in"
        // }

        try {
            $request->validate([
                'latitude' => ['required', 'string', 'max:24'],
                'longitude' => ['required', 'string', 'max:24'],
                'type' => ['required', 'string', 'in:in,out'],
            ]);

            $response_store = $this->checkStoreType($request->type);
            if ($response_store != null) {
                return $response_store;
            }

            $response_location = $this->checkLocation($request->latitude, $request->longitude);
            if ($response_location != null) {
                return $response_location;
            }

            $timeDeviation = $this->checkTime($request->type);
            if ($timeDeviation != 0) {
                return response([
                    'success' => false,
                    'message' => $timeDeviation > 0 ? 'Anda telah terlambat' : 'Anda terlalu cepat datang',
                ], 403);
            }

            return response([
                'success' => true,
                'message' => 'Success',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function store(Request $request)
    {
        // Contoh JSON
        // {
        //      "latitude": "3.591903",
        //      "longitude": "98.676726",
        //      "type": "out",
        //      "image": "image.png"
        // }

        try {
            $request->validate([
                'latitude' => ['required', 'string', 'max:24'],
                'longitude' => ['required', 'string', 'max:24'],
                'type' => ['required', 'string', 'in:in,out'],
                'image' => ['required', 'image', 'max:2048'],
            ]);

            $response_store = $this->checkStoreType($request->type);
            if ($response_store != null) {
                return $response_store;
            }

            $response_location = $this->checkLocation($request->latitude, $request->longitude);
            if ($response_location != null) {
                return $response_location;
            }

            $timeDeviation = $this->checkTime($request->type);
            $image = Utils::upload($request->image, 'attendance');

            $attendance = Auth::user()->attendances()->create([
                'type' => $request->type,
                'image' => $image,
                'time_deviation' => $timeDeviation,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            return response([
                'success' => true,
                'data' => $attendance,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function getAllData()
    {
        try {
            $data = Attendance::where('user_id', Auth::user()->id)->latest()->get();

            $groupedData = [];

            foreach ($data as $attendance) {
                $date = $attendance->created_at->format('Y-m-d');

                if (!isset($groupedData[$date])) {
                    $groupedData[$date] = [
                        'in' => null,
                        'out' => null,
                    ];
                }

                if ($attendance->type == 'in') {
                    $groupedData[$date]['in'] = $attendance;
                } else {
                    $groupedData[$date]['out'] = $attendance;
                }
            }

            $result = [];
            foreach ($groupedData as $date => $attendance) {
                $result[] = $attendance;
            }

            return response([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ], 422);
        }
    }

    public function getFewData()
    {
        try {
            $data = Attendance::where('user_id', Auth::user()->id)->latest()->take(4)->get();

            $groupedData = [];

            foreach ($data as $attendance) {
                $date = $attendance->created_at->format('Y-m-d');

                if (!isset($groupedData[$date])) {
                    $groupedData[$date] = [
                        'in' => null,
                        'out' => null,
                    ];
                }

                if ($attendance->type == 'in') {
                    $groupedData[$date]['in'] = $attendance;
                } else {
                    $groupedData[$date]['out'] = $attendance;
                }
            }

            $result = [];
            foreach ($groupedData as $date => $attendance) {
                $result[] = $attendance;
            }

            return response([
                'success' => true,
                'data' => $result,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ], 422);
        }
    }

    protected function checkLocation($employeeLatitude, $employeeLongitude)
    {
        $latFrom = deg2rad(Auth::user()->office->latitude);
        $lonFrom = deg2rad(Auth::user()->office->longitude);
        $latTo = deg2rad($employeeLatitude);
        $lonTo = deg2rad($employeeLongitude);

        $earthRadius = 6371000;
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        if (($earthRadius * $c) > 50.0) {
            return response([
                'success' => false,
                'message' => 'Anda terlalu jauh dari lokasi kantor',
            ], 403);
        }

        return null;
    }

    protected function checkStoreType($type)
    {
        $is_attendance_in =
            Attendance::where('user_id', Auth::user()->id)
                ->where('type', 'in')
                ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                ->exists();

        $is_attendance_out =
            Attendance::where('user_id', Auth::user()->id)
                ->where('type', 'out')
                ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
                ->exists();

        if ($type == 'out') {
            if (!$is_attendance_in) {
                return response([
                    'success' => false,
                    'message' => 'Anda harus absen masuk terlebih dahulu',
                ], 403);
            }

            if ($is_attendance_out) {
                return response([
                    'success' => false,
                    'message' => 'Anda sudah absen keluar',
                ], 403);
            }
        } else if ($type == 'in') {
            if ($is_attendance_in) {
                return response([
                    'success' => false,
                    'message' => 'Anda sudah absen masuk',
                ], 403);
            }
        }

        return null;
    }

    protected function checkTime($type)
    {
        $office = Auth::user()->office;
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
            return $nowTime - $startTime;
        } elseif ($nowTime >= $endTime) {
            return $nowTime - $endTime;
        } else {
            return 0;
        }
    }
}

