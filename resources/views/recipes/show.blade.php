<x-layout>
    <div class="mx-auto max-w-3xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipes</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">{{ $recipe->name }}</h1>
        <div class="mt-8 space-y-6">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Details</h2>
                <p class="mt-3 text-sm font-medium text-slate-500">Description</p>
                <p class="mt-1 text-slate-700">{{ $recipe->description ?: 'No description added yet.' }}</p>
                <p class="mt-4 text-sm font-medium text-slate-500">Instructions</p>
                <p class="mt-1 whitespace-pre-line text-slate-700">{{ $recipe->instructions ?: 'No instructions added yet.' }}</p>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('recipes.edit', $recipe) }}" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Edit Recipe</a>
            </div>
            <div>
                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex w-full justify-center rounded-2xl bg-rose-600 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-rose-700">Delete Recipe</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
