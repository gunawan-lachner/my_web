<?php

$current_date  = date("Y-m-d");

$CONNECTION    = $euromis->fn_ewidt_data2_sql();

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT IN ('BER','MSD','SBP','SB1','BID','BIP','GID') AND TRRSPC = '00'";
$result_SCB_00 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_00 );
$SCB_00        = odbc_result($result_SCB_00, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT IN ('BER','MSD','SBP','SB1','BID','BIP','GID') AND TRRSPC <> '00'";
$result_SCB_F = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_F );
$SCB_FAILED    = odbc_result($result_SCB_F, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRISPT != 'SCB' AND TRRSPC = '00'";
$result_NON_SCB_00 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_NON_SCB_00 );
$NON_SCB_00        = odbc_result($result_NON_SCB_00, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRISPT != 'SCB' AND TRRSPC <> '00'";
$result_SCB_F = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_F );
$NON_SCB_FAILED    = odbc_result($result_SCB_F, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT = 'SCB' AND TRRSPC = '08'";
$result_SCB_08 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_08 );
$SCB_08        = odbc_result($result_SCB_08, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT = 'SCB' AND TRRSPC = '10'";
$result_SCB_10 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_10 );
$SCB_10        = odbc_result($result_SCB_10, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT = 'SCB' AND TRRSPC = '50'";
$result_SCB_50 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_50 );
$SCB_50        = odbc_result($result_SCB_50, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT = 'SCB' AND TRRSPC = '99'";
$result_SCB_99 = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB_99 );
$SCB_99        = odbc_result($result_SCB_99, 1);

$SQL           = "SELECT COUNT(*) FROM ZTRANS_VIEW WITH (NOLOCK) WHERE _TDATTM BETWEEN '$current_date 00:00:00.000' AND '$current_date 23:59:59.000' AND CCOD = '360' AND TRAQPT = 'SCB' AND TRRSPC NOT IN ('00', '08', '10', '99', '61')";
$result_SCB    = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result_SCB );
$SCB_OTHER     = odbc_result($result_SCB, 1);

?>

<br /><?php echo $euromis->fn_show_last_data_check(); ?><br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header" align="center">
<td>Transaction info for today : <?php echo date( 'd F Y' ); ?></td>
</tr>

</table>

<br />

<table cellspacing="0" id="table_monitoring" width="100%">
<tr id="table_monitoring_header">
<td colspan="3">Transaction Status for SCB Card</td>
</tr>

<tr>
<td width="200">Success</td>
<td width="3">:</td>
<td><strong><?php echo $SCB_00; ?></strong></td>
</tr>

<tr>
<td width="200">Failed</td>
<td width="3">:</td>
<td><strong><?php echo $SCB_FAILED; ?></strong></td>
</tr>

<tr id="table_monitoring_header">
<td colspan="3">Transaction Status for Non SCB Card</td>
</tr>

<tr>
<td width="200">Success</td>
<td width="3">:</td>
<td><strong><?php echo $NON_SCB_00; ?></strong></td>
</tr>

<tr>
<td width="200">Failed</td>
<td width="3">:</td>
<td><strong><?php echo $NON_SCB_FAILED; ?></strong></td>
</tr>

<tr id="table_monitoring_header">
<td colspan="3">ATM Transaction Status Failed for SCB</td>
</tr>

<tr>
<td width="200">RC 08</td>
<td width="3">:</td>
<td><strong><?php echo $SCB_08; ?></strong></td>
</tr>

<tr>
<td>RC 10</td>
<td>:</td>
<td><strong><?php echo $SCB_10; ?></strong></td>
</tr>

<tr>
<td>RC 50</td>
<td>:</td>
<td><strong><?php echo $SCB_50; ?></strong></td>
</tr>

<tr>
<td>RC 99</td>
<td>:</td>
<td><strong><?php echo $SCB_99; ?></strong></td>
</tr>

<tr>
<td>RC Failed Other</td>
<td>:</td>
<td><strong><?php echo $SCB_OTHER; ?></strong></td>
</tr>

</table>

<br />

<?php

# Close connection
$euromis->fn_server_close();

?>