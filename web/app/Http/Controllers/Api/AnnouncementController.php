<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Exception;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function getAllData()
    {
        try {
            $data = Announcement::where('office_id', Auth::user()->office_id)->latest()->get();

            return response([
                'success' => true,
                'data' => $data,
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
            $data = Announcement::where('office_id', Auth::user()->office_id)->latest()->take(2)->get();

            return response([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Exception: ' . $e->getMessage(),
            ], 422);
        }
    }
}

