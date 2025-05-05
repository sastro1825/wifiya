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
            'user_id' => 'required|exists:wifi_users,user_id',
            'wifi_package' => 'required|exists:wifi_packages,name',
            'message' => 'required|string',
            'sent_at' => 'required|date',
        ]);

        Warning::create([
            'user_id' => $request->user_id,
            'wifi_package' => $request->wifi_package,
            'message' => $request->message,
            'sent_at' => $request->sent_at,
        ]);

        return redirect()->route('warnings.create')->with('success', 'Peringatan berhasil dikirim!');
    }
}