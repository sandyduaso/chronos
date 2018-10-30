@extends('Theme::layouts.admin')

@section('head:title', __('Edit Role'))
@section('page:title', __('Edit Role'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8">
        <form class="card" action="{{ route('roles.update', $resource->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="card-body">
            @field('input', ['name' => 'name', 'attr' => 'data-slugger=[name=code]', 'value' => $resource->name])

            @field('input', ['name' => 'code', 'value' => $resource->code])

            @field('textarea', ['name' => 'description', 'value' => $resource->description])

            @field('treeview', [
              'name' => 'permissions[]',
              'collapsed' => true,
              'label' => __('Permissions'),
              'value' => $resource->permissions->pluck('id')->toArray(),
              'items' => $repository->permissions(),
              'key' => 'code',
              'field' => 'permissions',
              'text' => 'description',
            ])
          </div>

          <div class="card-footer border-0 text-right">
            @submit('Update')
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
