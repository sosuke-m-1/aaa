<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>input</title>
</head>
<body>
<form action="/" method="post" style="width:960px; margin: 50px auto 0 auto;">
    {{ csrf_field() }}
    売上<input type="text" name="sales">円
    <br>
    <br>
    <button type="submit">送信</button>
</form>
</body>
</html>
