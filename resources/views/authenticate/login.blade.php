<x-guest>
    <x-slot:title>Log In</x-slot:title>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
            @if (session('status'))
                <div class="mt-4 text-center text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
        </div>

        <div class="mt-6">
            <button class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Log In</button>
        </div>
        <div class="mt-4 text-center text-sm">
            <p>Don't have an account? <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-medium">Register</a></p>
        </div>
        <div class="mt-4 text-sm text-red-600">
            @if ($errors->any())
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
            </form>
        </div>
    </div>
</x-guest>
