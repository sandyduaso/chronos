@foreach ($items as $menu)
    <v-btn icon :class="{'btn--active primary--text': '{{ $menu->active }}'}" link flat target="_blank" href="{{ $menu->url }}">
        <v-icon>{{ $menu->icon }}</v-icon>
    </v-btn>
@endforeach
