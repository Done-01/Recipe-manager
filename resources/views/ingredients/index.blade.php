<!DOCTYPE html>
<html>
<body>
    <h1>Ingredients</h1>
    <p><a href="{{ route('ingredients.create') }}">Create New Ingredient</a></p>
    <p>{{ $ingredients->count() }} records</p>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Organisation</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->id }}</td>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->organisation?->organisation_name ?? '—' }}</td>
                    <td>{{ $ingredient->createdBy?->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('ingredients.edit', $ingredient->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/') }}">← Back</a>
</body>
</html>
