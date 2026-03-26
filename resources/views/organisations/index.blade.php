<x-layout>
    <div class="min-h-screen w-full flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Organisations
            </h2>
            @if (session('message'))
                <div class="mt-4 text-center text-sm text-green-600">
                    {{ session('message') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" action="{{ route("organisations.select") }}" method="post">
                @csrf
            @foreach ($organisations as $organisation)
                <div class="flex items-center mb-2">
                    <input type="radio" name="organisation" value="{{ $organisation->id }}" class="focus:ring-purple-500 h-4 w-4 text-purple-600 border-gray-300">
                    <label for="organisation-{{ $organisation->id }}" class="ml-2 block text-sm font-medium text-gray-700">{{ $organisation->organisation_name }}</label>
                </div>
            @endforeach
            <div class="mt-6">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Select</button>
                <a href="{{ route('organisations.create') }}" class="mt-2 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Create Organisation</a>
            </div>
            </form>
        </div>
    </div>
</x-layout>
