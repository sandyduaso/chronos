@include("Frontier::partials.header")

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>

        <main data-main>

            @yield("content")

        </main>

    </v-app>
</div>

@stack("pre-footer")
@stack("footer")
@stack("post-footer")

@section("scripts")
    <script>
        let mixins = [{ data: { page: { model: false, }, }, }];
    </script>
    @stack("pre-scripts")
    <script src="{{ assets('frontier/app/filters.js') }}"></script>
    <script src="{{ assets('frontier/app/dist/app.js') }}"></script>
    @stack("post-scripts")
@show

@include("Theme::partials.footer")
