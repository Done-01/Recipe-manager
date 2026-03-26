<!DOCTYPE html>
<html>
</head>
<body>
    <h1>Edit Ingredient</h1>

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

<form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Ingredient Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $ingredient->name) }}"
            required
        >
    </div>

    <br>

    <div>
        <button type="submit">Update Ingredient</button>
    </div>
</form>
</body>
</html>