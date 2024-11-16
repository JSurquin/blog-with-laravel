<x-app-layout>
    <div class="mx-auto mt-6 max-w-7xl">
        <x-article-card :post="$post" />
    </div>

    <div class="container mx-auto mt-6 rounded-lg bg-white p-3 dark:bg-gray-800">
        <h2 class="text-xl font-bold dark:text-white">Commentaires</h2>
        @foreach ($post->comments as $comment)
            @include('comments.partials.comment', ['comment' => $comment])
        @endforeach
    </div>

    <div class="container mx-auto mt-6 rounded-lg bg-white p-3 dark:bg-gray-800">
        <h3 class="text-lg font-bold dark:text-white">Ajouter un commentaire</h3>
        @include('comments.partials.form', ['post' => $post])
    </div>
</div>
</x-app-layout>
