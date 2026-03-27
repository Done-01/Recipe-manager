<x-layouts.app>
        <x-ui.card>
            <x-typography.section-title>Organisations</x-typogrophy.section-title>
            <div class="mt-4 flex items-center justify-center">
            @foreach ($organisations as $organisation)
                <form action="{{ route('organisations.select') }}" method="post">
                    @csrf
                    <input type="hidden" name="organisation" value="{{ $organisation->id }}">
                    <x-ui.button type="submit" class="mt-2">
                        {{ $organisation->organisation_name }}
                    </x-ui.button>
                </form>
            @endforeach
            @if (session('message'))
                <div class="mt-4 text-center text-sm text-green-600">
                    {{ session('message') }}
                </div>
            @endif
            </div>
            <x-ui.button variant="dark" href="{{ route('organisations.create') }}">Create Organisation</x-ui.button>
        </x-ui.card>
</x-layouts.app>
