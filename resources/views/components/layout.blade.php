<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-gray-900 font-sans flex flex-col min-h-screen">
    <nav class="bg-purple-800 p-4 text-white flex justify-between items-center w-full">
        <div class="flex space-x-4 items-top">
            @if (session('active_organisation'))
                <x-nav-link href="/dashboard">Dashboard</x-nav-link>
                <x-nav-link href="/organisations">Organisations</x-nav-link>
                <x-nav-link href="/recipes">Recipes</x-nav-link>
            @endif
        </div>
        <div>
            @if (auth()->check())
                <x-nav-link href="logout">Logout</x-nav-link>
                @else
                    <x-nav-link href="/login">Login</x-nav-link>
                @endif
        </div>
    </nav>

    <main class="w-full mx-auto">
        {{ $slot }}
    </main>
</body>
</html>
