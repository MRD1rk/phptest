<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test project</title>
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<div id="alert"></div>
<div class="container">
    {$alert->output()}

    {$content}
</div>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>