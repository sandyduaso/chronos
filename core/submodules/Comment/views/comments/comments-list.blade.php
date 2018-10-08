@if (empty($comments))
    <div class="text-xs-center body-1 grey--text">{{ __('No comments yet.') }}</div>
@endif
@foreach ($comments as $comment)
    <v-card flat tile class="transparent">
        <v-list>
            <v-list-tile>
                <v-list-tile-avatar>
                    <img src="{{ $comment->user->avatar ?? '' }}">
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title class="td-n grey--text text--darken-4 body-2">
                        <a href="{{ route('profile.single', $comment->user->handlename) }}" class="td-n">{{ $comment->user->fullname }}</a>
                    </v-list-tile-title>
                    <v-list-tile-sub-title class="body-1 grey--text">
                        <v-icon left class="body-1">access_time</v-icon> {{ $comment->created }}
                    </v-list-tile-sub-title>
                </v-list-tile-content>
                @owned($comment->user->id)
                    <v-list-tile-action>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                {{-- <v-list-tile :href="route(urls.pages.edit, (prop.item.id))"> --}}
                                <v-list-tile ripple href="{{ route('comments.edit', $comment->id) }}">
                                    <v-list-tile-action>
                                        <v-icon accent>edit</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Edit Comment') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                {{-- <v-list-tile ripple @click="$refs[`destroy_{{ $comment->id }}`].submit()">
                                    <v-list-tile-action>
                                        <v-icon warning>delete</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Delete Comment') }}
                                            <form :id="`destroy_{{ $comment->id }}`" :ref="`destroy_{{ $comment->id }}`" action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile> --}}
                            </v-list>
                        </v-menu>
                    </v-list-tile-action>
                @endowned
            </v-list-tile>
        </v-list>
        <v-card flat class="pr-0 grey--text text--darken-2">
            <v-card-text class="page-content body-1">{!! filter_obscene_words($comment->body) !!}</v-card-text>
            <v-card-actions class="grey--text text--darken-2">
                {{-- Upvotes / Downvotes --}}
                <div>
                    <span class="green--text text--lighten-3 body-1">
                        <v-icon class="green--text text--lighten-3 body-1">fa-thumbs-up</v-icon>
                        <em>{{ $comment->upvotes ?? 0 }}</em>
                    </span>
                </div>
                <div>
                    <span class="red--text text--lighten-3 body-1">
                        <v-icon class="red--text text--lighten-3 body-1">fa-thumbs-down</v-icon>
                        <em>{{ $comment->downvotes ?? 0 }}</em>
                    </span>
                </div>
                <div>
                    {{-- Upvotes / Downvotes --}}
                    <v-spacer></v-spacer>
                    @can('post-comment')
                        <v-btn small accent flat @click="$refs[`commentform-{{ $comment->id }}`].style.display='block'">{{ __('Reply') }}</v-btn>
                    @else
                        <v-btn small accent flat disabled>{{ __('Reply') }}</v-btn>
                    @endcan
                </div>
            </v-card-actions>
            {{-- Replyform --}}
            <v-card flat class="mb-3" id="commentform-{{ $comment->id ?? 'random' }}" ref="commentform-{{ $comment->id ?? 'random' }}" :style="{display:'none',border:'1px solid rgba(0,0,0,0.3)'}">
                @include("Theme::comments.commentform", ['isPaper' => 'false'])
            </v-card>
            {{-- Replyform --}}

            <v-divider></v-divider>

            {{-- Replies --}}
            <v-card flat tile class="pl-5">
                @include("Theme::comments.comments-list", ['comments' => $comment->replies])
            </v-card>
            {{-- Replies --}}
        </v-card>
    </v-card>
@endforeach
