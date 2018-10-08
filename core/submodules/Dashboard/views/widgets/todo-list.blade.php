<v-card class="elevation-1">
    <v-toolbar class="cyan lighten-1 sortable-handle" dark>
        <v-toolbar-title>To-do List</v-toolbar-title>
        <v-spacer></v-spacer>
        {{-- dialog (add) --}}
        <v-dialog v-model="dialog.add" persistent width="50%">
            <v-btn icon slot="activator" v-tooltip:left="{html: 'Add new note'}"><v-icon>add</v-icon></v-btn>
            <v-card>
                <v-card-title dark class="cyan lighten-2 white--text">
                    <span class="title">Create New List</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-menu
                                    :position-absolutely="true"
                                    offset-x
                                    offset-y
                                    style="width: 100%"
                                    v-model="resource.icons.model"
                                    >
                                    <v-text-field
                                        slot="activator"
                                        :append-icon-cb="resource.icons.model"
                                        :prepend-icon="resource.icons.value"
                                        :value="resource.icons.value"
                                        append-icon="more_horiz"
                                        hint="{{ __('Choose what label do you want to add on your task') }}"
                                        label="{{ _('Label') }}"
                                        name="icon"
                                        @input="val => { resource.icons.value = val }"
                                    ></v-text-field>
                                    <v-card>
                                        <v-list>
                                            <v-list-tile v-for="item in resource.icons.items" :key="item.icon" @click="resource.icons.value = item.icon">
                                                <v-list-tile-action>
                                                    <v-icon>@{{ item.icon }}</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-title>@{{ item.name }}</v-list-tile-title>
                                            </v-list-tile>
                                        </v-list>
                                    </v-card>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field label="Title"></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-menu
                                    lazy
                                    :close-on-content-click="false"
                                    v-model="menu"
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    :nudge-right="40"
                                    max-width="290px"
                                    min-width="290px"
                                    >
                                    <v-text-field
                                        slot="activator"
                                        label="Date"
                                        v-model="date"
                                        prepend-icon="event"
                                        readonly
                                    ></v-text-field>
                                    <v-date-picker v-model="date" no-title scrollable actions>
                                        <template scope="{ save, cancel }">
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn flat primary @click="cancel">Cancel</v-btn>
                                                <v-btn flat primary @click="save">OK</v-btn>
                                            </v-card-actions>
                                        </template>
                                    </v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12 sm6>
                                <v-menu
                                    lazy
                                    :close-on-content-click="false"
                                    v-model="menu2"
                                    transition="scale-transition"
                                    offset-y
                                    full-width
                                    :nudge-right="40"
                                    max-width="290px"
                                    min-width="290px"
                                    >
                                    <v-text-field
                                        slot="activator"
                                        label="Time"
                                        v-model="time"
                                        prepend-icon="access_time"
                                        readonly
                                    ></v-text-field>
                                    <v-time-picker v-model="time" autosave></v-time-picker>
                                </v-menu>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn class="cyan--text darken-1" flat @click.native="dialog.add = false">Cancel</v-btn>
                    <v-btn class="cyan--text darken-1" flat @click.native="dialog.add = false">Add</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        {{-- /dialog --}}
        <v-menu bottom left>
            <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
            <v-list>
                <v-list-tile @click="" ripple>
                    <v-list-tile-action>
                        <v-icon error class="red--text">remove_circle</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ __('Remove') }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-menu>
    </v-toolbar>

    <v-card-text class="pa-0">
        {{-- <v-date-picker class="elevation-0 white lighten-5 cyan--text" color="cyan--text" v-model="picker" no-title="true" width="100%"></v-date-picker> --}}
    </v-card-text>

    <v-divider></v-divider>
    <v-card-text class="pt-4 pl-4 pr-4 pb-0">
        <v-list two-line subheader class="elevation-1">
            <v-subheader>Today</v-subheader>
            <v-list-tile avatar ripple @click="">
                <v-list-tile-avatar>
                    <v-icon class="cyan white--text">assignment</v-icon>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>Answer all assignments</v-list-tile-title>
                    <v-list-tile-sub-title>August 19, 2017 8:30AM</v-list-tile-sub-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-list-tile-action-text>
                            <v-icon class="green--text">check_circle</v-icon>
                    </v-list-tile-action-text>
                </v-list-tile-action>
            </v-list-tile>
            <v-divider inset></v-divider>

            <v-menu offset-y v-model="showMenu" :position-absolutely="true" full-width bottom left>
                <v-list-tile avatar slot="activator" ripple>
                <v-list-tile-avatar>
                <i class="fa icon cyan white--text fa-book"></i>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>Continue answering DPE SUP</v-list-tile-title>
                    <v-list-tile-sub-title>August 19, 2017 6:00AM</v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
              <v-list>
                <v-list-tile v-for="item in todo" :key="item.title" ripple @click="">
                  <v-list-tile-action>
                    <v-icon v-bind:class="[item.iconClass]">@{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>@{{ item.title }}</v-list-tile-title>
                </v-list-tile-content>
                </v-list-tile>
              </v-list>
            </v-menu>
        </v-list>
    </v-card-text>

    <v-card-text class="pa-4">
        <v-list two-line subheader class="elevation-1">
            <v-subheader>Next Week</v-subheader>
                <v-list-tile avatar ripple @click="">
                <v-list-tile-avatar>
                    <v-icon class="cyan white--text">account_circle</v-icon>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>Update profile</v-list-tile-title>
                    <v-list-tile-sub-title>August 29, 2017 11:30AM</v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-card-text>

</v-card>

@push('css')
    <style>
        .picker {
            width: 100%;
        }

        .picker table {
            width: 100%;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    time: null,
                    menu2: false,
                    modal2: false,
                    date: null,
                    menu: false,
                    dialog: {
                        add: false,
                    },
                    add: false,
                    picker: null,
                    showMenu: false,
                    x: 0,
                    y: 0,
                    todo: [
                        {
                            title: 'Mark as done',
                            icon: 'check',
                            iconClass: 'green--text'
                        },
                        {
                            title: 'Edit',
                            icon: 'edit',
                            iconClass: 'grey--text text--darken-1'
                        },
                        {
                            title: 'Delete',
                            icon: 'delete_forever',
                            iconClass: 'red--text'
                        }
                    ],
                    resource: {
                        icons: {
                            model: false,
                            items: [
                                {
                                    icon: 'assignment',
                                    name: 'Assignment'
                                },
                                {
                                    icon: 'fa fa-book',
                                    name: 'Course'
                                },
                                {
                                    icon: 'account_circle',
                                    name: 'Profile'
                                },
                                {
                                    icon: 'label',
                                    name: 'Lesson'
                                },
                            ],
                            value: '',
                        },
                    }
                }
            },
            methods: {
              show (e) {
                e.preventDefault()
                this.showMenu = true
                this.x = e.clientX
                this.y = e.clientY
              }
            }
        })
    </script>
@endpush
