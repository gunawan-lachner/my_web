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

    # Backup MR SMS Log
    if ( $params['MB_SMS']['ACTIVE'] == '1' )
    {
        $function = $params['MB_SMS']['FUNCTION'];
        $euromis->$function();   
    }

    # Backup MB SMS Log
    if ( $params['MR_SMS']['ACTIVE'] == '1' )
    {
        $function = $params['MR_SMS']['FUNCTION'];
        $euromis->$function();   
    }

    # Backup ITM Node Log
    if ( $params['ITM_NODE']['ACTIVE'] == '1' )
    {
        $function = $params['ITM_NODE']['FUNCTION'];
        $euromis->$function();   
    }
    
    # Backup ITM ATM Log
    if ( $params['ITM_ATM']['ACTIVE'] == '1' )
    {
        $function = $params['ITM_ATM']['FUNCTION'];
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
