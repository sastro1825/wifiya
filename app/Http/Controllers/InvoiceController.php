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
            'user_id' => 'required|exists:wifi_users,user_id',
            'wifi_package' => 'required|exists:wifi_packages,name',
            'message' => 'required|string',
            'sent_at' => 'required|date',
        ]);

        Invoice::create([
            'user_id' => $request->user_id,
            'wifi_package' => $request->wifi_package,
            'message' => $request->message,
            'sent_at' => $request->sent_at,
        ]);

        return redirect()->route('invoices.create')->with('success', 'Tagihan berhasil dikirim!');
    }
}