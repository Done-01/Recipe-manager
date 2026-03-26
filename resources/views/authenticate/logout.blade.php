<x-guest>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Logout Confirmation
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">Are you sure you want to logout?</p>
            <form class="mt-8 space-y-6" action="{{ route('logout') }}" method="POST">
                @csrf
            <div class="mt-6 flex flex-col items-center space-y-4">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pastel-orange hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pastel-orange">Yes, Log Me Out</button>
                <a href="/dashboard" class="text-pastel-orange hover:text-orange-700 font-medium">No, take me back!</a>
            </div>
            </form>
        </div>
    </div>
</x-guest>
