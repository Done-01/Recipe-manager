<!DOCTYPE html>
<html>
<body>
    <h1>Recipe Categories</h1>
    <p><a href="{{ route('recipe-categories.create') }}">Create New Recipe Category</a></p>
    <p>{{ $recipeCategories->count() }} records</p>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Organisation</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipeCategories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->organisation?->organisation_name ?? '—' }}</td>
                    <td>{{ $category->createdBy?->name ?? '—' }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td><a href="{{ route('recipe-categories.edit', $category->id) }}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/') }}">← Back</a>
</body>
</html>
