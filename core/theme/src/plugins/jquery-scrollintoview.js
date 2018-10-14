$(document).ready(function () {
  $('[data-smooth-scroll]').each(function () {
    $(this).click(function (e) {
      let offset = $(this).offset()
      $('[data-workspace]').animate({
        scrollTop: offset.top,
        scrollLeft: offset.left,
      })
      e.preventDefault()
    })
  })
})
