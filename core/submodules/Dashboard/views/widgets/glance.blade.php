@viewable('glance')

    @if (view()->exists("Theme::widgets.glance-" . user()->roles->first()->code))
        {{-- expr --}}
        @include("Theme::widgets.glance-" . user()->roles->first()->code)
    @else
        @include("Theme::widgets.glance-default")
    @endif

@endviewable

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    glance: {
                        selections: [
                            { title: 'Daily' },
                            { title: 'Weekly' },
                            { title: 'Monthly' },
                            { title: 'Yearly' }
                        ],
                        selected: 'Daily',
                        hidden: this.getStorage('glance.hidden') === "true" ? true : false,
                    },
                    interval: {},
                    value: 30,
                    rotate: 30,
                }
            },
        })
    </script>
@endpush

