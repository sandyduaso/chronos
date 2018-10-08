{{--
Template Name: A Generic Template
Description: A simple template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends('Theme::layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 order-lg-1">
        <header class="page-header">
          <h1 class="page-title"><strong>{{ __($page->title) }}</strong></h1>
        </header>
        <aside class="card">
          <img src="{{ $page->feature }}" width="100%" height="auto" alt="{{ __($page->title) }}" class="rounded">
        </aside>
        <div class="page-content mb-9">
          {!! $page->body !!}
        </div>
      </div>
    </div>
  </div>
@endsection
