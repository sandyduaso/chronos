@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>fa-twitter</v-icon>
        <v-toolbar-title>{{ __('Social Media') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="white">
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex md4 sm6>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm6 md4>


                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}

                    <v-card class="transparent" flat>
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Social Media') }}</v-toolbar-title>
                        </v-toolbar>

                        <v-subheader>{{ __('Links') }}</v-subheader>

                        <v-card-text>
                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'facebook.url') }}" prepend-icon="fa-facebook" label="{{ __('Facebook') }}" name="social_links[facebook][url]"></v-text-field>
                            <input type="hidden" name="social_links[facebook][name]" value="Facebook">
                            <input type="hidden" name="social_links[facebook][icon]" value="fa-facebook">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'twitter.url') }}" prepend-icon="fa-twitter" label="{{ __('Twitter') }}" name="social_links[twitter][url]"></v-text-field>
                            <input type="hidden" name="social_links[twitter][name]" value="Twitter">
                            <input type="hidden" name="social_links[twitter][icon]" value="fa-twitter">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'youtube.url') }}" prepend-icon="fa-youtube" label="{{ __('YouTube') }}" name="social_links[youtube][url]"></v-text-field>
                            <input type="hidden" name="social_links[youtube][name]" value="YouTube">
                            <input type="hidden" name="social_links[youtube][icon]" value="fa-youtube">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'linkedin.url') }}" prepend-icon="fa-linkedin" label="{{ __('Linkedin') }}" name="social_links[linkedin][url]"></v-text-field>
                            <input type="hidden" name="social_links[linkedin][name]" value="Linkedin">
                            <input type="hidden" name="social_links[linkedin][icon]" value="fa-linkedin">

                            <template v-for="(link, i) in links">
                                <v-text-field :prepend-icon="link.icon" :label="link.name" :name="`social_links[${i}][url]`" :value="link.url"></v-text-field>
                                <input type="hidden" :name="`social_links[${i}][name]`" :value="link.name">
                                <input type="hidden" :name="`social_links[${i}][icon]`" :value="link.icon">
                            </template>

                        </v-card-text>

                        <v-card-actions>
                            <v-btn primary type="submit" class="elevation-1">{{ __('Save') }}</v-btn>
                            <v-spacer></v-spacer>
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
                    links: {!! json_encode(collect($resources)->except(['facebook', 'twitter', 'youtube', 'linkedin'])->toArray()) !!},
                    custom: {name:'',icon:'',url:''},
                    errors: {!! json_encode($errors->getMessages()) !!}
                }
            }
        })
    </script>
@endpush
