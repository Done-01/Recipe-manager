<x-guest>
    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-10 text-center shadow-sm">
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-400 shadow-sm">
            <div class="h-6 w-6 rounded-full bg-amber-300"></div>
        </div>
        <h2 class="mt-6 text-3xl font-semibold text-slate-900">Welcome to STEVIE</h2>
        <p class="mt-3 text-sm leading-6 text-slate-600">
            Please <a href="{{ route('login') }}" class="font-medium text-teal-600 hover:text-teal-700">log in</a> or
            <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-700">register</a> to continue.
        </p>
    </div>
</x-guest>
