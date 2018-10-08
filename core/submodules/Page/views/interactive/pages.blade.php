{{-- Inline template --}}
<script type="text/x-template" id="template-draggable">
    <draggable @change="move" :list="items" :options="options" class="sortable-container" :class="{'top-level grey lighten-3': topLevel}">
        <div :key="i" v-for="(t,i) in items" class="mb-0 draggable sortable-handle">
            <v-card tile class="elevation-1" :class="{'accent white--text': t.new}">
                <v-toolbar card dense class="transparent">
                    <v-icon v-if="t.icon" left v-html="t.icon"></v-icon>
                    <v-toolbar-title class="subheading" v-html="t.title"></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn
                        icon
                        small
                        ripple
                        @click="remove(t,i)"
                    >
                        <v-icon small>close</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-card-text>
                    <div class="caption"><span v-html="`{{ __('Parent:') }} ${t.parent_name}`"></span></div>
                    <template v-if="typeof t.is_absolute_slug !== 'undefined' && t.is_absolute_slug">
                        <div class="caption"><span v-html="t.slug"></span></div>
                    </template>
                    <template v-else>
                        <div class="primary--text caption">{{ url('/') }}/<span v-html="t.slug"></span></div>
                    </template>
                </v-card-text>
                {{-- fields --}}
                <input type="hidden" :name="`menus[${t.key}][id]`" :value="t.id">
                <input type="hidden" v-if="t.icon" :name="`menus[${t.key}][icon]`" :value="t.icon">
                <input type="hidden" :name="`menus[${t.key}][title]`" :value="t.title">
                <input type="hidden" :name="`menus[${t.key}][slug]`" :value="t.slug">
                <input type="hidden" :name="`menus[${t.key}][code]`" :value="t.code">
                <input type="hidden" :name="`menus[${t.key}][sort]`" :value="i">
                <input type="hidden" :name="`menus[${t.key}][id]`" :value="t.id">
                <input type="hidden" :name="`menus[${t.key}][parent]`" :value="t.parent_key">
                <input type="hidden" :name="`menus[${t.key}][page_id]`" :value="t.page_id">
                {{-- <input type="hidden" :name="`menus[t.slug][parent_id]`" :value="t.parent_id"> --}}
                {{-- fields --}}
            </v-card>
            <div class="bordered--ant ml-4">
                <local-draggable @changed="changed" :top-level="false" :items="t.children" :options="options"></local-draggable>
            </div>
        </div>
    </draggable>
</script>

<v-container fluid grid-list-lg>
    <v-layout row wrap>
        <v-flex sm4>
            <v-card class="elevation-1 sticky">
                <v-toolbar card class="transparent">
                    <v-toolbar-title class="subheading">{{ __('Menus') }}</v-toolbar-title>
                </v-toolbar>
                <v-expansion-panel class="elevation-0">
                    <v-expansion-panel-content>
                        <div slot="header">{{ __('Pages') }}</div>
                        <v-card-text class="grey lighten-4">
                            @if (empty($pages))
                                <p class="text-xs-center ma-0 pa-3 caption">
                                    <v-icon class="grey--text display-3">insert_drive_file</v-icon>
                                    <br>
                                    <a target="_blank" href="{{ route('pages.create') }}">{{ __('Create new page') }}&nbsp;</a><sup><v-icon right class="primary--text caption">fa-external-link</v-icon></sup>
                                </p>
                            @endif
                            <draggable :list="availables" :clone="clone" :options="{animation: 150,draggable: '.draggable',forceFallback: true,group:{name:'pages',pull:'clone'}}">
                                <v-card flat tile :key="t.id" v-for="(t,i) in availables" class="elevation-1 draggable sortable-handle">
                                    <v-card-title class="subheading" v-html="t.title"></v-card-title>
                                </v-card>
                            </draggable>
                        </v-card-text>
                    </v-expansion-panel-content>

                    <v-expansion-panel-content>
                        <div slot="header">{{ __('Social') }}</div>
                        <v-card-text class="grey lighten-4">
                            @if (empty($social))
                                <p class="text-xs-center ma-0 pa-3 caption">
                                    <v-icon class="grey--text display-3">fa-facebook</v-icon>
                                    <br>
                                    <a target="_blank" href="{{ route('settings.social') }}">{{ __('Manage social links.') }}</a><sup><v-icon right class="primary--text caption">fa-external-link</v-icon></sup>
                                </p>
                            @endif
                            <draggable :list="social" :clone="clone" :options="{animation: 150,draggable: '.draggable',forceFallback: true,group:{name:'pages',pull:'clone'}}">
                                <v-card flat tile :key="t.id" v-for="(t,i) in social" class="elevation-1 draggable sortable-handle">
                                    <v-list dense two-line>
                                        <v-list-tile class="sortable-handle">
                                            <v-list-tile-avatar>
                                                <v-icon v-html="t.icon"></v-icon>
                                            </v-list-tile-avatar>
                                            <v-list-tile-content>
                                                <v-list-tile-title v-html="t.title"></v-list-tile-title>
                                                <div class="grey--text caption" v-html="t.slug"></div>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </draggable>
                            <div class="text-xs-right">
                                <a target="_blank" class="caption" href="{{ route('settings.social') }}">{{ __('Manage social links.') }}</a><sup><v-icon right class="primary--text caption">fa-external-link</v-icon></sup>
                            </div>
                        </v-card-text>
                    </v-expansion-panel-content>

                    <v-expansion-panel-content>
                        <div slot="header">{{ __('Custom Links') }}</div>
                        <v-card flat>
                            <v-card-text>
                                <v-text-field @input="custom.code = $options.filters.slugify(custom.title)" required v-model="custom.title" hide-details label="{{ __('Title') }}"></v-text-field>
                                <v-text-field required v-model="custom.slug" hide-details label="{{ __('URL') }}"></v-text-field>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn dark class="accent elevation-1" @click="add(custom)">{{ __('Add') }}</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-card>
            {{-- <local-draggable :top-level="1" :items="availables" :options="Object.assign(options,{group:{name:'pages',pull:'clone',put:false}})"></local-draggable> --}}
        </v-flex>
        <v-flex sm8>
            <form action="{{ route('menus.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="location" value="{{ $location->code }}">
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading">{{ $location->name }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="grey lighten-4">
                        <p class="caption grey--text text--darken-1">{{ __('Drag menus in the area below.') }}</p>
                        <p class="caption error--text" v-if="'{{ $errors->first('menus') }}'">{{ $errors->first('menus') }}</p>
                        <local-draggable @changed="changed" :top-level="1" :items="items" :options="options"></local-draggable>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" class="primary elevation-1">{{ __('Save') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </form>
        </v-flex>
    </v-layout>
