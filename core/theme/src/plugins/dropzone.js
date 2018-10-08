import $ from 'jquery'
import * as Dropzone from 'dropzone'

Dropzone.autoDiscover = false

$(document).ready(function () {
  $('[data-dropzone]').each(function (i) {
    let $self = $(this)
    let id = 'dropzone-' + i
    let options = JSON.parse(JSON.stringify($self.data('dropzone'))) || {}
    let $form = $self.parents('form')

    // Set ID
    $self.attr('data-dropzone', id)

    // Set options
    options = Object.assign(
      {},
      {
        url: $form.attr('action'),
        dictDefaultMessage: 'Upload files',
        autoProcessQueue: false,
        parallelUploads: 1,
        uploadMultiple: true,
        addRemoveLinks: true,
        // forceFallback: true,
      },
      options
    )

    // Init Dropzone
    let $dropzone = new Dropzone('[data-dropzone='+id+']', options)

    // Listen to Dropzone events
    if (!$dropzone.options.forceFallback) {
      $dropzone.on('sending', function (file, xhr, formData) {
        let $inputs = $form.find(':input')
        $inputs.each(function () {
          if ($(this).attr('name')) {
            formData.append($(this).attr('name'), $(this).val())
          }
        })
      })
      $dropzone.on('success', function (file, response) {
        let data = JSON.stringify(response)
        let $target = $($self.data('target')) || null

        if ($target) {
          $target.attr('data-value', data)
          $target.trigger('data-attribute:changed')
        }
      })
      $dropzone.on('addedfile', function (file) {
        alert('asd')
        let data = JSON.stringify(file)
        let $input = $('<input type=hidden name="file_json">')
        let exists = $form.find('input[name=file_json]').length

        $input.val(data)
        if (! exists) {
          $form.append($input)
        }
      })

      // Set button
      $form.find('[data-dropzone-button]').on('click', function (e) {
        e.preventDefault()
        $dropzone.options.parallelUploads = $dropzone.getAcceptedFiles().length
        $dropzone.processQueue()
      })
    }
  })
})
