<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @stack('pre-meta')
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="{{ app()->getLocale() }}">
  <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no">
  <title>
    @section('head:title')
      {{ $application->page->title }}
    @show
    @section('head:subtitle')
      {{ $application->page->subtitle }}
    @show
  </title>
  {{-- <base href="{{ url('/') }}"> --}}
  <meta name="description" content="{{ __(@$application->head->description) }}">
  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <!-- CSRF Token -->
  @stack('tokens')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
  @show
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ url('favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ url('favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ url('favicons/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ url('manifest.json') }}">
  <link rel="mask-icon" color="{{ settings('site_theme_color', '#3984e8') }}" href="{{ url('favicons/safari-pinned-tab.svg') }}">
  <meta name="theme-color" content="{{ settings('site_theme_color', '#ffff') }}">
  @stack('seo')
    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="{{ url('/') }}">
    -->
  @show
  @stack('post-meta')
  @stack('fonts')
    {{-- Display the links specified in config/stylesheets.php --}}
    {!! font_link_tags('stylesheets') !!}
  @show
  @stack('before-css')
    @if (settings('is_rtl', false))
      <link rel="preload" href="{{ theme('dist/app.rtl.min.css') }}" as="style">
    @else
      <link rel="preload" href="{{ theme('dist/app.min.css') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}" as="style">
    @endif
    {{--
      This line is only a preload.
      The actual script should be found in this theme's views/partials/foot.blade.php
    --}}
    <link rel="preload" href="{{ theme('dist/vendor.min.js') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}" as="script">
    <link rel="preload" href="{{ theme('dist/app.min.js') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}" as="script">
  @show
  @stack('css')
    @if (settings('is_rtl', false))
      <link rel="stylesheet" href="{{ theme('dist/app.rtl.min.css') }}">
    @else
      <link rel="stylesheet" type="text/css" href="{{ theme('dist/app.min.css') }}?v={{ app()->environment() === 'development' ? date('his') : $application->version }}">
    @endif
  @show
  @stack('after-css')
</head>
<body>
  @push('head.noscript')
    @include('Theme::partials.noscript')
  @show
