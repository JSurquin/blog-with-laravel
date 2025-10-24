<x-app-layout>
    <!-- Article Content -->
    <div class="bg-gray-50 py-12 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8 flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                <a href="/" class="hover:text-indigo-600 dark:hover:text-indigo-400">Accueil</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('posts.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">Articles</a>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-900 dark:text-white">{{ Str::limit($post->title, 50) }}</span>
            </nav>

            <!-- Article Header -->
            <article class="overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-gray-800">
                <!-- Hero Image/Gradient -->
                <div class="relative h-96 overflow-hidden bg-gradient-to-br from-indigo-400 via-purple-400 to-pink-400">
                    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iZ3JpZCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-30"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                    
                    <!-- Badge Premium -->
                    @if ($post->paid)
                        <div class="absolute right-8 top-8">
                            <span class="flex items-center space-x-2 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 px-4 py-2 text-sm font-bold text-white shadow-lg">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span>Article Premium</span>
                            </span>
                        </div>
                    @endif

                    <!-- Title Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-8">
                        <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                            {{ $post->title }}
                        </h1>
                    </div>
                </div>

                <!-- Article Meta & Content -->
                <div class="p-8">
                    <!-- Author Info & Meta -->
                    <div class="mb-8 flex flex-wrap items-center justify-between gap-4 border-b border-gray-200 pb-6 dark:border-gray-700">
                        <div class="flex items-center space-x-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-lg font-bold text-white">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $post->user->name }}</p>
                                <div class="flex items-center space-x-3 text-sm text-gray-500 dark:text-gray-400">
                                    <span>{{ $post->created_at->format('d M Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                    <span>•</span>
                                    <span>{{ str_word_count($post->content) }} mots</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            @can('update', $post)
                                <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center space-x-1 rounded-lg border-2 border-yellow-500 bg-yellow-50 px-4 py-2 text-sm font-medium text-yellow-700 transition-all hover:bg-yellow-500 hover:text-white dark:bg-yellow-900/20 dark:text-yellow-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>Modifier</span>
                                </a>
                            @endcan
                            
                            @can('delete', $post)
                                <form action="{{ route('posts.show', $post) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center space-x-1 rounded-lg border-2 border-red-500 bg-red-50 px-4 py-2 text-sm font-medium text-red-700 transition-all hover:bg-red-500 hover:text-white dark:bg-red-900/20 dark:text-red-400" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        <span>Supprimer</span>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none dark:prose-invert prose-headings:font-bold prose-a:text-indigo-600 dark:prose-a:text-indigo-400">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Tags/Meta -->
                    <div class="mt-8 flex items-center space-x-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300">
                            {{ $post->slug }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $post->comments->count() }} commentaire{{ $post->comments->count() > 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="mt-12">
                <div class="mb-8 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Commentaires ({{ $post->comments->count() }})
                    </h2>
                </div>

                <!-- Add Comment Form -->
                @auth
                    <div class="mb-8 rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Laisser un commentaire</h3>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea name="content" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" placeholder="Partagez votre avis sur cet article..." required></textarea>
                            <div class="mt-4 flex items-center justify-end">
                                <button type="submit" class="inline-flex items-center space-x-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-md transition-all hover:scale-105 hover:shadow-lg">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    <span>Publier le commentaire</span>
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="mb-8 rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 p-8 text-center dark:border-gray-700 dark:bg-gray-800">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Connectez-vous pour commenter</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Vous devez être connecté pour laisser un commentaire sur cet article.</p>
                        <div class="mt-6">
                            <a href="{{ route('login') }}" class="inline-flex items-center space-x-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-md transition-all hover:scale-105 hover:shadow-lg">
                                <span>Se connecter</span>
                            </a>
                        </div>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse ($post->comments as $comment)
                        <div class="rounded-2xl bg-white p-6 shadow-md transition-all hover:shadow-lg dark:bg-gray-800">
                            <div class="flex items-start space-x-4">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-sm font-bold text-white">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 p-12 text-center dark:border-gray-700 dark:bg-gray-800">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Aucun commentaire pour le moment</p>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Soyez le premier à partager votre avis sur cet article !</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
