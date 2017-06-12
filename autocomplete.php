<?php 

    if (isset($_POST) && isset($_POST['text'])) {
        $text = $_POST['text'];
        
        include 'database_connection.php';
        $queryText = "SELECT DISTINCT module FROM lecture WHERE module LIKE '$text%'";
        $result = $conn->query($queryText) or exit;
        
        $modules = array();
        while ($row = $result->fetch_assoc()) {
            array_push($modules, $row['module']);
        }
        $conn->close;
        echo json_encode($modules);
    }

?>