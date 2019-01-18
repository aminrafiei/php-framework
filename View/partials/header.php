<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if (auth()) : ?>
    welcome <?php print auth()->name ?>
<?php endif ?>
    <ul>
        <li><a href="/">home</a></li>
        <?php if (!auth()) : ?>
            <li><a href="login">login</a></li>
        <?php endif ?>
        <li><a href="task">task</a></li>
        <li><a href="about">about</a></li>
    </ul>
</body>
</html>