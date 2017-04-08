<!DOCTYPE html>
<html lang="en">

<head>
<title>{{ @title }} - {{ @SITENAME }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{{ @BASE.'/assets/bootstrap/css/bootstrap.min.css' }}">

<link rel="stylesheet" href="{{ @BASE.'/assets/bootstrap/css/bootstrap-theme.min.css' }}">

<script src="{{ @BASE.'/assets/js/jquery-3.1.1.min.js' }}"></script>

<script src="{{ @BASE.'/assets/bootstrap/js/bootstrap.min.js' }}"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script src="{{ @BASE.'/assets/js/jquery.form-validator.min.js' }}"></script>

<link rel="stylesheet" href="{{ @BASE.'/assets/css/frontend.css' }}">
</head>

<body>


    <div class="container">
        {{ Template::instance()->render('nav.php') }}
        {{ Template::instance()->render(@content) }}

    </div>

    <footer class="footer">
        <div class="container">
            <!--<p class="text-muted">Place sticky footer content here.</p>-->
        </div>
    </footer>

</body>

</html>