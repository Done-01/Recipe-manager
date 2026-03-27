<x-guest>
    <x-slot:title>Register</x-slot:title>

    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-10 shadow-sm">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">STEVIE</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Create a new account</h2>
        </div>
            <form class="mt-8 space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input id="password" type="password" name="password" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>

                <div class="space-y-4 text-center">
                    <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Register</button>
                    <p class="text-sm text-slate-600">Have an account? <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-700">Login</a></p>
                </div>
            </form>
        </div>
</x-guest>
