@foreach ($items as $menu)
    @if (isset($subtree) && $subtree)
        {{-- If three deep and more --}}
        @if ($menu->children)
            <v-menu offset-x open-on-hover transition="slide-x-transition">
                <v-list-tile slot="activator" @click="">
                    <v-list-tile-title>{{ $menu->title }}</v-list-tile-title>
                    <v-list-tile-action class="justify-end"><v-icon small>keyboard_arrow_right</v-icon></v-list-tile-action>
                </v-list-tile>
                <v-list>
                    @include("Template::recursives.main-menu", ['items' => $menu->children, 'subtree' => 1])
                </v-list>
            </v-menu>
        @else
            <v-list-tile :class="{'active active--text': '{{ $menu->active }}'}" href="{{ $menu->url }}">
                <v-list-tile-content>
                    <v-list-tile-title :class="{'active--text': '{{ $menu->active }}'}">
                        {{ $menu->title }}
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        @endif
    @elseif ($menu->children)
        <v-menu offset-y transition="slide-y-transition" bottom>
            <v-btn slot="activator" link flat :class="{'btn--active active--text': '{{ $menu->active }}'}">
                <span>{{ $menu->title }}</span>
                <v-icon right>keyboard_arrow_down</v-icon>
            </v-btn>
            <v-list>
                @include("Template::recursives.main-menu", ['items' => $menu->children, 'subtree' => 1])
            </v-list>
        </v-menu>
    @else
        <v-btn :class="{'btn--active active--text': '{{ $menu->active }}'}" link flat href="{{ $menu->url }}">
            <span>{{ $menu->title }}</span>
        </v-btn>
    @endif
@endforeach
