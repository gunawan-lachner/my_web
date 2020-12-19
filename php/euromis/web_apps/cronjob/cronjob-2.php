<?php

/********************************************************************
 * Cronjob.                                                         *
 ********************************************************************/

# Set default Time Zone
date_default_timezone_set("Asia/Jakarta");
 
require_once("c:\\wamp\\www\\euromis\\web_apps\\global\\process-helper.php");

# Don't set Time Limit
//set_time_limit(0);

# Don't display any errors           
ini_set("display_errors", "0"); 
 
function doBackup()
{
    # Print start time log
    # echo "[".Date("d/m/Y H:i:s")."] Start job\r\n";

    # Create object                                
    $euromis = new webapps();
    
    # Check INI configuration
    $params = parse_ini_file( INI_SCHEDULER, TRUE );

    # Backup MR Node Log
    if ( $params['MR_NODE']['ACTIVE'] == '1' )
    {
        $function = $params['MR_NODE']['FUNCTION'];
        $euromis->$function();   
    }

    # Backup MR Module Log
    if ( $params['MR_MODULE']['ACTIVE'] == '1' )
    {
        $function = $params['MR_MODULE']['FUNCTION'];
        $euromis->$function();   
    }

    # Backup MR DT Log
    if ( $params['MR_DT']['ACTIVE'] == '1' )
    {
        $function = $params['MR_DT']['FUNCTION'];
        $euromis->$function();   
    }
    
    # Print end time log
    # echo "[".Date("d/m/Y H:i:s")."] End job\r\n";    
}

# Loop for 6 times, 6x9 = 54 seconds
for($i=1; $i<=6; $i++) {

    # do backup
    doBackup();

    # Pause for 9 seconds
    if ( $i < 6 ) sleep(9);
}

?>
