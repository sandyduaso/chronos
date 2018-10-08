<a name="comments"></a>
<v-card flat class="transparent">
    <v-toolbar class="transparent elevation-0">
        <v-toolbar-title class="page-title subheading">{{ __("Comments") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>

    {{-- Comments Section --}}
    <v-card-text class="transparent pr-4">
        @include("Theme::comments.comments-list", [
            'comments' => $resource->comments()->parents()->paginate()->items()
        ])
    </v-card-text>
    {{-- Comments Section --}}

    {{-- Pagination --}}
    <v-card-actions>
        <v-spacer></v-spacer>
        @include("Theme::partials.pagination", [
            'resources' => $resource->comments()->paginate(),
            'section' => '#comments'
        ])
        <v-spacer></v-spacer>
    </v-card-actions>
    {{-- Pagination --}}

    <v-divider></v-divider>

    <a name="post-comments"></a>
    <v-card flat class="transparent">
        <v-toolbar card dense class="transparent">
            <v-toolbar-title class="subheading page-title">{{ __('Post Comment') }}</v-toolbar-title>
        </v-toolbar>
        <v-divider></v-divider>

        <form action="{{ route('comments.store') }}" method="POST">
            {{ csrf_field() }}
            @if (user())
                <input type="hidden" name="user_id" value="{{ user()->id }}">
            @endif
            <input type="hidden" name="commentable_id" value="{{ $id ?? $resource->id }}">
            <input type="hidden" name="commentable_type" value="{{ $type ?? get_class($resource) }}">

            {{-- editor --}}
            @include("Theme::comments.commentform-editor")
            @if ($errors->first('body'))
                <v-card-text>
                    <p class="error--text body-1">{{ __($errors->first('body')) }}</p>
                </v-card-text>
            @endif
            {{-- editor --}}

            <v-divider></v-divider>

            <v-card-actions>
                @if (user())
                    @can('post-comment')
                        <v-spacer></v-spacer>
                        <v-btn type="submit" flat primary>{{ __('Post Comment') }}</v-btn>
                    @endcan
                @else
                    <span class="pa-2 body-1 grey--text"><a class="td-n" href="{{ route('login.show', ['redirect_to' => route('courses.show', $resource->slug) . '#post-comments']) }}">{{ __('Login') }}</a> {{ __('and join the discourse.') }}</span>
                    <v-spacer></v-spacer>
                    <v-btn disabled flat primary>{{ __('Post Comment') }}</v-btn>
                @endif
            </v-card-actions>
        </form>
    </v-card>
</v-card>

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        // Vue.use(VueResource);
        mixins.push({
            data () {
                return {
                    resource: {
                        quill: {
                            html: '{!! old('body') !!}',
                            delta: JSON.parse({!! json_encode(old('delta')) !!}),
                        },
                    },
                    hidden: true,
                }
            },
        })
    </script>
@endpush
