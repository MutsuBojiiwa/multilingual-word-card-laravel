<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function health()
    {
        date_default_timezone_set('Asia/Tokyo');
        return response()->json(
            [
                'status' => 'OK',
                'now' => date("Y-m-d H:i:s")
            ],
            200
        );
    }
}
