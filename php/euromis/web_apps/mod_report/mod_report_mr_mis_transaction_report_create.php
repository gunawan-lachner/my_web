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
    $X_TRANSACTION = 9; $X_AMOUNT = 10;
    $SHEET_OPERATOR_FORMAT = array(
        array("TLK", "B"),
        array("SAT", "C"),
        array("IM3", "D"),
        array("EXL", "E"),
        array("EBT", "F"),
        array("M8T", "G"),
        array("HUT", "H"),
        array("FLX", "I"),
        array("AXS", "J")
    );
    
    # Set Date
    $FIRST_DATE = $euromis->fn_dateCalc($date_from, "-7 hour");
    $LAST_DATE  = $euromis->fn_dateCalc($date_to, "-7 hour");

    # Set Progress
    $totalRecord   = count( $SHEET_OPERATOR_FORMAT );
    $progress_file = PROGRESS_FILE.".".$random;    
    $progress      = 0;
    $totalProgress = $totalRecord + 0; # Add some number

    # Load the Excel driver
    require_once("../includes/excel/PHPExcel.php");

    # Load Excel Template
    $objPHPexcel = PHPExcel_IOFactory::load('../template/MIS_TRANSACTION.xlt');          
            
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
    
    $objWorksheet->getCell('A3')->setValue($date_from." - ".$date_to);
    
    # Prepare query
    $SQL = "
        SELECT PayeeId AS Operator, COUNT(*) AS Transactions, SUM(a.Amount) AS Amounts
        FROM 
        HistRechargeMinutes a
        LEFT OUTER JOIN HistRechargeUser b ON a.TransactionId=b.TransactionId
        LEFT OUTER JOIN HistBasicTx c ON a.TransactionId=c.TransactionId
        WHERE b.ParticipantId='$bank_id'
        AND TimeStamp BETWEEN '$FIRST_DATE 17:00:00' AND '$LAST_DATE 17:00:00'            
        GROUP BY b.PayeeId
    ";
    
    # Extend PHP time out
    set_time_limit(TIME_EXTENDED);
            
    # Write data to sheet        
    $result = odbc_exec( $MR_CONNECTION, $SQL );
    
    while ( odbc_fetch_row( $result ) )
    {

        $OPERATORS    = odbc_result( $result, 1 );
        $TRANSACTIONS = odbc_result( $result, 2 );
        $AMOUNTS      = odbc_result( $result, 3 );
        
        foreach ( $SHEET_OPERATOR_FORMAT AS $operator )
        {                
                                                                       
            if ( $OPERATORS == $operator[0] )
            {
                $objWorksheet->getCell($operator[1].$X_TRANSACTION)->setValue($TRANSACTIONS);
                $objWorksheet->getCell($operator[1].$X_AMOUNT)->setValue($AMOUNTS);                
            }                                                                               
        
        }            
    }
    
    # Set Progress
    $progress++;
    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );                

    # Save xls file to temp
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
    $fileTemp  = TMP_FILE.mt_rand();
    $objWriter->save($fileTemp);

    # Set Progress
    $progress = 99999;
    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );

    # Force download
    $euromis->fn_outputFile( $fileTemp, "($BANK_NAME)_MOBILE_RECHARGE_MIS_TRANSACTION_REPORT_".$date_from."_".$date_to.".xls" );            

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