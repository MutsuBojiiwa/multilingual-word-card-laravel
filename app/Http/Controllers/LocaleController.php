<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\LocaleMaster;
use Illuminate\Http\Request;
use App\Http\Requests\GetLocaleByIdRequest;


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

    public function getByIds(GetLocaleByIdRequest $request)
    {
        Log::debug('Full Request:', ['request' => $request->all()]);

        $ids = explode(',', $request->input('localeIds'));
        Log::debug('ids:', ['localeIds' => $ids]);

        $locales = LocaleMaster::whereIn('id', $ids)->get();
        Log::debug('locales:', ['locales' => $locales]);

        return response()->json(['data' => $locales], 200);
    }
}
