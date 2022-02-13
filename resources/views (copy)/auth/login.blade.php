<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Delivery App</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/login') }}"><b>Delivery App</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="alert alert-danger fade in alert-dismissible hide" id="error_div">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <div class="error-content">
            </div>
        </div>
        <form method="post" id="loginForm">
            @csrf

            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" value="" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    <span class="help-block">
                    <strong></strong>
                </span>

            </div>

            <div class="form-group has-feedback"">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>
<script src="/js/common.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
<script>
    const senderRoute = "{{route('sender.index')}}";
    const bikerRoute = "{{route('biker.index')}}";
    const form = document.querySelector('form');
    form.addEventListener('submit', async event => {
        event.preventDefault();
        const formPostData = ($(form).serializeObject());
        $('#error_div').removeClass('show').addClass('hide');
        $('#error_div .error-content').html('');
        await axios.post("{{route('authenticate')}}",formPostData)
        .then(function (response) {
            setToken(response.data.message.access_token);
            redirectUsingRole();
        }).catch(function(error) {
            if (error.response) {
                $.each(error.response.data.message, function(key, val) {
                    $('#error_div .error-content').append(`<span>${key}: ${val}</span><br />`);
                })
                $('#error_div').removeClass('hide').addClass('show');
            }
        });
    });

    $(document).ready(function() {
        if (getToken()) {
            redirectUsingRole();
        }
    });
</script>
</body>
</html>
