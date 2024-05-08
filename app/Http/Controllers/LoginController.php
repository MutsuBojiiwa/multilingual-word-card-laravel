<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Psy\Readline\Hoa\Console;

class LoginController extends Controller
{
    // テスト
    public function getJson(){
        return response()->json(['name' => 'john']);
    }
}
