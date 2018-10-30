@extends('Theme::layouts.admin')

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">

        <form action="{{ route('pages.store') }}" method="POST">
          @csrf

          @field('input', ['name' => 'title', 'attr' => 'data-slugger=[name=code]'])

          @field('input', ['name' => 'code', 'type' => 'hidden', 'label' => false])

          @field('textarea', ['name' => 'body'])

          @submit('Save')
        </form>

      </div>
    </div>
  </div>
@endsection
