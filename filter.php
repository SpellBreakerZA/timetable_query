<?php

    include 'database_connection.php';
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    function isValidModuleCode($code) {
        global $conn;
        $queryText = "SELECT * FROM lecture WHERE module = '$code'";
        echo $queryText . '<br>';
        $querySuccess = true;
        $result = $conn->query($queryText);
        //return false;
        if ($result === null || $result->num_rows == 0) {
            return false;
        }
        else return true;
    }

    function retrieveModuleArray($delimitedStr) {
        $modules = explode(",", $delimitedStr);
        $size = count($modules);
        $validModules = array();
        for($i = 0; $i < $size; $i++) {
            $bool = isValidModuleCode($modules[$i]);
            echo $modules[$i] . " = " . isValidModuleCode($modules[$i]) . "<br>";
            array_push($validModules, $bool);
        }
        return $validModules;
        //return array_combine($modules, $validModules);
    }

    $a = retrieveModuleArray("SPAZZ,LST111,AIM 101");
    print_r($a);

?>