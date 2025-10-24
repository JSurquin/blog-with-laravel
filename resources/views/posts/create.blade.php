<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl dark:text-white">
                    Créer un
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                        Nouvel Article
                    </span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Partagez vos connaissances et idées avec la communauté
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="bg-gray-50 py-12 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-gray-800">
                <div class="p-8">
                    <form class="space-y-8" action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        
                        <!-- Title Field -->
                        <div>
                            <label for="title" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Titre de l'article
                                <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" 
                                placeholder="Ex: Les meilleures pratiques en Laravel 11"
                                required
                            >
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Un titre accrocheur qui résume votre article
                            </p>
                        </div>

                        <!-- Content Field -->
                        <div>
                            <label for="content" class="mb-2 block text-sm font-semibold text-gray-900 dark:text-white">
                                Contenu
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="content" 
                                id="content"
                                rows="12"
                                class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white" 
                                placeholder="Rédigez le contenu de votre article ici..."
                                required
                            ></textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Développez votre sujet en détail. Minimum 100 caractères recommandés.
                            </p>
                        </div>

                        <!-- Additional Options -->
                        <div class="rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-900">
                            <h3 class="mb-4 flex items-center space-x-2 text-lg font-semibold text-gray-900 dark:text-white">
                                <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                                <span>Options avancées</span>
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Ces paramètres seront ajoutés automatiquement lors de la publication
                            </p>
                            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Slug généré automatiquement</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Publication immédiate</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Auteur attribué automatiquement</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Horodatage automatique</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col-reverse gap-4 sm:flex-row sm:justify-end">
                            <a href="{{ route('posts.index') }}" class="inline-flex items-center justify-center space-x-2 rounded-xl border-2 border-gray-300 bg-white px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Annuler</span>
                            </a>
                            <button type="submit" class="group inline-flex items-center justify-center space-x-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Publier l'article</span>
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-8 rounded-2xl border-2 border-indigo-200 bg-indigo-50 p-6 dark:border-indigo-900 dark:bg-indigo-900/20">
                <div class="flex items-start space-x-3">
                    <svg class="mt-1 h-6 w-6 flex-shrink-0 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-indigo-900 dark:text-indigo-300">Conseils pour un bon article</h4>
                        <ul class="mt-2 space-y-1 text-sm text-indigo-800 dark:text-indigo-200">
                            <li>• Utilisez un titre clair et descriptif</li>
                            <li>• Structurez votre contenu avec des paragraphes</li>
                            <li>• Relisez-vous avant de publier</li>
                            <li>• Ajoutez des exemples concrets si possible</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
