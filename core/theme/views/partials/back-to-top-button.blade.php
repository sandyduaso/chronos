<v-btn
    fixed
    dark
    fab
    bottom
    right
    dark
    class="elevation-3 red lighten-1"
    id="back-to-top"
    >
    <v-icon>keyboard_arrow_up</v-icon>
</v-btn>

@push('css')
    <style>
        #back-to-top {
            transition: opacity 0.2s ease-out;
            opacity: 0;
            z-index: 2;
        }
        #back-to-top.show {
            opacity: 1;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script>
        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 400);
            });
        }
    </script>

    <script type="text/javascript">function add_chatinline(){var hccid=79264332;var nt=document.createElement("script");nt.async=true;nt.src="https://www.mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
    add_chatinline();</script>
@endpush
