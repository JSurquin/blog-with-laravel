<x-app-layout>

<br> 
@can("create", \App\Models\Post::class)
        <a href="{{ route('posts.create') }}" class="mx-10 mt-4 rounded-md bg-blue-500 px-4 py-2 text-white">
            Créer un article
        </a>
    @endcan

    <div class="mx-auto mt-6 max-w-7xl">
        @include('posts.partials.all-articles')
    </div>
</x-app-layout>
