import $ from 'jquery'
import 'confetti-js'

$(document).ready(function () {
  $('[data-confetti]').each(function (i, j) {
    let $id = 'confetti-' + i
    $(this).attr('id', $id)

    let settings = Object.assign($(this).data('options') || {}, {target: $id})
    $(this).attr('data-options', null)

    let confetti = new ConfettiGenerator(settings)
    confetti.render()
  })
})
