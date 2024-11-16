<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Carte statistiques -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Statistiques</h3>
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">89%</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Augmentation ce mois</p>
                </div>

                <!-- Carte activité -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Activité récente</h3>
                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800 dark:bg-green-900 dark:text-green-200">En ligne</span>
                    </div>
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __("You're logged in!") }}</p>
                        </div>
                    </div>
                </div>

                <!-- Carte progrès -->
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Progrès</h3>
                        <div class="relative h-8 w-8">
                            <div class="absolute h-full w-full rounded-full border-2 border-blue-500"></div>
                            <div class="absolute h-full w-full animate-spin rounded-full border-t-2 border-blue-500"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="h-2 w-full rounded-full bg-gray-200 dark:bg-gray-700">
                            <div class="h-2 w-2/3 rounded-full bg-blue-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
