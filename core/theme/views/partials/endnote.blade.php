<footer class="footer bg-transparent text-muted mt-6 border-0">
  @stack('before-endnote')
  @section('endnote')
    <div class="container-fluid p-3">
      <div class="row">
        <div class="col-lg-12 text-right small">
          {{ $application->site->title }}
          {{ $application->version }}
        </div>
      </div>
    </div>
  @show
  @stack('after-endnote')
</footer>
