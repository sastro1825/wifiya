@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Pengguna WiFi</h2>

        <form method="POST" action="{{ route('wifi-users.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">ID Pengguna</label>
                <input id="user_id" type="text" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="wifi_package" class="block text-sm font-medium text-gray-700">Paket WiFi</label>
                <select id="wifi_package" name="wifi_package" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($wifiPackages as $package)
                        <option value="{{ $package->name }}">{{ $package->name }} ({{ number_format($package->price, 0, ',', '.') }} - {{ $package->speed }})</option>
                    @endforeach
                </select>
                @error('wifi_package')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah</button>
            </div>
        </form>
    </div>
@endsection