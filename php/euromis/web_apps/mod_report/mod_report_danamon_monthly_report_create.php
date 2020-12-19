<?php

# Load the global function
require_once("../global/process-helper.php");

# Extend PHP time out
set_time_limit(TIME_EXTENDED);

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
    
    # Set date parameter
    $FIRST_DATE = $euromis->fn_dateCalc($report_year."-".$report_month."-01", "-1 second");
    $TEMP_DATE  = $euromis->fn_dateCalc($report_year."-".$report_month."-01", "+1 month");
    $LAST_DATE  = $euromis->fn_dateCalc($TEMP_DATE, "-1 second");
    
    # SET QUERY
    # Auto TopUp Registration
    $SQL_DANAMON_MONTHLY_REPORT[1] = "
        SELECT 
        MSISDN AS PhoneNumber, 
        PayeeId AS Provider, 
        TriggerType, 
        TriggerData, 
        AmountTopup, 
        (
          CASE Status
            WHEN 1 THEN 'ACTIVE'
            WHEN 0 THEN 'CLOSED' 
            ELSE '' 
          END
        ) As Status, 
        DateAdd(hour, +7, RegistrationDate) AS RegistrationDate 
        FROM AutoTopupRegistrations 
        WHERE ParticipantId='014' 
        AND RegistrationDate BETWEEN '$FIRST_DATE 16:59:59' AND '$LAST_DATE 16:59:59'
        ORDER BY RegistrationDate    
    ";
    
    # Mobile Recharge Registration
    $SQL_DANAMON_MONTHLY_REPORT[2] = "
        SELECT 
        a.PayeeId AS Provider, 
        PayToAcctNumber AS PhoneNumber,
        FirstName, 
        LastName, 
        DateAdd(hour, +7, OpenDate) AS RegistrationDate, 
        (
          CASE ActiveFlag
            WHEN 1 THEN 'ACTIVE'
            WHEN 0 THEN 'CLOSED' 
            ELSE '' 
          END
        ) As Status,
        TriggerType, 
        TriggerData,
        AmountTopup, 
        DateAdd(hour, +7, RegistrationDate) AS 'AutoTopup RegistrationDate', 
        (
          CASE b.Status
            WHEN 1 THEN 'ACTIVE'
            WHEN 0 THEN 'CLOSED' 
            ELSE '' 
          END
        ) As 'AutoTopup Status' 
        FROM RechargeUser a 
        LEFT OUTER JOIN AutoTopupRegistrations b ON a.PayToAcctNumber = b.MSISDN 
        LEFT OUTER JOIN FastClientSummary c ON a.ClientId = c.ClientId 
        WHERE a.ParticipantId='014' 
        AND OpenDate BETWEEN '$FIRST_DATE 16:59:59' AND '$LAST_DATE 16:59:59' 
        ORDER BY OpenDate    
    ";
    
    # Mobile Recharge User List
    $SQL_DANAMON_MONTHLY_REPORT[3] = "
        SELECT UserId, AdminFlag, ActiveFlag, OpenDate, FullCardAccessFlag 
        FROM ParticipantOperator 
        WHERE ParticipantId='014'
        ORDER BY UserId
    ";

    # Mobile Banking Registration
    $SQL_DANAMON_MONTHLY_REPORT[4] = "
        SELECT 
        d.ExternalCIFKey, 
        d.LastName, 
        c.Alias AS Card_Alias, 
        a.SequenceNumber AS Account_SequenceNumber, 
        a.AccountNumber AS Account_Number, 
        a.AccountAlias AS Account_Alias,
        (
          CASE a.Currency
            WHEN '360' THEN 'Indonesia Rupiah'
            ELSE 'United States Dollar'
          END
        ) AS Currency, 
        (
          CASE a.[Type]
            WHEN '01' THEN 'Demand Deposit/Checking'
            WHEN '02' THEN 'Savings' 
            WHEN '03' THEN 'Credit Card'
            WHEN '05' THEN 'Credit Line' 
            WHEN '06' THEN 'Money Market' 
            WHEN '07' THEN 'Mortgage Loan' 
            WHEN '08' THEN 'Installment Loan' 
            WHEN '10' THEN 'CD' 
            WHEN '33' THEN 'Utility'
            WHEN '34' THEN 'Telephone'
            ELSE '' 
          END
        ) AS Account_Type,
        u.UserId AS SMS_User_ID, 
        p.Type AS Operator_Cellular, 
        DateAdd(hour, +7, u.OpenDate) AS Date_Opened, 
        (
          CASE u.ActiveFlag
            WHEN '1' THEN 'ACTIVE'
            ELSE 'INACTIVE'
          END
        ) AS Active
        FROM ClientAccounts a
        LEFT OUTER JOIN ClientRelationships r ON r.ClientRelationshipId = a.ClientRelationshipId
        LEFT OUTER JOIN SMSUSer u             ON u.ClientRelationshipId = r.ClientRelationshipId
        LEFT OUTER JOIN ClientPhones p        ON p.ClientRelationshipId = r.ClientRelationshipId
        LEFT OUTER JOIN ClientDirectory d     ON d.ClientId = r.ClientId
        LEFT OUTER JOIN CardRegistration c    ON c.ClientId = r.ClientId
        WHERE u.OpenDate BETWEEN '$FIRST_DATE 16:59:59' AND '$LAST_DATE 16:59:59'
        AND c.ParticipantId='001'
        ORDER BY u.OpenDate
    ";

    # Mobile Banking Registration
    $SQL_DANAMON_MONTHLY_REPORT[5] = "
        SELECT UserId, AccessRole, ActiveFlag, OpenDate
        FROM EmployeeUser
        ORDER BY 
        UserId,
        AccessRole,
        OpenDate
    ";

    # Connect to Database
    $MR_CONNECTION = $euromis->fn_mr_sql();
    $MB_CONNECTION = $euromis->fn_mb_sql();
    
    # Execute query
    $totalRecord = 0;
    $i = 1;
    foreach ( $SQL_DANAMON_MONTHLY_REPORT as $SQL )
    {
        if ( $i <= 3 )
        {
            $result[$i] = odbc_exec( $MR_CONNECTION, $SQL );            
        }
        else
        {
            $result[$i] = odbc_exec( $MB_CONNECTION, $SQL );            
        }

        $totalRecord += odbc_num_rows( $result[$i] );
        $i++;
    }
    
    # Set Progress
    $progress      = 0;
    $totalProgress = $totalRecord + 5; # Add some number
      
    if ( $totalRecord > 0 )
    {

        # Load the Excel driver
        require_once("../includes/excel/PHPExcel.php");

        # Load Excel Template
        $objPHPexcel = PHPExcel_IOFactory::load('../template/DANAMON_MONTHLY_REGISTRATION_REPORT.xlt');          
        
        $i = 1;
        foreach ( $SQL_DANAMON_MONTHLY_REPORT as $SQL )
        {
                    
            switch ($i)
            {
                # Auto TopUp Registration
                case 1:
                # Get sheet
                $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
                
                # Write data to sheet
                $no = 1; $X = 2;
                while( odbc_fetch_row( $result[$i] ) )
                {                 
                    $PHONE_NUMBER      = odbc_result( $result[$i], 1 );
                    $PROVIDER          = odbc_result( $result[$i], 2 );
                    $TRIGGER_TYPE      = odbc_result( $result[$i], 3 );
                    $TRIGGER_DATE      = odbc_result( $result[$i], 4 );
                    $AMOUNT_TOPUP      = odbc_result( $result[$i], 5 );
                    $STATUS            = odbc_result( $result[$i], 6 );
                    $REGISTRATION_DATE = odbc_result( $result[$i], 7 );
                    
                    $objWorksheet->getCell('A'.$X)->setValue($no);
                    $objWorksheet->getCell('B'.$X)->setValueExplicit($PHONE_NUMBER, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('C'.$X)->setValue($PROVIDER);
                    $objWorksheet->getCell('D'.$X)->setValue($TRIGGER_TYPE);
                    $objWorksheet->getCell('E'.$X)->setValue($TRIGGER_DATE);
                    $objWorksheet->getCell('F'.$X)->setValue($AMOUNT_TOPUP);
                    $objWorksheet->getCell('G'.$X)->setValue($STATUS);
                    $objWorksheet->getCell('H'.$X)->setValue($REGISTRATION_DATE);

                    # Set Progress
                    $progress++;
                    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );
                    
                    $no++; $X++;
                }                
                break;
                
                # Mobile Recharge Registration
                case 2:
                # Get sheet
                $objWorksheet = $objPHPexcel->setActiveSheetIndex(1);
                
                # Write data to sheet
                $no = 1; $X = 2;
                while( odbc_fetch_row( $result[$i] ) )
                {                 
                    $PROVIDER            = odbc_result( $result[$i], 1 );
                    $PHONE_NUMBER        = odbc_result( $result[$i], 2 );
                    $FIRST_NAME          = odbc_result( $result[$i], 3 );
                    $LAST_NAME           = odbc_result( $result[$i], 4 );
                    $REGISTRATION_DATE   = odbc_result( $result[$i], 5 );
                    $STATUS              = odbc_result( $result[$i], 6 );
                    $TRIGGER_TYPE        = odbc_result( $result[$i], 7 );
                    $TRIGGER_DATE        = odbc_result( $result[$i], 8 );
                    $AMOUNT_TOPUP        = odbc_result( $result[$i], 9 );
                    $AUTO_TOPUP_REG_DATE = odbc_result( $result[$i], 10 );
                    $AUTO_TOPUP_STATUS   = odbc_result( $result[$i], 11 );
                    
                    $objWorksheet->getCell('A'.$X)->setValue($no);
                    $objWorksheet->getCell('B'.$X)->setValue($PROVIDER);
                    $objWorksheet->getCell('C'.$X)->setValueExplicit($PHONE_NUMBER, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('D'.$X)->setValueExplicit($FIRST_NAME, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('E'.$X)->setValueExplicit($LAST_NAME, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('F'.$X)->setValue($REGISTRATION_DATE);
                    $objWorksheet->getCell('G'.$X)->setValue($STATUS);
                    $objWorksheet->getCell('H'.$X)->setValue($TRIGGER_TYPE);
                    $objWorksheet->getCell('I'.$X)->setValue($TRIGGER_DATE);
                    $objWorksheet->getCell('J'.$X)->setValue($AMOUNT_TOPUP);
                    $objWorksheet->getCell('K'.$X)->setValue($AUTO_TOPUP_REG_DATE);
                    $objWorksheet->getCell('L'.$X)->setValue($AUTO_TOPUP_STATUS);
                    
                    # Set Progress
                    $progress++;
                    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );                    
                                        
                    $no++; $X++;
                }                                
                break;

                # Mobile Recharge User List
                case 3:
                # Get sheet
                $objWorksheet = $objPHPexcel->setActiveSheetIndex(2);
                
                # Write data to sheet
                $no = 1; $X = 2;
                while( odbc_fetch_row( $result[$i] ) )
                {                 
                    $USER_ID        = odbc_result( $result[$i], 1 );
                    $ADMIN_FLAG     = odbc_result( $result[$i], 2 );
                    $ACTIVE_FLAG    = odbc_result( $result[$i], 3 );
                    $OPEN_DATE      = odbc_result( $result[$i], 4 );
                    $FULL_CARD_FLAG = odbc_result( $result[$i], 5 );
                    
                    $objWorksheet->getCell('A'.$X)->setValue($no);
                    $objWorksheet->getCell('B'.$X)->setValueExplicit($USER_ID, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('C'.$X)->setValue($ADMIN_FLAG);
                    $objWorksheet->getCell('D'.$X)->setValue($ACTIVE_FLAG);
                    $objWorksheet->getCell('E'.$X)->setValue($OPEN_DATE);
                    $objWorksheet->getCell('F'.$X)->setValue($FULL_CARD_FLAG);
                    
                    # Set Progress
                    $progress++;
                    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );                    
                                        
                    $no++; $X++;
                }                                
                break;

                # Mobile Banking Registration
                case 4:
                # Get sheet
                $objWorksheet = $objPHPexcel->setActiveSheetIndex(3);
                
                # Write data to sheet
                $no = 1; $X = 2;
                while( odbc_fetch_row( $result[$i] ) )
                {                 
                    $EXT_CIF_KEY       = odbc_result( $result[$i], 1 );
                    $LAST_NAME         = odbc_result( $result[$i], 2 );
                    $CARD_ALIAS        = odbc_result( $result[$i], 3 );
                    $ACCOUNT_SEQUENCE  = odbc_result( $result[$i], 4 );
                    $ACCOUNT_NUMBER    = odbc_result( $result[$i], 5 );
                    $ACCOUNT_ALIAS     = odbc_result( $result[$i], 6 );
                    $CURRENCY          = odbc_result( $result[$i], 7 );
                    $ACCOUNT_TYPE      = odbc_result( $result[$i], 8 );
                    $SMS_USER_ID       = odbc_result( $result[$i], 9 );
                    $OPERATOR_CELLULAR = odbc_result( $result[$i], 10 );
                    $DATE_OPENED       = odbc_result( $result[$i], 11 );
                    $ACTIVE            = odbc_result( $result[$i], 12 );
                    
                    $objWorksheet->getCell('A'.$X)->setValue($no);
                    $objWorksheet->getCell('B'.$X)->setValueExplicit($EXT_CIF_KEY, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('C'.$X)->setValueExplicit($LAST_NAME, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('D'.$X)->setValue($CARD_ALIAS);
                    $objWorksheet->getCell('E'.$X)->setValue($ACCOUNT_SEQUENCE);
                    $objWorksheet->getCell('F'.$X)->setValueExplicit($ACCOUNT_NUMBER, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('G'.$X)->setValue($ACCOUNT_ALIAS);
                    $objWorksheet->getCell('H'.$X)->setValue($CURRENCY);
                    $objWorksheet->getCell('I'.$X)->setValue($ACCOUNT_TYPE);
                    $objWorksheet->getCell('J'.$X)->setValueExplicit($SMS_USER_ID, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('K'.$X)->setValue($OPERATOR_CELLULAR);
                    $objWorksheet->getCell('L'.$X)->setValue($DATE_OPENED);
                    $objWorksheet->getCell('M'.$X)->setValue($ACTIVE);                                        
                    
                    # Set Progress
                    $progress++;
                    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );                    
                                        
                    $no++; $X++;
                }                                                
                break;

                # Mobile Banking User List
                case 5:
                # Get sheet
                $objWorksheet = $objPHPexcel->setActiveSheetIndex(4);
                
                # Write data to sheet
                $no = 1; $X = 2;
                while( odbc_fetch_row( $result[$i] ) )
                {                 
                    $USER_ID     = odbc_result( $result[$i], 1 );
                    $ACCESS_ROLE = odbc_result( $result[$i], 2 );
                    $ACTIVE_FLAG = odbc_result( $result[$i], 3 );
                    $OPEN_DATE   = odbc_result( $result[$i], 4 );
                    
                    $objWorksheet->getCell('A'.$X)->setValue($no);
                    $objWorksheet->getCell('B'.$X)->setValueExplicit($USER_ID, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objWorksheet->getCell('C'.$X)->setValue($ACCESS_ROLE);
                    $objWorksheet->getCell('D'.$X)->setValue($ACTIVE_FLAG);
                    $objWorksheet->getCell('E'.$X)->setValue($OPEN_DATE);

                    # Set Progress
                    $progress++;
                    $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );
                    
                    $no++; $X++;
                }                
                break;                
            }

            $i++;                        
        }

        # Set active sheet back to first sheet
        $objWorksheet = $objPHPexcel->setActiveSheetIndex(0);
        
        # Save xls file to temp
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
        $fileTemp  = TMP_FILE.mt_rand();
        $objWriter->save($fileTemp);

        # Set Progress
        $progress = 99999;
        $euromis->fn_write_progress( $progress_file, $progress.",".$totalProgress );
    
        # Force download
        $euromis->fn_outputFile( $fileTemp, "DANAMON_MONTHLY_REPORT_".$report_year."_".$report_month.".xls" );            

        # Delete Temporary File
        unlink($fileTemp);        

        # Close connection
        $euromis->fn_server_close();
                            
    }
    else
    {
        ?>
            <script>history.back();alert("There is no data on that date.")</script>
        <?php        
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