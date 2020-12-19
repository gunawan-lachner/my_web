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
    $MSISDN = trim($_POST['msisdn']);

    # Set variable
    $random        = trim($_POST['random']);
    $progress_file = PROGRESS_FILE.".".$random;    
    
    if ( substr($MSISDN, 0, 2) <> '62' )
    {
        ?>
            <script>history.back();alert("Please use prefix 62 on MSISDN number.")</script>
        <?php            
    } 
    else
    {
    
        # Connect to Database
        $MR_CONNECTION = $euromis->fn_mr_sql();

        # Get Bank Name
        $SQL    = "SELECT ParticipantId,Description FROM Participants";
        $result = odbc_exec( $MR_CONNECTION, $SQL );
        
        while( odbc_fetch_row( $result ) )
        {                 
            $PARTICIPANT_ID   = odbc_result( $result, 1 );   
            $PARTICIPANT_NAME = odbc_result( $result, 2 );
            
            $BANK[$PARTICIPANT_ID] = $PARTICIPANT_NAME;            
        }

        # Prepare Query
        $SQL = "
            SELECT                
            ISNULL(DATEADD(HOUR, 7, HistBasicTx.TimeStamp), '') AS TimeStamp,        
            HistRechargeUser.ParticipantId, 
            HistRechargeUser.PayeeId, 
            HistRechargeUser.ClientId, 
            HistRechargeUser.ActiveFlag,
            HistToken.UserName,
            HistToken.Source,
            HistBasicTx.UFOMethod,
            HistBasicTx.Reason,
            Reasons.Description                                           
            FROM 
            HistRechargeUser, 
            HistToken,
            HistBasicTx,
            Reasons
            WHERE
            Reasons.ReasonValue = HistBasicTx.Reason
            AND HistToken.ClientId = HistRechargeUser.ClientId
            AND HistToken.TransactionId = HistBasicTx.TransactionId
            AND HistRechargeUser.ActiveFlag IS NOT NULL
            AND HistRechargeUser.OpenDate>'1900-01-01 00:00:00.000'
            AND HistRechargeUser.UserId = '$MSISDN'
        ";
                                                   
        # Extend PHP time out
        set_time_limit(TIME_EXTENDED);
        
        # Execute query
        $result = odbc_exec( $MR_CONNECTION, $SQL );            

        # Set Progress
        $progress      = 0;
        $totalRecord   = 200;
        $totalProgress = $totalRecord + 5; # Add some number
    
        # Load the Excel driver
        require_once("../includes/excel/PHPExcel.php");

        # Load SPT PPh 21 Template
        $objPHPexcel = PHPExcel_IOFactory::load('../template/RECHARGE_USER_HISTORY.xlt');          
        
        # Get sheet
        $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
                                                             
        # Write data to sheet
        $objWorksheet->getCell('A3')->setValue("FOR NUMBER $MSISDN");
        
        $no = 1; $X = 6;
        while( odbc_fetch_row( $result ) )
        {                 
            $TIMESTAMP      = odbc_result( $result, 1 );
            $PARTICIPANT_ID = odbc_result( $result, 2 );
            $PAYEE_ID       = odbc_result( $result, 3 );
            $CLIENT_ID      = odbc_result( $result, 4 );
            $ACTIVE_FLAG    = odbc_result( $result, 5 );
            $USERNAME       = odbc_result( $result, 6 );
            $SOURCE         = odbc_result( $result, 7 );
            $UFO_METHOD     = odbc_result( $result, 8 );
            $REASON         = odbc_result( $result, 9 );
            $DESCRIPTION    = odbc_result( $result, 10 );

            $objWorksheet->getCell('A'.$X)->setValue($no);
            $objWorksheet->getCell('B'.$X)->setValue($TIMESTAMP);
            $objWorksheet->getCell('C'.$X)->setValueExplicit($BANK[$PARTICIPANT_ID], PHPExcel_Cell_DataType::TYPE_STRING);
            $objWorksheet->getCell('D'.$X)->setValue($PAYEE_ID);
            $objWorksheet->getCell('E'.$X)->setValueExplicit($CLIENT_ID, PHPExcel_Cell_DataType::TYPE_STRING);
            $objWorksheet->getCell('F'.$X)->setValue($ACTIVE_FLAG);
            $objWorksheet->getCell('G'.$X)->setValueExplicit($USERNAME, PHPExcel_Cell_DataType::TYPE_STRING);
            $objWorksheet->getCell('H'.$X)->setValue($SOURCE);
            $objWorksheet->getCell('I'.$X)->setValue($UFO_METHOD);
            $objWorksheet->getCell('J'.$X)->setValue($REASON);
            $objWorksheet->getCell('K'.$X)->setValue($DESCRIPTION);

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
        $euromis->fn_outputFile( $fileTemp, "RECHARGE_USER_HISTORY_".$MSISDN.".xls" );            

        # Delete Temporary File
        unlink($fileTemp);        

        # Close connection
        $euromis->fn_server_close();
            
    }
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