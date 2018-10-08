<header class="header {{ isset($fixed) ? 'header--fixed' : '' }} p-0">
  <div class="container">

    <div class="d-flex">
      {{-- Navigationbar Logo --}}
      <a href="{{ home() }}" class="py-2 header-brand">
        <img class="header-brand-img" src="{{ @$application->site->logo }}" width="auto" height="40px" alt="{{ @$application->site->title }}">
      </a>
      {{-- Navigationbar Logo --}}

      {{-- Navigation Menu --}}
      <div class="d-flex order-lg-2 ml-auto">
        <div class="d-none d-lg-flex">
          @include('Theme::menus.main')
        </div>
        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0 my-2" data-toggle="collapse" data-target="[data-main-menu]">
          <span class="header-toggler-icon"></span>
        </a>
      </div>
      {{-- Navigation Menu --}}

    </div>
  </div>
</header>
<div class="header collapse" data-main-menu>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 ml-auto">
        <form class="input-icon my-3 my-lg-0">
          <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
          <div class="input-icon-addon">
            <i class="fe fe-search"></i>
          </div>
        </form>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-12 ml-auto">
        @include('Theme::menus.main')
      </div>
    </div>
  </div>
</div>
