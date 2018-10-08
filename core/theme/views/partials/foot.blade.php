  @include('Theme::partials.footer')

  @stack("before-js")

  @stack("js")
    <script src="{{ theme('dist/app.min.js') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}"></script>
  @show

  @stack("after-js")
</body>
</html>
