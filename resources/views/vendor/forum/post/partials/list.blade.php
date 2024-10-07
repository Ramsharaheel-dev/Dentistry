<div @if (! $post->trashed())id="post-{{ $post->sequence }}"@endif
    class="post card mb-2 {{ $post->trashed() || $thread->trashed() ? 'deleted' : '' }}"
    :class="{ 'border-primary': selectedPosts.includes({{ $post->id }}) }">
    <div class="card-header">
        @if (! isset($single) || ! $single)
        <span class="float-end">
            <a href="{{ Forum::route('thread.show', $post) }}">#{{ $post->sequence }}</a>
            @if ($post->sequence != 1)

            <input type="checkbox" name="posts[]" :value="{{ $post->id }}" v-model="selectedPosts">

            @endif
        </span>
        @endif

        {{ $post->authorName }}

        <span class="text-muted">
            @include ('forum::partials.timestamp', ['carbon' => $post->created_at])
            @if ($post->hasBeenUpdated())
            ({{ trans('forum::general.last_updated') }} @include ('forum::partials.timestamp', ['carbon' => $post->updated_at]))
            @endif
        </span>
    </div>
    <div class="card-body">
        @if ($post->parent !== null)
        @include ('forum::post.partials.quote', ['post' => $post->parent])
        @endif

        @if ($post->trashed())

        {!! Forum::render($post->content) !!}
        <br>

        <span class="badge rounded-pill bg-danger">{{ trans('forum::general.deleted') }}</span>
        @else
        {!! Forum::render($post->content) !!}
        @endif

        @if (! isset($single) || ! $single)
        <div class="text-end">
            @if (! $post->trashed())
            <a href="{{ Forum::route('post.show', $post) }}" class="card-link text-muted">{{ trans('forum::general.permalink') }}</a>
            @if ($post->sequence != 1)

            <a href="{{ Forum::route('post.confirm-delete', $post) }}" class="card-link text-danger">{{ trans('forum::general.delete') }}</a>

            @endif

            <a href="{{ Forum::route('post.edit', $post) }}" class="card-link">{{ trans('forum::general.edit') }}</a>

            <a href="{{ Forum::route('post.create', $post) }}" class="card-link">{{ trans('forum::general.reply') }}</a>

            @else

            <a href="{{ Forum::route('post.confirm-restore', $post) }}" class="card-link">{{ trans('forum::general.restore') }}</a>

            @endif
        </div>
        @endif
    </div>
</div>