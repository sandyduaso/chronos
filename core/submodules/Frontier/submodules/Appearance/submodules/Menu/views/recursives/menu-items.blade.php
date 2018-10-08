@foreach ($items as $key => $item)
    <v-card tile class="elevation-1">
        <v-card-text class="subheading">
            {{ $item->title }}
            <div><em class="caption">{{ $item->slug }}</em></div>
        </v-card-text>
        @if ($item->children)
            <v-card-text class="pl-4">
                @include("Menu::recursives.menu-items", ['items' => $item->children])
            </v-card-text>
        @endif
    </v-card>
@endforeach
