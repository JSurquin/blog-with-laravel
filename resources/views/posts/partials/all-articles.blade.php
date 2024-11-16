    <div class="mx-12 grid grid-cols-3 gap-4">
    @foreach ($posts as $post)
        <x-article-card :post="$post" />
    @endforeach
    </div>
