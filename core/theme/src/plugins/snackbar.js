import 'snackbarjs/dist/snackbar.min.css'
import 'snackbarjs/themes-css/material.css'
import 'snackbarjs/dist/snackbar.min.js'

$(document).ready(function () {
  if (document.querySelectorAll('[data-snackbar-autoload]').length) {
    $('[data-snackbar-autoload]').snackbar('show')
  }
})
