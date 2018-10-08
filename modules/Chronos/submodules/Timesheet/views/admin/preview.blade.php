@extends('Theme::layouts.admin')

@push('after-css')
  <link href="{{ theme('dist/data.min.css') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}" rel="stylesheet" media="screen">
@endpush

@push('before-js')
  <script src="{{ theme('dist/data.min.js') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}"></script>
@endpush

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

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

            <div class="border mb-5" data-options='{"height": 400}' data-toggle="handsontable" data-target="[data-handsontable-input]" data-value="{{ json_encode($resources ?? []) }}"></div>

            <form action="{{ route('timesheets.store') }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="data" data-handsontable-input value="{{ old('data') }}">
              <button type="submit" class="btn btn-primary">{{ __('Generate Timesheet') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
