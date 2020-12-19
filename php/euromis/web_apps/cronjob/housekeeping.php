<?php

require_once("d:\\wamp\\www\\g4sei-monitoring\\mod_config\\process-helper.php");
# Don't set Time Limit
//set_time_limit(0);
# Don't display any errors           
ini_set("display_errors", "0"); 

# Housekeeping Database
fn_delete_under_3month();

?>
