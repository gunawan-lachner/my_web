<?php

$SQL        = "SELECT MTVDEV,MTLOC,_STATE,_STECHGD,ERACKP,ERAUDP,ERCRT1,ERCRT2,ERCRT3,ERCRT4,ERDLVY,ERDEP,ERDISP,ERCARD,ERCOMM,CUSLRP,CUSLJP,_CRCPLV FROM MT_VIEW WHERE MTDELE='' ORDER BY MTVDEV";
$CONNECTION = $euromis->fn_ewidt_data_sql();
$result     = odbc_exec( $CONNECTION, $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

echo "<br />".$euromis->fn_show_last_data_check()."<br />\r\n";
echo "<table border=\"1\" cellspacing=\"0\" id=\"table_monitoring\">\r\n";

$n = 0;      
# fetch the data from the database 
while( odbc_fetch_row( $result ) ) 
{ 

    $name        = odbc_result($result, 1);
    $description = odbc_result($result, 2);
    $status      = odbc_result($result, 3);
    $timestamp   = odbc_result($result, 4);
    $receiptprt  = odbc_result($result, 5);         
    $auditprt    = odbc_result($result, 6);
    $cassette1   = odbc_result($result, 7);
    $cassette2   = odbc_result($result, 8);
    $cassette3   = odbc_result($result, 9);
    $cassette4   = odbc_result($result, 10);
    $delivery    = odbc_result($result, 11);
    $depository  = odbc_result($result, 12);
    $dispenser   = odbc_result($result, 13);
    $cardreader  = odbc_result($result, 14);
    $comm        = odbc_result($result, 15);
    $receiptppr  = odbc_result($result, 16);
    $auditppr    = odbc_result($result, 17);
    $cashstatus  = odbc_result($result, 18);
    
    $cashlevel   = round( $cashstatus * 100, 2 );
    
    $date       = substr($timestamp, 0, 10);
    $time       = substr($timestamp, 10);
    $date_array = explode("-", $date);
    $time_array = explode(":", $time);            
    
    if( !is_null( $timestamp  ))
    {
        $date_full = date("d-M-Y H:i:s", mktime($time_array[0]+7, $time_array[1], $time_array[2], $date_array[1], $date_array[2], $date_array[0]));
    }
    
    if( $status<>1 || $receiptprt<>0 || $auditprt<>0 || $cassette1<>0 || $cassette2<>0 || $cassette3<>0 || $cassette4<>0 || $delivery<>0 || $depository<>0 || $dispenser<>0 || $cardreader<>0 || $comm<>0 || $cashlevel<CASH_LOW_THRESHOLD  )
    {                                    
        if( $status <> 1 ) 
        { 
            $tr_class      = "table_monitor_row_offline"; 
            $error_message = "OFFLINE"; 
        }
        elseif( $cashlevel < CASH_LOW_THRESHOLD ) 
        { 
            $tr_class      = "table_monitor_row_cash_low"; 
            $error_message = "CASH LOW<br />$cashlevel %";             
        } 
        else 
        { 
            $tr_class      = "table_monitor_row_warning"; 
            $error_message = "WARNING"; 
        }
                   
        echo "<tr id=\"$tr_class\">\r\n";
        echo "<td align=\"center\" id=\"date_small\"><strong>$date_full</strong></td>\r\n";
        echo "<td align=\"center\" width=\"100\"><strong>$name</strong></td>\r\n";
        echo "<td width=\"250\">$description</td>\r\n";
        echo "<td align=\"center\" width=\"100\"><strong>$error_message</strong></td>\r\n";
        echo "</tr>\r\n";        

        $n++;            
    }    
}
echo "</table><br />\r\n";    

if( $n == 0 )
{
    echo "<div align=\"center\" class=\"alert_monitoring\">".NO_ALERT."</div><br />\r\n";    
}        

# Close connection
$euromis->fn_server_close();

?>