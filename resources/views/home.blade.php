<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ACCollection</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="full-screen" content="true">
        <link rel="bookmark" type="image/png" href="/image/application-icon.png">
        <link rel="apple-touch-icon" href="/image/application-icon.png">
        <link rel="shortcut icon" href="/favicon.ico">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app"></div>
        <script src="/js/app.js"></script>
    </body>
</html>