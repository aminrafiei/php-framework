<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="View/assets/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Framework</title>
</head>
<body>

<section class="section" id="home-page">
    <h1>REGISTER</h1>
    <div class="row mt-5">
        <form method="post" action="register">
            <label>name:</label>
            <input class="form-control" name="name" type="text" required>
            <br>
            <label>username:</label>
            <input class="form-control" name="username" type="text" required>
            <br>
            <label>password:</label>
            <input class="form-control" name="password" type="password" required>
            <br>
            <input class="btn btn-success" type="submit">
        </form>
    </div>

</section>

</body>
</html>