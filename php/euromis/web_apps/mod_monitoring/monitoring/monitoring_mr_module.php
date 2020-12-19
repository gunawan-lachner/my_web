<?php

echo "<br />".$euromis->fn_show_last_data_check()."<br />\r\n";
echo "<table border=\"1\" cellspacing=\"0\" id=\"table_monitoring\">\r\n";

$SQL    = "SELECT * FROM ".PREFIX.MR_MODULE_TABLE.
          " INNER JOIN (SELECT MAX(F_ID) AS F_ID FROM ".
          PREFIX.MR_MODULE_TABLE." GROUP BY F_MODULE) mirror ON ".
          PREFIX.MR_MODULE_TABLE.".F_ID = mirror.F_ID".
          " WHERE F_MODULE NOT IN ".MR_MODULE_SKIP;
          
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

# fetch the data from the database 
$n = 0;
while( $row = mysql_fetch_assoc( $result ) ) 
{ 

    $date        = $row['F_DATE'];
    $time        = $row['F_TIME'];
    $date_array  = explode("-", $date);
    $date_full   = date("d-M-Y", mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]));
    
    $name        = $row['F_MODULE'];
    $description = $row['F_DESCRIPTION'];
    $status      = $row['F_STATUS'];

    if( $status<>"A" )
    {                                                       
        echo "<tr id=\"table_monitor_row_offline\">\r\n";
        echo "<td align=\"center\" id=\"date_small\"><strong>$date_full $time</strong></td>\r\n";
        echo "<td align=\"center\" width=\"70\"><strong>$name</strong></td>\r\n";
        echo "<td width=\"370\">$description</td>\r\n";
        echo "<td align=\"center\" width=\"50\"><strong>OFF</strong></td>\r\n";
        echo "</tr>\r\n";    
        
        $n++;    
    }    
}
echo "</table><br />\r\n";

if( $n == 0 )
{
    echo "<div align=\"center\" class=\"alert_monitoring\">".NO_ALERT."</div><br />\r\n";    
}    


?>