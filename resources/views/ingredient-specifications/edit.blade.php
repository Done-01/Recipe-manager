<x-layout>
    <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Ingredient Specifications</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Edit ingredient specification</h1>

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

        <form action="{{ route('ingredient-specifications.update', $ingredientSpecification->id) }}" method="POST" class="mt-8 grid gap-5 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div>
                <label for="ingredient_id" class="block text-sm font-medium text-slate-700">Ingredient</label>
                <select name="ingredient_id" id="ingredient_id" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                    <option value="">Select Ingredient</option>
                    @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" {{ old('ingredient_id', $ingredientSpecification->ingredient_id) == $ingredient->id ? 'selected' : '' }}>{{ $ingredient->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="supplier_id" class="block text-sm font-medium text-slate-700">Supplier</label>
                <select name="supplier_id" id="supplier_id" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $ingredientSpecification->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="nutrition_profile" class="block text-sm font-medium text-slate-700">Nutrition Profile</label>
                <select name="nutrition_profile" id="nutrition_profile" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                    <option value="">Select Nutrition Profile</option>
                    @foreach ($nutritionProfiles as $nutritionProfile)
                        <option value="{{ $nutritionProfile->id }}" {{ old('nutrition_profile', $ingredientSpecification->nutrition_profile) == $nutritionProfile->id ? 'selected' : '' }}>{{ $nutritionProfile->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="cost_per_item" class="block text-sm font-medium text-slate-700">Cost Per Item</label>
                <input type="number" step="0.01" id="cost_per_item" name="cost_per_item" value="{{ old('cost_per_item', $ingredientSpecification->cost_per_item) }}" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
            </div>

            <div>
                <label for="item_size" class="block text-sm font-medium text-slate-700">Item Size</label>
                <input type="number" step="0.01" id="item_size" name="item_size" value="{{ old('item_size', $ingredientSpecification->item_size) }}" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
            </div>

            <div>
                <label for="unit_id" class="block text-sm font-medium text-slate-700">Unit</label>
                <select name="unit_id" id="unit_id" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                    <option value="">Select Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $ingredientSpecification->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->unit_name }} ({{ $unit->unit_abbreviation }})</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Update Ingredient Specification</button>
            </div>
        </form>
    </div>
</x-layout>
