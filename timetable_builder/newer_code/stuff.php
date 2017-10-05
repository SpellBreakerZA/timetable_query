<?php

        include 'timetable.php';
        include 'module.php';
        include 'timetablewrapper.php';

        include '../database_tools.php';
            
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 226' AND groupNum = 'G01' AND classType LIKE 'L_'");
        $mod = new Module("COS 226", 2);
        $mod->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 226' AND groupNum = 'G02'");
        $mod->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 226' AND groupNum = 'G03'");
        $mod->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 226' AND groupNum = 'G04'");
        $mod->add_group_from_database($temp);
        echo $mod->to_string();


        $lectures = $mod->get_all_lectures();
        echo "ALL LECTURES <br>";
        foreach($lectures as $lect) {
            echo $lect->to_string();
        }
        $pracs = $mod->get_all_pracs();
        echo "ALL PRACS <br>";
        foreach($pracs as $prac) {
            echo $prac->to_string();
        }

        $tw = new TimeTableWrapper();
        $tw->add_module($mod);

        echo $tw->to_string();

        echo $tw->show_clashes();

        
        /* ADDING COS 122 to timetable */
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 122' AND groupNum = 'G01' AND classType LIKE 'L_'");
        $cos122 = new Module("COS 122", 3);
        $cos122->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 122' AND groupNum = 'G02' AND classType LIKE 'L_'");
        $cos122->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 122' AND groupNum = 'G03' AND classType LIKE 'L_'");
        $cos122->add_group_from_database($temp);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 122' AND groupNum = 'G04' AND classType LIKE 'L_'");
        $cos122->add_group_from_database($temp);

        $temp = getData("SELECT * FROM LECTURE WHERE module = 'COS 122' AND classType NOT LIKE 'L_'");
        $cos122->add_group_from_database($temp);
        echo $cos122->to_string();
        
        echo 'Trying to add COS122...';
        echo '<br> Possible? : ...' ;
        if ($tw->is_possible_module($cos122)) {
            echo 'true';  
            echo 'Adding COS122...';
            $tw->add_module($cos122);
        }
        else {
            echo 'false :()';
        }
        echo $tw->to_string();
        $conn->close();

        /* ADDING WTW 285 to the thing */
        $wtw = new Module("WTW 285", 3);
        $temp = getData("SELECT * FROM LECTURE WHERE module = 'WTW 285' AND classType LIKE 'L_'");
        $wtw->add_group_from_database($temp);

        $temp = getData("SELECT * FROM LECTURE WHERE module = 'WTW 285' AND classType NOT LIKE 'L_'");
        $wtw->add_group_from_database($temp);
        echo $wtw->to_string();
        
        echo 'Trying to add WTW 285...';
        echo '<br> Possible? : ...' ;
        if ($tw->is_possible_module($wtw)) {
            echo 'true';  
            echo 'Adding WTW 285...';
            $tw->add_module($wtw);
        }
        else {
            echo 'false :()';
        }
        echo $tw->to_string();
        $conn->close();

            
        /*$t = new TimeTable();
        $t->add_subject('Monday', '14:30', 'COS224');
        $t->add_subject('Monday', '13:30', 'COS224');
        $t->add_subject('Monday', '15:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_subject('Monday', '16:30', 'COS224');
        $t->add_prac('Tuesday', 13, 16 , 'OMG114');

        echo 'CLASH TABLE: <br>';
        $c = $t->getClashes()->createHTMLTableVerbose();
        echo $c;
        echo "TABLE: <br>";
        echo $t->createHTMLTable();*/

        /* 
            echo '<br><br> Is_possible_module(mod)';
            if ($tw->is_possible_module($mod)) {
                echo 'true';
            }
            else {
                echo 'false';
            }

            echo '<br><br> Is_possible_module($te)';
            //$code, $type, $day,  $startTime, $endTime, $group, $place, $prio
            $te = new TimeTableEntry("LOL123", "..", "Monday", "8:30", "9:30", "GG", "LargeChem", 2);
            if ($tw->is_possible_entry($te)) {
                echo 'true';
                $tw->add_time_table_entry($te);
                echo $tw->to_string();
            }
            else {
                echo 'false';
            }

            echo '<br><br> Is_possible_module($te)';
            //$code, $type, $day,  $startTime, $endTime, $group, $place, $prio
            $te = new TimeTableEntry("LOL666", "..", "Monday", "8:30", "9:30", "GG", "LargeChem", 2);
            if ($tw->is_possible_entry($te)) {
                echo 'true';
                $tw->add_time_table_entry($te);
                echo $tw->to_string();
            }
            else {
                echo 'false';
            }
        */
        

?>