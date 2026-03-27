<x-layouts.guest>
    <div class="min-h-screen flex items-center justify-center bg-purple-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md text-center">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Welcome!
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">Please <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-medium">log in</a> or <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-medium">register</a> to continue.</p>
        </div>
    </div>
</x-layouts.guest>
