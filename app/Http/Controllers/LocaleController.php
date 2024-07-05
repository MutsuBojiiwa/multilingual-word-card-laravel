<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Models\LocaleMaster;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function getAll()
    {
        $locales = LocaleMaster::all();

        return response()->json(['data' => $locales], 200);
    }
}
