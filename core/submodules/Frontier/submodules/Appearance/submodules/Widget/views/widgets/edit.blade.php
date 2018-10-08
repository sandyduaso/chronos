@extends("Theme::layouts.admin")

@section("head-title", __("Edit $resource->name Visibility"))

@section("content")
    <v-toolbar light class="white elevation-1 sticky">
        <v-toolbar-title primary-title>{{ __('Edit Widget Visibility') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat primary href="{{ route('widgets.index') }}">
            <v-icon left primary>arrow_back</v-icon> {{ __('Back') }}</v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm6 offset-sm3>

                @include("Theme::partials.banner")

                <form action="{{ route('widgets.update', $resource->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <v-card class="elevation-1 mb-3">
                        <v-toolbar card class="transparent">
                            <v-icon>{{ $resource->icon }}</v-icon>
                            <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <div class="body-1 grey--text">{{ $resource->description }}</div>
                            <div class="body-1 grey--text">
                                <strong>Location:</strong> {{ $resource->location }}
                            </div>
                            <input type="hidden" name="code" value="{{ $resource->code }}">
                        </v-card-text>

                        <v-card-text>
                            <v-select
                                :items="roles.items"
                                autocomplete
                                chips
                                label="{{ __('Roles') }}"
                                max-height="400"
                                multiple
                                item-text="name"
                                item-value="id"
                                v-model="roles.selected"
                                hint="{{ __('Only the roles selected will be able to see this widget.') }}"
                                persistent-hint
                            ></v-select>
                            <input type="hidden" name="roles[]" v-for="(role, i) in roles.selected" :value="role.id ? role.id : role">
                        </v-card-text>

                        <v-card-actions class="pa-3">
                            <v-spacer></v-spacer>
                            <v-btn primary class="elevation-1" type="submit">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '{{ old('name') ?? $resource->name }}',
                        },
                        roles: {!! json_encode($resource->roles ?? []) !!},
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                    roles: {
                        items: {!! json_encode($roles->toArray()) !!},
                        selected: {!! json_encode(old('roles') ?? $resource->roles()->get(['roles.id'])->toArray()) !!},
                    },
                };
            },
        });
    </script>
@endpush
