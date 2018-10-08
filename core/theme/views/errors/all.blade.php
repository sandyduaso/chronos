@if (! $errors->isEmpty())
  <div class="alert alert-danger">
    <ul class="m-0">
      @foreach ($errors->all() as $error)
        <li>{{ __($error) }}</li>
      @endforeach
    </ul>
  </div>
@endif
