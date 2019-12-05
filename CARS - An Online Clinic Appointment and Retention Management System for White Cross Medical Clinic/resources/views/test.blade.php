<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <h1>Pusher Test</h1>
    </div>

    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('89973cf8f98acc38053a', {
            cluster: 'ap1',
            'useTLS': false,
        });

        var channel = pusher.subscribe('AppointmentStatus.' + {{Auth::user()->id}});
        channel.bind('AppointmentStatus', function(data) {
            alert(JSON.stringify(data));
        });

    </script>
</body>