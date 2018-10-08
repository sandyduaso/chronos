{{-- <v-card class="mb-3 elevation-1">
    <v-toolbar card class="transparent">

        @stack("cards.saving.pre-title")

        @section("cards.saving.title")
        <v-toolbar-title class="accent--text">{{ __('Saving') }}</v-toolbar-title>
        @show

        @stack("cards.saving.post-title")

    </v-toolbar> --}}

    <v-card-text class="grey--text">
        @stack("cards.saving.pre-fields")

        @section("cards.saving.fields")
        {{-- <div class="subheading"><v-icon>email</v-icon> {{ __('Notifications') }}</div>
        <div>
            <v-checkbox
                color="primary"
                label="{!! __('Notify this user upon save') !!}"
                title="{!! __('Notify this user upon save') !!}"
                v-model="resource.notify.model"
                hide-details
            ></v-checkbox>
            <input type="hidden" name="notify" :value="resource.notify.model">
        </div> --}}
        @show

        @stack("cards.saving.post-fields")

    </v-card-text>

    <v-card-actions>
        @stack("cards.saving.pre-actions")

        <v-spacer></v-spacer>
        {{-- <v-btn primary type="submit" class="elevation-1">{{ __('Save') }}</v-btn> --}}

        @stack("cards.saving.post-actions")

    </v-card-actions>
{{-- </v-card> --}}
