<v-card flat class="mb-3 transparent">
    <v-list class="transparent">

        @if (isset(navigations('parent')->children))
            @if (isset(navigations('parent')->display_as_header))
                <v-subheader>
                    @if (isset(navigations('parent')->icon))
                        <v-icon left>{{ navigations('parent')->icon }}</v-icon>
                    @endif
                    {{ navigations('parent')->labels->title }}
                </v-subheader>
            @endif
            @foreach (navigations('parent')->children as $menu)
                <v-list-tile href="{{ $menu->url }}" title="{{ @$menu->labels->description }}">
                    @if (@$menu->icon)
                        <v-list-tile-action>
                            <v-icon :class="{'primary--text': '{{ $menu->active }}'}">{{ @$menu->icon }}</v-icon>
                        </v-list-tile-action>
                    @endif
                    <v-list-tile-content>
                        <v-list-tile-title
                            :class="{'primary--text': '{{ $menu->active }}'}"
                            class="body-1">{{ @$menu->labels->title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            @endforeach
        @endif

    </v-list>
</v-card>
