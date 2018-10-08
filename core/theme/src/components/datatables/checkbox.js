import $ from 'jquery'

$(document).ready(function () {
  $(document).on('click, change', '[data-select]', function () {
    let self = this
    let selected = $(this).parents('[data-with-selection]').find('[data-select]:checked')
    let selections = []

    selected.each(function (i) {
      const value = $(this).val()
      const name = $(this).attr('name')
      const $el = $('<input type="hidden">')
      $el.attr({value: value, name: name})
      selections.push($el)
    })

    // Toggle tr tag class
    if (self.checked) {
      $(self).parents('tr').addClass('active')
    } else {
      $(self).parents('tr').toggleClass('active')
    }

    let target = $(self).data('target')
    $(target).html(selections)

    if (selections.length <= 0) {
      $('[data-modal-toggle]').prop('disabled', true)
    } else {
      $('[data-modal-toggle]').prop('disabled', false)
    }

    // select-all toggle
    let allCheckboxes = $(self).parents('[data-with-selection]').find('[data-select]')
    $('[data-select-all]').prop('indeterminate', false)
    if (selected.length === 0) {
      $('[data-select-all]').prop('checked', false)
    } else if (allCheckboxes.length === selected.length) {
      $('[data-select-all]').prop('checked', true)
    } else {
      $('[data-select-all]').prop('indeterminate', true)
    }
  })

  // $('[data-select]').change(function (e) {
  //   console.log(this.checked)
  // })

  $('[data-select-all]').on('click, change', function () {
    let $parent = $(this).parents('[data-with-selection]')
    let state = $(this).data('select-all')

    if (state) {
      // check all
      $parent.find('[data-select]:not(:checked)').trigger('click')
    } else {
      // uncheck all
      $parent.find('[data-select]:checked').trigger('click')
    }

    // $parent.find('[data-select]').prop('checked', (i, v) => { return !v })
    // $(this).prop('indeterminate', false)
    $parent.find('[data-select]').trigger('click')
    $(this).data('select-all', !state)
  })
})
