<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Recipes</h1>
            <div class="mb-4">
                <a href="{{ route('recipes.create') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-600 hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600">Create Recipe</a>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($recipes as $recipe)
                <x-ui.card>

                        <h2 class="text-xl font-bold mb-2 text-gray-800">{{ $recipe->name }}</h2>
                        <a href="{{ route('recipes.recipe-versions.index', $recipe) }}" class="text-slate-600 hover:text-slate-100 font-medium">View Recipe</a>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</x-layouts.app>
