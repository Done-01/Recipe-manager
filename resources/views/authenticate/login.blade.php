<x-guest>
    <x-slot:title>Log In</x-slot:title>

    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-10 shadow-sm">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">STEVIE</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Sign in to your account</h2>
        </div>
            @if (session('status'))
                <div class="mt-6 rounded-2xl bg-emerald-50 px-4 py-3 text-center text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif
            <form class="mt-8 space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" type="password" name="password" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div>
                    <button class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Log In</button>
                </div>

                <div class="text-center text-sm text-slate-600">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-700">Register</a></p>
                </div>

                @if ($errors->any())
                    <div class="rounded-2xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
</x-guest>
