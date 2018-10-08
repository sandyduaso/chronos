{{--
Template Name: Default Template
Type: Submission
Description: The default submission template displaying the submitted results.
Author: Pluma CMS
Version: 2.0.1
--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $resource->form->name }}</title>
    <style>
        body {
            font-family: '{{ settings('font_family', 'Roboto, Lato, sans-serif') }}';
        }
        header.main-header * {
            line-height: 1;
            margin: 0;
        }
        header h1 {
            font-size: 20px;
            line-height: 1;
            margin-bottom: 0;
        }
        .mb-0 {
            margin-bottom: 0;
        }
        header a {
            text-decoration: none;
        }
        .grey {
            background: rgba(0,0,0,0.05);
        }
        tr th,
        tr td,
        .padded-large {
            padding: 10px;
        }
        .padded-large th,
        .padded-large td {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .text-centered {
            text-align: center;
        }
        header.fixed { position: fixed; top: -10px; left: 0px; right: 0px; height: 70px; }
        footer.fixed { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
        .text-small {
            font-size: 11px;
        }
        .fixed + .main {
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <center>
            <div class="padded-large">
                <img width="80" src="{{ public_path('logo.png') }}">
                {{-- <img width="50" src="/home/lioneil/Pictures/waw-magec.png"> --}}
            </div>
            <p class="mb-0"><a href="{{ url('/') }}"><strong>{{ $application->site->title }}</strong></a></p>
            <p>{{ $application->site->tagline }}</p>
            <div><small>{{ date('F d, Y') }}</small></div>
        </center>
    </header>
    <div class="main">
        <center>
            <br>
            <h1>{{ $resource->form->name }}</h1>
            <p>{{ __("Submitted by {$resource->user->fullname}") }}</p>
            <br>
        </center>
        {!! $resource->form->body !!}
    </div>

    <table class="table" width="100%">
        <thead>
            <tr class="padded-large">
                <th class="grey text-centered">{{ __('Questions') }}</th>
                <th class="grey text-centered">{{ __('Answer') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resource->fields() as $field)
                <tr class="padded-large">
                    <th>{{ $field->question->label }}</th>
                    <td>{!! $field->guess ?? '<em>no answer</em>' !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer class="fixed padded-large">
        <small class="text-small">{{ $application->site->copyright }}</small>
    </footer>
</body>
</html>
{{-- {{ dd('dd') }} --}}
