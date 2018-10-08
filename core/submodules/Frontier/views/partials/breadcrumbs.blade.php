<v-breadcrumbs icons divider="chevron_right" class="grey lighten-4 caption" style="justify-content: flex-start;">
    @section("breadcrumbs")
    <v-breadcrumbs-item
        :disable="! breadcrumb.active"
        :href="breadcrumb.url"
        :key="breadcrumb.name"
        v-for="breadcrumb in breadcrumbs"
        class="caption inline"
        ripple
    >
        <small class="ma-0 caption" :class="breadcrumb.active && !breadcrumb.last ? 'info--text' : 'grey--text'">@{{ breadcrumb.label }}</small>
    </v-breadcrumbs-item>
    @show
</v-breadcrumbs>

@push('pre-scripts')
    <script>
        @if (isset($navigation))
        mixins.push({
            data: {
                breadcrumbs: {!! json_encode($navigation->breadcrumbs->collect) !!},
            }
        });
        @endif
    </script>
@endpush
