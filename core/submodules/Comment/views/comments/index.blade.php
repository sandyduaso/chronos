@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <div class="box-body top-border">
                    {{-- <div id="comments-container"></div> --}}
                    @include(
                        "Comment::widgets.comments",
                        [
                            "post"=>route('api.forums.comment', $resource->id),
                            "all" => route('api.forums.all', $resource->id),
                            "put"=>route('api.forums.update', $resource->id)
                        ]
                    )
                </div>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
