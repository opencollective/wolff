<!DOCTYPE html>
<html>
<head>
    <title>{{ CONFIG['title'] }} - {{ $lang['title'] }}</title>
    <link href="{{ getPublicDirectory() }}assets/css/styles.css" rel="stylesheet"/>
</head>
<body>
<div class='center'>
    <h1 class='text-center'>{{ upper|$lang['title'] }}</h1>
    <p class='text-center'>{{ $lang['msg'] }}</p>
</div>

</body>
</html>
