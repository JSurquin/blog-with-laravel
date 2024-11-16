<article class="mb-8 overflow-hidden rounded-lg bg-white shadow-lg dark:bg-gray-800">
    <div class="px-6 py-4">
        @if ($post->paid)
            <span class="inline-block rounded-md bg-green-500 px-2 py-1 text-xs font-medium text-white">
                Payant
            </span>
        @endif
        <div class="mb-2 text-xl font-bold text-gray-800 dark:text-white">
            {{ $post->title }}
        </div>
        <p class="text-base text-gray-700 dark:text-gray-300">
            {{ Str::limit($post->content, 200) }}
        </p>
    </div>
    <div class="px-6 py-4">
        <div class="grid items-center justify-between">
            <div class="flex items-center">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Par {{ $post->user->name }} le {{ $post->created_at->format('d/m/Y') }}
                </span>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('posts.show', $post) }}" 
                   class="rounded-md bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600">
                    Lire la suite
                </a>
                @can('update', $post)
                    <a href="{{ route('posts.show', $post) }}" 
                       class="rounded-md bg-yellow-500 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-600">
                        Modifier
                    </a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.show', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="rounded-md bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-600"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                            Supprimer
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</article>
