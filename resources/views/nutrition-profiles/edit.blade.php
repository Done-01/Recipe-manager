<x-layout>
    <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Nutrition Profiles</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Edit nutrition profile</h1>

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

        <form action="{{ route('nutrition-profiles.update', $nutritionProfile->id) }}" method="POST" class="mt-8 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700">Nutrition Profile Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $nutritionProfile->name) }}" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
            </div>

            <div>
                <label for="source" class="block text-sm font-medium text-slate-700">Source</label>
                <select name="source" id="source" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                    <option value="">Select Source</option>
                    <option value="manual" {{ old('source', $nutritionProfile->source) == 'manual' ? 'selected' : '' }}>manual</option>
                    <option value="supplier_spec" {{ old('source', $nutritionProfile->source) == 'supplier_spec' ? 'selected' : '' }}>supplier_spec</option>
                    <option value="mccance" {{ old('source', $nutritionProfile->source) == 'mccance' ? 'selected' : '' }}>mccance</option>
                    <option value="library" {{ old('source', $nutritionProfile->source) == 'library' ? 'selected' : '' }}>library</option>
                    <option value="partner" {{ old('source', $nutritionProfile->source) == 'partner' ? 'selected' : '' }}>partner</option>
                </select>
            </div>

            <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Update Nutrition Profile</button>
        </form>
    </div>
</x-layout>
