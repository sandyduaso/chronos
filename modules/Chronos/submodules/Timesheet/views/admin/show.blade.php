@extends('Theme::layouts.admin')

@section('workspace:head')
  <div id="workspace" class="workspace justify-content-start" data-workspace data-spy="scroll" data-target="#report-list" data-offset="50">
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-lg-2">
        <div data-sticky="#report-list"></div>
        <div id="report-list" data-sticky-class="sticky pt-8" class="list-group">
          @foreach ($resource->department() as $department => $unused)
            <a data-smooth-scroll-test href="#scroll-{{ str_slug($department) }}" class="list-group-item list-group-item-action">{{ $department }}</a>
          @endforeach
        </div>
      </div>
      <div class="col-md-9 col-lg-10">
        @include('Timesheet::reports.html', ['data' => $resource->data->toArray()])
      </div>
    </div>
  </div>
@endsection

@push('after:js')
  {{-- <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script>
    document.querySelectorAll('[data-smooth-scroll-test]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
          e.preventDefault();
          document.querySelector(this.getAttribute('href')).scrollIntoView({
              behavior: 'smooth'
          });
      });
    });

  </script> --}}
@endpush
