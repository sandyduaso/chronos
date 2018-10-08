@stack('before-utilitybar')

@section('utilitybar')
  <nav class="navbar navbar-expand-lg bg-transparent">
    <button type="button" class="btn btn-secondary shadow-none mr-sm-2 py-1" aria-expanded="true" data-sidebar-toggle data-target="[data-sidebar]" aria-controls="sidebar" aria-label="{{ __('Toggle sidebar') }}">
      <i class="fe fe-menu"></i>
      <span class="sr-only">{{ __('Toggle Sidebar') }}</span>
    </button>

    {{-- @section('utilitysearch')
      @include('Theme::partials.search')
    @show --}}
    {{-- <div class="w-100 spacer"></div> --}}
    @section('utilitybar.user')
      <div class="d-flex order-lg-2 ml-auto">
        <div class="dropdown">
          <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown" aria-expanded="true">
            <img class="avatar avatar-fit" src="{{ user()->photo }}"></span>
            <span class="ml-2 d-none d-lg-block">
              <span class="text-default small">{{ user()->displayname }}</span>
              <small class="text-muted d-block mt-1 caption">{{ user()->displayrole }}</small>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end">
            <a class="dropdown-item" href="{{ route('profile.show', user()->username) }}">
              <i class="dropdown-icon fe fe-user"></i>
              <span>{{ __('Profile') }}</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout.logout') }}">
              <i class="dropdown-icon fe fe-log-out"></i>
              <span>{{ __('Sign out') }}</span>
            </a>
            {{-- <a class="dropdown-item" href="#">
              <i class="dropdown-icon fe fe-settings"></i> Settings
            </a>
            <a class="dropdown-item" href="#">
              <span class="float-right"><span class="badge badge-primary">6</span></span>
              <i class="dropdown-icon fe fe-mail"></i> Inbox
            </a>
            <a class="dropdown-item" href="#">
              <i class="dropdown-icon fe fe-send"></i> Message
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="dropdown-icon fe fe-help-circle"></i> Need help?
            </a>
            <a class="dropdown-item" href="#">
              <i class="dropdown-icon fe fe-log-out"></i> Sign out
            </a> --}}
          </div>
        </div>
      </div>
    @show
  </nav>
@show

@stack('after-utilitybar')
