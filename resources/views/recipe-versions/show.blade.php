<x-layouts.app>
    <div class="p-8 text-center">
        <h1 class="text-3xl font-bold mb-4">{{ $recipe->name }} Version {{ $recipeVersion->version }}</h1>
            <div class="mb-4">
                <a href="{{ route('recipes.create') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-600 hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600">Create new version</a>
            </div>
            <h2 class="text-xl font-bold mb-4 text-gray-800">Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <x-ui.card>
                        <h2 class="text-xl font-bold mb-2 text-gray-800">Yield</h2>
                        <p class="text-slate-600 mb-2">{{ $recipeVersion->yield }} {{ $recipeVersion->unit->unit_abbreviation ?? '-' }}</p>
                    </x-ui.card>
                    <x-ui.card>
                        <h2 class="text-xl font-bold mb-2 text-gray-800">Count</h2>
                        <p class="text-slate-600 mb-2">{{ $recipeVersion->count }} Units</p>
                    </x-ui.card>
                    <x-ui.card>
                        <h2 class="text-xl font-bold mb-2 text-gray-800">Status</h2>
                        <p class="text-slate-600 mb-2">{{ $recipeVersion->status }}</p>
                    </x-ui.card>
                    <x-ui.card>
                        <h2 class="text-xl font-bold mb-2 text-gray-800">Cost per unit</h2>
                        <p class="text-slate-600 mb-2">{{ $recipeVersion->cost_per_unit }}</p>
                    </x-ui.card>
            </div>
            <h2 class="text-xl font-bold mb-4 text-gray-800">Ingredients</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($recipeVersion->recipeIngredients as $ri)
                <x-ui.card>
                    <h2 class="text-xl font-bold mb-2 text-gray-800">{{ $ri->ingredient->name }}</h2>
                    <p class="text-slate-600 mb-2">{{ $ri->quantity }}</p>
                    <p class="text-slate-600 mb-2">{{ $ri->unit->unit_abbreviation ?? '-' }}</p>
                    <a href="{{ route('recipes.recipe-versions.index', $recipe) }}">View version</a>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</x-layouts.app>
