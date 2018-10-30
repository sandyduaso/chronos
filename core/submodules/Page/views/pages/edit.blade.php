@extends('Theme::layouts.admin')

@section('head:title', __('Edit Page'))
@section('page:title', __('Edit Page'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <form action="{{ route('pages.update', $resource->id) }}" method="POST">
          @csrf
          @method('PUT')


          @field('input', ['value' => $resource->title, 'name' => 'title', 'attr' => 'data-slugger=[name=code]'])
          <em>by {{ $resource->author }}</em>

          @field('input', ['value' => $resource->code, 'name' => 'code', 'type' => 'hidden', 'label' => false])

          @field('textarea', ['value' => $resource->body, 'name' => 'body'])

          @submit('Update')
        </form>

      </div>
    </div>
  </div>
@endsection
