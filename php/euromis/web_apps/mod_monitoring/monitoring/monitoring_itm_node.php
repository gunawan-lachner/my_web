<?php

echo "<br />".$euromis->fn_show_last_data_check()."<br />\r\n";
echo "<table border=\"1\" cellspacing=\"0\" id=\"table_monitoring\">\r\n";

# Updated By: Gunawan. 30 December 2014. SKIP BTPN
$SQL    = "SELECT * FROM ".PREFIX.ITM_NODE_TABLE.
          " INNER JOIN (SELECT MAX(G_ID) AS G_ID FROM ".
          PREFIX.ITM_NODE_TABLE." GROUP BY G_NODE) mirror ON ".
          PREFIX.ITM_NODE_TABLE.".G_ID = mirror.G_ID WHERE G_DESCRIPTION NOT LIKE ".ITM_ATM_NODE_SKIP;
          
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

$n = 0;
# Fetch the data from the database 
while ( $row = mysql_fetch_assoc( $result ) ) 
{ 
    $date        = $row['G_DATE'];
    $time        = $row['G_TIME'];                       
    $name        = $row['G_NODE'];
    $description = $row['G_DESCRIPTION'];
    $status      = $row['G_STATUS'];
    
    $date_array = explode("-", $date);
    $time_array = explode(":", $time);            
    $date_full  = date("d-M-Y H:i:s", mktime($time_array[0], $time_array[1], $time_array[2], $date_array[1], $date_array[2], $date_array[0]));
    
    if($status<>"P")
    {                        
        switch ($status)
        {
            case "R":                                            
            $node_status = "Recovery";
            break;

            case "F":
            $node_status = "Forwarding";
            break;
            
            default:
            $node_status = "OFF";
            break;
        }
                        
        echo "<tr>\r\n";
        echo "<td align=\"center\" id=\"date_small\"><strong>$date_full</strong></td>\r\n";        
        echo "<td align=\"center\" width=\"50\"><strong>$name</strong></td>\r\n";
        echo "<td width=\"400\">$description</td>\r\n";
        echo "<td align=\"center\"><strong>$node_status</strong></td>\r\n";            
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