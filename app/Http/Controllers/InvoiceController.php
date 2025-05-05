<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\WifiUser;
use App\Models\WifiPackage;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create()
    {
        $wifiUsers = WifiUser::all();
        $wifiPackages = WifiPackage::all();
        $invoices = Invoice::all();
        return view('invoices.create', compact('wifiUsers', 'wifiPackages', 'invoices'));
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
            Invoice::create([
                'user_id' => $userId,
                'wifi_package' => $wifiUser->wifi_package,
                'message' => $request->message,
                'sent_at' => $request->sent_at,
            ]);
        }

        return redirect()->route('invoices.create')->with('success', 'Tagihan berhasil dikirim ke ' . count($request->user_ids) . ' pengguna!');
    }
}