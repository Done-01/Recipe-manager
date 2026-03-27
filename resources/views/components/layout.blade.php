<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen w-full bg-slate-100 text-slate-900 font-sans">
    <nav class="border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-4 py-3 sm:px-6">
            <div class="flex items-center gap-8">
                <a href="/dashboard" class="flex items-center gap-3">
                    <span class="relative flex h-10 w-10 items-center justify-center bg-slate-400 shadow-sm">
                        <span class="h-4 w-4 rounded-full bg-amber-300"></span>
                    </span>
                    <div class="leading-tight">
                        <p class="text-sm font-semibold tracking-[0.18em] text-teal-600">STEVIE</p>
                        <p class="text-xs text-slate-500">R R R</p>
                    </div>
                </a>

                @if (session('active_organisation'))
                    <div class="flex items-center gap-2">
                        <x-nav-link href="/dashboard">Dashboard</x-nav-link>
                        <x-nav-link href="/organisations">Organisations</x-nav-link>
                        <x-nav-link href="/recipes">Recipes</x-nav-link>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                @if (auth()->check())
                    <x-nav-link href="/logout">Logout</x-nav-link>
                @else
                    <x-nav-link href="/login">Login</x-nav-link>
                @endif
            </div>
        </div>
    </nav>
    <main class="mx-auto w-full max-w-6xl px-4 py-6 sm:px-6">
        {{ $slot }}
    </main>
</body>
</html>
