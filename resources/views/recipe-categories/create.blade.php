<x-layouts.app>
    <h1>Create Recipe Category</h1>
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

    <form action="{{ route('recipe-categories.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <button type="submit">Create Recipe Category</button>
        </div>
    </form>
</x-layouts.app>
