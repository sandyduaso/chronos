import $ from 'jquery'

$(document).ready(function () {
    $(document).on('click', '[data-toggle=modal]', function (e) {
        let target = $(this).data('target')
        $(target).appendTo('body')
    })
})
