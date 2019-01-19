<?php require 'partials/header.php' ?>

login Page
<hr>

<form method="post" action="/register">
    <label>
        name:
        <input name="name" type="text">
    </label>
    <label>
        username:
        <input name="username" type="text">
    </label>
    <label>
        password:
        <input type="password" name="password">
    </label>
    <button type="submit">submit</button>
</form>