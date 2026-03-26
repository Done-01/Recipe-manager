<x-layout>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Ingredient Specifications</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">Ingredient specifications</h1>
                <p class="mt-2 text-sm text-slate-600">{{ $ingredientSpecifications->count() }} records.</p>
            </div>
            <a href="{{ route('ingredient-specifications.create') }}" class="flex justify-center rounded-2xl bg-teal-500 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Specification</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-slate-500">
                        <tr>
                            <th class="px-4 py-3 font-medium">Ingredient</th>
                            <th class="px-4 py-3 font-medium">Supplier</th>
                            <th class="px-4 py-3 font-medium">Nutrition Profile</th>
                            <th class="px-4 py-3 font-medium">Cost Per Item</th>
                            <th class="px-4 py-3 font-medium">Item Size</th>
                            <th class="px-4 py-3 font-medium">Unit</th>
                            <th class="px-4 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($ingredientSpecifications as $ingredientSpecification)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3">{{ $ingredientSpecification->ingredient?->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredientSpecification->supplier?->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredientSpecification->nutritionProfile?->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredientSpecification->cost_per_item ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredientSpecification->item_size ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $ingredientSpecification->unit?->unit_name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-3">
                                        <a href="{{ route('ingredient-specifications.edit', $ingredientSpecification->id) }}" class="font-medium text-teal-600 hover:text-teal-700">Edit</a>
                                        <form action="{{ route('ingredient-specifications.destroy', $ingredientSpecification->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this ingredient specification?')" class="font-medium text-rose-600 hover:text-rose-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
