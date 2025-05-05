@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Kirim Tagihan</h2>

        <form method="POST" action="{{ route('invoices.store') }}" class="space-y-6">
            @csrf
            <div class="relative">
                <label for="search_user" class="block text-sm font-medium text-gray-700">Cari Pengguna</label>
                <input id="search_user" type="text" name="search_user" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocomplete="off">
            </div>
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih Pengguna</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">-- Pilih Pengguna --</option>
                    @foreach ($wifiUsers as $user)
                        <option value="{{ $user->user_id }}">{{ $user->user_id }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="wifi_package" class="block text-sm font-medium text-gray-700">Pilih Paket</label>
                <select id="wifi_package" name="wifi_package" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($wifiPackages as $package)
                        <option value="{{ $package->name }}">{{ $package->name }}</option>
                    @endforeach
                </select>
                @error('wifi_package')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan Tagihan</label>
                <textarea id="message" name="message" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="4" required></textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="sent_at" class="block text-sm font-medium text-gray-700">Tanggal Pengiriman</label>
                <input id="sent_at" type="date" name="sent_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('sent_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kirim</button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Tagihan Terkirim</h2>
        @if ($invoices->isEmpty())
            <p class="text-gray-600">Belum ada tagihan yang dikirim.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pengguna</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket WiFi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $invoice->user_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $invoice->wifi_package }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $invoice->message }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $invoice->sent_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection