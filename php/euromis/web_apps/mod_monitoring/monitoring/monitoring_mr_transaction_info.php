<?php

$date         = date( 'd' );
$current_date = "1" . date("ymd");

$SQL        = "SELECT COUNT(*) FROM autotopupregistrations WHERE triggertype = 'D' AND triggerdata = $date AND status = 1";
$CONNECTION = $euromis->fn_mr_sql();
$result     = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

odbc_fetch_row( $result );
$AUTOTOPUP_REGISTERED = odbc_result($result, 1);

$SQL    = "SELECT COUNT(*) AS AT_TRX FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY='AT'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$AUTOTOPUP_TRIGGERED = $row['AT_TRX'];

$SQL    = "SELECT COUNT(*) AS AT_TRX_SUCCESS FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY='AT' AND D_TRRSPC='00'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$AUTOTOPUP_TRIGGERED_SUCCESS = $row['AT_TRX_SUCCESS'];

# Updated By: Gunawan, 27 January 2015. D_TRTRTY IN ('MR','AT','AR','F1','F2') 
$SQL    = "SELECT COUNT(*) AS TRANSACTION_SUCCESS FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='00'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$TRANSACTION_SUCCESS = $row['TRANSACTION_SUCCESS'];

# Updated By: Gunawan, 27 January 2015. D_TRTRTY IN ('MR','AT','AR','F1','F2') 
$SQL    = "SELECT COUNT(*) AS TRANSACTION_FAILED FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC<>'00'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$TRANSACTION_FAILED = $row['TRANSACTION_FAILED'];

$SQL    = "SELECT COUNT(*) AS TRX_RC08 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='08'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC08 = $row['TRX_RC08'];

$SQL    = "SELECT COUNT(*) AS TRX_RC10 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='10'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC10 = $row['TRX_RC10'];

$SQL    = "SELECT COUNT(*) AS TRX_RC50 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='50'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC50 = $row['TRX_RC50'];

$SQL    = "SELECT COUNT(*) AS TRX_RC63 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='63'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC63 = $row['TRX_RC63'];

$SQL    = "SELECT COUNT(*) AS TRX_RC12 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='12'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC12 = $row['TRX_RC12'];

$SQL    = "SELECT COUNT(*) AS TRX_RC05 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='05'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC05 = $row['TRX_RC05'];

$SQL    = "SELECT COUNT(*) AS TRX_RC02 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='02'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC02 = $row['TRX_RC02'];

$SQL    = "SELECT COUNT(*) AS TRX_RC06 FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRTRTY IN ('MR','AT','AR','F1','F2') AND D_TRRSPC='06'";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$row = mysql_fetch_array( $result, MYSQL_ASSOC );
$RC06 = $row['TRX_RC06'];

# Updated By: Gunawan, 27 January 2015. Add Percentage
$TOTAL_TRX = $TRANSACTION_SUCCESS + $TRANSACTION_FAILED;
$PERCENTAGE_SUCCESS = round($TRANSACTION_SUCCESS / $TOTAL_TRX * 100, 2);
$PERCENTAGE_FAILED = round($TRANSACTION_FAILED / $TOTAL_TRX * 100, 2);


$SQL_BY_OPERATOR    = "SELECT D_TRVND, COUNT(*) AS FAILED FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRRSPC<>'00' AND D_TRVND NOT IN ('', 'XXX') GROUP BY D_TRVND";
$result_BY_OPERATOR = mysql_query( $SQL_BY_OPERATOR ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL_BY_OPERATOR );

$SQL_BY_BANK    = "SELECT D_TRAQPT, COUNT(*) AS FAILED FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRRSPC<>'00' AND D_TRAQPT NOT IN ('', 'TLK', 'TLM') GROUP BY D_TRAQPT";
$result_BY_BANK = mysql_query( $SQL_BY_BANK ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL_BY_BANK );

$SQL_BY_BANKOK    = "SELECT D_TRAQPT, COUNT(*) AS FAILED FROM `".PREFIX.MR_AS400_TABLE."` WHERE D_TRMSGC='2' AND D_TRXMDT=$current_date AND D_TRRSPC = '00' AND D_TRAQPT NOT IN ('', 'TLK', 'TLM') GROUP BY D_TRAQPT";
$result_BY_BANKOK = mysql_query( $SQL_BY_BANKOK ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL_BY_BANKOK );


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
<td colspan="3">AutoTopup Transaction</td>
</tr>

