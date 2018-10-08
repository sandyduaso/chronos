@extends('Theme::layouts.admin')

@push('after-css')
  <link href="{{ theme('dist/data.min.css') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}" rel="stylesheet" media="screen">
@endpush

@push('before-js')
  <script src="{{ theme('dist/data.min.js') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}"></script>
@endpush

@section('head-title', __('New Timesheet'))

@section('page-title')
  <h1 class="page-title">{{ __('New Timesheet') }}</h1>
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <span class="text-divider bordered-circle mt-3"><strong class="text-muted lead p-3 px-4 rounded-circle"><i class="fe fe-upload-cloud"></i></strong></span>
          @if (! session('data'))
            <div class="card-body">
              @include('Theme::errors.all')
              <form action="{{ route('timesheets.process') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <legend class="small mb-4">
                  {{ __('Upload a compatible .csv file to process a timesheet batch.') }}
                </legend>

                <div class="form-group">
                  <label for="#name" class="form-label">{{ __('Name') }}</label>
                  <input id="name" type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ session('name') ?? old('name') ?? date('F Y') }}">
                  @if ($errors->has('name'))
                    <div class="small mt-2 text-danger">{{ __($errors->first('name')) }}</div>
                  @endif
                </div>

                <div class="form-row">
                  <div class="col">
                    <div class="form-group">
                      <label for="#start_date" class="form-label">{{ __('Start Date') }}</label>
                      <input id="start_date" type="text" name="start_date" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" data-mask="99/99/9999" data-mask-clearifnotmatch="true" placeholder="MM/DD/YYYY" autocomplete="off" maxlength="10" value="{{ session('start_date') ?? old('start_date') ?? date('m/01/Y') }}">
                      @if ($errors->has('start_date'))
                        <div class="small mt-2 text-danger">{{ __($errors->first('start_date')) }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="#end_date" class="form-label">{{ __('End Date') }}</label>
                      <input id="end_date" type="text" name="end_date" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" data-mask="99/99/9999" data-mask-clearifnotmatch="true" placeholder="MM/DD/YYYY" autocomplete="off" maxlength="10" value="{{ session('end_date') ?? old('end_date') ?? date('m/t/Y') }}">
                      @if ($errors->has('end_date'))
                        <div class="small mt-2 text-danger">{{ __($errors->first('end_date')) }}</div>
                      @endif
                    </div>
                  </div>
                </div>

                {{-- <div class="form-group mb-6">
                  <label for="file" class="form-label">{{ __('CSV') }}</label>
                  <input id="file" type="file" name="file" accept=".csv">
                  @if ($errors->has('file'))
                    <div class="small text-danger">{{ __($errors->first('file')) }}</div>
                  @endif
                </div> --}}

                @include('Theme::fields.upload', [
                  'attr' => 'data-target=#csv-preview',
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

                <div class="d-flex text-center mt-3">
                  <button type="submit" class="btn btn-primary btn-lg">{{ __('Preview') }}</button>
                </div>
              </form>
            </div>
          @endif

          {{-- <div class="text-muted small text-divider">{{ __('or') }}</div> --}}

          @if (session('data') || isset($resources) && $resources)
            <span class="text-divider bordered-circle"><strong class="text-muted p-3 px-4 rounded-circle"><i class="fe fe-export"></i></strong></span>
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

              <legend>{{ __(session('name')) }}</legend>
              <div class="border mb-5" data-options='{"height": 400}' data-toggle="handsontable" data-target="[data-handsontable-input]" data-value="{{ json_encode(session('data') ?? $resources ?? []) }}"></div>

              <form action="{{ route('timesheets.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="{{ session('name') }}">
                <input type="hidden" name="start_date" value="{{ session('start_date') }}">
                <input type="hidden" name="end_date" value="{{ session('end_date') }}">
                <input type="hidden" name="data" data-handsontable-input value="{{ old('data') ?? json_encode(session('data')) }}">
                <button type="submit" class="btn btn-primary">{{ __('Generate Timesheet') }}</button>
              </form>
            </div>
          @endif

        </div>

      </div>
    </div>
  </div>
@endsection
