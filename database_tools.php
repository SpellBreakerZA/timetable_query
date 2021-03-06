<?php

    include 'database_connection.php';
    
    function deleteAllTables() {
		global $conn;
		
		$deleteQuery = 'drop table if exists lecture';
		$conn->query($deleteQuery) or die('Error ' . $conn->error);
		
	}
	
	function createTables() {
	
		global $conn;
		deleteAllTables();
		$createQuery = 'CREATE TABLE lecture (
						id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
						module VARCHAR(50),
						venue VARCHAR(255),
                        day VARCHAR(255),
						startTime VARCHAR(50),
						endTime VARCHAR(255),
						timePeriod VARCHAR(80),
                        classType VARCHAR(255),
                        language VARCHAR(8), 
                        groupNum VARCHAR(8)
                        
					);';
					
        echo '<br>'. $createQuery . '<br>';
		$result = $conn->query($createQuery) or die ('User table not created' . $conn->error); 	
		
	}

    function getTableCreationDate($tableName) {
        
        global $conn;
        $queryText = "SELECT create_time FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '$tableName'";
        $result = $conn->query($queryText) or die ('Could not query creation date of table...');
        
        if ($result->num_rows !== 0) {
            $row = $result->fetch_assoc();
            $date = $row['create_time'];
            return $date;
        }
        else {
//            die("Got no result from DBMS...");
            return null;
        } 
        
    }

    function getDaysSinceLastUpdate($tableName) {
        
        global $conn;
        $queryText = "SELECT DATEDIFF(NOW(), create_time) as diff FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '$tableName'";
        $result = $conn->query($queryText) or die ('Could not query creation date of table...');
        
        if ($result->num_rows !== 0) {
            $row = $result->fetch_assoc();
            $date = $row['diff'];
            return $date;
        }
        else {
//            die("Got no result from DBMS...");
            return null;
        } 
        
    }

    function shouldUpdate($tableName) {
        
        if (getDaysSinceUpdate($tableName) >= '7') {
            echo 'update';
        }
        else echo 'no update';
        
    }

    function getData($queryText) {
        
        if ($queryText === null || $queryText === '') {
            return null;
        }
            
        global $conn;
        $result = $conn->query($queryText);
        
        if ($result === null || $result->num_rows == 0) {
            return null;
        }
        else {
            return $result;
        }
        
    }

?>