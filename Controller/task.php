<?php

if (Request::method() == 'GET') {

    $tasks = $database->selectAll('task');

    require 'View/task.view.php';
} else {

    echo $_POST['name'];
}
