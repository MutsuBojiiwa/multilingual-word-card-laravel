<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function health()
    {
        return response()->json(['status' => 'ok'], 200);
    }
}
