<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DropCreateSeedController extends Controller
{
    public function DCS()
    {
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        return response()->json([
            'message' => 'Database reset, migrated, and seeded successfully',
        ], 200);
    }
}
