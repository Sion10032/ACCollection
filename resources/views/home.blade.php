<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="full-screen" content="true">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ACCollection</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app"></div>
        <script src="/js/app.js"></script>
    </body>
</html>