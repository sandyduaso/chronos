@extends('Theme::layouts.settings')

@section('form:title', __('Displaying Data'))

@section('form:content')
  <p class="form-label">{{ __('Formats') }}</p>
  @field('input', ['name' => 'date_format', 'value' => settings('date_format'), 'label' => __('Global Date Format')])

  @field('input', ['name' => 'items_per_page', 'type' => 'number', 'value' => settings('items_per_page'), 'label' => __('Items per Page')])

  <p class="form-label">{{ __('Grid Display') }}</p>
  @field('checkbox', ['name' => 'center_main_content', 'label' => __('Center the main content when possible.'), 'checked' => settings('center_main_content'), 'value' => settings('center_main_content', false)])
@endsection
