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
    case 1:
    # Turn off output buffering to decrease cpu usage
    @ob_end_clean();

    # Get POST variable
    $report_month = trim($_POST['report_month']);
    $report_year  = trim($_POST['report_year']);

    # Set variable
    $random        = trim($_POST['random']);
    $progress_file = PROGRESS_FILE.".".$random;
    $column_code   = array( 'D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT' );
    $response_code = $euromis->fn_get_edc_response_code();
    
    $response_code_column = array_combine( $response_code, $column_code );
    
    # Set date parameter
    $FIRST_DATE = $report_year."-".$report_month."-01";
    $TEMP_DATE  = $euromis->fn_dateCalc($report_year."-".$report_month."-01", "+1 month");
    $LAST_DATE  = $euromis->fn_dateCalc($TEMP_DATE, "-1 second");
    
    # SET QUERY
    # Auto TopUp Registration
    $BTPN_TERMINAL_IDENTITY = "BEDC";
    
    $SQL_LIST_BTPN_EDC = "
        SELECT 
        terminal_identification,
        description
        FROM transaction_terminal
        WHERE SUBSTRING( terminal_identification, 1, 4 )='$BTPN_TERMINAL_IDENTITY'
        ORDER BY terminal_identification  
    ";
    
    # Connect to Database
    $EDC_CONNECTION = $euromis->fn_edc_sql();
    
    # Execute query
    $result = odbc_exec( $EDC_CONNECTION, $SQL_LIST_BTPN_EDC );    

    # Get EDC List    
    $LIST_BTPN_EDC = array();
    $i = 0;
    while( odbc_fetch_row( $result ) )
    {                 
        $LIST_BTPN_EDC[$i][0] = odbc_result( $result, 1 );
        $LIST_BTPN_EDC[$i][1] = odbc_result( $result, 2 );        
        $i++;
    }

    # Load the Excel driver
    require_once("../includes/excel/PHPExcel.php");

    # Load Excel Template
    $objPHPexcel = PHPExcel_IOFactory::load('../template/BTPN_EDC_MONTHLY_GENERAL_REPORT.xls');          

    # Get sheet
    $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
    
    # Print Header
    $objWorksheet->getCell('A2')->setValue($euromis->fn_dateFormat( $FIRST_DATE, 'F' ) );    
    
    # Set Progress
    $totalRecord   = count($LIST_BTPN_EDC);
    $progress      = 0;
    $totalProgress = $totalRecord + 50; # Add some number

    # Extend PHP time out
    set_time_limit(TIME_EXTENDED);
    
    $no = 1; $X = 5; $start = $X;
    foreach( $LIST_BTPN_EDC AS $BTPN_EDC )
    {
        # Write data to sheet
        $objWorksheet->getCell('A'.$X)->setValue($no);
        $objWorksheet->getCell('B'.$X)->setValue($BTPN_EDC[0]);
        $objWorksheet->getCell('C'.$X)->setValue($BTPN_EDC[1]);

        $SQL_LIST_BTPN_EDC_REPORT = "
            SELECT 
            bit39,
            COUNT(bit39) AS jumlah
            FROM iso_msg
            WHERE waktu BETWEEN '$FIRST_DATE 00:00:00' AND '$LAST_DATE 00:00:00'
            AND bit41='".$BTPN_EDC[0]."'
            AND bit39 IS NOT NULL
            AND bit41 IS NOT NULL
            AND source IS NOT NULL
            GROUP BY bit39
        ";
        
        # Execute query
        $result = odbc_exec( $EDC_CONNECTION, $SQL_LIST_BTPN_EDC_REPORT );    
        
        while ( odbc_fetch_row( $result ) )
        {
            $EDC_RESPONSE_CODE       = odbc_result( $result, 1 );
            $EDC_RESPONSE_CODE_COUNT = odbc_result( $result, 2 );                    
            
            if ( !empty( $EDC_RESPONSE_CODE ) ) $objWorksheet->getCell($response_code_column[$EDC_RESPONSE_CODE].$X)->setValue($EDC_RESPONSE_CODE_COUNT);
        }
        
        # Set Progress
        $progress++;
        $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );            
              
        $no++; $X++;                                
    }

    # Sum the count
    $objWorksheet->getStyle('C'.$X)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    
    $objWorksheet->getStyle('C'.$X)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);    
    
    $objWorksheet->getStyle('C'.$X)->getFont()->setSize('11');
    $objWorksheet->getStyle('C'.$X)->getFont()->setBold(true);
    
    $objWorksheet->getCell('C'.$X)->setValue('TOTAL');
    
    foreach ( $column_code AS $column )
    {
        $objWorksheet->getStyle($column.$X)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);    
        $objWorksheet->getStyle($column.$X)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);    
        
        $objWorksheet->getStyle($column.$X)->getFont()->setSize('11');
        $objWorksheet->getStyle($column.$X)->getFont()->setBold(true);
                
        $objWorksheet->getStyle($column.$X)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objWorksheet->getStyle($column.$X)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $objWorksheet->getCell($column.$X)->setValue('=SUM('.$column.$start.':'.$column.($X-1).')');   
    }
    
    # Save xls file to temp
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
    $fileTemp  = TMP_FILE.mt_rand();
    $objWriter->save($fileTemp);

    # Set Progress
    $progress = 99999;
    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );

    # Force download
    $euromis->fn_outputFile( $fileTemp, "BTPN_EDC_GENERAL_MONTHLY_REPORT_".$report_year."_".$report_month.".xls" );            

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