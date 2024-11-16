<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="content" rows="3" class="w-full rounded border p-2 dark:bg-gray-700" placeholder="Votre commentaire..."></textarea>
    <button type="submit" class="mt-2 rounded bg-blue-500 px-4 py-2 text-white">Commenter</button>
</form>
