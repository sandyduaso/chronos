import $ from 'jquery'
import 'datatables'
import './checkbox'

$(document).ready(function () {
  $('[data-table]').each(function (i) {
    const options = $(this).data('options') ? JSON.parse($(this).data('options')) : {}
    $(this).DataTable(options)
  })
})
