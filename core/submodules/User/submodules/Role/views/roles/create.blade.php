@extends('Theme::layouts.admin')

@section('head:title', __('Add Role'))
@section('page:title', __('Add Role'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <form class="card" action="{{ route('roles.store') }}" method="POST">
          @csrf

          <div class="card-body">
            @field('input', ['name' => 'name', 'attr' => 'data-slugger=[name=code]'])

            @field('input', ['name' => 'code'])

            @field('textarea', ['name' => 'description'])

            @field('treeview', [
              'name' => 'permissions[]',
              'label' => __('Permissions'),
              'description' => __('Permissions are set of abilities a role can inherit. Permissions dictate which URLs are restricted or allowed.'),
              'items' => $repository->permissions(),
              'key' => 'code',
              'field' => 'permissions',
              'text' => 'description',
            ])

            {{-- @field('treeview', [
              'name' => 'permissions[]',
              'label' => __('Policies'),
              'description' => __('Policies are set of actions a user can or cannot do.'),
              'items' => $repository->permissions(),
              'key' => 'code',
              'field' => 'permissions',
              'text' => 'description',
            ]) --}}
          </div>

          <div class="card-footer border-0 text-right">
            @submit('Add Role')
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
