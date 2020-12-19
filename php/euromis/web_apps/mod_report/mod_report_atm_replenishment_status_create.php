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
    
    # Get Post parameter
    $atm_bank_id    = trim($_POST['bank']);    
    $date_replenish = trim($_POST['date_replenish']);    
    $random         = trim($_POST['random']);

    # Set date parameter
    $LAST_DATE  = $euromis->fn_dateCalc($date_replenish, "+1 day");

    # Connect to Database
    $CONNECTION = $euromis->fn_ewidt_data_sql();
    
    # Get ATM ID
    $SQL    = "SELECT MTVDEV,MTLOC FROM MT_VIEW WHERE MTDELE='' AND LEFT( MTVDEV, 3 )='$atm_bank_id' ORDER BY MTVDEV";
    $result = odbc_exec( $CONNECTION, $SQL );
        
    # Set Progress
    $totalRecord   = odbc_num_rows( $result );
    $progress_file = PROGRESS_FILE.".".$random;    
    $progress      = 0;
    $totalProgress = $totalRecord + 5; # Add some number

    # Load the Excel driver
    require_once("../includes/excel/PHPExcel.php");

    # Load Excel Template
    $objPHPexcel = PHPExcel_IOFactory::load('../template/ATM_REPLENISHMENT.xlt');          
            
    # Get sheet
    $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);

    # Write Title
    $objWorksheet->getCell('A1')->setValue( 'ATM '.$euromis->ATM_BANK_ID[$atm_bank_id].' REPLENISHMENT STATUS' );    
    $objWorksheet->getCell('A2')->setValue( $euromis->fn_dateFormat( $date_replenish, 'd F Y' ) );
    
    $no = 1; $X = 5;
    while( odbc_fetch_row( $result ) )
    {
        # Set Variable
        $ATM_ID  = odbc_result( $result, 1 );
        $ATM_LOC = odbc_result( $result, 2 );
        
        # Set SQL
        $SQL = "SELECT ". 
                '_TDATTM '. 
                "FROM ".
                'ZTRANS_ATM_ATR$ '.
                "WITH (NOLOCK) 
                WHERE 
                (TRVDEV = '$ATM_ID') 
                AND (TRRETF = 'Y' OR TRTRTY = 'TI' OR TRRSPC = '61') 
                AND (_TDATTM BETWEEN '$date_replenish 00:00:00' AND '$LAST_DATE 00:00:00')
                ORDER BY _TDATTM DESC";


        # Connect to Database
        $CONNECTION2 = $euromis->fn_ewidt_data2_sql();
                
        # Get Data
        $result_REPLENISH = odbc_exec( $CONNECTION2, $SQL );        

        $objWorksheet->getCell('A'.$X)->setValue($no);
        $objWorksheet->getCell('B'.$X)->setValue($ATM_ID);
        $objWorksheet->getCell('C'.$X)->setValue($ATM_LOC);
        
        $REPLENISH_ROWS = FALSE;
        while ( odbc_fetch_row( $result_REPLENISH ) )
        {
            $REPLENISH_ROWS = TRUE;
            $TDATTM = odbc_result( $result_REPLENISH, 1 );   
            $objWorksheet->getCell('D'.$X)->setValueExplicit($TDATTM, PHPExcel_Cell_DataType::TYPE_STRING);
            $X++;
        }

        if ( $REPLENISH_ROWS === FALSE ) $X++;
        
        $no++;
        $X++;
                
        # Set Progress
        $progress++;
        $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );                        
    }
    
    # Save xls file to temp
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
    $fileTemp  = TMP_FILE.mt_rand();
    $objWriter->save($fileTemp);

    # Set Progress
    $progress = 99999;
    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );

    # Force download
    $name = str_replace( " ", "_", $euromis->ATM_BANK_ID[$atm_bank_id] );
    $euromis->fn_outputFile( $fileTemp, $name."_ATM_REPLENISHMENT.xls" );            

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