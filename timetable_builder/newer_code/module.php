<?php 

        include 'group.php';
        include 'timetableentry.php';

        class Module {

                var $module_code;
                var $prio;
                var $groups;
                var $groups_size;

                function __construct($module_code, $prio) {
                        $this->module_code = $module_code;
                        $this->prio = $prio;
                        $this->groups = array();
                        $this->groups_size = 0;
                }

                /* this will add all items from a mysql result into a group and store it
                /* NOTE: this assumes the query result will be only one group
                /*        and that it doesn't need to filter it
                */

                function add_group_from_database($result) {
                    
                   
                    if ($result === null) {
                        return;
                    }
                    
                    $entries = array();
                    $count = 0;
                    while($entry = $result->fetch_assoc()) {
                             print_r($entry);
                            $start = substr($entry['startTime'], 0, 5);
                            if ($start[0] == "0") { 
                                $start = substr($entry['startTime'], 1, 4);
                            }
                            $end = substr($entry['endTime'], 0, 5);
                            if ($end[0] == "0") { 
                                $end = substr($entry['endTime'], 1, 4);
                            }
                            $classType = $entry['classType'];
                            $place = $entry['venue'];
                            $day = $entry['day'];

                            $temp_entry = new TimeTableEntry($this->module_code, "...", $day,  $start, $end, $classType, $place, $this->prio);
                            array_push($entries, $temp_entry);
                            $count++;
                    }
                    $group = new Group($entries, $count);
                    array_push($this->groups, $group);
                    $this->groups_size++;
                }


                function get_module_code() { 
                        return $this->module_code; 
                }

                function get_prio() { 
                        return $this->prio; 
                }

                function get_num_groups() { 
                        return $this->groups_size; 
                }

                //returns group object array for each lecture
                function get_all_lectures() {
                        $arr = array();
                        for($i = 0; $i < $this->groups_size; $i++) {
                                $entry = $this->groups[$i];
                                $group = $entry->get_group();
                                if (strpos($group, 'L') !== FALSE) {
                                        array_push($arr, $entry);
                                }
                        }
                        return $arr;
                }

                //returns group object array for each pracitcal
                function get_all_pracs() {
                        $arr = array();
                        for($i = 0; $i < $this->groups_size; $i++) {
                                $entry = $this->groups[$i];
                                $group = $entry->get_group();
                                if (strpos($group, 'P') !== FALSE) {
                                        array_push($arr, $entry);
                                }
                        }
                        return $arr;
                }

                function get_all() {
                        return $this->groups;
                }
            
                function to_string() {
                    $str = "Module: $this->module_code with prio: $this->prio <br>";
                    foreach($this->groups as $group) {
                        $str .= $group->to_string();
                        $str .= "<br>";
                    }
                    return $str;
                }
                
        }

?>