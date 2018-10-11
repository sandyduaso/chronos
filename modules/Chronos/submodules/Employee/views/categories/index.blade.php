@extends('Category::categories.index')

@section('head:title', __('Departments | Office'))

@section('page:title')
  <h1 class="page-title">{{ __('Departments') }}</h1>
@endsection

@section('formcreate:title')
  <h1 class="card-title">{{ __("New Department") }}</h1>
@endsection

@section('tablelist:title', __('All Departments'))
