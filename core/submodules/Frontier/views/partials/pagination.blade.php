@if ($resources->lastPage() > 1)
    <v-card flat tile class="transparent">
        <v-card-actions>
            @if ($resources->currentPage() == 1)
                <v-btn ripple small icon disabled>
                    <v-icon class="body-1">fa-angle-double-left</v-icon>
                </v-btn>
            @else
                <v-btn ripple small icon href="{{ $resources->url(1) }}{{ $section ?? '' }}">
                    <v-icon class="body-1">fa-angle-double-left</v-icon>
                </v-btn>
            @endif

            @if ($resources->currentPage() == 1)
                <v-btn ripple small icon disabled>
                    <v-icon class="body-1">fa-angle-left</v-icon>
                </v-btn>
            @else
                <v-btn ripple small icon href="{{ $resources->url($resources->currentPage()-1) }}{{ $section ?? '' }}">
                    <v-icon class="body-1">fa-angle-left</v-icon>
                </v-btn>
            @endif

            @for ($i = 1; $i <= $resources->lastPage(); $i++)
                @if ($resources->currentPage() == $i)
                    <v-btn ripple small icon class="primary">
                        <span class="white--text">{{ $i }}</span>
                    </v-btn>
                @else
                    <v-btn ripple small icon href="{{ $resources->url($i) }}{{ $section ?? '' }}">
                        <span class="grey--text">{{ $i }}</span>
                    </v-btn>
                @endif
            @endfor

            @if ($resources->currentPage() == $resources->lastPage())
                <v-btn ripple small icon disabled>
                    <v-icon class="body-1">fa-angle-right</v-icon>
                </v-btn>
            @else
                <v-btn ripple small icon href="{{ $resources->url($resources->currentPage()+1) }}{{ $section ?? '' }}">
                    <v-icon class="body-1">fa-angle-right</v-icon>
                </v-btn>
            @endif

            @if ($resources->currentPage() == $resources->lastPage())
                <v-btn ripple small icon disabled>
                    <v-icon class="body-1">fa-angle-double-right</v-icon>
                </v-btn>
            @else
                <v-btn ripple small icon href="{{ $resources->url($resources->lastPage()) }}{{ $section ?? '' }}">
                    <v-icon class="body-1">fa-angle-double-right</v-icon>
                </v-btn>
            @endif
        </v-card-actions>
    </v-card>
@endif
