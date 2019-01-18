<?php require 'partials/header.php' ?>

login Page
<hr>

<form method="post" action="/login">
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