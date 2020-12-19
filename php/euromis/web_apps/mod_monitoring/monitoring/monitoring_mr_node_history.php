<?php

# Get Post Variable
$row = trim($_POST['row']);

$SQL    = "SELECT E_DATE,E_TIME,E_NODE,E_DESCRIPTION,E_STATUS FROM `".PREFIX.MR_NODE_TABLE."` ORDER BY E_DATE DESC, E_TIME DESC LIMIT 0,$row";
$result = mysql_query( $SQL ) or $euromis->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );

echo "<br />".$euromis->fn_show_last_data_check()."<br />\r\n";
                             
echo "<table border=\"1\" cellspacing=\"0\" id=\"table_monitoring\">\r\n";
echo "<tr id=\"table_monitoring_header\" align=\"center\"><td>DATE</td><td width=\"50\">NAME</td><td width=\"270\">DESCRIPTION</td><td width=\"120\">STATUS</td></tr>\r\n";

# Fetch the data from the database 
while ( $row = mysql_fetch_assoc( $result ) ) 
{ 
    $date        = $row['E_DATE'];
    $time        = $row['E_TIME'];
    $name        = $row['E_NODE'];
    $description = $row['E_DESCRIPTION'];
    $status      = $row['E_STATUS'];

    $date_array = explode("-", $date);
    $time_array = explode(":", $time);            
    $date_full  = date("d-M-Y H:i:s", mktime($time_array[0], $time_array[1], $time_array[2], $date_array[1], $date_array[2], $date_array[0]));

    switch ($status)
    {
        case "P":
        $node_status = "Processing";
        break;

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
    echo "<td align=\"center\" id=\"date_small\">$date_full</td>\r\n";
    echo "<td align=\"center\"><strong>$name</strong></td>\r\n";
    echo "<td>$description</td>\r\n";
    echo "<td align=\"center\"><strong>$node_status</strong></td>\r\n";
    echo "</tr>\r\n";        

}
echo "</table><br />\r\n";     

?>