<?php require 'partials/header.php' ?>

task Page
<hr>
<?php foreach ($tasks as $task): ?>
    <?= $task->name ?>
    <br>
<?php endforeach; ?>
