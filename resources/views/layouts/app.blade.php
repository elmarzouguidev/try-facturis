<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Demande d'essai Facturis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="shortcut icon" href="{{ asset('images/logo-app-2.png') }}">
    <meta content="app_creator" name="Elmarzougui Abdelghafour" />
    <meta content="app_version" name="v2.1" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    @env('production')
    @turnstileScripts()
    @endenv
</head>

<body>

    <div>
        @yield('content')
    </div>

</body>

</html>
