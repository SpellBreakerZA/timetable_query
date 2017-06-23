<?php 

    if (isset($_POST) && isset($_POST['text'])) {
        include 'database_connection.php';

        $text = $conn->real_escape_string($_POST['text']);

        $queryText = "SELECT DISTINCT module FROM lecture WHERE module LIKE '$text%' ORDER BY module";
        $result = $conn->query($queryText) or exit;
        
        $modules = array();
        while ($row = $result->fetch_assoc()) {
            array_push($modules, $row['module']);
        }
        $conn->close();
        echo json_encode($modules);
    }

?>