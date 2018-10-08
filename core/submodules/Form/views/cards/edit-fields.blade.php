<template>
    <v-divider></v-divider>

    <v-card class="elevation-0 grey lighten-4" :class="fields.toolbar.modes.distraction.model?'mode-distraction-free mb-0':'mb-3'">
        <v-toolbar card class="white lighten-3 sticky" :class="fields.toolbar.modes.distraction.model?'mode-distraction-free--toolbar elevation-3':''">
            <v-icon class="pink--text">text_fields</v-icon>
            <v-toolbar-title class="subheading pink--text">{{ __('Fields') }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <template>
                {{-- Add --}}
                <v-btn
                    icon
                    v-tooltip:left="{'html': '{{ __('Add Field') }}'}"
                    @click.native.stop="addSection(draggables.items)"
                >
                    <v-icon>add</v-icon>
                </v-btn>

                {{-- Expand --}}
                <v-btn
                    ripple
                    icon
                    v-tooltip:left="{'html': fields.toolbar.expand.model?'{{ __('Expand All') }}':'{{ __('Compress All') }}'}"
                    @click="toolbar().expand().toggle(draggables.items, fields.toolbar.expand.model)"
                >
                    <v-icon small>@{{ fields.toolbar.expand.model ? 'fa-expand' : 'fa-compress'}}</v-icon>
                </v-btn>
            </template>
            <template>
                <v-btn
                    icon
                    v-model="fields.toolbar.modes.distraction.model"
                    v-tooltip:left="{'html': '{{ __('Toggle Distraction-Free Mode') }}'}"
                    @click.native.stop="fields.toolbar.modes.distraction.model = !fields.toolbar.modes.distraction.model"
                >
                    <v-icon>@{{ fields.toolbar.modes.distraction.model ? 'fullscreen_exit' : 'fullscreen' }}</v-icon>
                </v-btn>
            </template>
        </v-toolbar>

        <v-card-text :class="fields.toolbar.modes.distraction.model?'pa-5 mt-5':''">
            <template v-if="!draggables.items.length">
                <v-card-text role="button" v-tooltip:top="{'html': '{{ __('Add field') }}'}" class="text-xs-center grey--text my-5" @click="addSection(draggables.items)">
                    <v-icon x-large>text_fields</v-icon>
                    <p v-if="resource.errors.fields" class="caption error--text" v-html="resource.errors.fields.join(', ')"></p>
                    <p v-else class="subheading text-xs-center ma-0">{{ __('No fields yet') }}</p>
                </v-card-text>
            </template>
            <draggable v-if="draggables.items.length" class="sortable-container" v-model="draggables.items" :options="{animation: 150, handle: '.parent-handle', group: 'fields', draggable: '.draggable-field', forceFallback: true}">
                <transition-group>
                    <v-card
                        :key="key"
                        class="draggable-field elevation-1 mb-4"
                        tile
                        v-for="(draggable, key) in draggables.items"
                        v-model="draggable.active"
                    >
                        {{-- head --}}
                        <div class="pink lighten-3" style="height: 3px;"></div>
                        <v-toolbar card slot="header" class="sortable-handle parent-handle white lighten-3" dense @click.native.stop="draggable.active = !draggable.active">
                            <v-icon>drag_handle</v-icon>
                            <span v-if="draggable.resource.lockable" v-tooltip:right="{html:'{{ __('This Field is lockable') }}'}"><v-icon>lock</v-icon></span>
                            <v-spacer></v-spacer>
                            <v-toolbar-title class="subheading">@{{ draggable.resource.name }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-icon>@{{ draggable.active ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
                            <v-btn icon @click.native.stop="draggables.items.splice(key, 1)"><v-icon>close</v-icon></v-btn>
                        </v-toolbar>

                        {{-- fields --}}
                        {{-- <v-scale-transition> --}}
                        <v-card flat tile v-show="draggable.active" transition="slide-y-transition">
                            <input v-if="draggable.resource.feature" type="hidden" :name="`fields[${key}][feature]`" :value="draggable.resource.feature.thumbnail">
                            <v-layout row wrap>
                                <v-flex sm12>
                                    <v-card-text>
                                        <input type="hidden" :name="`fields[${key}][id]`" :value="draggable.resource.id">
                                        <input type="hidden" :name="`fields[${key}][sort]`" :value="key">

                                        <v-text-field
                                            label="{{ __('Field Title') }}"
                                            :name="`fields[${key}][label]`"
                                            :error-messages="resource.errors[`fields.${key}.label`]"
                                            v-model="draggable.resource.label"
                                        ></v-text-field>

                                        <v-text-field
                                            label="{{ __('Name') }}"
                                            :name="`fields[${key}][name]`"
                                            :error-messages="resource.errors[`fields.${key}.name`]"
                                            v-model="draggable.resource.name"
                                        ></v-text-field>

                                        <v-select
                                            auto
                                            clearable
                                            append-icon="keyboard_arrow_down"
                                            :input-value="resource.item.fieldtype_id"
                                            item-value="id"
                                            item-text="name"
                                            label="{{ __('Fieldtype') }}"
                                            :items="resource.fieldtypes.items"
                                            v-model="draggable.resource.fieldtype_id">
                                        </v-select>
                                        <input type="hidden" :name="`fields[${key}][fieldtype_id]`" :value="draggable.resource.fieldtype_id">

                                        <v-text-field
                                            label="{{ __('Value') }}"
                                            :name="`fields[${key}][value]`"
                                            :error-messages="resource.errors[`fields.${key}.value`]"
                                            v-model="draggable.resource.value"
                                        ></v-text-field>
                                    </v-card-text>
                                </v-flex>
                            </v-layout>
                        </v-card>
                        {{-- </v-scale-transition> --}}
                    </v-card>
                </transition-group>
            </draggable>
        </v-card-text>
    </v-card>
</template>

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            fieldtype_id: {!! json_encode($resource->fieldtype_id) !!}
                        },
                        fieldtypes: {
                            items: {!! json_encode($fieldtypes->toArray()) !!}
                        }
                    },
                    fields: {
                        toolbar: {
                            modes: {
                                distraction: {
                                    model: false,
                                },
                            },
                            expand: {
                                model: false,
                            }
                        },
                    },
                    draggables: {
                        items: [],
                        old: [],
                    },
                    mediabox: {
                        model: false,
                        output: null,
                    }
                };
            },

            methods: {
                toolbar () {
                    let self = this;
                    return {
                        expand () {
                            return {
                                toggle (togglables, value) {
                                    self.fields.toolbar.expand.model = !value;
                                    for (var i = 0; i < togglables.length; i++) {
                                        let current = togglables[i];
                                        current.active = value;
                                    }
                                }
                            }
                        }
                    }
                },

                addSection (sections) {
                    let c = {
                        id: sections.length + 1,
                        name: '{{ __('Field') }}',
                        active: true,
                        icon: false,
                        resource: {
                            id: '',
                            name: '',
                            icon: '',
                            label: '',
                            attribute: '',
                            value: '',
                            code: '',
                            fieldtype_id: '',
                        },
                        mediabox: false,
                        options: {
                            view: false,
                            model: false,
                            feature: {
                                model: false,
                                current: null,
                            },
                        },
                        sections: [],
                    }
                    sections.push(c);
                },

                updateSection (sections, values) {
                    console.log("update",values)
                    sections.push({
                        id: values.id,
                        name: values.name,
                        label: values.label,
                        fieldtype_id: values.fieldtype_id,
                        value: values.value,
                        sort: values.sort,
                        attribute: values.attribute,
                        active: true,
                        icon: false,
                        resource: {
                            id: values.id ? values.id : '',
                            name: values.name,
                            code: values.code,
                            label: values.label,
                            fieldtype_id: values.fieldtype_id,
                            value: values.value,
                            sort: values.sort,
                            attribute: values.attribute,
                            icon: values.icon,
                            interactive: values.interactive ? JSON.parse(values.interactive) : [],
                        },
                        mediabox: false,
                        assignment: {
                            view: false,
                            model: false,
                            deadline: false,
                        },
                        options: {
                            view: false,
                            model: false,
                            feature: {
                                model: false,
                                current: null,
                            },
                        },
                        sections: [],
                    });
                },

                close (origin, options) {
                    // console.log("mediabox-origin", origin);
                },

                old () {
                    let olds = {!! json_encode($resource->fields) !!};
                    if (olds) {
                        for (var i = 0; i < olds.length; i++) {
                            let current = olds[i];
                            this.updateSection(this.draggables.items, current);

                            if (current.contents) {
                                for (var j = 0; j < current.contents.length; j++) {
                                    let c = current.contents[j];
                                    this.updateSection(this.draggables.items[i].sections, c);
                                }
                            }
                        }
                    }
                },

                getMediaboxOutput (content, value) {
                    // console.log('GMO', content, value)
                }
            },

            mounted () {
                this.old();
            },
        });
    </script>
@endpush
