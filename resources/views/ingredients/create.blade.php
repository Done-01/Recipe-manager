<x-layout>
    <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Ingredients</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Create ingredient</h1>

        @if ($errors->any())
            <div class="mt-6 rounded-2xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <strong>There were some errors:</strong>
                <ul class="mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ingredients.store') }}" method="POST" class="mt-8 space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Ingredient Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
            </div>

            <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Ingredient</button>
        </form>
    </div>
</x-layout>
