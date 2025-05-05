<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WifiUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('q');
        $users = WifiUser::where('user_id', 'like', "%{$query}%")->get(['user_id', 'wifi_package']);
        return response()->json($users);
    }
}