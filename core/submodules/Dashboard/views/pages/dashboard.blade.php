@extends("Theme::layouts.admin")

@section("content")
  {{-- @parent --}}
  {{-- @include("Dashboard::partials.overview") --}}

  <v-container v-if="!$root.$router.current" fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm6 md5>

        <v-card class="mb-3" light color="yellow accent-1">
          <v-system-bar color="yellow accent-4">
            <v-icon color="yellow accent-1">notification_important</v-icon>
            <v-spacer></v-spacer>
            <v-icon role="button">close</v-icon>
          </v-system-bar>
          <v-card-title>Sample Notification</v-card-title>
          <v-card-text>Material icons are delightful, beautifully crafted symbols for common actions and items. Download on desktop to use them in your digital products for Android, iOS, and web.</v-card-text>
        </v-card>

          <v-card class="mb-3 elevation-2">
            <v-system-bar window color="primary">
              <v-spacer></v-spacer>
              <v-icon role="button">close</v-icon>
            </v-system-bar>
            <v-card-text>
              <p class="caption mb-2 primary--text"><strong>{{ $application->pluma->fullcopy }}</strong></p>
              <h3 class="title mb-3"><v-icon left>loyalty</v-icon>Welcome to the New Dashboard!</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis dolores obcaecati harum libero, molestiae, ipsum pariatur ad mollitia sit iusto velit ea magnam deleniti fugiat ut, praesentium at aliquid ducimus!</p>
              <p><strong>Wan't to take the tour?</strong></p>
            </v-card-text>
            <v-card-actions v-text-actions>
              <v-spacer></v-spacer>
              <v-btn flat>{{ __('No, Thanks') }}</v-btn>
              <v-btn color="primary">{{ __('Get Started') }}</v-btn>
            </v-card-actions>
          </v-card>
          <v-btn @click.native="$root.alert({
              text: 'User saved to draft',
              timeout: 2000,
              x: 'right',
              y: 'bottom'
          })">Snackbar</v-btn>
          <v-btn @click.native="$root.dialogbox({
              text: 'You have unsaved changes. Navigating away will delete the data permanently.',
              actionText: 'Save as Draft',
              timeout: 20000000
          })">Dialog</v-btn>
          <mediabox></mediabox>
          {{-- @include("Theme::partials.dialogbox") --}}
      </v-flex>
    </v-layout>
  </v-container>

  <v-card height="300px"></v-card>
  <template v-else>
    <router-view></router-view>
  </template>

@endsection
