<x-layout>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipe Versions</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $recipe->name }}</h1>
                <p class="mt-2 text-sm text-slate-600">{{ $recipeVersions->count() }} version records.</p>
            </div>
            <a href="{{ route('recipes.recipe-versions.create', $recipe) }}" class="flex justify-center rounded-2xl bg-teal-500 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Version</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-4 py-3 font-medium">ID</th>
                            <th class="px-4 py-3 font-medium">Version</th>
                            <th class="px-4 py-3 font-medium">Name</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Yield</th>
                            <th class="px-4 py-3 font-medium">Unit</th>
                            <th class="px-4 py-3 font-medium">Committed By</th>
                            <th class="px-4 py-3 font-medium">Committed At</th>
                            <th class="px-4 py-3 font-medium">Created At</th>
                            <th class="px-4 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($recipeVersions as $version)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">{{ $version->id }}</td>
                                <td class="px-4 py-3">{{ $version->version }}</td>
                                <td class="px-4 py-3">{{ $version->name }}</td>
                                <td class="px-4 py-3">{{ $version->status ?: '-' }}</td>
                                <td class="px-4 py-3">{{ $version->yield ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $version->unit?->unit_abbreviation ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $version->commitedBy?->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $version->commited_at ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $version->created_at }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('recipes.recipe-versions.show', ['recipe' => $recipe, 'recipe_version' => $version]) }}" class="font-medium text-teal-600 hover:text-teal-700">
                                        Open Version
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
