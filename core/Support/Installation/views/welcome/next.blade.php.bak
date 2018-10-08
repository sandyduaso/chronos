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
                <h2 class="header-title mt-5">Pluma&trade; | <span class="text-muted">Next</span></h2>
                <p class="lead">You are about to install <strong>Pluma&trade;</strong> and all its components.</p>
                <p>Below, you may specify the configurations crucial in installing the app. Alternatively, you may specify these configurations in a <code>.env</code> file located at the root of the folder.</p>
            </header>

            <main class="content">
                @include("Install::partials.banner")

                <form action="{{ route('installation.write') }}" class="form" method="POST">
                    <hr>

                    <div class="form-block p-b-3">
                        <legend>Application</legend>
                        <p class="text-muted">The details of this application.</p>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Site Name</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="APP_NAME" class="form-control" value="{{ env('APP_NAME') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Tagline</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="APP_TAGLINE" class="form-control" value="{{ env('APP_TAGLINE') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Year</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="APP_YEAR" class="form-control" value="{{ date('Y') }}">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="form-block p-b-3">
                        <legend>Database</legend>
                        <p class="text-muted">Make sure you have correctly specified your database, database username, and database password below. If no existing database is found, the installer will create it for you.</p>
                        <p><small class="text-muted mb-3">Note to succesfully create a database, you must give a user that has the appropriate permissions.</small></p>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Database Name</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="DB_DATABASE" class="form-control" value="{{ env('DB_DATABASE') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Username</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="DB_USERNAME" class="form-control" value="{{ env('DB_USERNAME') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Password</strong></label>
                            <div class="col-md-9">
                                <input type="password" name="DB_PASSWORD" class="form-control" value="{{ env('DB_PASSWORD') }}">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="form-block p-b-3">
                        <legend>Mail</legend>
                        <p class="text-muted m-b-2">Below, you may specify your server's default mail configurations. Leave blank if unsure or want to configure later.</p>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Mail Driver</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="MAIL_DRIVER" class="form-control" value="{{ env('MAIL_DRIVER') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Host</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="MAIL_HOST" class="form-control" value="{{ env('MAIL_HOST') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Port</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="MAIL_PORT" class="form-control" value="{{ env('MAIL_PORT') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Username</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="MAIL_USERNAME" class="form-control" value="{{ env('MAIL_USERNAME') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Password</strong></label>
                            <div class="col-md-9">
                                <input type="password" name="MAIL_PASSWORD" class="form-control" value="{{ env('MAIL_PASSWORD') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Encryption</strong></label>
                            <div class="col-md-9">
                                <input type="text" name="MAIL_ENCRYPTION" class="form-control" value="{{ env('MAIL_ENCRYPTION') }}">
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="form-block">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <small class="text-muted">Installing will also migrate and seed the database. It may take several minutes.</small>
                            </div>
                            <div class="col-md-6">
                                <button role="button" type="submit" class="btn btn-primary float-right">Proceed</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </form>

            </main>

            <aside class="footnote mb-3">
                <small>&copy; Pluma&trade; 2017. Licensed under the MIT.</small>
            </aside>
        </div>
    </div>

@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
@endpush
