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
    $bank_id   = trim($_POST['bank_id']);    
    $date_from = trim($_POST['date_from']);
    $date_to   = trim($_POST['date_to']);
    $random    = trim($_POST['random']);
    
    # Set Variable
    $X = 9;
    $SHEET_OPERATOR_FORMAT = array(
        array("TLK", "B", "C", "D"),
        array("SAT", "E", "F", "G"),
        array("IM3", "H", "I", "J"),
        array("EXL", "K", "L", "M"),
        array("EBT", "N", "O", "P"),
        array("M8T", "Q", "R", "S"),
        array("HUT", "T", "U", "V"),
        array("FLX", "W", "X", "Y"),
        array("AXS", "Z", "AA", "AB")
    );
    
    # Set Date
    $FIRST_DATE = $euromis->fn_dateCalc($date_from, "-7 hour");
    $LAST_DATE  = $euromis->fn_dateCalc($date_to, "-7 hour");

    # Set Progress
    $totalRecord   = count( $SHEET_OPERATOR_FORMAT );
    $progress_file = PROGRESS_FILE.".".$random;    
    $progress      = 0;
    $totalProgress = $totalRecord + 5; # Add some number

    # Load the Excel driver
    require_once("../includes/excel/PHPExcel.php");

    # Load Excel Template
    $objPHPexcel = PHPExcel_IOFactory::load('../template/MIS_REGISTRATION.xlt');          
            
    # Get sheet
    $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);

    # Connect to Database
    $MR_CONNECTION = $euromis->fn_mr_sql();
    
    # Write Title
    $SQL           = "SELECT Description FROM Participants WHERE ParticipantId = '$bank_id'";
    $result        = odbc_exec( $MR_CONNECTION, $SQL );
    odbc_fetch_row( $result );
    $BANK_NAME     = odbc_result( $result, 1 );
    
    $objWorksheet->getCell('A1')->setValue(strtoupper($BANK_NAME));
    
    $objWorksheet->getCell('A'.$X)->setValue($date_from." - ".$date_to);
    
    foreach ( $SHEET_OPERATOR_FORMAT AS $operator )
    {
        # Prepare query
        $SQL_MANUAL_TOPUP = "
            SELECT COUNT(*) FROM RechargeUser 
            WHERE ParticipantId = '$bank_id' 
            AND PayeeId = '".$operator[0]."' 
            AND UpdateSeqNum = '0' 
            AND OpenDate BETWEEN '$FIRST_DATE 17:00:00' AND '$LAST_DATE 17:00:00'
        ";

        $SQL_AUTO_TOPUP_BY_DATE = "
            SELECT COUNT(*) FROM AutoTopupRegistrations
            WHERE TriggerType = 'D' 
            AND ParticipantId = '$bank_id'
            AND PayeeId = '".$operator[0]."'
            AND DataUpdate = 'N'
            AND RegistrationDate BETWEEN '$FIRST_DATE 17:00:00' AND '$LAST_DATE 17:00:00'
        ";
        
        $SQL_AUTO_TOPUP_BY_BALANCE = "
            SELECT COUNT(*) FROM AutoTopupRegistrations
            WHERE TriggerType = 'B' 
            AND ParticipantId = '$bank_id'
            AND PayeeId = '".$operator[0]."'
            AND DataUpdate = 'N'
            AND RegistrationDate BETWEEN '$FIRST_DATE 17:00:00' AND '$LAST_DATE 17:00:00'
        ";        
                
        # Write data to sheet        
        $result_MANUAL_TOPUP          = odbc_exec( $MR_CONNECTION, $SQL_MANUAL_TOPUP );
        $result_AUTO_TOPUP_BY_DATE    = odbc_exec( $MR_CONNECTION, $SQL_AUTO_TOPUP_BY_DATE );
        $result_AUTO_TOPUP_BY_BALANCE = odbc_exec( $MR_CONNECTION, $SQL_AUTO_TOPUP_BY_BALANCE );
        
        odbc_fetch_row( $result_MANUAL_TOPUP );
        $MANUAL_TOPUP = odbc_result( $result_MANUAL_TOPUP, 1 );
        
        odbc_fetch_row( $result_AUTO_TOPUP_BY_DATE );
        $AUTO_TOPUP_BY_DATE = odbc_result( $result_AUTO_TOPUP_BY_DATE, 1 );

        odbc_fetch_row( $result_AUTO_TOPUP_BY_BALANCE );
        $AUTO_TOPUP_BY_BALANCE = odbc_result( $result_AUTO_TOPUP_BY_BALANCE, 1 );
        
        $objWorksheet->getCell($operator[1].$X)->setValue($MANUAL_TOPUP);
        $objWorksheet->getCell($operator[2].$X)->setValue($AUTO_TOPUP_BY_DATE);
        $objWorksheet->getCell($operator[3].$X)->setValue($AUTO_TOPUP_BY_BALANCE);
        
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
    $euromis->fn_outputFile( $fileTemp, "($BANK_NAME)_MOBILE_RECHARGE_MIS_REGISTRATION_REPORT_".$date_from."_".$date_to.".xls" );            

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