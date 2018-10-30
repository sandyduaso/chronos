@extends('Theme::layouts.admin')

@section('head:title', __("Edit {$resource->name}"))
@section('page:title', __("Edit {$resource->name}"))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
        <div class="card">
          <div class="card-header">
            <i class="mdi mdi-toolbox">&nbsp;</i>
            {{ __('Menus Toolbox') }}
          </div>
          <div id="menus-options-accordion" class="accordion bg-workspace">
            {{-- Pages --}}
            <div class="accordion-item">
              <div role="button" class="accordion-header px-5 py-3 d-flex justify-content-between" data-toggle="collapse" data-target="#accordion-item-page" aria-expanded="false" aria-controls="accordion-item-page">{{ __('Pages') }} <i class="mdi mdi-chevron-down"></i></div>
              <div id="accordion-item-page" data-dragula-options class="card-body collapse" aria-labelledby="headingOne" data-parent="#menus-options-accordion">
                @foreach ($repository->pages() as $page)
                  <div class="card shadow-sm mb-2">
                    <div role="drag" class="card-header">
                      <i class="mdi mdi-cursor-move">&nbsp;</i>
                      <div><strong>{{ $page['title'] }}</strong></div>
                    </div>
                    <div class="card-body text-muted">
                      <em class="small">/{{ $page['code'] }}</em>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            {{-- Pages --}}
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <form class="card" action="{{ route('menus.update', $resource->code) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="card-header justify-content-between border-0">
            <strong>
              @isset ($resource->icon)
                <i class="{{ $resource->icon }}"></i>
              @endisset
              {{ $resource->name }}
            </strong>
          </div>
          <div class="card-body">
            <p class="text-muted">{{ $resource->description }}</p>
          </div>
          <div class="card-body bg-workspace pt-2">

            @empty ($resource->menus)
              <div class="text-center text-muted p-7">
                <div class="p-4"><i class="mdi mdi-calendar-edit display-4"></i></div>
                <p>{{ __("Drag and drop menus from the Menus Toolbox and build your site's menu!") }}</p>
              </div>
            @else
              <p class="text-muted"><strong>{{ __('Menu Structure') }}</strong></p>

{{-- <code>
<pre><div contenteditable>
Home, /
About, /about-us
-Meet the Team, /about-us/meet-the-team
-Mission & Vision, /about-us/mission-and-vision
--Mission, /about-us/mission-and-vision/mission
--Vision, /about-us/mission-and-vision/vision
Contact Us, /contact-us
[icon]mdi mdi-facebook, https://facebook.com/pluma@cms
</div></pre>
</code> --}}

              @include('Menu::partials.menuitems', [
                'menus' => $resource->menus,
                'disabled' => false,
              ])
            @endempty

          </div>
          <div class="card-footer bg-workspace border-0 text-right">
            @submit('Save Menu')
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
