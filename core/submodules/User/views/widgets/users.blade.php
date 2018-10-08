<div class="card mb-3">
  <div class="row">
    <div class="col-sm">
      <div id="user-chart" data-toggle="chart" data-options='{"size":{"height":200},"data":{"colors":{"active":"#772953","deactivated":"#a9909d"},"columns":[["active","{{ \User\Models\User::count() }}"],["deactivated","{{ \User\Models\User::onlyTrashed()->count() }}"]],"types":{"active":"pie","deactivated":"pie"}},"axis":{"x":{"show":false},"y":{"show":false},"rotated":true},"legend":{"show":false}}'></div>
    </div>
    <div class="col-sm">
      <div class="card-body">
        <h3 class="mb-1 display-4 text-primary">{{ \User\Models\User::count() }} <a href="{{ route('users.index') }}" class="h3">{{ __('users') }}</a></h3>

        @if (\User\Models\User::onlyTrashed()->count())
          <div><a href="{{ route('users.trashed') }}" class="small text-muted">+{{ \User\Models\User::onlyTrashed()->count() }} {{ __('deactivated') }}</a></div>
        @endif
        <div class="mt-6 d-flex justify-content-end">
          <a href="{{ route('users.create') }}" role="button" class="btn ml-3 btn-secondary"><i class="{{ $widget->icon }}"></i>&nbsp;{{ __('Add') }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
