@field('upload', [
  'attr' => 'data-target=#csv-import',
  'label' => __('CSV File'),
  'dropzone' => false,
  'multiple' => false,
  'hint' => __('CSV file must follow a certain order. See table below for the correct headers to import.'),
  'name' => 'import',
  'options' => [
    'maxFiles' => 1,
    'acceptedFiles' => '.csv',
    'uploadMultiple' => false,
  ]
])

{{-- <div class="text-divider text-muted my-5">{{ __('or') }}</div>
<label class="form-label">{{ __('Manual Batch Import') }}</label>
<div class="border mb-5" data-options='{"height": 200,"minSpareRows": 30,"dataSchema":{"firstname":null,"middlename":null,"lastname":null,"email":null,"username":null,"password":null}, "colHeaders":["First Name","Middle Name","Last Name","Email","Username","Password Hash"],"columns":[{"data": "firstname"},{"data":"middlename"},{"data":"lastname"},{"data":"email"},{"data":"username"},{"data":"password"}]}' data-toggle="handsontable" data-target="[data-handsontable-input]" data-value="[]"></div>
<input type="hidden" name="data" data-handsontable-input value="{{ json_encode(old('data')) }}"> --}}
