<div class="mt-4 text-sm text-red-600">
    @if ($errors->any())
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
