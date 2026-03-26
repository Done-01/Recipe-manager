<x-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Create Recipe Version</h1>
        <div class="w-1/2">
        <form action="{{ route('recipes.recipe-versions.store', $recipe->id) }}" method="POST">
            @csrf
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="mb-4">
                    <label for="version" class="block text-sm font-medium text-gray-700">Version</label>
                    <input type="text" name="version" id="version" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="mb-4">
                    <label for="yield" class="block text-sm font-medium text-gray-700">Yield</label>
                    <input type="text" name="yield" id="yield" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="mb-4">
                    <label for="unit_id" class="block text-sm font-medium text-gray-700">Unit</label>
                    <select name="unit_id" id="unit_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Select a unit</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->unit_abbreviation }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="changelog" class="block text-sm font-medium text-gray-700">Changelog</label>
                    <textarea name="changelog" id="changelog" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Create Recipe</button>
                </div>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        </form>
    </div>
</x-layout>
