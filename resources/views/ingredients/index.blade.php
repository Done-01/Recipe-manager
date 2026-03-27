<x-layouts.app>
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-4">Recipes</h1>
            <div class="mb-4">
                <a href="{{ route('ingredients.create') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-600 hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-600">Create Ingredient</a>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($ingredients as $ingredient)
                <x-ui.card>

                        <h2 class="text-xl font-bold mb-2 text-gray-800">{{ $ingredient->name }}</h2>
                        <a href="{{ route('ingredients.show', $ingredient) }}" class="text-slate-600 hover:text-slate-100 font-medium">View Ingredient</a>
                </x-ui.card>
            @endforeach
        </div>
    </div>
</x-layouts.app>
