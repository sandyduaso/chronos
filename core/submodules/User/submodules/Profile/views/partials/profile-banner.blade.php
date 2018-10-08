<v-parallax height="280" src="" class="elevation-2 {{ $resource->detail('backdrop', 'accent lighten-1') }}">
    {{-- <div class="text-xs-right"><v-btn icon class="grey--text darken-1"><v-icon>photo_camera</v-icon></v-btn></div> --}}
    <v-layout row wrap align-end justify-bottom>
        <v-flex xs12>
            <v-card dark flat class="transparent">
                <v-card-text>
                    <v-avatar size="120px">
                        <img src="{{ $resource->displayavatar }}" alt="{{ $resource->fullname }}" height="120">
                    </v-avatar>
                    <div class="title pt-4">{{ $resource->fullname }}</div>
                    <div class="body-1">{{ $resource->displayemail }}</div>
                    <div class="body-1">{{ $resource->displayrole }}</div>
                </v-card-text>
            </v-card>
        </v-flex xs12>
    </v-layout>
</v-parallax>
