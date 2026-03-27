<x-layouts.guest>
    <x-ui.card>
        <x-typography.section-title>Logout Confirmation</x-typography.section-title>
        <p class="mt-2 text-center text-sm text-gray-600">Are you sure you want to logout?</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <div class="mt-2 flex flex-col items-center">
                <x-ui.button type="submit">Yes, Log Me Out</x-ui.button>
                <x-ui.button type="button" href="/dashboard">No, take me back!</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</x-layouts.guest>
