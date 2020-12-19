<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");
                                                                                                                                               
# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Connect to Database
$CONNECTION = $euromis->fn_as400mr_sql();

#$SQL = "SELECT * FROM ZTRANS0P WHERE TRXMDT=1110331 ORDER BY TRXMDT DESC, TRXMTM DESC";
#$SQL = "SELECT * FROM ZTRANS0P ORDER BY TRXMDT DESC, TRXMTM DESC FETCH FIRST 10 ROWS ONLY";
$SQL = "SELECT * FROM ZTRNDT0P";

$result = odbc_exec( $CONNECTION, $SQL );            

odbc_result_all($result);

# Close connection
$euromis->fn_server_close();

?>
