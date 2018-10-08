<div id="backdrop" class="grey lighten-4" style="position: fixed; width: 100vw; height: 100vh;z-index:99999;opacity:1;transition: opacity 1s"></div>

@push('post-js')
    <script>
        (function () {
            let $backdrop = document.querySelector('#backdrop');
            $backdrop.style.opacity = "0";
            setTimeout(function () {
                $backdrop.remove();
            }, 200);
        })();
    </script>
@endpush
