<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Anggota')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto">
            <a href="{{ route('dashboard.anggota') }}" class="font-bold">eLibrary</a>
            <span class="float-right">Anggota: {{ Auth::user()->anggota->nama_anggota}}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
            <div class="flex justify-end mb-4">
                <a href="{{ route('anggota.buku.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Lihat Daftar Buku
                </a>
            </div>

        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>
