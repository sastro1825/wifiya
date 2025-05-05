<?php

namespace App\Http\Controllers;

use App\Models\Warning;
use App\Models\WifiUser;
use App\Models\WifiPackage;
use Illuminate\Http\Request;

class WarningController extends Controller
{
    public function create()
    {
        $wifiUsers = WifiUser::all();
        $wifiPackages = WifiPackage::all();
        $warnings = Warning::all();
        return view('warnings.create', compact('wifiUsers', 'wifiPackages', 'warnings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:wifi_users,user_id',
            'message' => 'required|string',
            'sent_at' => 'required|date',
        ]);

        foreach ($request->user_ids as $userId) {
            $wifiUser = WifiUser::where('user_id', $userId)->firstOrFail();
            Warning::create([
                'user_id' => $userId,
                'wifi_package' => $wifiUser->wifi_package,
                'message' => $request->message,
                'sent_at' => $request->sent_at,
            ]);
        }

        return redirect()->route('warnings.create')->with('success', 'Peringatan berhasil dikirim ke ' . count($request->user_ids) . ' pengguna!');
    }
}