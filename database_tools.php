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
                        classType VARCHAR(255)
					);';
					
		$result = $conn->query($createQuery) or die ('User table not created' . $conn->error); 	
		
	}

?>