@include("Theme::partials.header")

@yield("before:content")
@yield("content")
@yield("after:content")

@include("Theme::partials.footer")
