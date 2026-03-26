<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Recipes</h1>
        <div class="mb-4">
            <a href="{{ route('recipes.create') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Create Recipe</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($recipes as $recipe)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-xl font-bold mb-2">{{ $recipe->name }}</h2>
                    <a href="{{ route('recipes.recipe-versions.index', $recipe) }}" class="text-purple-600 hover:text-purple-800 font-medium">View Recipe</a>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
