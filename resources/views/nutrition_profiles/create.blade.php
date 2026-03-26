<!DOCTYPE html>
<html>
<body>
    <h1>Create Nutrition Profile</h1>

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

<form action="{{ route('nutrition-profiles.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Nutrition Profile Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="source">Source</label>
        <select name="source" id="source" required>
            <option value="">Select Source</option>
            <option value="manual" {{ old('source') == 'manual' ? 'selected' : '' }}>manual</option>
            <option value="supplier_spec" {{ old('source') == 'supplier_spec' ? 'selected' : '' }}>supplier_spec</option>
            <option value="mccance" {{ old('source') == 'mccance' ? 'selected' : '' }}>mccance</option>
            <option value="library" {{ old('source') == 'library' ? 'selected' : '' }}>library</option>
            <option value="partner" {{ old('source') == 'partner' ? 'selected' : '' }}>partner</option>
        </select>
    </div>

    <br>

    <div>
        <button type="submit">Create Nutrition Profile</button>
    </div>
</form>
</body>
</html>