<x-onboarding>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-lg shadow-md">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Select an Organisation
            </h2>
            <p class="text-center text-sm text-gray-600">Please select an organization to continue.</p>
            <form class="mt-8 space-y-6" action="{{ route('onboarding.organisation') }}" method="POST">
                @csrf
        <select name="organisation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-pastel-orange focus:border-pastel-orange sm:text-sm rounded-md">
            @foreach ($organisations as $organisation)
                <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
            @endforeach
        </select>
        <div class="mt-6">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pastel-orange hover:bg-orange-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pastel-orange">Next</button>
        </div>
    </form>
        </div>
    </div>
</x-onboarding>
