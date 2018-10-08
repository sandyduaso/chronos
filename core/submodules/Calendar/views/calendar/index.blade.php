@extends("Frontier::layouts.admin")


@push("utilitybar" )
    <strong class="subheading">{{ __(date('F Y')) }}</strong>
@endpush

@section("content")
    <v-container fluid class="pa-0" fill-height>
        <v-layout row wrap fill-height class="pink">
            <v-flex xs12 sm3 fill-height class="white">
                <v-card flat height="100vh">
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-date-picker no-title class="elevation-0"></v-date-picker>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex xs12 sm9>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('calendar/dist/calendar/Calendar.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('calendar/dist/calendar/Calendar.js') }}"></script>
    <script>
        Vue.use(Calendar);

        mixins.push({
            components: {calendar: Calendar},
            data () {
                return {
                    events: [{
                        date: '2017/09/22',
                        title: 'Foo',
                        description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius eum modi quos, nesciunt aperiam dolores! Corporis, sit, molestiae. Deserunt, quas. Autem illum veniam, maiores consectetur cumque velit odio at. Soluta.'
                      },{
                        date: '2017/09/12',
                        title: 'Bar'
                      }],
                };
            }
        });
    </script>
@endpush
