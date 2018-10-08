@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")
    {{-- src="{{ $resource->detail('backdrop', 'accent') }}" --}}
    <v-parallax height="280" src="" class="elevation-2" :class="resource.details.backdrop">
        <v-layout row wrap align-end justify-bottom>
            <v-flex xs12>
                <v-card dark flat class="transparent">
                    <v-card-text>
                        <div class="text-xs-right">
                            <v-menu>
                                <a slot="activator" role="button" class="body-1 primary--text"><v-icon class="body-1 primary--text">edit</v-icon> {{ __('Change backdrop') }}</a>
                                <v-card>
                                    <v-list>
                                        <v-list-tile v-for="(backdrop, i) in backdrops" @click="resource.details.backdrop = backdrop.value">
                                            <v-list-tile-avatar size="30px">
                                                <v-chip :class="backdrop.value">&nbsp;</v-chip>
                                            </v-list-tile-avatar>
                                            <v-list-tile-title v-html="backdrop.name"></v-list-tile-title>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-menu>
                        </div>
                        <v-menu>
                            <v-avatar ref="avatar-menu-activator" slot="activator" align-end size="120px" class="elevation-0">
                                <img :src="resource.item.avatar" alt="{{ $resource->fullname }}" height="120">
                            </v-avatar>
                            <v-card>
                                <v-list>
                                    <v-list-tile v-for="(avatar, i) in avatars" @click="resource.item.avatar = avatar.avatar">
                                        <v-list-tile-avatar size="30px">
                                            <img :src="avatar.avatar">
                                        </v-list-tile-avatar>
                                        <v-list-tile-title v-html="avatar.name"></v-list-tile-title>
                                    </v-list-tile>
                                </v-list>
                                <v-card-actions>
                                    <span class="caption grey--text">{{ __('More coming soon') }}</span>
                                </v-card-actions>
                            </v-card>
                        </v-menu>
                        <div class="body-1"><a role="button" @click.stop="$refs['avatar-menu-activator'].click()"><v-icon class="primary--text body-1">edit</v-icon> {{ __('Change avatar') }}</a></div>
                        <div class="title pt-2" v-html="`${resource.firstname} ${resource.lastname}`"></div>
                        <div class="subheading pb-2">{{ $resource->displayrole }}</div>
                    </v-card-text>
                </v-card>
            </v-flex xs12>
        </v-layout>
    </v-parallax>
    {{-- <v-toolbar dark class="elevation-2 sticky" :class="resource.details.backdrop">
        <v-toolbar-title>
            <div class="title pt-2" v-html="`${resource.firstname} ${resource.lastname}`"></div>
            <div class="subheading pb-2">{{ $resource->displayrole }}</div>
        </v-toolbar-title>
    </v-toolbar> --}}

    @include("Frontier::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>
            <v-flex sm9 md10>
                <form action="{{ route('profile.update', $resource->handlename) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    {{-- HIDDEN --}}
                    <input type="hidden" name="avatar" :value="resource.item.avatar">
                    <input type="hidden" name="details[backdrop]" :value="resource.details.backdrop">
                    {{-- HIDDEN --}}

                    <v-card class="elevation-1 mb-3">
                        <v-card-text>
                            <v-subheader class="pl-0">{{ __('Basic Information') }}</v-subheader>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Full Name') }}
                                </v-flex>

                                <v-flex xs8>
                                    <v-text-field
                                        :error-message="resource.errors.firstname"
                                        label="{{ __('First name') }}"
                                        name="firstname"
                                        v-model="resource.firstname"
                                    ></v-text-field>
                                    <v-text-field
                                        :error-message="resource.errors.middlename"
                                        label="{{ __('Middle name') }}"
                                        name="middlename"
                                        v-model="resource.middlename"
                                    ></v-text-field>
                                    <v-text-field
                                        :error-message="resource.errors.lastname"
                                        label="{{ __('Last name') }}"
                                        name="lastname"
                                        v-model="resource.lastname"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Email Address') }}
                                </v-flex>

                                <v-flex xs8>
                                    <v-text-field
                                        :error-message="resource.errors.email"
                                        label="{{ __('Email') }}"
                                        name="email"
                                        type="email"
                                        v-model="resource.email"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-subheader class="pl-0">Other Details</v-subheader>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Gender') }}
                                </v-flex>

                                <v-flex xs8>
                                    <v-select label="{{ __('Gender') }}" v-model="resource.details.gender" :items="['Male', 'Female']"></v-select>
                                    <input type="hidden" name="details[gender]" :value="resource.details.gender">
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Birthday') }}
                                </v-flex>

                                <v-flex xs8>
                                    <div class="input-group input-group--text-field">
                                        <div class="input-group__input">
                                            <input placeholder="MM/DD/YYYY" name="details[birthday]" tabindex="0" type="text" class="masked-input" :value="resource.details.birthday">
                                        </div>
                                        <div class="input-group__details">
                                            <div class="input-group__messages"></div>
                                        </div>
                                    </div>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Home Address') }}
                                </v-flex>

                                <v-flex xs8>
                                    <v-text-field
                                        label="{{ __('Home Address') }}"
                                        name="details[home_address]"
                                        v-model="resource.details.home_address"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs4 class="grey--text body-1">
                                    {{ __('Phone Number') }}
                                </v-flex>

                                <v-flex xs8>
                                    <v-text-field
                                        label="{{ __('Phone Number') }}"
                                        name="details[phone_number]"
                                        v-model="resource.details.phone_number"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                        <v-card-text class="text-xs-right">
                            <v-spacer></v-spacer>
                            <v-btn outline primary type="submit">{{ __('Save') }}</v-btn>
                            <v-btn flat href="{{ route('profile.show', $resource->handlename) }}">{{ __('Cancel') }}</v-btn>
                        </v-card-text>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ url('core/js/cleave.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            avatar: '{{ old('avatar') ?? $resource->avatar }}',
                        },
                        firstname: '{{ old('firstname') ?? $resource->firstname }}',
                        middlename: '{{ old('middlename') ?? $resource->middlename }}',
                        lastname: '{{ old('lastname') ?? $resource->lastname }}',
                        email: '{{ old('email') ?? $resource->email }}',
                        details: {
                            backdrop: '{{ old('details.backdrop') ?? $resource->detail('backdrop') ?? 'accent' }}',
                            gender: '{{ old('details.gender') ?? $resource->detail('gender') }}',
                            birthday: '{{ old('details.birthday') ?? $resource->detail('birthday') }}',
                            phone_number: '{{ old('details.phone_number') ?? $resource->detail('phone_number') }}',
                            home_address: '{{ old('details.home_address') ?? $resource->detail('home_address') }}',
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                    avatars: {!! json_encode($avatars) !!},
                    backdrops: [
                        {name: '{{ __('Default') }}', value: 'accent'},
                        {name: '{{ __('Cherry Red') }}', value: 'red lighten-1'},
                        {name: '{{ __('Ocean Blue') }}', value: 'blue lighten-1'},
                        {name: '{{ __('Indigo Go') }}', value: 'indigo lighten-1'},
                        {name: '{{ __('Green Field') }}', value: 'green lighten-1'},
                        {name: '{{ __('Morning Teal') }}', value: 'teal lighten-1'},
                        {name: '{{ __('Tangerine Tree') }}', value: 'orange lighten-1'},
                        {name: '{{ __('Sunlight Yellow') }}', value: 'yellow lighten-1'},
                        {name: '{{ __('Hot Pink') }}', value: 'pink lighten-1'},
                        {name: '{{ __('Deep Black') }}', value: 'black lighten-3'},
                        {name: '{{ __('Space Gray') }}', value: 'grey darken-3'},
                    ],
                }
            },
            mounted () {
                let cleave = new Cleave('.masked-input', {
                    date: true,
                    datePattern: ['m', 'd', 'Y'],
                });
            }
        });
    </script>
@endpush
