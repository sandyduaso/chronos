import 'd3/dist/d3.min.js'
import 'c3/c3.css'
import c3 from 'c3'

$(document).ready(function () {
  $(document).find('[data-toggle=chart]').each(function () {
    let $this = $(this)
    let options = JSON.parse(JSON.stringify($this.data('options')))
    $this.attr('data-options', null)
    $this.attr('id', 'c3-chart-0' + $this.attr('id'))
    c3.generate(Object.assign(options, {
      bindto: '#' + $this.attr('id'),
      grid: {
        x: {
          show: true
        },
        y: {
          show: true
        }
      }
    }))
  })
})
