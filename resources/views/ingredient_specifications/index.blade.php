<!DOCTYPE html>
<html>
<body>
<h1>Ingredient Specifications</h1>

<p>
    <a href="{{ route('ingredient-specifications.create') }}">Create New Ingredient Specification</a>
</p>

@if ($ingredientSpecifications->count())
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Ingredient</th>
                <th>Supplier</th>
                <th>Nutrition Profile</th>
                <th>Cost Per Item</th>
                <th>Item Size</th>
                <th>Unit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredientSpecifications as $ingredientSpecification)
                <tr>
                    <td>{{ $ingredientSpecification->ingredient?->name ?? '—' }}</td>
                    <td>{{ $ingredientSpecification->supplier?->name ?? '—' }}</td>
                    <td>{{ $ingredientSpecification->nutritionProfile?->name ?? '—' }}</td>
                    <td>{{ $ingredientSpecification->cost_per_item ?? '—' }}</td>
                    <td>{{ $ingredientSpecification->item_size ?? '—' }}</td>
                    <td>{{ $ingredientSpecification->unit?->unit_name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('ingredient-specifications.edit', $ingredientSpecification->id) }}">Edit</a>

                        <form action="{{ route('ingredient-specifications.destroy', $ingredientSpecification->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this ingredient specification?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No ingredient specifications found.</p>
@endif
    <br>
    <a href="{{ url('/') }}">← Back</a>
</body>
</html>
