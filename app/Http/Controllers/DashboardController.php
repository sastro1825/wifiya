<?php

namespace App\Http\Controllers;

use App\Models\WifiUser;
use App\Models\WifiPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $wifiPackages = WifiPackage::all();
        return view('dashboard', compact('wifiPackages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|unique:wifi_users,user_id',
            'password' => 'required|string|min:6',
            'wifi_package' => 'required|exists:wifi_packages,name',
        ]);

        WifiUser::create([
            'user_id' => $request->user_id,
            'password' => Hash::make($request->password),
            'wifi_package' => $request->wifi_package,
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengguna WiFi berhasil ditambahkan!');
    }
}