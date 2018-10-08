@include("Theme::comments.commentform-messages")

<form action="{{ route('comments.store') }}" method="POST">
    {{ csrf_field() }}
    <v-card flat class="transparent">
        <input type="hidden" name="type" value="{{ $type ?? get_class($resource) }}">
        <input type="hidden" name="commentable_id" value="{{ $id ?? $resource->id }}">
        <input type="hidden" name="commentable_type" value="{{ $type ?? get_class($resource) }}">

        @if (user())
            <input type="hidden" name="user_id" value="{{ user()->id }}">
            @isset ($comment)
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            @endisset
        @endif

        {{-- editor --}}
        @include("Theme::comments.commentform-editor")
        {{-- editor --}}

        <v-divider></v-divider>

        <v-card-actions>
            @if(user())
                @can('post-comment')
                    <v-btn flat @click="$refs[`commentform-{{ $comment->id ?? 'random' }}`].style.display='none'">{{ __('Cancel') }}</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" flat primary>{{ __('Post Comment') }}</v-btn>
                @endcan
            @else
                <span class="pa-2 body-1 grey--text"><a class="td-n" href="{{ route('login.show', ['redirect_to' => route('courses.show', $resource->slug) . '#post-comments']) }}">{{ __('Login') }}</a> {{ __('and join the discourse.') }}</span>
                <v-spacer></v-spacer>
                <v-btn disabled flat primary>{{ __('Post Comment') }}</v-btn>
            @endif
        </v-card-actions>
    </v-card>
</form>
