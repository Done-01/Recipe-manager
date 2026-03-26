<x-layout>
        <h1>Recipes</h1>
        @foreach ($recipes as $recipe)
            <p>{{ $recipe->name }}</p>
        @endforeach
</x-layout>
