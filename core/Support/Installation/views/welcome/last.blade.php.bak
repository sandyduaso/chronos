@extends("Install::layouts.installation")

@push('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
        body {
            background-color: #f1f2f3;
        }
    </style>
@endpush

@section("content")
    <div class="container">
        <div class="col-sm-8 offset-sm-2">
            <header class="header">
                <h2 class="header-title mt-5">Pluma&trade; | <span class="text-muted">Finish</span></h2>
                <p class="lead">Done! you may still edit additional configurations in settings.</p>
            </header>

            <main class="content">
                <p>You may now visit the <a href="{{ url('admin') }}">Admin Dashboard</a> and login with the following credentials:</p>

                <ul>
                    <li><strong>Username: {{ $user->email }}</strong></li>
                    <li><strong>Password: <em>Your password</em></strong></li>
                </ul>

                <a href="{{ route('login.show') }}" class="btn btn-primary">Login</a>
                <a href="{{ url('home') }}" class="btn btn-secondary">Home</a>

            </main>

        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
@endpush
