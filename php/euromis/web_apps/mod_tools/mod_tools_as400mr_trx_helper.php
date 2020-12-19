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

        $SQL = "SELECT * FROM `".PREFIX.MR_AS400_TABLE."` WHERE $searchMultiple";
        $result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
        
        $count = mysql_num_rows($result);
        
        if( $count >0 ) 
        {
            $total_pages = ceil($count/$limit);
        } 
        else 
        {
            $total_pages = 0;
        }

        if ( $page > $total_pages ) $page = $total_pages;
        
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if ( $start < 0 ) $start = 0;
        
        $SQL = "SELECT * FROM `".PREFIX.MR_AS400_TABLE."` WHERE $searchMultiple ORDER BY D_TRXMDT DESC, $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
  
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
        {
            header("Content-type: application/xhtml+xml;charset=utf-8");
        } 
        else 
        {
            header("Content-type: text/xml;charset=utf-8");                   
        }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MR_AS400_TABLE."` WHERE $searchMultiple ORDER BY $sidx $sord</userdata>";
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {

                $DATE_YEAR   = substr( trim($row[D_TRXMDT]), 1, 2 );
                $DATE_MONTH  = substr( trim($row[D_TRXMDT]), 3, 2 );
                $DATE_DAY    = substr( trim($row[D_TRXMDT]), 5, 2 );
                $DATE        = "20" . $DATE_YEAR . "-" . $DATE_MONTH . "-" . $DATE_DAY;
                
                $TIME_RAW    = str_pad( trim($row[D_TRXMTM]), 6, "0", STR_PAD_LEFT );
                $TIME_HOUR   = substr( $TIME_RAW, 0, 2 );
                $TIME_MINUTE = substr( $TIME_RAW, 2, 2 );
                $TIME_SECOND = substr( $TIME_RAW, 4, 2 );
                $TIME        = $TIME_HOUR . ":" . $TIME_MINUTE . ":" . $TIME_SECOND;

                $DATE_YEAR   = substr( trim($row[D_TRI1DT]), 1, 2 );
                $DATE_MONTH  = substr( trim($row[D_TRI1DT]), 3, 2 );
                $DATE_DAY    = substr( trim($row[D_TRI1DT]), 5, 2 );
                $DATE_SETTL  = "20" . $DATE_YEAR . "-" . $DATE_MONTH . "-" . $DATE_DAY;
                
                if ( trim($row[D_TRRSPC]) <> '' )
                {
                    $SQL_RC    = "SELECT I_DESCRIPTION FROM `".PREFIX.RC_ITM_JUN_TABLE."` WHERE I_RC_ITM = '".trim($row[D_TRRSPC])."'";  
                    $result_RC = mysql_query( $SQL_RC );
                    $row_RC    = mysql_fetch_array( $result_RC, MYSQL_ASSOC );
                    $DESC_RC   = " - ".$row_RC['I_DESCRIPTION'];
                }
                else
                {
                    $DESC_RC   = "" ;
                }                
                
                echo "<row id='". $row[D_ID]."'>";
                       echo "<cell><![CDATA[$DATE]]></cell>";
                       echo "<cell><![CDATA[$TIME]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRMSGC]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRSTAN]) ."]]></cell>";
                       echo "<cell><![CDATA[". ltrim($row[D_TRAC2], TRIM_CHARLIST) ."]]></cell>";
                       echo "<cell><![CDATA[". ltrim($row[D_TRCZID], TRIM_CHARLIST) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCRD]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRISPT]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRVND]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRTRTY]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRRSPC]) ."$DESC_RC]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRRRF])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRAQPT])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCAID])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCATA])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCATI])."]]></cell>";
                       echo "<cell><![CDATA[$DATE_SETTL]]></cell>";                       
                       echo "<cell><![CDATA[". trim($row[D_TRTRN])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TROREQ])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRVDEV])."]]></cell>";
                echo "</row>";
                       
            }
                       
            echo "</rows>";
        
    }
    else
    {

        if(!$sidx) $sidx =1;

        $SQL    = "SELECT COUNT(*) AS count FROM `".PREFIX.MR_AS400_TABLE;  
        $result = mysql_query( $SQL );
        $row    = mysql_fetch_array( $result, MYSQL_ASSOC );
        $count  = $row['count'];

        if( $count >0 ) 
        {
            $total_pages = ceil($count/$limit);
        } 
        else 
        {
            $total_pages = 0;
        }

        if ( $page > $total_pages ) $page = $total_pages;

        $start  = $limit*$page - $limit; // do not put $limit*($page - 1)
        $SQL    = "SELECT * FROM `".PREFIX.MR_AS400_TABLE."` ORDER BY D_TRXMDT DESC, $sidx $sord LIMIT $start , $limit";
        $result = mysql_query( $SQL );
        
        if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
        {
            header("Content-type: application/xhtml+xml;charset=utf-8");
        } 
        else 
        {
            header("Content-type: text/xml;charset=utf-8");
                   
        }
                   
            $et = ">";
            echo "<?xml version='1.0' encoding='utf-8'?$et\n";
            echo "<rows>";                                    
            echo "<userdata name=\"SQL\">SELECT * FROM `".PREFIX.MR_AS400_TABLE."` ORDER BY D_TRXMDT DESC, $sidx $sord</userdata>";                        
            echo "<page>".$page."</page>";
            echo "<total>".$total_pages."</total>";
            echo "<records>".$count."</records>";                      

            // be sure to put text data in CDATA
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
            {
                
                $DATE_YEAR   = substr( trim($row[D_TRXMDT]), 1, 2 );
                $DATE_MONTH  = substr( trim($row[D_TRXMDT]), 3, 2 );
                $DATE_DAY    = substr( trim($row[D_TRXMDT]), 5, 2 );
                $DATE        = "20" . $DATE_YEAR . "-" . $DATE_MONTH . "-" . $DATE_DAY;
                
                $TIME_RAW    = str_pad( trim($row[D_TRXMTM]), 6, "0", STR_PAD_LEFT );
                $TIME_HOUR   = substr( $TIME_RAW, 0, 2 );
                $TIME_MINUTE = substr( $TIME_RAW, 2, 2 );
                $TIME_SECOND = substr( $TIME_RAW, 4, 2 );
                $TIME        = $TIME_HOUR . ":" . $TIME_MINUTE . ":" . $TIME_SECOND;

                $DATE_YEAR   = substr( trim($row[D_TRI1DT]), 1, 2 );
                $DATE_MONTH  = substr( trim($row[D_TRI1DT]), 3, 2 );
                $DATE_DAY    = substr( trim($row[D_TRI1DT]), 5, 2 );
                $DATE_SETTL  = "20" . $DATE_YEAR . "-" . $DATE_MONTH . "-" . $DATE_DAY;
                
                if ( trim($row[D_TRRSPC]) <> '' )
                {
                    $SQL_RC    = "SELECT I_DESCRIPTION FROM `".PREFIX.RC_ITM_JUN_TABLE."` WHERE I_RC_ITM = '".trim($row[D_TRRSPC])."'";  
                    $result_RC = mysql_query( $SQL_RC );
                    $row_RC    = mysql_fetch_array( $result_RC, MYSQL_ASSOC );
                    $DESC_RC   = " - ".$row_RC['I_DESCRIPTION'];
                }
                else
                {
                    $DESC_RC   = "" ;
                }
                                            
                echo "<row id='". $row[D_ID]."'>";
                       echo "<cell><![CDATA[$DATE]]></cell>";
                       echo "<cell><![CDATA[$TIME]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRMSGC])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRSTAN]) ."]]></cell>";                       
                       echo "<cell><![CDATA[". ltrim($row[D_TRAC2], TRIM_CHARLIST) ."]]></cell>";
                       echo "<cell><![CDATA[". ltrim($row[D_TRCZID], TRIM_CHARLIST) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCRD]) ."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRISPT])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRVND])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRTRTY])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRRSPC])."$DESC_RC]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRRRF])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRAQPT])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCAID])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCATA])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRCATI])."]]></cell>";
                       echo "<cell><![CDATA[$DATE_SETTL]]></cell>";                       
                       echo "<cell><![CDATA[". trim($row[D_TRTRN])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TROREQ])."]]></cell>";
                       echo "<cell><![CDATA[". trim($row[D_TRVDEV])."]]></cell>";
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
    $objPHPexcel = PHPExcel_IOFactory::load('../template/AS400_MR_LOG.xlt');          
    
    # Set active sheet to first sheet
    $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
    $objWorksheet->setTitle('AS400 MR Transaction Log');
    $objWorksheet->getCell('A1')->setValue("AS400 MR TRANSACTION LOG");
    
    # Write data to sheet
    $result = mysql_query( $SQL );
    
    $totalRecord = mysql_num_rows( $result );

    # Set Progress
    $progress      = 0;
    $totalProgress = $totalRecord + 5; # Add some number
       
    $no = 1; $X = 4;
    while( $row = mysql_fetch_array($result, MYSQL_ASSOC) )
    {
        $DATE_YEAR   = substr( trim($row['D_TRXMDT']), 1, 2 );
        $DATE_MONTH  = substr( trim($row['D_TRXMDT']), 3, 2 );
        $DATE_DAY    = substr( trim($row['D_TRXMDT']), 5, 2 );
        $DATE        = $DATE_DAY . "-" . $DATE_MONTH . "-20" . $DATE_YEAR;
        
        $TIME_RAW    = str_pad( trim($row['D_TRXMTM']), 6, "0", STR_PAD_LEFT );
        $TIME_HOUR   = substr( $TIME_RAW, 0, 2 );
        $TIME_MINUTE = substr( $TIME_RAW, 2, 2 );
        $TIME_SECOND = substr( $TIME_RAW, 4, 2 );
        $TIME        = $TIME_HOUR . ":" . $TIME_MINUTE . ":" . $TIME_SECOND;

        $DATE_YEAR   = substr( trim($row['D_TRI1DT']), 1, 2 );
        $DATE_MONTH  = substr( trim($row['D_TRI1DT']), 3, 2 );
        $DATE_DAY    = substr( trim($row['D_TRI1DT']), 5, 2 );
        $DATE_SETTL  = $DATE_DAY . "-" . $DATE_MONTH . "-20" . $DATE_YEAR;                
        
        $objWorksheet->getCell('A'.$X)->setValue($no);
        $objWorksheet->getCell('B'.$X)->setValue($DATE);
        $objWorksheet->getCell('C'.$X)->setValue($TIME);
        $objWorksheet->getCell('D'.$X)->setValue($row['D_TRMSGC']);
        $objWorksheet->getCell('E'.$X)->setValueExplicit(ltrim($row['D_TRAC2'], TRIM_CHARLIST), PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('F'.$X)->setValueExplicit(ltrim($row['D_TRCZID'], TRIM_CHARLIST), PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('G'.$X)->setValueExplicit($row['D_TRCRD'], PHPExcel_Cell_DataType::TYPE_STRING);    
        $objWorksheet->getCell('H'.$X)->setValue($row['D_TRISPT']);    
        $objWorksheet->getCell('I'.$X)->setValue($row['D_TRVND']);    
        $objWorksheet->getCell('J'.$X)->setValue($row['D_TRTRTY']);    
        $objWorksheet->getCell('K'.$X)->setValueExplicit($row['D_TRRSPC'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('L'.$X)->setValueExplicit($row['D_TRRRF'], PHPExcel_Cell_DataType::TYPE_STRING);
        $objWorksheet->getCell('M'.$X)->setValue($row['D_TRAQPT']);
        $objWorksheet->getCell('N'.$X)->setValue($row['D_TRCAID']);
        $objWorksheet->getCell('O'.$X)->setValue($row['D_TRCATA']);
        $objWorksheet->getCell('P'.$X)->setValue($row['D_TRCATI']);
        $objWorksheet->getCell('Q'.$X)->setValue($DATE_SETTL);
        $objWorksheet->getCell('R'.$X)->setValue($row['D_TRTRN']);
        $objWorksheet->getCell('S'.$X)->setValue($row['D_TROREQ']);
        $objWorksheet->getCell('T'.$X)->setValue($row['D_TRVDEV']);

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
    $euromis->fn_outputFile( $fileTemp, "AS400_MR_LOG.xls" );            

    # Delete Temporary File
    unlink($fileTemp);        

    # Close connection
    $euromis->fn_server_close();
            
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