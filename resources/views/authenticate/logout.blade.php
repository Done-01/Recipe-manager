<x-layouts.guest>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Logout Confirmation
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">Are you sure you want to logout?</p>
            <form class="mt-8 space-y-6" action="{{ route('logout') }}" method="POST">
                @csrf
            <div class="mt-6 flex flex-col items-center space-y-4">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Yes, Log Me Out</button>
                <a href="/dashboard" class="text-purple-600 hover:text-purple-800 font-medium">No, take me back!</a>
            </div>
            </form>
        </div>
    </div>
</x-layouts.guest>
