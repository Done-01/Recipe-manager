<x-layout>
    <div class="space-y-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipe Version</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $recipeVersion->name }}</h1>
            <p class="mt-2 text-sm text-slate-600">
                Recipe: {{ $recipe->name }} | Version: {{ $recipeVersion->version }}
            </p>
        </div>

        @if (session('success'))
            <div class="rounded-2xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[1.2fr_1fr]">
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Ingredients</p>
                        <h2 class="mt-3 text-2xl font-semibold text-slate-900">Current recipe ingredients</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-600">{{ $recipeIngredients->count() }} items</span>
                </div>

                @if ($recipeIngredients->isEmpty())
                    <p class="mt-6 text-sm text-slate-600">No ingredients have been added to this version yet.</p>
                @else
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Ingredient</th>
                                    <th class="px-4 py-3 font-medium">Specification</th>
                                    <th class="px-4 py-3 font-medium">Quantity</th>
                                    <th class="px-4 py-3 font-medium">Waste %</th>
                                    <th class="px-4 py-3 font-medium">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @foreach ($recipeIngredients as $recipeIngredient)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-4 py-3">{{ $recipeIngredient->ingredient?->name ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            {{ $recipeIngredient->ingredientSpecification?->supplier?->name ?? 'No specification' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ $recipeIngredient->quantity }} {{ $recipeIngredient->unit?->unit_abbreviation ?? '' }}
                                        </td>
                                        <td class="px-4 py-3">{{ $recipeIngredient->waste_percentage ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ $recipeIngredient->notes ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Add Ingredients</p>
                <h2 class="mt-3 text-2xl font-semibold text-slate-900">Add multiple rows</h2>
                <p class="mt-2 text-sm text-slate-600">Use the button below to add as many ingredients as you need before saving.</p>

                <form action="{{ route('recipes.recipe-versions.ingredients.store', ['recipe' => $recipe, 'recipeVersion' => $recipeVersion]) }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div id="ingredient-rows" class="space-y-4">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <div class="grid gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Ingredient</label>
                                    <select name="ingredients[0][ingredient_id]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                        <option value="">Select ingredient</option>
                                        @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700">Specification</label>
                                    <select name="ingredients[0][ingredient_specification_id]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                        <option value="">No specification</option>
                                        @foreach ($ingredientSpecifications as $ingredientSpecification)
                                            <option value="{{ $ingredientSpecification->id }}">
                                                {{ $ingredientSpecification->ingredient?->name }} - {{ $ingredientSpecification->supplier?->name ?? 'No supplier' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Quantity</label>
                                        <input type="number" step="0.0001" name="ingredients[0][quantity]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Unit</label>
                                        <select name="ingredients[0][unit_id]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                            <option value="">Select unit</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }} ({{ $unit->unit_abbreviation }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Waste Percentage</label>
                                        <input type="number" step="0.01" name="ingredients[0][waste_percentage]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Notes</label>
                                        <input type="text" name="ingredients[0][notes]" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <button type="button" id="add-ingredient-row" class="flex w-full justify-center rounded-2xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-700 transition hover:bg-teal-100">Add Another Ingredient</button>
                        <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Save Ingredients</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="ingredient-row-template">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <div class="grid gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Ingredient</label>
                    <select data-name="ingredient_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                        <option value="">Select ingredient</option>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Specification</label>
                    <select data-name="ingredient_specification_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                        <option value="">No specification</option>
                        @foreach ($ingredientSpecifications as $ingredientSpecification)
                            <option value="{{ $ingredientSpecification->id }}">
                                {{ $ingredientSpecification->ingredient?->name }} - {{ $ingredientSpecification->supplier?->name ?? 'No supplier' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Quantity</label>
                        <input type="number" step="0.0001" data-name="quantity" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Unit</label>
                        <select data-name="unit_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                            <option value="">Select unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }} ({{ $unit->unit_abbreviation }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Waste Percentage</label>
                        <input type="number" step="0.01" data-name="waste_percentage" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Notes</label>
                        <input type="text" data-name="notes" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400">
                    </div>
                </div>

                <button type="button" class="remove-ingredient-row self-start text-sm font-medium text-rose-600 hover:text-rose-700">Remove Row</button>
            </div>
        </div>
    </template>

    <script>
        const ingredientRows = document.getElementById('ingredient-rows');
        const addIngredientRowButton = document.getElementById('add-ingredient-row');
        const ingredientRowTemplate = document.getElementById('ingredient-row-template');

        let ingredientRowIndex = 1;

        addIngredientRowButton.addEventListener('click', () => {
            const fragment = ingredientRowTemplate.content.cloneNode(true);
            const row = fragment.querySelector('div');

            row.querySelectorAll('[data-name]').forEach((field) => {
                field.name = `ingredients[${ingredientRowIndex}][${field.dataset.name}]`;
            });

            row.querySelector('.remove-ingredient-row').addEventListener('click', () => {
                row.remove();
            });

            ingredientRows.appendChild(fragment);
            ingredientRowIndex += 1;
        });
    </script>
</x-layout>
