import $ from 'jquery'

$(document).ready(function () {
  $('[data-sidebar-toggle]').on('click', function (e) {
    e.preventDefault();
    let target = $(this).data('target')
    if (!target) {
      target = '[data-sidebar]'
    }

    $(target).toggleClass('active')
  })
})
