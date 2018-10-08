<v-dialog v-model="dialog.model" persistent>
  <v-card>
    <v-card-title class="headline">
        <v-icon v-if="dialog.icon">@{{ dialog.icon }}</v-icon>
        @{{ dialog.title }}
    </v-card-title>
    <v-card-text>@{{ dialog.description }}</v-card-text>
    <v-list class="layout column wrap">
      <v-list-tile @click="">
        <v-list-tile-content>Discard Changes</v-list-tile-content>
      </v-list-tile>
      <v-list-tile @click="">
        <v-list-tile-content>Save Draft</v-list-tile-content>
      </v-list-tile>
      <v-list-tile @click="">
        <v-list-tile-content>Cancel</v-list-tile-content>
      </v-list-tile>
    </v-list>
    {{-- <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn class="darken-1" flat="flat" @click.native="dialog.cancelHandler()">@{{ dialog.no }}</v-btn>
        <v-btn class="error--text darken-1" flat="flat" @click.native="dialog.confirmHandler()">@{{ dialog.yes }}</v-btn>
    </v-card-actions> --}}
  </v-card>
</v-dialog>
