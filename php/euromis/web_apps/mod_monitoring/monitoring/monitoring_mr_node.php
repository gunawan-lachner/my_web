<?php

echo "<br />".$euromis->fn_show_last_data_check()."<br />\r\n";
echo "<table border=\"1\" cellspacing=\"0\" id=\"table_monitoring\">\r\n";

$SQL    = "SELECT * FROM ".PREFIX.MR_NODE_TABLE.
          " INNER JOIN (SELECT MAX(E_ID) AS E_ID FROM ".
          PREFIX.MR_NODE_TABLE." GROUP BY E_NODE) mirror ON ".
          PREFIX.MR_NODE_TABLE.".E_ID = mirror.E_ID".
          " WHERE E_NODE NOT IN ".MR_NODE_SKIP;;
          
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

# fetch the data from the database 
$n = 0;
while( $row = mysql_fetch_assoc( $result ) ) 
{ 

    $date        = $row['E_DATE'];
    $time        = $row['E_TIME'];        
    $name        = $row['E_NODE'];
    $description = $row['E_DESCRIPTION'];
    $status      = $row['E_STATUS'];
    
    $date_array  = explode("-", $date);
    $date_full   = date("d-M-Y", mktime(0, 0, 0, $date_array[1], $date_array[2], $date_array[0]));        
    
    $tr_class    = "";

    if( $status<>"P" )
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
            $tr_class    = "table_monitor_row_offline";             
            $node_status = "OFF";
            break;
        }
                   
        echo "<tr id=\"$tr_class\">\r\n";
        echo "<td align=\"center\" id=\"date_small\"><strong>$date_full $time</strong></td>\r\n";            
        echo "<td align=\"center\" width=\"50\"><strong>$name</strong></td>\r\n";
        echo "<td width=\"270\">$description</td>\r\n";
        echo "<td align=\"center\" width=\"120\"><strong>$node_status</strong></td>\r\n";            
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