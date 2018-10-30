@extends('Theme::layouts.admin')

@section('head:title', __('All Permissions'))
@section('page:title', __('All Permissions'))

@section('page:content')
  <div class="container-fluid">
    @include('Theme::partials.banner')

    <div class="row">
      <div class="col-lg-4 col-md-6">

        <div class="card">
          <div class="card-body">
            @include('Theme::fields.treeview', [
              'label' => null,
              'readonly' => true,
              'icon' => 'mdi mdi-shield-half-full text-green',
              'items' => $resources,
              'key' => 'code',
              'text' => 'description',
            ])
          </div>
        </div>

      </div>

      <div class="col-lg-8 col-md-6">
        <div class="jumbotron mb-2">TODO: Add svg image</div>
        <div class="card border-0 shadow-none bg-transparent">
          <div class="text-wrap">
            <h2 class="mb-4">{{ __('Refresh List') }}</h2>
            <p>{{ __("Refreshing will add and/or update all new permissions specified by the modules you've installed.") }}</p>
            <p>{{ __('Outdated permissions or permissions from uninstalled modules will be removed.') }}</p>
            <form action="{{ route('permissions.refresh') }}" method="POST">
              {{ csrf_field() }}
              <button type="submit" class="btn btn-success btn-lg">{{ __('Refresh Permissions') }}</button>
            </form>

            <div class="text-divider text-divider-dashed mt-6 mb-0">
              <span class="rounded-circle p-2 bg-gray">
                <i class="mdi mdi-skull text-white"></i>
              </span>
            </div>
            <div class="mx-auto small text-muted text-center">{{ __('Danger Ahead') }}</div>

            <h2 class="mb-4">{{ __('Reset List') }}</h2>
            <p>{!! __("Performing this action will completely remove all permissions data from the database before reinstalling them. Users might lose their previous privileges after this action.") !!}</p>
            <div class="alert alert-warning mt-5 mb-6">
              <div><i class="fe fe-alert-triangle"></i>&nbsp; <strong>{{ __('Warning') }}</strong><br>{{ __("You might need to setup the user roles manually again. If you do not want to upset the order of the Cosmos, then for the love of Talos, do not proceed!") }}</div>
            </div>

            <button data-modal-toggle type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#reset-permissions-confirmbox">
              {{ __('Reset Permissions...') }}
            </button>
            @include('Theme::partials.modal', [
              'dataset' => false,
              'id' => 'reset-permissions-confirmbox',
              'icon' => 'mdi mdi-skull display-1 icon-border icon-faded d-inline-block',
              'lead' => __('WARNING! Read before proceeding.'),
              'text' => __("<p>Resetting the permissions table will break your existing users' established roles. Though the application will try to rebuild the permissions table, there is no guarantee all items will be restored. In fact, any manually added permission will not be recovered. You might need to setup the user roles manually again. If you do not want to upset the order of the Cosmos, then for the love of Talos, do not proceed.</p><p>Are you sure yout want to reset permissions?</p>"),
              'method' => 'POST',
              'action' => route('permissions.reset'),
              'button' => __("Reset Permissions"),
              'context' => 'danger',
            ])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
