$(document).ready(function () {
  $(document).on('change', '[data-reveal]', function () {
    let $target = $($(this).attr('data-reveal'))

    if ($target) {
      if (this.checked) {
        $target.fadeIn()
      } else {
        $target.hide()
      }
      $target.find(':input, input').attr('disabled', !this.checked)
    }
  })
})
