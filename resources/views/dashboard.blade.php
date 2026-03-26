<x-layout>
    <div class="text-center">
        <h1>Welcome!</h1>
        @if (auth()->check())
            <p>You are logged in as {{ auth()->user()->name }}.</p>
        @else
            <p>You are not logged in.</p>
        @endif
            @if(session('active_organisation'))
                <p>Selected organisation: {{ auth()->user()->currentOrganisation()->organisation_name ?? 'No organisation selected' }}</p>
            @endif
    </div>
</x-layout>
