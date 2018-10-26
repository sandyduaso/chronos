@extends('Theme::layouts.admin')

@section('head:title', __('Edit').' / '.$resource->name)

@section('page:title', __('Edit').' / '.$resource->name)

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <form class="card" action="{{ route('timesheets.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="card-body">
            <legend class="small mb-4">
              {{ __('Upload a compatible .csv file to process a timesheet batch.') }}
            </legend>

            @include('Theme::fields.input', ['name' => 'name', 'value' => $resource->name])

            <div class="form-row">
              <div class="col">
                @include('Theme::fields.input', [
                  'name' => 'start_date',
                  'value' => date('m/d/Y', strtotime($resource->start_date)),
                  'attr' => 'data-mask=99/99/9999 data-mask-clearifnotmatch=true placeholder=MM/DD/YYYY autocomplete=off maxlength=10'
                ])
              </div>
              <div class="col">
                @include('Theme::fields.input', [
                  'name' => 'end_date',
                  'value' => date('m/d/Y', strtotime($resource->end_date)),
                  'attr' => "data-mask=99/99/9999 data-mask-clearifnotmatch=true placeholder=MM/DD/YYYY autocomplete=off maxlength=10"
                ])
              </div>
            </div>

            <div class="text-divider text-accent"><i class="fe fe-upload-cloud"></i></div>
            <div class="text-muted small mb-4">{{ __('You will not be able to edit the previous uploaded csv file. If you need to ammend the data, please upload another timesheet') }}</div>

            @include('Theme::fields.checkbox', [
              'name' => 'allow-csv-upload',
              'label' => __('I want to upload a new csv file.'),
              'value' => old('allow-csv-upload'),
              'attr' => 'data-reveal=#csv-upload'
            ])

            <div id="csv-upload" class="collapse">
              <div class="alert alert-info p-4">
                <div><strong>{{ __('Before Proceeding') }}</strong></div>
                <p>{{ __('Prepare the data before importing. Please be mindful of the following:') }}</p>
                <ol class="mb-0 pl-5">
                  <li>{{ __('Make sure you have headings columns.') }}</li>
                  <li>{{ __('In your headings columns, make sure you have a `time_in` column. This must be exact. No other names like `timeIn` will be recognized.') }}</li>
                  <li>{{ __('Make sure you have a `time_out` column.') }}</li>
                  <li>{{ __('Make sure you have a `user_id`. If no `user_id` is found, a `card_id` column will be required.') }}</li>
                  <li>{{ __('All recognized columns are "time_in", "time_out", "card_id", "user_id", "department", "firstname", and "lastname" only (without quotations). Keywords must be exact with no trailing spaces in between.') }}</li>
                  <li>{{ __('All other columns present but not recognized will be stored as a json metadata.') }}</li>
                </ol>
              </div>

              @include('Theme::fields.upload', [
                'attr' => 'disabled data-target=#csv-preview',
                'disabled' => true,
                'label' => __('CSV File'),
                'dropzone' => false,
                'multiple' => false,
                'name' => 'file',
                'options' => [
                  'maxFiles' => 1,
                  'acceptedFiles' => '.csv',
                  'uploadMultiple' => false,
                ]
              ])
            </div>
          </div>

          <div class="card-footer border-0 text-right">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
