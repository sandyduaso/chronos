<v-card v-model="widgets" class="elevation-1 mb-4">
    <v-card-actions>
        <v-btn flat>
            <v-icon left>date_range</v-icon>
            Add Note
        </v-btn>
        <v-spacer></v-spacer>
        <v-btn icon @click.native="widgets.show = !widgets.show">
            <v-icon>@{{ widgets.show ? 'keyboard_arrow_up' : 'settings' }}</v-icon>
        </v-btn>
    </v-card-actions>
    <v-slide-y-transition>
        <v-card-text v-show="widgets.show">
            <v-switch label="Landscape Calendar" v-model="calendar.landscape"></v-switch>
            <v-switch label="Show Calendar" v-model="calendar.show"></v-switch>
            <v-switch label="Landscape Clock" v-model="clock.landscape"></v-switch>
            <v-switch label="Show Clock" v-model="clock.show"></v-switch>
        </v-card-text>
    </v-slide-y-transition>
    <v-divider></v-divider>
    <v-date-picker
        :landscape="calendar.landscape"
        class="ba-0 elevation-0 w-100"
        v-model="calendar.model"
        v-show="calendar.show"
        value="calendar.model"
    ></v-date-picker>
    <v-time-picker
        :landscape="clock.landscape"
        class="ba-0 elevation-0 w-100"
        scrollable
        v-model="clock.model"
        v-show="clock.show"
    ></v-time-picker>
</v-card>

@push('post-css')
    <style>
        .w-100,
        .w-100 table {
            width: 100%;
        }
    </style>
@endpush

@push('pre-scripts')
    <script>
        mixins.push({
            data: {
                widgets: {
                    show: false,
                },
                calendar: {
                    landscape: true,
                    model: new Date(),
                    show: true,
                },
                clock: {
                    landscape: true,
                    model: null,
                    show: false,
                },
            }
        })
    </script>
@endpush
