@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark extended class="indigo elevation-0">
        <v-btn
            href="{{ route('forms.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card flat class="transparent">
                    <v-layout row wrap>
                        <v-flex md8 offset-md2 xs12>
                            <v-card class="card--flex-toolbar">
                                <v-toolbar card prominent class="transparent">
                                    <v-toolbar-title class="title">{{ __($resource->name) }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>

                                {{-- @include("Form::templates.test") --}}

                                <form action="{{ $resource->action ?? route('submissions.submit') }}" method="{{ $resource->method }}" {!! $resource->attributes !!}>
                                   {{ csrf_field() }}
                                   <input type="hidden" name="form_id" value="{{ $resource->id }}">
                                   <input type="hidden" name="type" value="forms">

                                   <v-card class="elevation-1">
                                        <v-card-text>{!! $resource->body !!}</v-card-text>

                                        @foreach ($resource->fields()->orderBy('sort')->get() as $label => $field)
                                            <v-card-text>
                                                <div class="mb-2">{!! json_decode($field->template()->render()) !!}</div>
                                            </v-card-text>
                                        @endforeach

                                        <v-divider></v-divider>

                                        <v-card-text class="text-xs-right">
                                            <v-btn primary class="elevation-1" type="submit">{{ __('Submit') }}</v-btn>
                                        </v-card-text>
                                   </v-card>
                               </form>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
        .fw-500 {
            font-weight: 500 !important;
        }
        .input-group.radio {
            height: auto !important;
            position: relative !important;
            /*display: block !important;*/
        }
        .input-group.radio label {
            position: relative !important;
            height: auto !important;
            /*overflow: hidden !important;*/
            padding-left: 30px !important;
            /*word-wrap: break-word !important;*/
            float: left !important;
            margin-top: -30px;
            white-space: normal !important;
        }
        .input-group.radio .input-group__input{
            order: -1;
        }
    </style>
@endpush


@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                       item: {!! json_encode(old() ?? []) !!},
                       errors: {!! json_encode($errors->getMessages()) !!},
                    },
                };
            },
        });
    </script>
@endpush
