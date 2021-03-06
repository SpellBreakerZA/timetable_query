<?php

//    include 'database_connection.php';
    include 'database_tools.php';

    function insertLecture($module, $venue, $start, $end, $lang, $time, $day, $classType, $group) {
        
        global $conn;
        
        $stmt = $conn->prepare('INSERT INTO lecture (module, venue, startTime, endTime, language, timePeriod, day, classType,groupNum) VALUES(?,?,?,?,?,?,?,?,?)');
        
        $stmt->bind_param("sssssssss", $module, $venue, $start, $end, $lang, $time, $day, $classType, $group);
        $stmt->execute();
        
    }

    /*
    $createQuery = 'CREATE TABLE lecture (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        module VARCHAR(50),
        venue VARCHAR(255),
        day VARCHAR(255),
        startTime VARCHAR(50),
        endTime VARCHAR(255),
        language VARCHAR(8),
        timePeriod VARCHAR(80),
        classType VARCHAR(255)
    );'; */

?>