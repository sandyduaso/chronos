@extends('Theme::layouts.admin')

@section('head-title', __('Refresh Permissions'))

@section('page-title')
  <a href="{{ route('permissions.index') }}" role="button" class="btn shadow-none"><i class="fe fe-arrow-left"></i></a>
  <h1 class="page-title mr-auto">{{ __('Refresh Permissions') }}</h1>
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="text-wrap p-lg-4">
              <h2 class="mb-4">{{ __('Refresh List') }}</h2>
              <p>{{ __("Refreshing will add and/or update all new permissions specified by the modules you've installed.") }}</p>
              <p>{{ __('Outdated permissions or permissions from uninstalled modules will be removed.') }}</p>
              <form action="{{ route('permissions.refresh') }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-success btn-lg">{{ __('Refresh Permissions') }}</button>
              </form>

              <hr>

              <h2 class="mb-4">{{ __('Reset List') }}</h2>
              <p>{!! __("Performing this action will completely remove ALL permissions data from the database. <strong>Users might lose their previous privileges after this action</strong>.") !!}</p>
              <div class="alert alert-warning mt-5 mb-6">
                <div><i class="fe fe-alert-triangle"></i>&nbsp; <strong>{{ __('Warning') }}</strong><br>{{ __("You might need to setup the user roles manually again. If you do not want to upset the order of the Cosmos, then for the love of Talos, do not proceed!") }}</div>
              </div>
              <form action="{{ route('permissions.reset') }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-lg">{{ __('Reset Permissions') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
