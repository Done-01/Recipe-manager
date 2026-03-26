<x-layout>
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Dashboard</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Welcome to STEVIE</h1>
        @if (auth()->check())
            <p class="mt-3 text-slate-600">You are logged in as {{ auth()->user()->name }}.</p>
        @else
            <p class="mt-3 text-slate-600">You are not logged in.</p>
        @endif
        @if(session('active_organisation'))
            <div class="mt-6 rounded-2xl bg-teal-50 px-4 py-3 text-sm text-teal-700">
                Selected organisation: {{ auth()->user()->currentOrganisation()->organisation_name ?? 'No organisation selected' }}
            </div>
        @endif
    </div>
</x-layout>
