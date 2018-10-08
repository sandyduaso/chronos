import $ from 'jquery'

$(document).ready(function () {
  $('[data-dynamic-item-template]').hide()

  $('[data-dynamic-add-button]').each(function (i, el) {
    $(this).on('click', function (e) {
      let $container = $(this).parents('[data-dynamic-container]')
      let $template = $container.find('[data-dynamic-item-template]')
      let $addButton = $container.find('[data-dynamic-add-button]')
      let $clone = $template.clone()

      // Number, zero-based
      let $number = $container.find('[data-dynamic-item]').length

      // Template disable
      $template.find(':input').attr('disabled', true)

      // Clone
      $clone.removeAttr('data-dynamic-item-template')
      $clone.attr('data-dynamic-item', true)
      $clone.attr('data-dynamic-item-number', $number)
      $clone.show().insertBefore($container.find('[data-dynamic-after-items]'))
      $clone.find(':input').attr('disabled', false)
      $clone.find('select').selectpicker('refresh')
      $clone.trigger('dynamic-item-added')

      // Inputs
      if ($clone.find(':input:not([type=button])')) {
        $clone.find(':input:not([type=button])').each(function (l, m) {
          $(m).attr('name', $(m).attr('name').replace('#', $number))
        })
      }

      if ($clone.find('.disabled')) {
        $clone.find('.disabled').removeClass('disabled')
      }
    })
  })

  $(document).on('click', '[data-dynamic-remove-button]', function () {
    let $item = $(this).parents('[data-dynamic-item]')
    $item.remove()
  })
})


