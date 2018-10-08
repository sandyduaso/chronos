import $ from 'jquery'
import 'inputmask/dist/inputmask/jquery.inputmask.js'

$(document).ready(function () {
  $('[data-mask]').each(function (e) {
    $(this).inputmask($(this).data('mask'))
  })
  // Inputmask({'mask': '99/99/9999'}).mask(document.querySelectorAll('[data-mask]'))
})
