@stack('before-footer')

@section('footer')
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center flex-row-reverse">
        <div class="col-auto ml-lg-auto">
          <div class="row align-items-center">
            <div class="col-auto">
              @include('Theme::menus.footnote')
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
          {!! $application->site->copyright !!}
        </div>
      </div>
    </div>
  </footer>
@show

@stack('after-footer')
