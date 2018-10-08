{{-- @viewable("glance") --}}
  {{-- Superadmins --}}
  <v-card flat tile color="transparent">
    <v-card-title class="grey--text text--darken-2">{{ __('Recent Activities') }}</v-card-title>
    <v-card-text>
      <v-layout row wrap fill-height align-end>
        <v-flex sm9 fill-height align-end>
          <v-card flat color="secondary" height="300px"></v-card>
        </v-flex>
        <v-flex sm3 fill-height align-end>
          <v-card flat tile color="transparent">
            <v-card-text>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora voluptates numquam repellat laborum tenetur! Nam fugit reiciendis reprehenderit, facere aspernatur id a, placeat porro accusantium autem ipsum consequatur quis assumenda.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn class="elevation-1">{{ __('Download .csv') }}</v-btn link>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-card-text>
  </v-card>
{{-- @endviewable --}}
