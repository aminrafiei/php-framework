<?php require 'partials/header.php' ?>

<div class="container mx-auto">
    <p class="text-4xl">Main Page</p>
</div>
<hr>

<form method="post" action="/task">
    <input name="_method" type="hidden" value="DELETE" />
    <input name="name" type="text">
    <button type="submit">submit</button>
</form>