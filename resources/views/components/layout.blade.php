<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <div class="flex space-x-4">
            @if (auth()->check())
                <x-nav-link href="/dashboard">Dashboard</x-nav-link>
                <x-nav-link href="/organisations">Organisations</x-nav-link>
                <x-nav-link href="/recipes">Recipes</x-nav-link>
            @else
                <x-nav-link href="/login">Login</x-nav-link>
            @endif
        </div>
        <div>
            @if (auth()->check())
                <x-nav-link href="logout">Logout</x-nav-link>
            @endif
        </div>
    </nav>

    <main class="container mx-auto mt-4 p-4">
        {{ $slot }}
    </main>
</body>
</html>
