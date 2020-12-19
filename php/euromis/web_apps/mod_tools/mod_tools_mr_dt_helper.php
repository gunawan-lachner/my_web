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
    case 0:     

    $page   = $_POST['page']; // get the requested page
    $limit  = $_POST['rows']; // get how many rows we want to have into the grid
    $sidx   = $_POST['sidx']; // get index row - i.e. user click to sort
    $sord   = $_POST['sord']; // get the direction
    $search = $_POST['_search'];
    
    if ( $search == "true" )
    {
        $searchMultiple = $_POST['filters'];
        
        $search = json_decode( $searchMultiple, TRUE );
        $searchMultiple = $euromis->fn_convert_jqgrid_filters_to_mysql($search);
    
        if(!$sidx) $sidx =1;

        $SQL = "SELECT * FROM `".PREFIX.MR_DT_AS400_TABLE."` WHERE $searchMultiple";
        $result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
        
        $count = mysql_num_rows($result);
        
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
            } else {
            $total_pages = 0;
            }

        if ($page > $total_pages) $page=$total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ( $start < 0 ) $start = 0;
        
        $SQL = "SELECT * FROM `".PREFIX.MR_DT_AS400_TABLE."` WHERE $searchMultiple ORDER BY $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
  
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
            header("Content-type: application/xhtml+xml;charset=utf-8");
            } else {
                    header("Content-type: text/xml;charset=utf-8");
                   }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MR_DT_AS400_TABLE."` WHERE $searchMultiple ORDER BY $sidx $sord</userdata>";
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

                echo "<row id='". $row[J_ID]."'>";
                       echo "<cell><![CDATA[". $row[J_DATE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_TIME]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTSTAN]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTDTID]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTPHONE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTAMOUNT]."]]></cell>";                       
                       echo "<cell><![CDATA[". $row[J_DTSERIAL]."]]></cell>";                                              
                echo "</row>";
                       
            }
                       
            echo "</rows>";
        
    }
    else
    {

        if(!$sidx) $sidx =1;

        $SQL = "SELECT COUNT(*) AS count FROM `".PREFIX.MR_DT_AS400_TABLE;  
        $result = mysql_query($SQL);
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $count = $row['count'];

        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
            } else {
            $total_pages = 0;
            }

        if ($page > $total_pages) $page=$total_pages;

        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        $SQL = "SELECT * FROM `".PREFIX.MR_DT_AS400_TABLE."` ORDER BY $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL );

        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
            header("Content-type: application/xhtml+xml;charset=utf-8");
            } else {
                    header("Content-type: text/xml;charset=utf-8");
                   }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";                                    
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MR_DT_AS400_TABLE."` ORDER BY $sidx $sord</userdata>";                        
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                
                echo "<row id='". $row[J_ID]."'>";
                       echo "<cell><![CDATA[". $row[J_DATE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_TIME]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTSTAN]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTDTID]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTPHONE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[J_DTAMOUNT]."]]></cell>";                       
                       echo "<cell><![CDATA[". $row[J_DTSERIAL]."]]></cell>";                                              
                echo "</row>";
                       
            }
                       
            echo "</rows>";
        
    }
    
    # Close connection
    $euromis->fn_server_close();
    
    break; 
}

?>