<x-layouts.app>
    <h1>Edit Recipe Category</h1>

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

<form action="{{ route('recipe-categories.update', $recipeCategory->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Category Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $recipeCategory->name) }}"
            required
        >
    </div>

    <br>

    <div>
        <button type="submit">Update Recipe Category</button>
    </div>
</form>
</x-layouts.app>
