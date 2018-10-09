import 'handsontable/dist/handsontable.full.min.css'
import * as Handsontable from 'handsontable'

$(document).ready(function () {
  $('[data-toggle=handsontable]').each(function (i, el) {
    let $self = $(el)
    let $data = JSON.parse(JSON.stringify($self.data('value') || []))
    let $target = $($self.data('target'))
    let options = Object.assign({
      rowHeaders: true,
      colHeaders: true,
      filters: true,
      dropdownMenu: true,
      manualRowResize: true,
      manualColumnResize: true,
      manualRowMove: true,
      manualColumnMove: true,
      contextMenu: true,
      mergeCells: true,
      columnSorting: {
        indicator: true,
      },
      afterChange: function (changes) {
        $target.val(JSON.stringify(this.getData()))
      },
    },
    JSON.parse(JSON.stringify($self.data('options') || {})),
    {
      data: $data,
    })

    const hot = new Handsontable($self[0], options)

    $target.val(JSON.stringify($data))
    $self.attr('data-value', null)
  })
})
