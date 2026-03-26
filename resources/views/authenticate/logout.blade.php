<x-guest>
    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-10 shadow-sm">
        <div class="text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">STEVIE</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Logout confirmation</h2>
            <p class="mt-3 text-sm text-slate-600">Are you sure you want to logout?</p>
        </div>
            <form class="mt-8 space-y-6" action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="flex flex-col items-center space-y-4">
                    <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Yes, Log Me Out</button>
                    <a href="/dashboard" class="text-sm font-medium text-teal-600 hover:text-teal-700">No, take me back</a>
                </div>
            </form>
        </div>
</x-guest>
