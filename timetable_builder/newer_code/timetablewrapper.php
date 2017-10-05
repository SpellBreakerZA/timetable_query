<?php

        class TimeTableWrapper {

                var $time_table;
                function __construct() {
                        $this->time_table = new TimeTable();
                }

                function add_module($module) {
                    $lectures = $module->get_all_lectures();
                    foreach ($lectures as $item) {
                        if ($this->is_possible_group($item)) {
                            $this->add_group($item);
                            break;
                        }
                    }
                    $pracs = $module->get_all_pracs();
                    $pracs_added = 0;
                    foreach ($pracs as $group) {
                        if ($pracs_added === 0) {
                            $entries = $group->get_all_entries();
                            foreach($entries as $entry) {
                                $entry->to_string();
                                $add_success = $this->time_table->add_prac($entry->get_day(), $entry->get_start_as_int(), $entry->get_end_as_int(), $entry->get_code());
                                if ($add_success === true) {
                                    $pracs_added++;
                                }
                            }
                        }
                    }
                    
                }

                function add_group($group) {
                    
                    $arr = $group->get_all_entries();
                    foreach ($arr as $item) {
                        $this->add_time_table_entry($item);
                    }
                    
                }

                function add_time_table_entry($entry) {
                    $this->time_table->add_subject($entry->get_day(), $entry->get_start(), $entry->get_code());
                    
                }
            
                function is_possible_entry($entry) {
                    return !$this->time_table->is_occupied($entry->get_day(), $entry->get_start());
                }
            
                function is_possible_group($group) {
                    $arr = $group->get_all_entries();
                    $possible = true;
                    foreach ($arr as $item) {
                        $possible = $possible && $this->is_possible_entry($item);
                    }
                    return $possible;
                }

                function is_possible_module($module) {
                    $lectures = $module->get_all_lectures();
                    $possible = true;
                    foreach ($lectures as $item) {
                         $possible = $possible && $this->is_possible_group($item);
                    }
                    $pracs = $module->get_all_pracs();
                    $pracs_added = 0;
                    
                    $prac_possible = false;
                    foreach ($pracs as $group) {
                        echo "ISPOSSIBLEMOD!:  ";
                        echo $group->to_string();
                        $entries = $group->get_all_entries();
                        foreach($entries as $entry) {
                            if ($this->is_possible_entry($entry)) {
                                $prac_possible = true;
                                break;
                            }
                        }
                    }
                    if ($possible) {
                        echo "lectures were possible...";
                    }
                    else echo "lectures were not possible...";
                    
                    if ($prac_possible) {
                        echo "pracs were possible...";
                    }
                    else echo "pracs were not possible...";
                    
                    return $prac_possible && $possible;
                }
            
                function to_string() {
                    return $this->time_table->createHTMLTable();
                }
            
                function show_clashes() {
                    return $this->time_table->getClashes()->createHTMLTableVerbose();
                }
                

        }

?>