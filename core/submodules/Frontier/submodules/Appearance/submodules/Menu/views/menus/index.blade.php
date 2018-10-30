@extends('Theme::layouts.admin')

@section('head:title', __('Menus'))
@section('page:title', __('Menus'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">

      @foreach ($locations as $menu)
        <div class="col-lg-4 order-lg-1 order-sm-3">
          <div role="panel" class="card td-none mb-3">
            <div class="card-header border-0 justify-contents-between">
              <a href="{{ route('menus.edit', $menu['code']) }}">
                <strong>{{ $menu['name'] }}</strong>
              </a>
            </div>
            @isset ($menu['description'])
              <div class="card-body ov-h">
                @isset ($menu['icon'])
                  <div class="card-value float-right text-blue">
                    <i class="text-primary {{ $menu['icon'] }}"></i>
                  </div>
                @endisset
                <p class="small text-truncate">{{ $menu['description'] }}</p>
              </div>
            @endisset
            <div class="card-footer border-0">
              <a role="button" href="{{ route('menus.edit', $menu['code']) }}" class="btn btn-secondary btn-sm">
                <i class="mdi mdi-pencil">&nbsp;</i>
                {{ __('Edit') }}
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
