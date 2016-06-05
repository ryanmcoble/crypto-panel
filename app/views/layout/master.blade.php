<!DOCTYPE html>
<html>
    <head>
        <title>Crypto Panel - {{ $title }}</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <link rel="stylesheet" href="/assets/css/animate.css" type="text/css">

        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Lato';
            }

            .title {
                font-weight: 600;
                font-size: 32px;
                text-align: center;
                margin-bottom: 24px;
            }

            .stats {
                padding-top: 24px;
            }

            .table > tbody > tr > td {
                color: #000 !important;
                font-weight: 600;
            }

            .tab-pane {
                padding-top: 12px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        <div id="footer">
            <div class="container">
                <p class="text-muted credit animated hinge">Coded with love by <a href="http://coble.ninja">Ryan M. Coble</a>.</p>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    </body>
</html>