<br /><?php echo $euromis->fn_show_last_data_check(); ?><br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header" align="center">
<td>ATM info for today : <?php echo date( 'd F Y' ); ?></td>
</tr>

</table>

<br />

<?php

foreach ( $euromis->ATM_BANK_ID AS $key=>$value )
{

    $SQL        = "SELECT COUNT(*) FROM MT_VIEW WHERE MTDELE='' AND LEFT( MTVDEV, 3 )='$key'";
    $CONNECTION = $euromis->fn_ewidt_data_sql();
    $result     = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
    
    $ATM_COUNT  = odbc_result($result, 1);
    
    $SQL        = "SELECT COUNT(*) FROM MT_VIEW WHERE MTDELE='' AND LEFT( MTVDEV, 3 )='$key' AND _STATE<>1";
    $CONNECTION = $euromis->fn_ewidt_data_sql();
    $result     = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
    
    $ATM_OFF    = odbc_result($result, 1);
	
    $SLA        = round( ( intval( $ATM_COUNT ) - intval( $ATM_OFF ) ) / $ATM_COUNT * 100, 2 ) ;
?>

<table cellspacing="0" id="table_monitoring" width="100%">

<tr>
<td width="200">ATM <?php echo $value; ?></td>
<td width="3">:</td>
<td><strong><?php echo $ATM_COUNT; ?></strong></td>
</tr>

<tr>
<td width="200">ATM Offline</td>
<td width="3">:</td>
<td><strong><?php echo $ATM_OFF; ?></strong></td>
</tr>

<tr>
<td>Percent SLA</td>
<td>:</td>
<td><strong><?php echo $SLA; ?> %</strong></td>
</tr>

</table>

<br />

<?php    
}

# Close connection
$euromis->fn_server_close();

?>