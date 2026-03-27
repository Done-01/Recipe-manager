<x-layout>
    <div class="mx-auto max-w-xl rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-600">Organisation</p>
        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Create organisation</h2>
        <p class="mt-2 text-sm text-slate-600">Add a workspace for your recipes, ingredients, and nutrition data.</p>
            <form class="mt-8 space-y-6" action="{{ route('organisations.store') }}" method="POST">
                @csrf
                <div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">Organisation name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required class="mt-2 block w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-teal-400 focus:bg-white" placeholder="Organisation Name">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-2xl bg-teal-500 px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-teal-600">
                        Create
                    </button>
                </div>
            </form>
        </div>
</x-layout>
