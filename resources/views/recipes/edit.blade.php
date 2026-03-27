<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Edit Recipe</h1>
        <form action="{{ route('recipes.update', $recipe) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $recipe->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">{{ $recipe->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="instructions" class="block text-sm font-medium text-gray-700">Instructions</label>
                    <textarea name="instructions" id="instructions" rows="6" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-purple-500 focus:border-purple-500">{{ $recipe->instructions }}</textarea>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Update Recipe</button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>
