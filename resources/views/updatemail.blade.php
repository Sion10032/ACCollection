<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p><strong>{{ $user->name }}</strong>, 您的收藏中有以下漫画更新了：</p>
    @foreach ($updatedItems as $item)
        <p>{{ $item->name }}</p>
    @endforeach
</body>
</html>