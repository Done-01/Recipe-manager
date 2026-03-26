<!DOCTYPE html>
<html>
<body>
    <h1>Recipe Versions</h1>
    <p>{{ $recipeVersions->count() }} records</p>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Recipe</th>
                <th>Version</th>
                <th>Name</th>
                <th>Status</th>
                <th>Yield</th>
                <th>Unit</th>
                <th>Committed By</th>
                <th>Committed At</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recipeVersions as $version)
                <a href="{{ route('recipes.recipe-versions.index', $version) }}"></a>
                <tr>
                    <td>{{ $version->id }}</td>
                    <td>{{ $version->recipe?->name ?? '—' }}</td>
                    <td>{{ $version->version }}</td>
                    <td>{{ $version->name }}</td>
                    <td>{{ $version->status }}</td>
                    <td>{{ $version->yield ?? '—' }}</td>
                    <td>{{ $version->unit?->unit_abbreviation ?? '—' }}</td>
                    <td>{{ $version->commitedBy?->name ?? '—' }}</td>
                    <td>{{ $version->commited_at ?? '—' }}</td>
                    <td>{{ $version->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/') }}">← Back</a>
</body>
</html>
