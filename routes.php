<?php

Router::get('','Controller/index.php');
Router::get('about','Controller/about.php');
Router::get('task','Controller/task.php');
Router::post('task','Controller/task.php');