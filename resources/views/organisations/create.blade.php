<x-layouts.app>
    <div class="min-h-screen w-full flex items-center justify-center bg-gray-100">
        <x-ui.card>
            <x-typography.section-title>Create Organisation</x-typography.section-title>
            <form class="mt-4" action="{{ route('organisations.store') }}" method="POST">
                <x-forms.label for="name">Name</x-forms.label>
                <x-forms.input name="name" label="Name" />
                <x-ui.button variant="dark" type="submit">Create</x-ui.button>
            </form>
        </x-ui.card>
    </div>
</x-layouts.app>