</v-container>


@push('css')
    <style>
        .top-level.sortable-container {
            min-height: 200px !important;
        }
        .sortable-container {
            min-height: 20px !important;
        }

        .bordered--ant {
            border-left: 1px dashed rgba(0,0,0, 0.2) !important;
            /*border-bottom: 1px dashed rgba(0,0,0, 0.2) !important;*/
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script>
        let localDraggable = {
            name: 'local-draggable',
            model: {prop: 'items'},
            template: '#template-draggable',
            props: ['items', 'options', 'topLevel'],
            methods: {
                changed (items, evt) {
                    this.$emit('changed', this.items, evt);
                    this.$emit('input', this.items);
                },
                move (evt, origEvt) {
                    this.$emit('changed', this.items, evt);
                    this.$emit('input', this.items);
                },
                remove (item, key) {
                    this.items.splice(key, 1);
                }
            }
        }

        mixins.push({
            components: {'local-draggable': localDraggable},
            data () {
                return {
                    options: {
                        animation: 150,
                        draggable: '.draggable',
                        forceFallback: true,
                        group: {name: 'pages'},
                    },
                    items: [],
                    availables: [],
                    resource: {
                        location: 'main-menu',
                    },
                    social: [],
                    custom: {
                        title: '',
                        slug: '',
                        code: '',
                        parent_name: 'root',
                        parent_id: null,
                        is_absolute_slug: true,
                    },
                }
            },
            methods: {
                add (item) {
                    if (item.title !== "") {
                        this.custom = {
                            title: '',
                            slug: '',
                            code: '',
                            parent_name: 'root',
                            parent_id: null,
                            is_absolute_slug: true,
                            children: [],
                            is_home: false,
                        }
                        this.items.push(JSON.parse(JSON.stringify(item)));
                        this.update(this.items);
                    }
                },
                clone (el) {
                    // empty children
                    el = JSON.parse(JSON.stringify(el));
                    el.children = [];

                    // return a cloned `el`
                    // not the actual `el` instance.
                    return el;
                },
                update (items, parent) {
                    let branch = [];

                    items = items ? items : this.items;
                    parent = parent ? parent : {id: null, title: 'root', slug: '', code: 'root'};

                    let j = 0;
                    for (var i = 0; i < items.length; i++) {
                        let current = items[i];
                        if (current.children) {
                            current.children = this.update(current.children, current);
                        } else {
                            current.children = [];
                        }

                        if (typeof current.is_absolute_slug !== 'undefined' && current.is_absolute_slug) {
                            //
                        } else {
                            // if (parent.slug)
                            current.slug = parent.slug + (parent.slug?'/':'') + current.code;
                        }
                        current.is_home = false;
                        current.is_home = typeof current.is_home !== 'undefined' && current.is_home ? current.is_home : false;
                        current.key = current.slug+"-"+(j++);
                        current.parent_id = parent.id;
                        current.parent_name = parent.title;
                        current.parent_code = parent.slug;
                        current.parent_key = parent.key;

                        branch.push(current);
                    }

                    return branch;
                },
                changed (items, evt) {
                    this.items = this.update(items);
                    console.log('changed', this.items);
                },
            },
            mounted () {
                let items = {!! json_encode($items) !!};
                this.items = this.update(items);
                console.log(items);

                this.availables = {!! json_encode($pages) !!};
                this.social = {!! json_encode($social) !!};
            }
        });
    </script>
@endpush
