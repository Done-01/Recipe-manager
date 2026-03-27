<x-layouts.guest>
    <x-ui.card>
        <x-typography.section-title>Log In</x-typography.section-title>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div>
                <x-forms.input name="email" label="Email" type="email" />
            </div>
            <div>
                <x-forms.input name="password" label="Password" type="password" />
            </div>
                <x-forms.error />
                <div class="flex flex-col items-center">
                <x-ui.button variant="dark" type="submit">Log In</x-ui.button>
                <a href="{{ route('register') }}" class="mt-4 inline-block text-sm text-gray-600 hover:text-gray-900">
                    Register
                </a>
        </form>
    </x-ui.card>
</x-layouts.guest>