<tr>
<td width="200">AutoTopup Registered</td>
<td width="3">:</td>
<td><strong><?php echo $AUTOTOPUP_REGISTERED; ?></strong></td>
</tr>

<tr>
<td>AutoTopup Triggered</td>
<td>:</td>
<td><strong><?php echo $AUTOTOPUP_TRIGGERED; ?></strong></td>
</tr>

<tr>
<td>AutoTopup Triggered Success</td>
<td>:</td>
<td><strong><?php echo $AUTOTOPUP_TRIGGERED_SUCCESS; ?></strong></td>
</tr>

</table>

<br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header">
<td colspan="3">MR Transaction Status</td>
</tr>

<tr>
<td width="200">Success</td>
<td width="3">:</td>
<td><strong><?php echo $TRANSACTION_SUCCESS; ?></strong></td>
</tr>

<tr>
<td>Failed</td>
<td>:</td>
<td><strong><?php echo $TRANSACTION_FAILED; ?></strong></td>
</tr>

<tr>
<td width="200">Percentage Success</td>
<td width="3">:</td>
<td><strong><?php echo $PERCENTAGE_SUCCESS; ?> %</strong></td>
</tr>
<?php if ($PERCENTAGE_FAILED > 2) {
		echo "<tr  bgcolor=\"#FF0000\">";
	} else {
		echo "<tr  bgcolor=\"#000000\">";
	}
?>
<td>Percentage Failed</td>
<td>:</td>
<td><strong><?php echo $PERCENTAGE_FAILED; ?> %</strong></td>
</tr>
<tr>
<td width="200">RC 08</td>
<td width="3">:</td>
<td><strong><?php echo $RC08; ?></strong></td>
</tr>
<tr>
<td width="200">RC 10</td>
<td width="3">:</td>
<td><strong><?php echo $RC10; ?></strong></td>
</tr>
<tr>
<td width="200">RC 50</td>
<td width="3">:</td>
<td><strong><?php echo $RC50; ?></strong></td>
</tr>
<tr>
<td width="200">RC 63</td>
<td width="3">:</td>
<td><strong><?php echo $RC63; ?></strong></td>
</tr>
<tr>
<td width="200">RC 12</td>
<td width="3">:</td>
<td><strong><?php echo $RC12; ?></strong></td>
</tr>
<tr>
<td width="200">RC 05</td>
<td width="3">:</td>
<td><strong><?php echo $RC05; ?></strong></td>
</tr>
<tr>
<td width="200">RC 02</td>
<td width="3">:</td>
<td><strong><?php echo $RC02; ?></strong></td>
</tr>
<tr>
<td width="200">RC 06</td>
<td width="3">:</td>
<td><strong><?php echo $RC06; ?></strong></td>
</tr>
</table>

<br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header">
<td colspan="3">MR Transaction Status Failed by Operator</td>
</tr>

<?php
while ( $row = mysql_fetch_array( $result_BY_OPERATOR, MYSQL_ASSOC ) )
{
?>
<tr>
<td width="200"><?php echo $row['D_TRVND']; ?></td>
<td width="3">:</td>
<td><strong><?php echo  $row['FAILED']; ?></strong></td>
</tr>
<?php
}
?>

</table>

<br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header">
<td colspan="3">MR Transaction Status Failed by Bank</td>
</tr>

<?php
while ( $row = mysql_fetch_array( $result_BY_BANK, MYSQL_ASSOC ) )
{
?>
<tr>
<td width="200"><?php echo $row['D_TRAQPT']; ?></td>
<td width="3">:</td>
<td><strong><?php echo  $row['FAILED']; ?></strong></td>
</tr>
<?php 
}
?>

</table>

<br />

<table cellspacing="0" id="table_monitoring" width="100%">

<tr id="table_monitoring_header">
<td colspan="3">MR Transaction Status Success by Bank</td>
</tr>

<?php
while ( $row = mysql_fetch_array( $result_BY_BANKOK, MYSQL_ASSOC ) )
{
?>
<tr>
<td width="200"><?php echo $row['D_TRAQPT']; ?></td>
<td width="3">:</td>
<td><strong><?php echo  $row['FAILED']; ?></strong></td>
</tr>
<?php 
}
?>

</table>

<br />
<?php

# Close connection
$euromis->fn_server_close();

?>