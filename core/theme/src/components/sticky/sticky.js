import $ from 'jquery'

$(document).ready(function () {
  if ($(document).find('[data-sticky]').length) {
    let $elements = $('[data-sticky]')

    $elements.each(function (i, el) {
      (new IntersectionObserver(function(e, observer) {
        let t = e[0].target
        let target = $(t).data('sticky')

        if (e[0].intersectionRatio > 0){
          document.documentElement.removeAttribute('class')
          $(target).removeClass($(target).data('sticky-class'))
        } else {
          document.documentElement.setAttribute('class', 'stuck')
          $(target).addClass($(target).data('sticky-class'))
        }
      })).observe(el)
    })

  }
})
