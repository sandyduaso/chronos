@extends("Theme::layouts.master")

@section("pre-container", "")
@section("post-container", "")

@section("root")
    @yield("Template::public.menu")
    @yield("content")
@endsection
