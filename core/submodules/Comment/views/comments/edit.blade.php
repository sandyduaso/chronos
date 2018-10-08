@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title>{{ $resource->commentable->name ?? $resource->commentable->title }}</v-toolbar-title>
                    </v-toolbar>

                    <form action="{{ route('comments.update', $resource->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        {{-- Editor --}}
                        <v-quill
                            :paper="{{ $isPaper ?? 'false' }}"
                            :options="{
                                placeholder: '{{ __('Write something...') }}',
                            }"
                            :toolbar-options="[
                                [{'header':1},{'header':2}],
                                ['bold','italic','underline','strike'],
                                [{'align':''},{'align':'center'},{'align':'right'},{'align':'justify'}],
                                ['blockquote','code-block'],
                                [{'list':'ordered'},{'list':'bullet'}],
                                [{'indent':'-1'},{'indent':'+1'},'image'],
                            ]"
                            class="elevation-0"
                            class="mb-3 card--flat white elevation-1"
                            v-model="resource.quill"
                        >
                            <template>
                                <input type="hidden" name="body" :value="resource.quill.html">
                                <input type="hidden" name="delta" :value="JSON.stringify(resource.quill.delta)">
                            </template>
                        </v-quill>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary class="elevation-1">{{ __('Update Comment') }}</v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        quill: {
                            html: '{!! $resource->body !!}',
                            delta: JSON.parse({!! json_encode($resource->delta) !!}),
                            errors: {
                                body: '{!! json_encode($errors->first('body')) !!}',
                                delta: '{!! json_encode($errors->first('delta')) !!}',
                            }
                        }
                    },
                }
            }
        })
    </script>
@endpush
