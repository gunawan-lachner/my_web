<?php

# Load the global function
require_once("../global/process-helper.php");

# Create object
$euromis = new webapps();

# Get post parameter for task
$task = trim($_POST['t']);

# Choose task function
switch($task)
{               
    case 0:     
    # Turn off output buffering to decrease cpu usage
    @ob_end_clean();
    
    # Get Post parameter
    $date_from = trim($_POST['date_from']);
    $date_to   = trim($_POST['date_to']);
    
    # Set Date
    $DATE_TMP_1 = str_replace( "-", "", $date_from );
    $DATE_TMP_2 = substr( $DATE_TMP_1, 2 );
    $FIRST_DATE = "1" . $DATE_TMP_2;
    
    $DATE_TMP_1 = str_replace( "-", "", $date_to );
    $DATE_TMP_2 = substr( $DATE_TMP_1, 2 );
    $LAST_DATE  = "1" . $DATE_TMP_2;

    # Set query
    $SQL = "
        SELECT D_TRCATI,COUNT(*) AS DUPLICATE
        FROM `".PREFIX.MR_AS400_TABLE."` 
        WHERE D_TRRSPC='38' 
        AND D_TRISPT='CIB'
        AND D_TRXMDT BETWEEN '$FIRST_DATE' AND '$LAST_DATE'
        GROUP BY D_TRCATI
    ";
    $result = mysql_query( $SQL );
    
    echo "TERMINAL ID\t\tDUPLICATE COUNT\r\n";
    echo "----------------------------------------\r\n\r\n";

    # Write Result
    while ( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
    {
        echo $row['D_TRCATI']."\t\t".$row['DUPLICATE']."\r\n";
    }

    # Close connection
    $euromis->fn_server_close();      
            
    break;
}

?>