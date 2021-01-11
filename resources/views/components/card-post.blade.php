@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    <img class="w-full h-72 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{ route('posts.show', $post) }}">{{ $post->name }}</a>
        </h1>
        <div class="text-gray-700 text-base">
            {{ $post->extract }}
        </div>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tag as $t)
            <a class="inline-block bg-{{ $t->color }}-500 rounded-full px-3 py-1 text-sm text-white mr-2" href="{{ route('posts.tag', $t) }}">{{ $t->name }}</a>
        @endforeach
    </div>
</article>