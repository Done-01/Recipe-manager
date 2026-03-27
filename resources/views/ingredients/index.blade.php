<x-layout>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Ingredients</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">Ingredient library</h1>
                <p class="mt-2 text-sm text-slate-600">{{ $ingredients->count() }} records.</p>
            </div>
            <a href="{{ route('ingredients.create') }}" class="flex justify-center rounded-2xl bg-teal-500 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Ingredient</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-4 py-3 font-medium">ID</th>
                            <th class="px-4 py-3 font-medium">Name</th>
                            <th class="px-4 py-3 font-medium">Organisation</th>
                            <th class="px-4 py-3 font-medium">Created By</th>
                            <th class="px-4 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($ingredients as $ingredient)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">{{ $ingredient->id }}</td>
                                <td class="px-4 py-3">{{ $ingredient->name }}</td>
                                <td class="px-4 py-3">{{ $ingredient->organisation?->organisation_name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredient->createdBy?->name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="font-medium text-teal-600 hover:text-teal-700">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
