<!DOCTYPE html>
<html>
<body>
    <h1>Edit Nutrition Profile</h1>

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

<form action="{{ route('nutrition-profiles.update', $nutritionProfile->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Nutrition Profile Name</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $nutritionProfile->name) }}"
            required
        >
    </div>

    <br>

    <div>
        <label for="source">Source</label>
        <select name="source" id="source" required>
            <option value="">Select Source</option>
            <option value="manual" {{ old('source', $nutritionProfile->source) == 'manual' ? 'selected' : '' }}>manual</option>
            <option value="supplier_spec" {{ old('source', $nutritionProfile->source) == 'supplier_spec' ? 'selected' : '' }}>supplier_spec</option>
            <option value="mccance" {{ old('source', $nutritionProfile->source) == 'mccance' ? 'selected' : '' }}>mccance</option>
            <option value="library" {{ old('source', $nutritionProfile->source) == 'library' ? 'selected' : '' }}>library</option>
            <option value="partner" {{ old('source', $nutritionProfile->source) == 'partner' ? 'selected' : '' }}>partner</option>
        </select>
    </div>

    <br>

    <div>
        <button type="submit">Update Nutrition Profile</button>
    </div>
</form>
</body>
</html>