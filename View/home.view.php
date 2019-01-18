<?php require 'partials/header.php' ?>

Main Page
<hr>
<hr>

<form method="post" action="/task">
    <input name="_method" type="hidden" value="DELETE" />
    <input name="name" type="text">
    <button type="submit">submit</button>
</form>