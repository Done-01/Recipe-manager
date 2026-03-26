<x-onboarding>
    <h1></h1>
    <x-slot:title>Create Organisation</x-slot:title>
    <form action="{{ route('organisations.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <button type="submit" class="bg-pastel-orange text-white px-4 py-2 rounded hover:bg-orange-400">Create</button>
        </div>
    </form>
</x-onboarding>
