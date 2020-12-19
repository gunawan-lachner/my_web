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
    case 1:
    # Connect to Database
    $EWIDT_DATA_CONNECTION = $euromis->fn_ewidt_data_miner_sql();
    
    # Set Query
    $SQL = "SELECT DSRLEV, DWHONL, HSTONL FROM DWH_SRV_R, DWH_SERVERS, ITM_HOSTS";
    
    # Execute query
    $result = odbc_exec( $EWIDT_DATA_CONNECTION, $SQL );            

    odbc_fetch_row( $result );
    $DSRLEV = odbc_result( $result, 1 );
    $DWHONL = odbc_result( $result, 2 );
    $HSTONL = odbc_result( $result, 3 );        

    # Output result
    echo "<table>\r\n";
    echo "<tr align=\"left\"><td colspan=\"3\">\r\n";
    echo "<strong>Status of EWIDT Table BEFORE Re-Trigger</strong>";
    echo "</td></tr>\r\n";    

    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">DSRLEV Status</td><td width=\"3\">:</td><td><strong>$DSRLEV</strong></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr align=\"left\"><td colspan=\"3\">\r\n";
    echo "DSRLEV should be 0. If it is not 0 then set it 0\r\n";
    echo "</td></tr>\r\n";

    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">DWHONL Status</td><td width=\"3\">:</td><td><strong>$DWHONL</strong></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr align=\"left\"><td colspan=\"3\">\r\n";
    echo "DWHONL should be 1. If it is not 1 then set it to 1\r\n";
    echo "</td></tr>\r\n";
    
    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">HSTONL Status</td><td width=\"3\">:</td><td><strong>$HSTONL</strong></td>\r\n";
    echo "</tr>\r\n";
    echo "<tr align=\"left\"><td colspan=\"3\">\r\n";
    echo "HSTONL should be 1. If it is not 1 then set it to 1\r\n";
    echo "</td></tr>\r\n";    
    echo "</table>\r\n";
    
    break;
    
    case 2:
    # Connect to Database
    $EWIDT_DATA_CONNECTION = $euromis->fn_ewidt_data_miner_sql();
    
    # Set Query
    $SQL_1 = "UPDATE DWH_SRV_R SET DSRLEV=0";
    $SQL_2 = "UPDATE DWH_SERVERS SET DWHONL=1";
    $SQL_3 = "UPDATE ITM_HOSTS SET HSTONL=1";
    
    # Execute query
    $result = odbc_exec( $EWIDT_DATA_CONNECTION, $SQL_1 );
    $result = odbc_exec( $EWIDT_DATA_CONNECTION, $SQL_2 );
    $result = odbc_exec( $EWIDT_DATA_CONNECTION, $SQL_3 );

    # Set Query
    $SQL = "SELECT DSRLEV, DWHONL, HSTONL FROM DWH_SRV_R, DWH_SERVERS, ITM_HOSTS";
    
    # Execute query
    $result = odbc_exec( $EWIDT_DATA_CONNECTION, $SQL );            

    odbc_fetch_row( $result );
    $DSRLEV = odbc_result( $result, 1 );
    $DWHONL = odbc_result( $result, 2 );
    $HSTONL = odbc_result( $result, 3 );        

    # Close connection
    $euromis->fn_server_close();
    
    # Output result
    echo "<table>\r\n";
    echo "<tr align=\"left\"><td colspan=\"3\">\r\n";
    echo "<strong>Status of EWIDT Table AFTER Re-Trigger</strong>";
    echo "</td></tr>\r\n";    

    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">DSRLEV Status</td><td width=\"3\">:</td><td>$DSRLEV</td>\r\n";
    echo "</tr>\r\n";

    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">DWHONL Status</td><td width=\"3\">:</td><td>$DWHONL</td>\r\n";
    echo "</tr>\r\n";
    
    echo "<tr align=\"left\">\r\n";
    echo "<td width=\"100\">HSTONL Status</td><td width=\"3\">:</td><td>$HSTONL</td>\r\n";
    echo "</tr>\r\n";
    echo "</table>\r\n";
    
    break;
}
    
?>