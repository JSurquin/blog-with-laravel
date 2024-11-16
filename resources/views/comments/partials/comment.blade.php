<div class="mb-4 rounded-lg border bg-white p-4 shadow-lg dark:bg-gray-800">
    <div class="mb-2 flex items-center text-sm text-gray-600 dark:text-white">
        <span class="font-medium text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
        <span class="mx-2">•</span>
        <span>{{ $comment->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <p class="text-gray-800 dark:text-white">{{ $comment->content }}</p>
</div>
