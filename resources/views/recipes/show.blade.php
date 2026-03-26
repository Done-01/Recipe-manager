<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">{{ $recipe->name }}</h1>
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-bold mb-2">Details</h2>
            <p><strong>Description:</strong> {{ $recipe->description }}</p>
            <p><strong>Instructions:</strong> {{ $recipe->instructions }}</p>
            <div class="mt-4">
                <a href="{{ route('recipes.edit', $recipe) }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Edit Recipe</a>
            </div>
            <div class="mt-4">
                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete Recipe</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
