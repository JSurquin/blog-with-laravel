<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>
    <div class="mx-12 mt-6">
        <form class="flex flex-col gap-y-4" action="{{ route('posts.store') }}" method="POST">
            @csrf
            <label class="text-white" for="title">Titre</label>
            <input class="rounded-md border-2 border-gray-300 p-2" type="text" name="title" placeholder="Titre">
            <label class="text-white" for="content">Contenu</label>
            <input class="rounded-md border-2 border-gray-300 p-2" type="text" name="content" placeholder="Contenu">
            <button class="rounded-md bg-blue-500 px-3 py-2 text-white" type="submit">Créer</button>
        </form>
    </div>
</x-app-layout>
