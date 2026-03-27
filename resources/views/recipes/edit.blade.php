<x-layout>
    <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Recipes</p>
        <h1 class="mt-3 text-3xl font-semibold text-slate-900">Edit recipe</h1>
        <form action="{{ route('recipes.update', $recipe) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-8 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ $recipe->name }}" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">{{ $recipe->description }}</textarea>
                </div>
                <div>
                    <label for="instructions" class="block text-sm font-medium text-slate-700">Instructions</label>
                    <textarea name="instructions" id="instructions" rows="6" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white">{{ $recipe->instructions }}</textarea>
                </div>
                <div class="mt-6">
                    <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">Update Recipe</button>
                </div>
            </div>
        </form>
    </div>
</x-layout>
