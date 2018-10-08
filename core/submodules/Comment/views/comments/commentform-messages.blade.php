@if (user())
    @cannot('post-comment')
        <v-alert warning v-show="'true'" v-model="alert" dismissible>
            {{ __('Your credentials does not meet the requirements to post comments.') }}
        </v-alert>
    @endcannot
@else
    <v-alert info v-show="'true'" v-model="alert" dismissible>
        {{ __('Login to post comments.') }}
    </v-alert>
@endif
