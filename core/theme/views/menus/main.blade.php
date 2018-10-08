<nav class="nav nav-tabs border-0 flex-column flex-lg-row">
  @foreach(get_menu('main-menu') as $menu)
    <span class="nav-item">
      <a
        class="nav-link {{ $menu->active ? 'active' : '' }}"
        href="{{ $menu->url }}"
        title="{{ $menu->title }}"
      >
        @if ($menu->icon)
          <i class="{{ $menu->icon }}"></i>
        @endif
        {{ __($menu->title) }}
      </a>
    </span>
  @endforeach

  {{-- Login --}}
  @if (!auth()->check())
    <span class="nav-item">
      <a role="button" href="{{ route('login.show') }}" class="btn btn-outline-primary">{{ __('Sign in') }}</a>
      <a role="button" href="{{ route('register.show') }}" class="btn btn-primary ml-2">{{ __('Sign up') }}</a>
    </span>
  @else
    <span class="nav-item">
      <a href="{{ route('dashboard') }}" role="button" class="btn btn-outline-primary"><i class="fe fe-anchor"></i>{{ __('Dashboard') }}</a>
    </span>
  @endif
  {{-- Login --}}
</nav>
