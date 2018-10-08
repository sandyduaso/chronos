import $ from 'jquery'

$('.custom-file-input').on('change',function(event) {
  let input = event.target.files[0]
  let name = input.name
  $(this).next('.custom-file-label').addClass("selected").html(name);
})
