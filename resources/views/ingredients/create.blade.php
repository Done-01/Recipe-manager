<!DOCTYPE html>
<html>
<body>
    <h1>Create Ingredient</h1>

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

    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Ingredient Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <button type="submit">Create Ingredient</button>
        </div>
    </form>
</body>
</html>