<x-layout>
    <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Organisation</p>
        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Choose your workspace</h2>
        <p class="mt-2 text-sm text-slate-600">Select the organisation you want to work in.</p>
            @if (session('message'))
                <div class="mt-6 rounded-2xl bg-emerald-50 px-4 py-3 text-center text-sm text-emerald-700">
                    {{ session('message') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" action="{{ route("organisations.select") }}" method="post">
                @csrf
            @foreach ($organisations as $organisation)
                <div class="flex items-center rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <input id="organisation-{{ $organisation->id }}" type="radio" name="organisation" value="{{ $organisation->id }}" class="h-4 w-4 border-slate-300 text-teal-500 focus:ring-teal-400">
                    <label for="organisation-{{ $organisation->id }}" class="ml-3 block text-sm font-medium text-slate-700">{{ $organisation->organisation_name }}</label>
                </div>
            @endforeach
            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Select</button>
                <a href="{{ route('organisations.create') }}" class="flex w-full justify-center rounded-2xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-700 transition hover:bg-teal-100">Create Organisation</a>
            </div>
            </form>
        </div>
</x-layout>
