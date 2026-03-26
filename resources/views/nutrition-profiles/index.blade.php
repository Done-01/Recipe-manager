<!DOCTYPE html>
<html>
<body>
    <h1>Nutrition Profiles</h1>
    <p>{{ $nutritionProfiles->count() }} records</p>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Source</th>
                <th>Organisation</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nutritionProfiles as $nutritionProfile)
                <tr>
                    <td>{{ $nutritionProfile->name }}</td>
                    <td>{{ $nutritionProfile->source }}</td>
                    <td>{{ $nutritionProfile->organisation?->organisation_name ?? '—' }}</td>
                    <td>{{ $nutritionProfile->createdBy?->name ?? '—' }}</td>
                    <td>{{ $nutritionProfile->created_at }}</td>
                    <td>
                        <a href="{{ route('nutrition-profiles.edit', $nutritionProfile->id) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <a href="{{ url('/') }}">← Back</a>
</body>
</html>
