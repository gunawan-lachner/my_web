<?php

# Load the global function
require_once("../global/process-helper.php");
require_once("../includes/JAK8583.class.php");

# Create object
$euromis = new webapps();

# Get post parameter for task
$task = trim($_POST['t']);

# Choose task function
switch($task)
{
    # Display file type select
    case 0:                     
    $stanlist = explode("\n", $_POST['requestlist']);    
    foreach( $stanlist as $stan )
    {                     
        # Get data
        $stan   = trim($stan);
        
        if ( !empty($stan) )
        {

            $SQL    = "SELECT J_DTSERIAL FROM `".PREFIX.MR_DT_AS400_TABLE."` WHERE J_DTSTAN='$stan' ORDER BY J_DATE DESC, J_TIME DESC LIMIT 0,1";
            $result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

            if( mysql_num_rows( $result ) > 0 )
            {
                $row = mysql_fetch_array( $result, MYSQL_ASSOC );
                echo $row['J_DTSERIAL']."\n";
            }                                 
            else
            {            
                # Connect to Database
                $MR_CONNECTION = $euromis->fn_mr_sql();

                $SQL    = "SELECT TOP 1 requestid FROM AuditRequestID WHERE stan='$stan' ORDER BY timestamp DESC";
                $result = odbc_exec( $MR_CONNECTION, $SQL );
                
                if( odbc_num_rows( $result ) > 0 )
                {
                    odbc_fetch_row( $result );
                    $serial = odbc_result( $result, 1 );
                    echo $serial."\n";
                }
                else
                {
                    echo "NONE\n";
                }
            }     
            
            # Close connection
            $euromis->fn_server_close();
            
        }        
    }    
    break;    
    
    # Display file type select
    case 1:                     
    $stanlist = explode("\n", $_POST['requestlist']);    
    foreach( $stanlist as $stan )
    {                     
        # Get data
        $stan   = trim($stan);
        
        if ( !empty($stan) )
        {

            $SQL    = "SELECT D_TRSTAN FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRSTAN='$stan' ORDER BY D_TRXMDT DESC, D_TRXMTM DESC LIMIT 0,1";
            $result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

            if( mysql_num_rows( $result ) > 0 )
            {
                $row = mysql_fetch_array( $result, MYSQL_ASSOC );
                echo $row['D_TRSTAN']."\n";
            }                                 
            else
            {            
                echo "NONE\n";
            }     
            
            # Close connection
            $euromis->fn_server_close();
            
        }        
    }    
    break;        
}

?>