<nav id="sidebar" class="sidebar active p-4 pb-2 sidebar-fixed" data-sidebar>
  <header class="sidebar-header">
    <img width="80px" height="80px" class="sidebar-brand img-fit" src="{{ $application->site->logo }}">
    <h2 class="sidebar-title">{{ $application->site->title }}</h2>
  </header>
  <div class="sidebar-content">
    <div class="sidebar-nav list-group list-group-transparent mb-0">
      @foreach ($sidebar as $i => $menu)

        @if (! isset($menu['is_hidden']) || ! $menu['is_hidden'])
          @if ($menu['has_children'])

            <div class="sidebar-item sidebar-dropdown">
              <a role="button" href="#" aria-expanded="{{ $menu['active'] ? 'true' : 'false' }}" data-toggle="collapse" data-target="#sidebar-dropdown-{{ $i }}" class="dropdown-toggle list-group-item list-group-item-action d-flex align-items-center rounded {{ $menu['active'] ? 'active' : '' }}">
                <span class="icon mr-3">
                  @isset ($menu['icon'])
                    <i class="{{ $menu['icon'] }}"></i>
                  @endisset
                </span>

                @if (isset($menu['labels']))
                  {{ __($menu['labels']['title']) }}
                @endif

                <span class="icon ml-auto text-muted">
                  <i class="fe fe-chevron-down"></i>
                </span>
              </a>
              <div id="sidebar-dropdown-{{ $i }}" class="sidebar-dropdown-menu {{ $menu['active'] ? 'show active' : '' }}">
                @foreach ($menu['children'] as $submenu)
                  @if ($submenu['is_divider'])
                    <div class="sidebar-dropdown-divider dropdown-divider"></div>
                  @else
                    <a class="dropdown-item sidebar-dropdown-item {{ $submenu['active'] ? 'active' : '' }}" href="{{ $submenu['url'] }}">
                      @isset ($submenu['icon'])
                        <span class="icon mr-1">
                          <i class="{{ $submenu['icon'] }}"></i>
                        </span>
                      @endisset
                      @isset ($submenu['labels'])
                        {{ $submenu['labels']['title'] }}
                      @endisset
                    </a>
                  @endif
                @endforeach
              </div>
            </div>

          @elseif (isset($menu['is_header']) && $menu['is_header'])

            <div class="list-group-item list-group-separator"></div>

          @else
            <a role="button" href="{{ $menu['url'] }}" class="list-group-item list-group-item-action d-flex align-items-center {{ $menu['active'] ? 'active' : '' }}">
              <span class="icon mr-3">
                @if (isset($menu['icon']))
                  <i class="{{ $menu['icon'] }}"></i>
                @endif
              </span>

              @if (isset($menu['labels']))
                {{ __($menu['labels']['title']) }}
              @endif

              @if (isset($menu['badge']))
                <span class="ml-auto badge badge-primary">{{ $menu['badge'] }}</span>
              @endif
            </a>
          @endif
        @endif

      @endforeach

    </div>
  </div>
  @section('sidebar-footer')
  <div class="sidebar-footer">
    <a role="button" class="btn btn-block btn-secondary">{{ __('Create Timesheet') }}</a>
    {{-- <small class="text-muted text-center d-block">{{ $application->version }}</small> --}}
  </div>
  @show
</nav>
