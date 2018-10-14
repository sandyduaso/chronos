@extends('Theme::layouts.admin')

@section('head:title', $resource->fullname)

@section('main:title')
  <div data-sticky="#page-header"></div>
  <header id="page-header" data-sticky-class="sticky bg-workspace shadow-sm p-3" class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <a title="{{ __('Return to all users') }}" role="button" href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fe fe-arrow-left"></i> {{ __('Back') }}</a>
        <a role="button" href="{{ route('users.edit', $resource->id) }}" class="btn btn-secondary btn-sm"><i class="fe fe-edit-2"></i> {{ __('Edit') }}</a>

        <button data-modal-toggle type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#delete-single-confirmbox-{{ $resource->id }}" title="{{ __('Move this user to trash') }}">
          <i class="fe fe-trash-2"></i>
          {{ __('Deactivate') }}
        </button>
        @include('Theme::partials.modal', [
          'dataset' => false,
          'id' => 'delete-single-confirmbox-'.$resource->id,
          'icon' => 'fe fe-user-x display-1 icon-border icon-faded d-inline-block',
          'lead' => __('You are about to deactivate the selected user.'),
          'text' => 'If you have selected your account and continued, you will be signed out from the app. Are you sure yout want to continue?',
          'method' => 'DELETE',
          'action' => route('users.destroy', $resource->id),
          'button' => __("Deactivate {$resource->firstname}"),
          'context' => 'warning',
        ])
      </div>
    </div>
  </header>
@endsection

@section('page:content')
  <div class="container-fluid mt-6">

    <div class="row text-center text-lg-left">

      @section('user.sidebar')
        <div class="col-lg-auto col-sm-12">
          @section('user.avatar')
            <img data-avatar-img class="avatar-fit rounded-circle mb-4" width="150px" height="150px" src="{{ $resource->photo }}" alt="{{ $resource->alt }}">
          @show

          @yield('user.sidemenu')
        </div>
      @show

      @section('user.main')
        <div class="col-lg col-sm-12">
          <h1 class="display-6">{{ $resource->fullname }}</h1>
          <div class="mb-7">
            @if ($resource->username)
              <div class="mb-1" title="{{ __('Username') }}">
                <i class="fe fe-at-sign"></i>
                <span>{{ $resource->username }}</span>
              </div>
            @endif
            @if ($resource->email)
              <div class="mb-1" title="{{ __('Email') }}">
                <i class="fe fe-mail"></i>
                <span>{{ $resource->email }}</span>
              </div>
            @endif
            @if ($resource->displayrole)
              <div class="mb-1" title="{{ __('Role group') }}">
                <i class="fe fe-user"></i>
                <span>{{ $resource->displayrole }}</span>
              </div>
            @endif
          </div>

          @section('user.about')
            <div class="mb-7">
              <div class="mt-6">
                <h3 class="h4">{{ __('About') }}</h3>
              </div>
              @empty($resource->info->toArray())
                <div class="row mb-2">
                  <p class="col text-muted"><em>{{ __('No additional information available.') }}</em></p>
                </div>
              @endempty
              @foreach ($resource->info as $detail)
                <div class="row mb-3">
                  <div class="col-auto"><i class="{{ $detail->icon }} mr-2"></i>{{ __($detail->keyword) }}</div>
                  <div class="col text-left"><em>{{ $detail->value }}</em></div>
                </div>
              @endforeach
            </div>
          @show

          @section('user.activity')
            <div class="mb-7">
              <div class="mt-6">
                <h3 class="h4">{{ __('Activity') }}</h3>
              </div>
              {{-- @can('activities.show') --}}
                <div class="row mb-1">
                  @empty ($resource->activities->all())
                    <p class="col text-muted"><em>{{ __('Either no activity available or this feed is hidden.') }}</em></p>
                  @else
                    <div class="col text-left">
                      @include('Theme::partials.timeline', ['activities' => $resource->activities])
                    </div>
                  @endempty
                </div>
              {{-- @else --}}
                {{-- <p class="col text-muted"><em>{{ __('Either no activity available or this feed is hidden.') }}</em></p> --}}
              {{-- @endcan --}}
            </div>
          @show
        </div>
      @show

    </div>
  </div>
@endsection

@push('after:footer')
  @include('Theme::partials.modal', [
    'id' => 'delete-confirmbox',
    'icon' => 'fe fe-user-x display-1 icon-border icon-faded d-inline-block',
    'lead' => __('You are about to deactivate the selected users.'),
    'text' => 'If you have selected your account and continued, you will be signed out from the app. Are you sure yout want to continue?',
    'method' => 'DELETE',
    'action' => route('users.destroy'),
    'button' => __('Deactivate Users'),
    'context' => 'warning',
  ])
@endpush
