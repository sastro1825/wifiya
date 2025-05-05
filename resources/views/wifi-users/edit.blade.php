@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pengguna WiFi: {{ $user->user_id }}</h2>

        <form method="POST" action="{{ route('wifi-users.update', $user->user_id) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="wifi_package" class="block text-sm font-medium text-gray-700">Paket WiFi</label>
                <select id="wifi_package" name="wifi_package" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach ($wifiPackages as $package)
                        <option value="{{ $package->name }}" {{ $user->wifi_package === $package->name ? 'selected' : '' }}>{{ $package->name }} ({{ number_format($package->price, 0, ',', '.') }} - {{ $package->speed }})</option>
                    @endforeach
                </select>
                @error('wifi_package')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input id="password" type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Simpan</button>
                <a href="{{ route('wifi-users.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Kembali</a>
            </div>
        </form>
    </div>
@endsection