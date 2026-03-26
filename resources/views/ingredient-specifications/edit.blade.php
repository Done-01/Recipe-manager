<!DOCTYPE html>
<html>
<body>
<h1>Edit Ingredient Specification</h1>

@if ($errors->any())
    <div>
        <strong>There were some errors:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('ingredient-specifications.update', $ingredientSpecification->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="ingredient_id">Ingredient</label>
        <select name="ingredient_id" id="ingredient_id" required>
            <option value="">Select Ingredient</option>
            @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}"
                    {{ old('ingredient_id', $ingredientSpecification->ingredient_id) == $ingredient->id ? 'selected' : '' }}>
                    {{ $ingredient->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label for="supplier_id">Supplier</label>
        <select name="supplier_id" id="supplier_id" required>
            <option value="">Select Supplier</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}"
                    {{ old('supplier_id', $ingredientSpecification->supplier_id) == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label for="nutrition_profile">Nutrition Profile</label>
        <select name="nutrition_profile" id="nutrition_profile" required>
            <option value="">Select Nutrition Profile</option>
            @foreach ($nutritionProfiles as $nutritionProfile)
                <option value="{{ $nutritionProfile->id }}"
                    {{ old('nutrition_profile', $ingredientSpecification->nutrition_profile) == $nutritionProfile->id ? 'selected' : '' }}>
                    {{ $nutritionProfile->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label for="cost_per_item">Cost Per Item</label>
        <input
            type="number"
            step="0.01"
            id="cost_per_item"
            name="cost_per_item"
            value="{{ old('cost_per_item', $ingredientSpecification->cost_per_item) }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="item_size">Item Size</label>
        <input
            type="number"
            step="0.01"
            id="item_size"
            name="item_size"
            value="{{ old('item_size', $ingredientSpecification->item_size) }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="unit_id">Unit</label>
        <select name="unit_id" id="unit_id" required>
            <option value="">Select Unit</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}"
                    {{ old('unit_id', $ingredientSpecification->unit_id) == $unit->id ? 'selected' : '' }}>
                    {{ $unit->unit_name }} ({{ $unit->unit_abbreviation }})
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <button type="submit">Update Ingredient Specification</button>
    </div>
</form>
</body>
</html>