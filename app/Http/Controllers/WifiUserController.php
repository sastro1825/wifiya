<?php

namespace App\Http\Controllers;

use App\Models\WifiUser;
use App\Models\WifiPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WifiUserController extends Controller
{
    public function index()
    {
        $wifiUsers = WifiUser::all();
        return view('wifi-users.index', compact('wifiUsers'));
    }

    public function edit($user_id)
    {
        $user = WifiUser::where('user_id', $user_id)->firstOrFail();
        $wifiPackages = WifiPackage::all();
        return view('wifi-users.edit', compact('user', 'wifiPackages'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'wifi_package' => 'required|exists:wifi_packages,name',
            'password' => 'nullable|string|min:6',
        ]);

        $user = WifiUser::where('user_id', $user_id)->firstOrFail();
        $user->wifi_package = $request->wifi_package;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('wifi-users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }
}