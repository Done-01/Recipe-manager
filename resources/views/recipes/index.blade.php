<x-layout>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipes</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">Recipe library</h1>
                <p class="mt-2 text-sm text-slate-600">Manage your recipes and open each version record from one place.</p>
            </div>
            <a href="{{ route('recipes.create') }}" class="flex justify-center rounded-2xl bg-teal-500 px-5 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Create Recipe</a>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($recipes as $recipe)
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900">{{ $recipe->name }}</h2>
                    <a href="{{ route('recipes.recipe-versions.index', $recipe) }}" class="mt-5 inline-flex text-sm font-medium text-teal-600 hover:text-teal-700">View Recipe</a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
