<?php 

    include "database_connection.php";
    function getResultAsTableString($queryText) {
        
        echo $queryText;
        if ($queryText === null || $queryText === '') {
            return "null query!";
        }
            
        global $conn;
        $result = $conn->query($queryText);
        
        if ($result === null || $result->num_rows == 0) {
            return "No results!";
        }

        $table = '<table> <thead>';
        $table .= '<tr>
                <td> ID </td>
                <td> Module </td>
                <td> Venue </td>
                <td> Start </td>
                <td> End </td>
                <td> Day </td>
                <td> When </td>
                <td> Type </td>
               </tr>';
        $table .= '</thead>';
        $table .= '<tbody>';
        while ($row = $result->fetch_assoc()) {

            if ($row['module'] == null) {
                continue;
            }
            $table .= '<tr>';
            foreach ($row as $key => $val) {
                $table .= '<td>' . $val . '</td>';
            }
            $table .= '</tr>'; 
        }
        $table .= '</tbody></table>';
        return $table;
    }
        
?>