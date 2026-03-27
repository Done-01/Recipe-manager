<x-layout>
    <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipe Versions</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Create recipe version</h1>
        <p class="mt-2 text-sm text-slate-600">Add a new version record for {{ $recipe->name }}.</p>

        <form action="{{ route('recipes.recipe-versions.store', $recipe->id) }}" method="POST" class="mt-8 space-y-5">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>
                <div>
                    <label for="version" class="block text-sm font-medium text-slate-700">Version</label>
                    <input type="text" name="version" id="version" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white"></textarea>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
                    <input type="text" name="status" id="status" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>
                <div>
                    <label for="yield" class="block text-sm font-medium text-slate-700">Yield</label>
                    <input type="text" name="yield" id="yield" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>
                <div>
                    <label for="unit_id" class="block text-sm font-medium text-slate-700">Unit</label>
                    <select name="unit_id" id="unit_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                        <option value="">Select a unit</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->unit_abbreviation }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="changelog" class="block text-sm font-medium text-slate-700">Changelog</label>
                    <textarea name="changelog" id="changelog" rows="4" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white"></textarea>
                </div>
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

            <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Recipe Version</button>
        </form>
    </div>
</x-layout>
