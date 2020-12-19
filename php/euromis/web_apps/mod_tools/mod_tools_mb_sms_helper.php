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

        $SQL = "SELECT * FROM `".PREFIX.MB_SMS_TABLE."` WHERE $searchMultiple";
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
        
        $SQL = "SELECT * FROM `".PREFIX.MB_SMS_TABLE."` WHERE $searchMultiple ORDER BY $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
  
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
            header("Content-type: application/xhtml+xml;charset=utf-8");
            } else {
                    header("Content-type: text/xml;charset=utf-8");
                   }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MB_SMS_TABLE."` WHERE $searchMultiple ORDER BY $sidx $sord</userdata>";
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

                preg_match( "/<value type='java.lang.String'>(.*?)<\/value>/", $row[C_BODYXML], $BODYXML );
                
                echo "<row id='". $row[C_ID]."'>";
                       echo "<cell><![CDATA[". $row[C_TIMESTAMP]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_DATE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_TIME]."]]></cell>";                       
                       echo "<cell><![CDATA[". $row[C_ORIGINATOR]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_DESTINATION]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_CHANNEL]."]]></cell>";
                       echo "<cell><![CDATA[". $BODYXML[1]."]]></cell>";
                       echo "<cell>". $row[C_STATUS]."</cell>";
                echo "</row>";
                       
            }
                       
            echo "</rows>";
        
    }
    else
    {

        if(!$sidx) $sidx =1;

        $SQL = "SELECT COUNT(*) AS count FROM `".PREFIX.MB_SMS_TABLE;  
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
        $SQL = "SELECT * FROM `".PREFIX.MB_SMS_TABLE."` ORDER BY $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL );

        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
            header("Content-type: application/xhtml+xml;charset=utf-8");
            } else {
                    header("Content-type: text/xml;charset=utf-8");
                   }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";                                    
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MB_SMS_TABLE."` ORDER BY $sidx $sord</userdata>";                        
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                
                preg_match( "/<value type='java.lang.String'>(.*?)<\/value>/", $row[C_BODYXML], $BODYXML );
                $BODYXML = str_replace( '\r\n', '', $BODYXML );
                
                echo "<row id='". $row[C_ID]."'>";
                       echo "<cell><![CDATA[". $row[C_TIMESTAMP]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_DATE]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_TIME]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_ORIGINATOR]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_DESTINATION]."]]></cell>";
                       echo "<cell><![CDATA[". $row[C_CHANNEL]."]]></cell>";
                       echo "<cell><![CDATA[". $BODYXML[1]."]]></cell>";
                       echo "<cell>". $row[C_STATUS]."</cell>";
                echo "</row>";
                       
            }
                       
            echo "</rows>";
        
    }
    break; 
    
    case 1:
    # Turn off output buffering to decrease cpu usage
    @ob_end_clean();

    # Set variable
    $SQL           = trim($_POST['SQL']);
    $random        = trim($_POST['random']);
    $progress_file = PROGRESS_FILE.".".$random;    

    # Load the Excel driver
    require_once("../includes/excel/PHPExcel.php");

    # Load Excel Template
    $objPHPexcel = PHPExcel_IOFactory::load('../template/SMS_LOG.xlt');          
    
    # Set active sheet to first sheet
    $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
    $objWorksheet->setTitle('Mobile Banking SMS Log');
    $objWorksheet->getCell('A1')->setValue("MOBILE BANKING SMS LOG");
    
    # Write data to sheet
    $result = mysql_query( $SQL );
    
    $totalRecord = mysql_num_rows( $result );

    # Set Progress
    $progress      = 0;
    $totalProgress = $totalRecord + 5; # Add some number
       
    $no = 1; $X = 4;
    while( $row = mysql_fetch_array($result, MYSQL_ASSOC) )
    {
        preg_match( "/<value type='java.lang.String'>(.*?)<\/value>/", $row['C_BODYXML'], $BODYXML );
        $BODYXML = str_replace( '\r\n', '', $BODYXML );
                
        $objWorksheet->getCell('A'.$X)->setValue($no);
        $objWorksheet->getCell('B'.$X)->setValue($row['C_DATE']);
        $objWorksheet->getCell('C'.$X)->setValue($row['C_TIME']);
        $objWorksheet->getCell('D'.$X)->setValueExplicit($row['C_ORIGINATOR'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('E'.$X)->setValueExplicit($row['C_DESTINATION'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('F'.$X)->setValue($row['C_CHANNEL']);
        $objWorksheet->getCell('G'.$X)->setValue($BODYXML[1]);    
        $objWorksheet->getCell('H'.$X)->setValue($row['C_STATUS']);    

        # Set Progress
        $progress++;
        $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );
                
        $no++; $X++;
    }
                 
    # Save xls file to temp
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
    $fileTemp  = TMP_FILE.mt_rand();
    $objWriter->save($fileTemp);        

    # Set Progress
    $progress = 99999;
    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );
                     
    # Force download
    $euromis->fn_outputFile( $fileTemp, "SMS_LOG_MOBILE_BANKING.xls" );            

    # Delete Temporary File
    unlink($fileTemp);        
        
    break;           
    
    case 2:
    $random        = trim($_POST['random']);        
    $progress_file = PROGRESS_FILE.".".$random;
    $content       = $euromis->fn_read_progress( $progress_file );
    
    # Output progress number
    echo $content;
    
    # Delete Temporary File
    unlink($progress_file);    
    break;    
}

?>