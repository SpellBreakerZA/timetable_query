<?php

    include 'database_tools.php';
    $daysOld = getDaysSinceLastUpdate("lecture");
    echo $daysOld;

?>