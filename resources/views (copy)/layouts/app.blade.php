<!doctype html>
<html>
<head>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">
</head>
<body>
<div class="container">
    <header class="row">
        @include('layouts.menu')
    </header>
    <div id="main" class="row">
        @yield('content')
    </div>
</div>
</body>
</html>
