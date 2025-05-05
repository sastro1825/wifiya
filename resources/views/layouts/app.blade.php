<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Wifiya Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">Wifiya Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Tambah Pengguna WiFi</a>
                    <a href="{{ route('warnings.create') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Kirim Peringatan</a>
                    <a href="{{ route('invoices.create') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Kirim Tagihan</a>
                    <a href="{{ route('wifi-users.index') }}" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Data Pengguna</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:bg-indigo-700 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>