<?php

require_once("config.php");

class webapps 
{        
    var $LOG_VERBOSE     = FALSE;   # Log to file and echo to console
    var $LOG_SQL_VERBOSE = FALSE;   # Log SQL Query to file
    var $LOG_MAIL        = FALSE;   # Send alert mail to selected recipients    
    var $LOG_MAIL_NODE   = TRUE;   # Send alert mail to selected recipients    
    
    var $ATM_BANK_ID     = array(
                                 "SCB" => "STANDARD CHARTERED",
                                 "BTP" => "BTPN"
    );
    
    /* CONSTRUCTOR */
    function webapps()
    {

        #####################CONSTRUCTOR########################        
        
        $this->fn_mysql_connect();
        
        #####################CONSTRUCTOR########################        
                
    }

    /* TRANSACTION SQL */
    function fn_begin()
    {
        mysql_query("START TRANSACTION");
    }

    function fn_commit()
    {
        mysql_query("COMMIT");
    }

    function fn_rollback()
    {
        mysql_query("ROLLBACK");
    }

    /* DATA MANIPULATION FUNCTION */
    function fn_delete_record($table, $params, $username='system function', $LOG=FALSE)
    {
        $query = "DELETE FROM `$table` WHERE $params";
                        
        $result = mysql_query($query);
        if (!$result || mysql_affected_rows()<1)  
        {
            $response = 0;    
        }  
        else
        {
            $response = 1;    
        }
        
        if ( $this->LOG_SQL_VERBOSE ) $this->fn_write_log("SQL : ".$query." | RESULT : ".$result." | USERNAME : ".$username);
        
        return $response;    
    }

    function fn_insert_record($table, $key_field, $value_field, $username='system function', $LOG=FALSE)
    {
        $query = "INSERT INTO `$table` ($key_field[0]";
        for ( $i=1; $i<count($key_field); $i++ )
        { $query .= "," . "$key_field[$i]"; }

        $query .= ") VALUES ('$value_field[0]'";
        
        for ( $i=1; $i<count($value_field); $i++ )
        { $query .= "," . "'$value_field[$i]'"; }

        $query = $query . ")";
        
        $result = mysql_query($query);
        
        if ( $this->LOG_SQL_VERBOSE ) $this->fn_write_log("SQL : ".$query." | RESULT : ".$result." | USERNAME : ".$username);
        
        return $result;
    }

    function fn_update_record($table, $key_field, $value_field, $params, $username='system function', $LOG=FALSE)
    {
        $query = "UPDATE `$table` SET $key_field[0]='$value_field[0]'";
        
        for ( $i=1; $i<count($key_field); $i++ )
        { $query .= "," . "$key_field[$i]='$value_field[$i]'"; }
        
        $query .= " WHERE $params";
        
        $result = mysql_query($query);
        
        if ( $this->LOG_SQL_VERBOSE ) $this->fn_write_log("SQL : ".$query." | RESULT : ".$result." | USERNAME : ".$username);    
        
        return $result;
    }

    /* DATA QUERY FUNCTION */
    function fn_data_generate_sql_insert($table, $key_field, $value_field)
    {
        $query = "INSERT INTO `$table` ($key_field[0]";
        for ( $i=1; $i<count($key_field); $i++ )
        { $query .= "," . "$key_field[$i]"; }

        $query .= ") VALUES ('$value_field[0]'";
        
        for ( $i=1; $i<count($value_field); $i++ )
        { $query .= "," . "'$value_field[$i]'"; }

        $query = $query . ")";
        
        return $query;
    }

    function fn_get_record($table, $field, $params="1")
    {
        $sql = "SELECT $field FROM `$table` WHERE $params";
        $result = mysql_query($sql);
                                        
        if (!$result)  
        {
            $response = 0;    
        }  
        else
        {
            $response = $result;    
        }
        
        return $response;    
    }

    /* DATA TOOLS */
    function fn_server_connect()
    {
        mysql_connect(DBHOST, DBUSER, DBPASS) or die("Can't connect to MySQL Server : ".DBHOST);
        mysql_select_db(DBNAME);
    }

    function fn_server_close()
    {
        odbc_close_all();        
    }
    
    function is_jQuery()
    {                
        global $jQuery_exist;
        
        if ( isset($jQuery_exist) AND $jQuery_exist === TRUE )
        {
            return TRUE;
        }
        else
        {
            $jQuery_exist = TRUE;
            return FALSE;
        }
    }

    function fn_mysql_add_text($data)
    {
        $result = mysql_escape_string( trim( $data ) );
        
        return $result;
    }

    function is_odd($number) 
    {
        
       return $number & 1; // 0 = even, 1 = odd
       
    }

    function fn_dateFormat($date, $format) 
    {
        $datestr = explode("-", $date);    
        $result  = date($format, mktime(0, 0, 0, intval($datestr[1]), intval($datestr[2]), intval($datestr[0])));
        
        return $result;
    }

    function fn_dateCalc($date, $calc) 
    {
        $result = date("Y-m-d", strtotime($calc, strtotime($date, strtotime(date("m")."/01/".date("Y")." 00:00:00"))));        
        
        return $result;
    }

    function fn_get_time_difference( $start, $end )
    {
        $uts['start']      =    strtotime( $start );
        $uts['end']        =    strtotime( $end );
        if( $uts['start']!==-1 && $uts['end']!==-1 )
        {
            if( $uts['end'] >= $uts['start'] )
            {
                $diff    =    $uts['end'] - $uts['start'];
                if( $days=intval((floor($diff/86400))) )
                    $diff = $diff % 86400;
                if( $hours=intval((floor($diff/3600))) )
                    $diff = $diff % 3600;
                if( $minutes=intval((floor($diff/60))) )
                    $diff = $diff % 60;
                $diff    =    intval( $diff );            
                return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
            }
            else
            {
                trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
            }
        }
        else
        {
            trigger_error( "Invalid date/time data detected", E_USER_WARNING );
        }
        return( false );
    }    
    
    function fn_convert_jqgrid_op($op, $data)
    {
        switch($op)
        {
            case "eq":
            $SQL = " = '$data'";
            break;

            case "ne":
            $SQL = " != '$data'";
            break;
            
            case "le":
            $SQL = " <= '$data'";
            break;

            case "lt":
            $SQL = " < '$data'";
            break;

            case "ge":
            $SQL = " >= '$data'";
            break;

            case "gt":
            $SQL = " > '$data'";
            break;            
            
            case "cn":
            $SQL = " LIKE '%$data%'";
            break;                        
        }        
        return $SQL;
    }
    
    function fn_convert_jqgrid_filters_to_mysql($search)
    {
        $mysql_SQL = "";
        
        foreach ( $search['rules'] AS $jqgrid )
        {
            $field = $jqgrid['field'];
            $data  = $jqgrid['data'];
            $op    = $jqgrid['op'];
            
            if ( $field == 'D_TRXMDT' )
            {
                $date       = explode( "-", $data );
                $date_year  = substr( $date[0], 2, 2 );
                $date_month = $date[1];
                $date_day   = $date[2];
                
                $data       = "1" . $date_year .  $date_month . $date_day;
            }

            if ( $field == 'D_TRXMTM' )
            {
                $time_tmp = str_replace( ":", "", $data );
                $data     = ltrim( $time_tmp, '\x0' );
            }

            if ( $field == 'D_TRAC2' && $op == 'eq' )
            {
                $data  = str_pad( $data, 19, "0", STR_PAD_LEFT );
                $field = "LPAD( D_TRAC2, 19, '0' )";
            }
                        
            $mysql_op  = $this->fn_convert_jqgrid_op( $op, $data );
                        
            $mysql_SQL .= " " . $field . $mysql_op . " " . $search['groupOp'];
        }
        
        $mysql_SQL  = substr( $mysql_SQL, 0, -3 ) . " ";
        
        return $mysql_SQL;
    }
    
    function fn_outputFile($file, $name, $mime_type='')
    {
         /*
         This function takes a path to a file to output ($file), 
         the filename that the browser will see ($name) and 
         the MIME type of the file ($mime_type, optional).
         
         If you want to do something on download abort/finish,
         register_shutdown_function('function_name');
         */
         if(!is_readable($file)) die('File not found or inaccessible!');
         
         $size = filesize($file);
         $name = rawurldecode($name);
         
         /* Figure out the MIME type (if not specified) */
         $known_mime_types=array(
            "pdf" => "application/pdf",
            "txt" => "application/octet-stream",
            "csv" => "application/octet-stream",
            "html"=> "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg"=> "image/jpg",
            "jpg" => "image/jpg",
            "php" => "text/plain"
         );
         
         if($mime_type==''){
             $file_extension = strtolower(substr(strrchr($file,"."),1));
             if(array_key_exists($file_extension, $known_mime_types)){
                $mime_type=$known_mime_types[$file_extension];
             } else {
                $mime_type="application/force-download";
             };
         };
         
         @ob_end_clean(); //turn off output buffering to decrease cpu usage
         
         // required for IE, otherwise Content-Disposition may be ignored
         if(ini_get('zlib.output_compression'))
          ini_set('zlib.output_compression', 'Off');
         
         header('Content-Type: ' . $mime_type . '; charset=utf-8');
         header('Content-Disposition: attachment; filename="'.$name.'"');
         header("Content-Transfer-Encoding: binary");
         header('Accept-Ranges: bytes');
         
         /* The three lines below basically make the 
            download non-cacheable */
         header("Cache-control: private");
         header('Pragma: private');
         header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         // multipart-download and download resuming support
         if(isset($_SERVER['HTTP_RANGE']))
         {
            list($a, $range) = explode("=",$_SERVER['HTTP_RANGE']);
            str_replace($range, "-", $range);
            $size2 = $size-1;
            $new_length = $size-$range;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range$size2/$size");
         } else {
            $size2=$size-1;
            header("Content-Length: ".$size);
         }
         
         /* output the file itself */
         $chunksize = 1*(1024*1024);
         $bytes_send = 0;
         if ($file = fopen($file, 'r'))
         {
            if(isset($_SERVER['HTTP_RANGE']))
            fseek($file, $range);
         
            while(!feof($file) && (connection_status()==0))
            {
                $buffer = fread($file, $chunksize);
                print($buffer); //echo($buffer); // is also possible
                flush();
                $bytes_send += strlen($buffer);
            }
         fclose($file);
         } else die('Error - can not open file.');
        
        # die();
    }    
    
    function fn_send_mail($subject, $message)
    {
        require_once("../includes/mail/smtp.php");
        
        $smtp = new smtp_class;
                
        $from = "EURONET_EUROMIS_SYSTEM@id.g4s.com";
        $to   = explode( ";", EURONET_PIC_MAIL );

        $smtp->host_name = SMTP_SERVER;
        $smtp->host_port = SMTP_PORT;

        $smtp->localhost    = "localhost";
        $smtp->timeout      = 10;
        $smtp->data_timeout = 0;
        
        $message_header = "Please do not reply to this email. This email is generated by system.\r\n\r\n";
        $message        = $message_header . $message;

        if( $smtp->SendMessage(
            $from,
            $to,
            array(
                "From: $from",
                "To: ".EURONET_PIC_MAIL,
                "Subject: $subject",
                "Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z")
            ),
            $message) )
            
            if ( $this->LOG_VERBOSE ) $this->fn_write_log( "[".Date("d/m/Y H:i:s")."] Message sent to $to OK.\r\n" );
        else
            if ( $this->LOG_VERBOSE ) $this->fn_write_log( "[".Date("d/m/Y H:i:s")."] Could not send the message to $to. Error: ".$smtp->error."\r\n" );                
    }
    
    
    /* FILE I/O TOOLS */
    function fn_write_progress($progress_file, $progress)
    {                        
        $fh = fopen($progress_file, 'w');
        fwrite($fh, $progress);
        fclose($fh);    
    }                                   

    function fn_read_progress($progress_file)
    {                        
        $fh = fopen($progress_file, 'a+');
        $fcontent = fread( $fh, filesize($progress_file) );
        fclose($fh);        
        
        if ( $fcontent !== FALSE )
        {
            return $fcontent;
        }    
    }                                   

    function fn_write_log($log)
    {                    
        if ( file_exists(LOG) && filesize(LOG) > 40960000 )
        {
            rename( LOG, LOG.".".date( 'Ymdhis' ) );
        }
        
        $log_text = "[".Date("d/m/Y H:i:s")."] : $log\r\n";
        $fh = fopen(LOG, 'a+') or die("Can't open, error log file.\r\n");
        fwrite($fh, $log_text);
        fclose($fh);    
    } 

    function fn_error_log($log)
    {                    
        if ( file_exists(ERROR_LOG) && filesize(ERROR_LOG) > 40960000 )
        {
            rename( ERROR_LOG, ERROR_LOG.".".date( 'Ymdhis' ) );
        }
        
        $log_text = "[".Date("d/m/Y H:i:s")."] : $log\r\n";
        $fh = fopen(ERROR_LOG, 'a+') or die("Can't open, error log file.\r\n");
        fwrite($fh, $log_text);
        fclose($fh);    
    }                             
    
    function fn_log($LOG)
    {
        if ( $this->LOG_VERBOSE ) 
        {
            echo $LOG;
            $this->fn_write_log( $LOG );    
        }        
    }
    
    ###################################################### EUROMIS DATABASE CONNECTION ######################################################

    /* MySQL Local Database Connection */
    function fn_mysql_connect()
    {
        mysql_connect(DBHOST, DBUSER, DBPASS) or die("Can't connect to MySQL Server : ".DBHOST);
        mysql_select_db(DBNAME);
    }
    
    /* Mobile Banking Database Connection - MS SQL by ODBC */
    function fn_mb_sql()
    {
        $result = odbc_connect(MB_DATABASE, MB_USER, MB_PASS) or $this->fn_error_log( "Can't connect to Database ".MB_DATABASE );
        return $result;
    }

    /* Mobile Recharge Database Connection - MS SQL by ODBC */
    function fn_mr_sql()
    {
        $result = odbc_connect(MR_DATABASE, MR_USER, MR_PASS) or $this->fn_error_log( "Can't connect to Database ".MR_DATABASE );        
        return $result;
    }
    
    /* Mobile Recharge Satelindo HTTP Database Connection - MS SQL by ODBC */
    function fn_mr_sat_sql()
    {
        $result = odbc_connect(MR_HTTP_DATABASE, MR_HTTP_USER, MR_HTTP_PASS) or $this->fn_error_log( "Can't connect to Database ".MR_HTTP_DATABASE );        
        return $result;
    }

    /* EWIDT Data ASDATA_DL Database Connection - MS SQL by ODBC */
    function fn_ewidt_data_miner_sql()
    {
        $result = odbc_connect(EWIDT_DATA_MINER_DATABASE, EWIDT_DATA_MINER_USER, EWIDT_DATA_MINER_PASS) or $this->fn_error_log( "Can't connect to Database ".EWIDT_DATA_MINER_DATABASE );        
        return $result;
    }

    /* EWIDT Data ASDATA Database Connection - MS SQL by ODBC */
    function fn_ewidt_data_sql()
    {
        $result = odbc_connect(EWIDT_DATA_DATABASE, EWIDT_DATA_USER, EWIDT_DATA_PASS) or $this->fn_error_log( "Can't connect to Database ".EWIDT_DATA_DATABASE );        
        return $result;
    }

    /* EWIDT Data ASDATA Database Connection - MS SQL by ODBC */
    function fn_ewidt_data2_sql()
    {
        $result = odbc_connect(EWIDT_DATA2_DATABASE, EWIDT_DATA_USER, EWIDT_DATA_PASS) or $this->fn_error_log( "Can't connect to Database ".EWIDT_DATA_DATABASE );        
        return $result;
    }
    
    /* EDC Database Connection - MS SQL by ODBC */
    function fn_edc_sql()
    {
        $result = odbc_connect(EDC_DATABASE, EDC_USER, EDC_PASS) or $this->fn_error_log( "Can't connect to Database ".EDC_DATABASE );        
        return $result;
    }

    /* AS400 MR Database Connection - DB2 by ODBC */
    function fn_as400mr_sql()
    {
        $result = odbc_connect(AS400MR_DATABASE, AS400MR_USER, AS400MR_PASS) or $this->fn_error_log( "Can't connect to Database ".AS400MR_DATABASE );        
        return $result;
    }

    /* AS400 ATM Database Connection - DB2 by ODBC */
    function fn_as400atm_sql()
    {
        $result = odbc_connect(AS400ATM_DATABASE, AS400ATM_USER, AS400ATM_PASS) or $this->fn_error_log( "Can't connect to Database ".AS400ATM_DATABASE );        
        return $result;
    }    
    
    /* EUROMIS DATA CONNECTION FUNCTION */
    function fn_data_connection($table, $query_where, $query_field, $connection) 
    {                 
        $SQL    = "SELECT $query_field FROM $table WHERE $query_where";
        $result = odbc_exec($connection, $SQL) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );

        return $result;
    }
    
    ###################################################### EUROMIS DATABASE CONNECTION ######################################################
    
    

    ###################################################### EUROMIS DATA TOOLS FUNCTION ######################################################
    
    function fn_get_edc_response_code()
    {
        # Query
        $SQL = "SELECT A_RESPONSE_CODE FROM ".PREFIX.EDC_RESPONSE_CODE." ORDER BY A_ID";
        
        # Connecting to Database
        $this->fn_mysql_connect();

        # Execute query
        $result = mysql_query( $SQL );    
        
        # Get data
        $response_code = array();
        while( $row = mysql_fetch_array($result, MYSQL_ASSOC) )
        {                 
            $response_code[] = $row['A_RESPONSE_CODE'];
        }
        
        return $response_code;
    }    
    
    function fn_get_data_element($data_element)
    {
        $result = "";
        foreach ( $data_element as $bit => $data )
        {
            $result .= "bit[$bit] : $data\r\n";
        }
        return $result;
    }
    
    function fn_show_last_data_check()
    {
        return "<center>data update every 10 second(s), last check : ".date("d-M-Y H:i:s")."</center>";
    }
    
    ###################################################### EUROMIS DATA TOOLS FUNCTION ######################################################
    
    
    
    #######################################################  EUROMIS LOG GET FUNCTION  ######################################################

    function fn_as400mr_trx_logging() 
    {                                     
        # Get data from local table      
        $current_date = "1" . date("ymd");

        $SQL    = "SELECT D_TRSTAN,D_TRXMTM FROM ".PREFIX.MR_AS400_TABLE." WHERE D_TRXMDT='$current_date' ORDER BY D_TRXMTM DESC LIMIT 0,1";
        $result = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . " : " . mysql_error() . " : " . $SQL );
        $row    = mysql_fetch_array( $result, MYSQL_ASSOC );
        $TRSTAN = $row['D_TRSTAN'];
        $TRXMTM = $row['D_TRXMTM'];
        
        # If get previous record, start from the last record, if not, get all record
        if ( !empty( $TRSTAN ) )
        {
            # Extend PHP time out
            set_time_limit(TIME_EXTENDED);
            
            $SQL         = "SELECT * FROM ZTRANS0P WHERE TRXMDT=$current_date AND TRXMTM>=$TRXMTM AND TRSTAN<>$TRSTAN ORDER BY TRXMTM";
            $CONNECTION  = $this->fn_as400mr_sql();            
            $result      = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
            
            # Get all record
            $x = 0;
            while( odbc_fetch_row( $result ) ) 
            { 
                $this->fn_mr_trx_log_insert( $result, "Error [fn_mr_trx_logging:1]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR Trx Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );    
        }
        else
        {
            # Extend PHP time out
            set_time_limit(TIME_EXTENDED);

            $SQL         = "SELECT * FROM ZTRANS0P WHERE TRXMDT=$current_date ORDER BY TRXMTM";
            $CONNECTION  = $this->fn_as400mr_sql();            
            $result      = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
            
            # Get all record
            $x = 0;
            while( odbc_fetch_row( $result ) ) 
            { 
                $this->fn_mr_trx_log_insert( $result, "Error [fn_mr_trx_logging:2]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR Trx Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );                
        }    
        
        # Close connection
        $this->fn_server_close();
    }

    function fn_as400mr_dt_logging() 
    {                                     
        # Get data from local table      
        $current_date = date("Y-m-d");                                                                                                     

        $SQL      = "SELECT J_DTSTAN FROM ".PREFIX.MR_DT_AS400_TABLE." WHERE J_DATE='$current_date' ORDER BY J_TIME DESC LIMIT 0,1";
        $result   = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . " : " . mysql_error() . " : " . $SQL );
        $row      = mysql_fetch_array( $result, MYSQL_ASSOC );
        $J_DTSTAN = $row['J_DTSTAN'];
        
        # If get previous record, start from the last record, if not, get all record
        if ( !empty( $J_DTSTAN ) )
        {
            # Extend PHP time out
            set_time_limit(TIME_EXTENDED);
            
            $SQL         = "SELECT * FROM ZTRNDT0P WHERE DTSTAN>$J_DTSTAN AND DTDTID<>'TRK' ORDER BY DTSTAN";
            $CONNECTION  = $this->fn_as400mr_sql();            
            $result      = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
            
            # Get all record
            $x = 0;
            while( odbc_fetch_row( $result ) ) 
            { 
                $this->fn_mr_dt_log_insert( $result, "Error [fn_mr_dt_logging:1]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR DT Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );    
        }
        else
        {
            # Extend PHP time out
            set_time_limit(TIME_EXTENDED);

            $SQL         = "SELECT * FROM ZTRNDT0P WHERE DTDTID<>'TRK' ORDER BY DTSTAN";
            $CONNECTION  = $this->fn_as400mr_sql();            
            $result      = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
            
            # Get all record
            $x = 0;
            while( odbc_fetch_row( $result ) ) 
            { 
                $this->fn_mr_dt_log_insert( $result, "Error [fn_mr_dt_logging:2]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR DT Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );                
        }    
        
        # Close connection
        $this->fn_server_close();
    }
    
    function fn_mr_sms_logging() 
    {                                   
        # Get data from local table    
        $SQL       = "SELECT B_TIMESTAMP FROM ".PREFIX.MR_SMS_TABLE.
                     " ORDER BY B_TIMESTAMP DESC LIMIT 0,1";
                      
        $result    = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . " : " . mysql_error() . " : " . $SQL );
        $row       = mysql_fetch_array( $result, MYSQL_ASSOC );
        $TIMESTAMP = $row['B_TIMESTAMP'];
        
        $MR_SMS_TABLE = "Messages";
        $MR_SMS_FIELD = "DATEADD(HOUR, 7, TimeStamp) AS TimeStamp,Originator,Destination,Channel,BodyXML,Status";
        
        $CONNECTION   = $this->fn_mr_sql();
        
        # If there is previous data, insert new one, if empty, just insert one data only
        if( !empty( $TIMESTAMP ) )
        {
            # Query table from Mobile Recharge Database
            $QUERY  = "DATEADD(HOUR, 7, TimeStamp)>'$TIMESTAMP' ORDER BY TimeStamp DESC";
            $result = $this->fn_data_connection( $MR_SMS_TABLE, $QUERY, $MR_SMS_FIELD, $CONNECTION );
                         
            $x = 0;
            while(odbc_fetch_row($result)) 
            { 
                $this->fn_mr_sms_log_insert( $result, "Error [fn_mr_sms_logging:1]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR SMS Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );
        }
        else
        {
            $QUERY  = "1=1 ORDER BY TimeStamp DESC";
            $result = $this->fn_data_connection( $MR_SMS_TABLE, $QUERY, $MR_SMS_FIELD, $CONNECTION );

            odbc_fetch_row($result);
            $this->fn_mr_sms_log_insert($result, "Error [fn_mr_sms_logging:2]");
        }
        
        # Close connection
        $this->fn_server_close();
    }

    function fn_mb_sms_logging() 
    {                              
        # Get data from local table         
        $SQL       = "SELECT C_TIMESTAMP FROM ".PREFIX.MB_SMS_TABLE.
                     " ORDER BY C_TIMESTAMP DESC LIMIT 0,1";
                      
        $result    = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . " : " . mysql_error() . " : " . $SQL );
        $row       = mysql_fetch_array( $result, MYSQL_ASSOC );
        $TIMESTAMP = $row['C_TIMESTAMP'];
        
        $MB_SMS_TABLE = "Messages";
        $MB_SMS_FIELD = "DATEADD(HOUR, 7, TimeStamp) AS TimeStamp,Originator,Destination,Channel,BodyXML,Status";
        
        $CONNECTION   = $this->fn_mb_sql();
        
        # If there is previous data, insert new one, if empty, just insert one data only
        if( !empty( $TIMESTAMP ) )
        {
            # Query table from Mobile Banking Database
            $QUERY  = "DATEADD(HOUR, 7, TimeStamp)>'$TIMESTAMP' ORDER BY TimeStamp DESC";
            $result = $this->fn_data_connection( $MB_SMS_TABLE, $QUERY, $MB_SMS_FIELD, $CONNECTION );
                         
            $x = 0;
            while(odbc_fetch_row($result)) 
            { 
                $this->fn_mb_sms_log_insert( $result, "Error [fn_mb_sms_logging:1]" );
                $x++;
            }
            
            # Print log if there is number of change in status
            $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MB SMS Record Log : $x\r\n";
            $this->fn_log( $SYSTEM_LOG );
        }
        else
        {
            $QUERY  = "1=1 ORDER BY TimeStamp DESC";
            $result = $this->fn_data_connection( $MB_SMS_TABLE, $QUERY, $MB_SMS_FIELD, $CONNECTION );

            odbc_fetch_row($result);
            $this->fn_mb_sms_log_insert($result, "Error [fn_mb_sms_logging:2]");
        }
        
        # Close connection
        $this->fn_server_close();
    }

    function fn_mr_node_logging()
    {
        # Query from AS400 table
        $SQL        = "SELECT NDNODE,NDDESC,NDISTS FROM ZNODCT0P WHERE NDNODE NOT IN " . MR_NODE_SKIP . " ORDER BY NDNODE";        
        $CONNECTION = $this->fn_as400mr_sql();        
        $result     = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $SQL );
        
        # Get data and insert to local table
        $x = 0;
        while( odbc_fetch_row( $result ) ) 
        { 
            $NDNODE = trim( odbc_result($result, 1) );
            $NDDESC = trim( odbc_result($result, 2) );
            $NDISTS = trim( odbc_result($result, 3) );
            
            $n = $this->fn_mr_node_log_insert( $NDNODE, $NDDESC, $NDISTS );  
            
            if ( $n == 1 ) $x++;
        }        

        # Print log if there is number of change in status
        $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR Node Record Log : $x\r\n";
        $this->fn_log( $SYSTEM_LOG );
        
        # Close connection
        $this->fn_server_close();
    }

    function fn_mr_module_logging()
    {
        # Query from AS400 table
        $SQL        = "SELECT MDNAME,MDDESC,MDMSTA FROM ZMODCT0P WHERE MDNAME NOT IN " . MR_MODULE_SKIP . " ORDER BY MDNAME";
        $CONNECTION = $this->fn_as400mr_sql();        
        $result     = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log (ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $query);
        
        # Get data and insert to local table
        $x = 0;
        while( odbc_fetch_row( $result ) ) 
        { 
            $MDNAME = trim( odbc_result($result, 1) );
            $MDDESC = trim( odbc_result($result, 2) );
            $MDMSTA = trim( odbc_result($result, 3) );
            
            $n = $this->fn_mr_module_log_insert( $MDNAME, $MDDESC, $MDMSTA );  
            
            if ( $n == 1 ) $x++;
        }        

        # Print log if there is number of change in status
        $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] MR Module Record Log : $x\r\n";
        $this->fn_log( $SYSTEM_LOG );
        
        # Close connection
        $this->fn_server_close();        
    }

    function fn_itm_node_logging()
    {
        # Query from EWIDT table
        $SQL        = "SELECT NDNODE,NDDESC,NDISTS,_NDCHGD FROM ND ORDER BY NDNODE";
        $CONNECTION = $this->fn_ewidt_data_sql();        
        $result     = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log (ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $query);
        
        # Get data and insert to local table
        $x = 0;
        while( odbc_fetch_row( $result ) ) 
        { 
            $NDNODE = trim( odbc_result($result, 1) );
            $NDDESC = trim( odbc_result($result, 2) );
            $NDISTS = trim( odbc_result($result, 3) );
            $NDCHGD = trim( odbc_result($result, 4) );                        
            
            $n = $this->fn_itm_node_log_insert( $NDNODE, $NDDESC, $NDISTS, $NDCHGD );  
            
            if ( $n == 1 ) $x++;
        }        

        # Print log if there is number of change in status
        $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] ITM Node Record Log : $x\r\n";
        $this->fn_log( $SYSTEM_LOG );
        
        # Close connection
        $this->fn_server_close();        
    }

    function fn_itm_atm_logging()
    {
        # Query from EWIDT table
        $SQL        = "SELECT MTVDEV,MTLOC,_STATE,_STECHGD,_CRCPLV FROM MT_VIEW WHERE MTDELE='' ORDER BY MTVDEV";
        $CONNECTION = $this->fn_ewidt_data_sql();        
        $result     = odbc_exec( $CONNECTION, $SQL ) or $this->fn_error_log (ERROR_ON_QUERY . ' : ' . odbc_error() . '-' . odbc_errormsg() . ' : ' . $query);
        
        # Get data and insert to local table
        $x = 0;
        while( odbc_fetch_row( $result ) ) 
        { 
            $MTVDEV  = trim( odbc_result($result, 1) );
            $MTLOC   = trim( odbc_result($result, 2) );
            $STATE   = trim( odbc_result($result, 3) );
            $STECHGD = trim( odbc_result($result, 4) );                        
            $CRCPLV  = trim( odbc_result($result, 5) );
            
            $n = $this->fn_itm_atm_log_insert( $MTVDEV, $MTLOC, $STATE, $STECHGD, $CRCPLV );  
            
            if ( $n == 1 ) $x++;
        }        

        # Print log if there is number of change in status
        $SYSTEM_LOG = "[".Date("d/m/Y H:i:s")."] ITM ATM Record Log : $x\r\n";
        $this->fn_log( $SYSTEM_LOG );
        
        # Close connection
        $this->fn_server_close();        
    }
    
    ######################################################  EUROMIS LOG GET FUNCTION  #####################################################
    
    
    
    ##################################################### EUROMIS LOG INSERT FUNCTION #####################################################

    function fn_mr_trx_log_insert($result, $error)
    {
        # Get variable
        $TRMSGC = $this->fn_mysql_add_text( odbc_result( $result, 1 ) );
        $TRMSGF = $this->fn_mysql_add_text( odbc_result( $result, 2 ) );
        $TRMSGT = $this->fn_mysql_add_text( odbc_result( $result, 3 ) );
        $TRMICD = $this->fn_mysql_add_text( odbc_result( $result, 4 ) );
        $TRTRTY = $this->fn_mysql_add_text( odbc_result( $result, 5 ) );
        $TRTRFA = $this->fn_mysql_add_text( odbc_result( $result, 6 ) );
        $TRTRTA = $this->fn_mysql_add_text( odbc_result( $result, 7 ) );
        $TRACTN = $this->fn_mysql_add_text( odbc_result( $result, 8 ) );
        $TRRSPC = $this->fn_mysql_add_text( odbc_result( $result, 9 ) );
        $TRAPR  = $this->fn_mysql_add_text( odbc_result( $result, 10 ) );
        $TRCRD  = $this->fn_mysql_add_text( odbc_result( $result, 11 ) );
        $TRXMDT = $this->fn_mysql_add_text( odbc_result( $result, 12 ) );
        $TRXMTM = $this->fn_mysql_add_text( odbc_result( $result, 13 ) );
        $TRSTAN = $this->fn_mysql_add_text( odbc_result( $result, 14 ) );
        $TRRRF  = $this->fn_mysql_add_text( odbc_result( $result, 15 ) );
        $TRAQPT = $this->fn_mysql_add_text( odbc_result( $result, 16 ) );
        $TRISPT = $this->fn_mysql_add_text( odbc_result( $result, 17 ) );
        $TRI2PT = $this->fn_mysql_add_text( odbc_result( $result, 18 ) );
        $TRAQND = $this->fn_mysql_add_text( odbc_result( $result, 19 ) );
        $TRISND = $this->fn_mysql_add_text( odbc_result( $result, 20 ) );
        $TRI2ND = $this->fn_mysql_add_text( odbc_result( $result, 21 ) );
        $TRNTID = $this->fn_mysql_add_text( odbc_result( $result, 22 ) );
        $TRGWAY = $this->fn_mysql_add_text( odbc_result( $result, 23 ) );
        $TRMCAT = $this->fn_mysql_add_text( odbc_result( $result, 24 ) );
        $TRCAID = $this->fn_mysql_add_text( odbc_result( $result, 25 ) );
        $TRCATI = $this->fn_mysql_add_text( odbc_result( $result, 26 ) );
        $TRCATA = $this->fn_mysql_add_text( odbc_result( $result, 27 ) );
        $TRAQID = $this->fn_mysql_add_text( odbc_result( $result, 28 ) );
        $TRI1ID = $this->fn_mysql_add_text( odbc_result( $result, 29 ) );
        $TRI2ID = $this->fn_mysql_add_text( odbc_result( $result, 30 ) );
        $TRTDAT = $this->fn_mysql_add_text( odbc_result( $result, 31 ) );
        $TRTTIM = $this->fn_mysql_add_text( odbc_result( $result, 32 ) );
        $TRCASD = $this->fn_mysql_add_text( odbc_result( $result, 33 ) );
        $TRASDT = $this->fn_mysql_add_text( odbc_result( $result, 34 ) );
        $TRI1DT = $this->fn_mysql_add_text( odbc_result( $result, 35 ) );
        $TRI2DT = $this->fn_mysql_add_text( odbc_result( $result, 36 ) );
        $TRPOSL = $this->fn_mysql_add_text( odbc_result( $result, 37 ) );
        $TRTRCC = $this->fn_mysql_add_text( odbc_result( $result, 38 ) );
        $TRTRN  = $this->fn_mysql_add_text( odbc_result( $result, 39 ) );
        $TRATR  = $this->fn_mysql_add_text( odbc_result( $result, 40 ) );
        $TRTRFE = $this->fn_mysql_add_text( odbc_result( $result, 41 ) );
        $TRCOCC = $this->fn_mysql_add_text( odbc_result( $result, 42 ) );
        $TRCOT  = $this->fn_mysql_add_text( odbc_result( $result, 43 ) );
        $TRACO  = $this->fn_mysql_add_text( odbc_result( $result, 44 ) );
        $TRCICC = $this->fn_mysql_add_text( odbc_result( $result, 45 ) );
        $TRCIT  = $this->fn_mysql_add_text( odbc_result( $result, 46 ) );
        $TRASCC = $this->fn_mysql_add_text( odbc_result( $result, 47 ) );
        $TRASA  = $this->fn_mysql_add_text( odbc_result( $result, 48 ) );
        $TRASF  = $this->fn_mysql_add_text( odbc_result( $result, 49 ) );
        $TRASP  = $this->fn_mysql_add_text( odbc_result( $result, 50 ) );
        $TRASCR = $this->fn_mysql_add_text( odbc_result( $result, 51 ) );
        $TRI1BC = $this->fn_mysql_add_text( odbc_result( $result, 52 ) );
        $TRI1CC = $this->fn_mysql_add_text( odbc_result( $result, 53 ) );
        $TRI1A  = $this->fn_mysql_add_text( odbc_result( $result, 54 ) );
        $TRI1F  = $this->fn_mysql_add_text( odbc_result( $result, 55 ) );
        $TRI1P  = $this->fn_mysql_add_text( odbc_result( $result, 56 ) );
        $TRI1CR = $this->fn_mysql_add_text( odbc_result( $result, 57 ) );
        $TRI2BC = $this->fn_mysql_add_text( odbc_result( $result, 58 ) );
        $TRI2CC = $this->fn_mysql_add_text( odbc_result( $result, 59 ) );
        $TRI2A  = $this->fn_mysql_add_text( odbc_result( $result, 60 ) );
        $TRI2F  = $this->fn_mysql_add_text( odbc_result( $result, 61 ) );
        $TRI2P  = $this->fn_mysql_add_text( odbc_result( $result, 62 ) );
        $TRI2CR = $this->fn_mysql_add_text( odbc_result( $result, 63 ) );
        $TRC1CC = $this->fn_mysql_add_text( odbc_result( $result, 64 ) );
        $TRC1A  = $this->fn_mysql_add_text( odbc_result( $result, 65 ) );
        $TRC1AF = $this->fn_mysql_add_text( odbc_result( $result, 66 ) );
        $TRC1PF = $this->fn_mysql_add_text( odbc_result( $result, 67 ) );
        $TRC1SF = $this->fn_mysql_add_text( odbc_result( $result, 68 ) );
        $TRC1M  = $this->fn_mysql_add_text( odbc_result( $result, 69 ) );
        $TRC1MP = $this->fn_mysql_add_text( odbc_result( $result, 70 ) );
        $TRSC1R = $this->fn_mysql_add_text( odbc_result( $result, 71 ) );
        $TRC2CC = $this->fn_mysql_add_text( odbc_result( $result, 72 ) );
        $TRC2A  = $this->fn_mysql_add_text( odbc_result( $result, 73 ) );
        $TRC2AF = $this->fn_mysql_add_text( odbc_result( $result, 74 ) );
        $TRC2PF = $this->fn_mysql_add_text( odbc_result( $result, 75 ) );
        $TRC2SF = $this->fn_mysql_add_text( odbc_result( $result, 76 ) );
        $TRC2M  = $this->fn_mysql_add_text( odbc_result( $result, 77 ) );
        $TRC2MP = $this->fn_mysql_add_text( odbc_result( $result, 78 ) );
        $TRSC2R = $this->fn_mysql_add_text( odbc_result( $result, 79 ) );
        $TRAC1Q = $this->fn_mysql_add_text( odbc_result( $result, 80 ) );
        $TRAC1B = $this->fn_mysql_add_text( odbc_result( $result, 81 ) );
        $TRAC1T = $this->fn_mysql_add_text( odbc_result( $result, 82 ) );
        $TRAC1  = $this->fn_mysql_add_text( odbc_result( $result, 83 ) );
        $TRAC2Q = $this->fn_mysql_add_text( odbc_result( $result, 84 ) );
        $TRAC2B = $this->fn_mysql_add_text( odbc_result( $result, 85 ) );
        $TRAC2T = $this->fn_mysql_add_text( odbc_result( $result, 86 ) );
        $TRAC2  = $this->fn_mysql_add_text( odbc_result( $result, 87 ) );
        $TRPNEM = $this->fn_mysql_add_text( odbc_result( $result, 88 ) );
        $TRPNEC = $this->fn_mysql_add_text( odbc_result( $result, 89 ) );
        $TRPNCC = $this->fn_mysql_add_text( odbc_result( $result, 90 ) );
        $TRPCCD = $this->fn_mysql_add_text( odbc_result( $result, 91 ) );
        $TRTRKT = $this->fn_mysql_add_text( odbc_result( $result, 92 ) );
        $TRCRDL = $this->fn_mysql_add_text( odbc_result( $result, 93 ) );
        $TRISOL = $this->fn_mysql_add_text( odbc_result( $result, 94 ) );
        $TRMBR  = $this->fn_mysql_add_text( odbc_result( $result, 95 ) );
        $TRVEXD = $this->fn_mysql_add_text( odbc_result( $result, 96 ) );
        $TRDATI = $this->fn_mysql_add_text( odbc_result( $result, 97 ) );
        $TREXDT = $this->fn_mysql_add_text( odbc_result( $result, 98 ) );
        $TRCVVV = $this->fn_mysql_add_text( odbc_result( $result, 99 ) );
        $TRCVVI = $this->fn_mysql_add_text( odbc_result( $result, 100 ) );
        $TRCVVL = $this->fn_mysql_add_text( odbc_result( $result, 101 ) );
        $TRCVCD = $this->fn_mysql_add_text( odbc_result( $result, 102 ) );
        $TRSVCI = $this->fn_mysql_add_text( odbc_result( $result, 103 ) );
        $TRSVCD = $this->fn_mysql_add_text( odbc_result( $result, 104 ) );
        $TRVPIN = $this->fn_mysql_add_text( odbc_result( $result, 105 ) );
        $TRPBTY = $this->fn_mysql_add_text( odbc_result( $result, 106 ) );
        $TRPINB = $this->fn_mysql_add_text( odbc_result( $result, 107 ) );
        $TROFFU = $this->fn_mysql_add_text( odbc_result( $result, 108 ) );
        $TROFFL = $this->fn_mysql_add_text( odbc_result( $result, 109 ) );
        $TRPINO = $this->fn_mysql_add_text( odbc_result( $result, 110 ) );
        $TRPVKI = $this->fn_mysql_add_text( odbc_result( $result, 111 ) );
        $TRPVKC = $this->fn_mysql_add_text( odbc_result( $result, 112 ) );
        $TRPVVI = $this->fn_mysql_add_text( odbc_result( $result, 113 ) );
        $TRPVVC = $this->fn_mysql_add_text( odbc_result( $result, 114 ) );
        $TRAQCO = $this->fn_mysql_add_text( odbc_result( $result, 115 ) );
        $TRAFMT = $this->fn_mysql_add_text( odbc_result( $result, 116 ) );
        $TRPOZP = $this->fn_mysql_add_text( odbc_result( $result, 117 ) );
        $TRPOAD = $this->fn_mysql_add_text( odbc_result( $result, 118 ) );
        $TRUBDF = $this->fn_mysql_add_text( odbc_result( $result, 119 ) );
        $TRCCNV = $this->fn_mysql_add_text( odbc_result( $result, 120 ) );
        $TRSVCF = $this->fn_mysql_add_text( odbc_result( $result, 121 ) );
        $TRWSVC = $this->fn_mysql_add_text( odbc_result( $result, 122 ) );
        $TRDNFG = $this->fn_mysql_add_text( odbc_result( $result, 123 ) );
        $TRRETF = $this->fn_mysql_add_text( odbc_result( $result, 124 ) );
        $TRCZID = $this->fn_mysql_add_text( odbc_result( $result, 125 ) );
        $TRVND  = $this->fn_mysql_add_text( odbc_result( $result, 126 ) );
        $TRVNDQ = $this->fn_mysql_add_text( odbc_result( $result, 127 ) );
        $TRDOC1 = $this->fn_mysql_add_text( odbc_result( $result, 128 ) );
        $TRDOC2 = $this->fn_mysql_add_text( odbc_result( $result, 129 ) );
        $TRDOC  = $this->fn_mysql_add_text( odbc_result( $result, 130 ) );
        $TRSPDY = $this->fn_mysql_add_text( odbc_result( $result, 131 ) );
        $TRSPDT = $this->fn_mysql_add_text( odbc_result( $result, 132 ) );
        $TRUSER = $this->fn_mysql_add_text( odbc_result( $result, 133 ) );
        $TRTOVR = $this->fn_mysql_add_text( odbc_result( $result, 134 ) );
        $TRSOVR = $this->fn_mysql_add_text( odbc_result( $result, 135 ) );
        $TROARF = $this->fn_mysql_add_text( odbc_result( $result, 136 ) );
        $TRPST1 = $this->fn_mysql_add_text( odbc_result( $result, 137 ) );
        $TRPST2 = $this->fn_mysql_add_text( odbc_result( $result, 138 ) );
        $TRRPSF = $this->fn_mysql_add_text( odbc_result( $result, 139 ) );
        $TRITKY = $this->fn_mysql_add_text( odbc_result( $result, 140 ) );
        $TRSECS = $this->fn_mysql_add_text( odbc_result( $result, 141 ) );
        $TRPROD = $this->fn_mysql_add_text( odbc_result( $result, 142 ) );
        $TROREQ = $this->fn_mysql_add_text( odbc_result( $result, 143 ) );
        $TRVDEV = $this->fn_mysql_add_text( odbc_result( $result, 144 ) );
        $TRITBF = $this->fn_mysql_add_text( odbc_result( $result, 145 ) );
        $TRABFL = $this->fn_mysql_add_text( odbc_result( $result, 146 ) );
        $TRCAFL = $this->fn_mysql_add_text( odbc_result( $result, 147 ) );
        $TRI1BF = $this->fn_mysql_add_text( odbc_result( $result, 148 ) );
        $TRI2BF = $this->fn_mysql_add_text( odbc_result( $result, 149 ) );
        $TRSND  = $this->fn_mysql_add_text( odbc_result( $result, 150 ) );
        $TRREVS = $this->fn_mysql_add_text( odbc_result( $result, 151 ) );
        $TRRCST = $this->fn_mysql_add_text( odbc_result( $result, 152 ) );
        $TRDSRN = $this->fn_mysql_add_text( odbc_result( $result, 153 ) );
        
        # Set array to insert
        $TABLE       = PREFIX.MR_AS400_TABLE;
        $FIELD_KEY   = array( 
            'D_TRMSGC',
            'D_TRMSGF',
            'D_TRMSGT',
            'D_TRMICD',
            'D_TRTRTY',
            'D_TRTRFA',
            'D_TRTRTA',
            'D_TRACTN',
            'D_TRRSPC',
            'D_TRAPR',
            'D_TRCRD',
            'D_TRXMDT',
            'D_TRXMTM',
            'D_TRSTAN',
            'D_TRRRF',
            'D_TRAQPT',
            'D_TRISPT',
            'D_TRI2PT',
            'D_TRAQND',
            'D_TRISND',
            'D_TRI2ND',
            'D_TRNTID',
            'D_TRGWAY',
            'D_TRMCAT',
            'D_TRCAID',
            'D_TRCATI',
            'D_TRCATA',
            'D_TRAQID',
            'D_TRI1ID',
            'D_TRI2ID',
            'D_TRTDAT',
            'D_TRTTIM',
            'D_TRCASD',
            'D_TRASDT',
            'D_TRI1DT',
            'D_TRI2DT',
            'D_TRPOSL',
            'D_TRTRCC',
            'D_TRTRN',
            'D_TRATR',
            'D_TRTRFE',
            'D_TRCOCC',
            'D_TRCOT',
            'D_TRACO',
            'D_TRCICC',
            'D_TRCIT',
            'D_TRASCC',
            'D_TRASA',
            'D_TRASF',
            'D_TRASP',
            'D_TRASCR',
            'D_TRI1BC',
            'D_TRI1CC',
            'D_TRI1A',
            'D_TRI1F',
            'D_TRI1P',
            'D_TRI1CR',
            'D_TRI2BC',
            'D_TRI2CC',
            'D_TRI2A',
            'D_TRI2F',
            'D_TRI2P',
            'D_TRI2CR',
            'D_TRC1CC',
            'D_TRC1A',
            'D_TRC1AF',
            'D_TRC1PF',
            'D_TRC1SF',
            'D_TRC1M',
            'D_TRC1MP',
            'D_TRSC1R',
            'D_TRC2CC',
            'D_TRC2A',
            'D_TRC2AF',
            'D_TRC2PF',
            'D_TRC2SF',
            'D_TRC2M',
            'D_TRC2MP',
            'D_TRSC2R',
            'D_TRAC1Q',
            'D_TRAC1B',
            'D_TRAC1T',
            'D_TRAC1',
            'D_TRAC2Q',
            'D_TRAC2B',
            'D_TRAC2T',
            'D_TRAC2',
            'D_TRPNEM',
            'D_TRPNEC',
            'D_TRPNCC',
            'D_TRPCCD',
            'D_TRTRKT',
            'D_TRCRDL',
            'D_TRISOL',
            'D_TRMBR',
            'D_TRVEXD',
            'D_TRDATI',
            'D_TREXDT',
            'D_TRCVVV',
            'D_TRCVVI',
            'D_TRCVVL',
            'D_TRCVCD',
            'D_TRSVCI',
            'D_TRSVCD',
            'D_TRVPIN',
            'D_TRPBTY',
            'D_TRPINB',
            'D_TROFFU',
            'D_TROFFL',
            'D_TRPINO',
            'D_TRPVKI',
            'D_TRPVKC',
            'D_TRPVVI',
            'D_TRPVVC',
            'D_TRAQCO',
            'D_TRAFMT',
            'D_TRPOZP',
            'D_TRPOAD',
            'D_TRUBDF',
            'D_TRCCNV',
            'D_TRSVCF',
            'D_TRWSVC',
            'D_TRDNFG',
            'D_TRRETF',
            'D_TRCZID',
            'D_TRVND',
            'D_TRVNDQ',
            'D_TRDOC1',
            'D_TRDOC2',
            'D_TRDOC',
            'D_TRSPDY',
            'D_TRSPDT',
            'D_TRUSER',
            'D_TRTOVR',
            'D_TRSOVR',
            'D_TROARF',
            'D_TRPST1',
            'D_TRPST2',
            'D_TRRPSF',
            'D_TRITKY',
            'D_TRSECS',
            'D_TRPROD',
            'D_TROREQ',
            'D_TRVDEV',
            'D_TRITBF',
            'D_TRABFL',
            'D_TRCAFL',
            'D_TRI1BF',
            'D_TRI2BF',
            'D_TRSND',
            'D_TRREVS',
            'D_TRRCST',
            'D_TRDSRN'        
        );
        
        $FIELD_VALUE = array( 
            $TRMSGC,
            $TRMSGF,
            $TRMSGT,
            $TRMICD,
            $TRTRTY,
            $TRTRFA,
            $TRTRTA,
            $TRACTN,
            $TRRSPC,
            $TRAPR ,
            $TRCRD ,
            $TRXMDT,
            $TRXMTM,
            $TRSTAN,
            $TRRRF ,
            $TRAQPT,
            $TRISPT,
            $TRI2PT,
            $TRAQND,
            $TRISND,
            $TRI2ND,
            $TRNTID,
            $TRGWAY,
            $TRMCAT,
            $TRCAID,
            $TRCATI,
            $TRCATA,
            $TRAQID,
            $TRI1ID,
            $TRI2ID,
            $TRTDAT,
            $TRTTIM,
            $TRCASD,
            $TRASDT,
            $TRI1DT,
            $TRI2DT,
            $TRPOSL,
            $TRTRCC,
            $TRTRN ,
            $TRATR ,
            $TRTRFE,
            $TRCOCC,
            $TRCOT ,
            $TRACO ,
            $TRCICC,
            $TRCIT ,
            $TRASCC,
            $TRASA ,
            $TRASF ,
            $TRASP ,
            $TRASCR,
            $TRI1BC,
            $TRI1CC,
            $TRI1A ,
            $TRI1F ,
            $TRI1P ,
            $TRI1CR,
            $TRI2BC,
            $TRI2CC,
            $TRI2A ,
            $TRI2F ,
            $TRI2P ,
            $TRI2CR,
            $TRC1CC,
            $TRC1A ,
            $TRC1AF,
            $TRC1PF,
            $TRC1SF,
            $TRC1M ,
            $TRC1MP,
            $TRSC1R,
            $TRC2CC,
            $TRC2A ,
            $TRC2AF,
            $TRC2PF,
            $TRC2SF,
            $TRC2M ,
            $TRC2MP,
            $TRSC2R,
            $TRAC1Q,
            $TRAC1B,
            $TRAC1T,
            $TRAC1 ,
            $TRAC2Q,
            $TRAC2B,
            $TRAC2T,
            $TRAC2 ,
            $TRPNEM,
            $TRPNEC,
            $TRPNCC,
            $TRPCCD,
            $TRTRKT,
            $TRCRDL,
            $TRISOL,
            $TRMBR ,
            $TRVEXD,
            $TRDATI,
            $TREXDT,
            $TRCVVV,
            $TRCVVI,
            $TRCVVL,
            $TRCVCD,
            $TRSVCI,
            $TRSVCD,
            $TRVPIN,
            $TRPBTY,
            $TRPINB,
            $TROFFU,
            $TROFFL,
            $TRPINO,
            $TRPVKI,
            $TRPVKC,
            $TRPVVI,
            $TRPVVC,
            $TRAQCO,
            $TRAFMT,
            $TRPOZP,
            $TRPOAD,
            $TRUBDF,
            $TRCCNV,
            $TRSVCF,
            $TRWSVC,
            $TRDNFG,
            $TRRETF,
            $TRCZID,
            $TRVND ,
            $TRVNDQ,
            $TRDOC1,
            $TRDOC2,
            $TRDOC ,
            $TRSPDY,
            $TRSPDT,
            $TRUSER,
            $TRTOVR,
            $TRSOVR,
            $TROARF,
            $TRPST1,
            $TRPST2,
            $TRRPSF,
            $TRITKY,
            $TRSECS,
            $TRPROD,
            $TROREQ,
            $TRVDEV,
            $TRITBF,
            $TRABFL,
            $TRCAFL,
            $TRI1BF,
            $TRI2BF,
            $TRSND ,
            $TRREVS,
            $TRRCST,
            $TRDSRN        
        );
        
        # Insert data and check if any error
        $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );
        if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
    }

    function fn_mr_dt_log_insert($result, $error) 
    {
        # Get variable
        $DATE     = date('Y-m-d');
        $TIME     = date('H:i:s');
        $DTSTAN   = $this->fn_mysql_add_text( odbc_result($result, 1) );
        $DTDTID   = $this->fn_mysql_add_text( odbc_result($result, 2) );
        $DTPHONE  = substr( odbc_result($result, 3), 0, 13 );
        $DTAMOUNT = ltrim( substr( odbc_result($result, 3), 15, 7 ), '\x00' );
        $DTSERIAL = ltrim( substr( odbc_result($result, 3), 30 ) );

        # Set array to insert
        $TABLE       = PREFIX.MR_DT_AS400_TABLE;
        $FIELD_KEY   = array( "J_DATE", "J_TIME", "J_DTSTAN", "J_DTDTID", "J_DTPHONE", "J_DTAMOUNT", "J_DTSERIAL" );
        $FIELD_VALUE = array( $DATE, $TIME, $DTSTAN, $DTDTID, $DTPHONE, $DTAMOUNT, $DTSERIAL );

        # Insert data and check if any error
        $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );
        if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
    }
    
    function fn_mr_sms_log_insert($result, $error) 
    {
        # Get variable
        $TIMESTAMP   = odbc_result($result, 1);
        $DATE        = trim(substr($TIMESTAMP, 0, 10));
        $TIME        = trim(substr($TIMESTAMP, 11));
        $ORIGINATOR  = odbc_result($result, 2);
        $DESTINATION = odbc_result($result, 3);
        $CHANNEL     = odbc_result($result, 4);
        $BODYXML     = mysql_real_escape_string(odbc_result($result, 5));
        $STATUS      = odbc_result($result, 6);

        # Set array to insert
        $TABLE       = PREFIX.MR_SMS_TABLE;
        $FIELD_KEY   = array( "B_TIMESTAMP", "B_DATE", "B_TIME", "B_ORIGINATOR", "B_DESTINATION", "B_CHANNEL", "B_BODYXML", "B_STATUS" );
        $FIELD_VALUE = array( $TIMESTAMP, $DATE, $TIME, $ORIGINATOR, $DESTINATION, $CHANNEL, $BODYXML, $STATUS );

        # Insert data and check if any error
        $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );
        if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
    }

    function fn_mb_sms_log_insert($result, $error) 
    {
        # Get variable
        $TIMESTAMP   = odbc_result($result, 1);
        $DATE        = trim(substr($TIMESTAMP, 0, 10));
        $TIME        = trim(substr($TIMESTAMP, 11));
        $ORIGINATOR  = odbc_result($result, 2);
        $DESTINATION = odbc_result($result, 3);
        $CHANNEL     = odbc_result($result, 4);
        $BODYXML     = mysql_real_escape_string(odbc_result($result, 5));
        $STATUS      = odbc_result($result, 6);

        # Set array to insert
        $TABLE       = PREFIX.MB_SMS_TABLE;
        $FIELD_KEY   = array( "C_TIMESTAMP", "C_DATE", "C_TIME", "C_ORIGINATOR", "C_DESTINATION", "C_CHANNEL", "C_BODYXML", "C_STATUS" );
        $FIELD_VALUE = array( $TIMESTAMP, $DATE, $TIME, $ORIGINATOR, $DESTINATION, $CHANNEL, $BODYXML, $STATUS );

        # Insert data and check if any error
        $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );
        if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
    }
    
    function fn_mr_node_log_insert($NDNODE, $NDDESC, $NDISTS)
    {
        # Get previous status from table
        $SQL    = "SELECT E_STATUS FROM ".PREFIX.MR_NODE_TABLE." WHERE E_NODE='$NDNODE' ORDER BY E_DATE DESC,E_TIME DESC LIMIT 0,1";
        $result = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );
        $row    = mysql_fetch_assoc( $result );
        
        # Check if status change
        $STATUS_CHANGE = FALSE;
        if( $row['E_STATUS']<>$NDISTS )
        {
            $TABLE         = PREFIX.MR_NODE_TABLE;
            $FIELD_KEY     = array( "E_DATE", "E_TIME", "E_NODE", "E_DESCRIPTION", "E_STATUS" );
            $FIELD_VALUE   = array( date("y-m-d"), date("H:i:s"), $NDNODE, $NDDESC, $NDISTS );
            $STATUS_CHANGE = TRUE;
            
            # Run insert function
            $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );    
            if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
            
            # Send Alert Mail
            if ( $this->LOG_MAIL && $NDISTS == 'O' ) 
            {
                $this->fn_send_mail( date( 'Y-m-d H:i:s' )." EuroMIS Alert : Node MR $NDNODE ($NDDESC) OFFLINE", "Node $NDNODE for $NDDESC is indication problem, status is OFF");
            }                                    
        }
        
        # Return 1 if status has changed
        if( $STATUS_CHANGE === FALSE )
        { return 0; }
        else
        { return 1; }
        
    }   
    
    function fn_mr_module_log_insert($MDNAME, $MDDESC, $MDMSTA)
    {
        # Get previous status from table
        $SQL    = "SELECT F_STATUS FROM ".PREFIX.MR_MODULE_TABLE." WHERE F_MODULE='$MDNAME' ORDER BY F_DATE DESC,F_TIME DESC LIMIT 0,1";
        $result = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );
        $row    = mysql_fetch_assoc( $result );

        $DATE   = date("Y-m-d");
        $TIME   = date("H:i:s");        
        
        # Check if status change
        $STATUS_CHANGE = FALSE;
        if( $row['F_STATUS']<>$MDMSTA )
        {
            $TABLE         = PREFIX.MR_MODULE_TABLE;
            $FIELD_KEY     = array( "F_DATE", "F_TIME", "F_MODULE", "F_DESCRIPTION", "F_STATUS" );
            $FIELD_VALUE   = array( $DATE, $TIME, $MDNAME, $MDDESC, $MDMSTA );
            $STATUS_CHANGE = TRUE;
            
            # Run insert function
            $result = $this->fn_insert_record( $TABLE, $FIELD_KEY, $FIELD_VALUE );
            if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
            
            # Send Alert Mail
            if ( $this->LOG_MAIL && $MDMSTA <> 'A' ) 
            {
                $this->fn_send_mail( date( 'Y-m-d H:i:s' )." EuroMIS Alert : Module MR $MDNAME ($MDDESC) OFFLINE", "Module $MDNAME for $MDDESC is indication problem, status is OFF");
            }                    
        }
        
        # Return 1 if status has changed
        if( $STATUS_CHANGE === FALSE )
        { return 0; }
        else
        { return 1; }
    }                             

    function fn_itm_node_log_insert($NDNODE, $NDDESC, $NDISTS, $NDCHGD)
    {
        # Get previous status from table
        $SQL    = "SELECT G_STATUS FROM ".PREFIX.ITM_NODE_TABLE." WHERE G_NODE='$NDNODE' ORDER BY G_DATE DESC,G_TIME DESC LIMIT 0,1";
        $result = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );
        $row    = mysql_fetch_assoc( $result );
        
        $DATE   = substr( $NDCHGD, 0, 10 );
        $TIME   = str_replace( ".", " ", substr( $NDCHGD, 12, 8 ) );
        $DIFF   = $this->fn_get_time_difference( $DATE." ".$TIME, date('Y-m-d H:i:s') );        
        
        # Check if status change
        $STATUS_CHANGE = FALSE;
        if( $row['G_STATUS']<>$NDISTS )
        {
            $table         = PREFIX.ITM_NODE_TABLE;
            $key_field     = array( "G_DATE", "G_TIME", "G_NODE", "G_DESCRIPTION", "G_STATUS" );
            $value_field   = array( $DATE, $TIME, $NDNODE, $NDDESC, $NDISTS );
            $STATUS_CHANGE = TRUE;
            
            # Run insert function
            $result = $this->fn_insert_record( $table, $key_field, $value_field );
            if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
            
            # Send Alert Mail
            if ( $this->LOG_MAIL_NODE && $NDISTS == 'O' && $DIFF['minutes'] >= THRESHOLD_DOWNTIME && $NDNODE<>'MIS' ) 
            {
                $this->fn_send_mail( date( 'Y-m-d H:i:s' )." EuroMIS Alert : ITM Node $NDNODE ($NDDESC) OFFLINE", "Node $NDNODE for $NDDESC is indication problem, status is OFF for ".$DIFF['minutes']." minutes." );
            }                    
        }
        
        # Return 1 if status has changed
        if( $STATUS_CHANGE === FALSE )
        { return 0; }
        else
        { return 1; }
    }                             

    function fn_itm_atm_log_insert($MTVDEV, $MTLOC, $STATE, $STECHGD, $CRCPLV)
    {
        # Get previous status from table
        $SQL    = "SELECT H_STATUS,H_CASH_STATUS FROM ".PREFIX.ITM_ATM_TABLE." WHERE H_ATMID='$MTVDEV' ORDER BY H_DATE DESC,H_TIME DESC LIMIT 0,1";
        $result = mysql_query( $SQL ) or $this->fn_error_log( ERROR_ON_QUERY . ' : '.mysql_error() . ' : ' . $SQL );
        $row    = mysql_fetch_assoc( $result );
        
        $DATE        = substr( $STECHGD, 0, 10 );
        $TIME        = str_replace( ".", " ", substr( $STECHGD, 12, 8 ) );
        $CASH_STATUS = intval( floor( $CRCPLV*100 ) );
        $DIFF        = $this->fn_get_time_difference( $DATE." ".$TIME, date('Y-m-d H:i:s') );
        
        $CASH_STATUS_LOW = 0;
        if ( $CASH_STATUS < CASH_LOW_THRESHOLD ) $CASH_STATUS_LOW = 1;
                 
        # Check if status change
        $STATUS_CHANGE = FALSE;
        if( $row['H_STATUS']<>$STATE || $row['H_CASH_STATUS']<>$CASH_STATUS_LOW )
        {
            $table         = PREFIX.ITM_ATM_TABLE;
            $key_field     = array( "H_DATE", "H_TIME", "H_ATMID", "H_LOCATION", "H_STATUS", "H_CASH_STATUS" );
            $value_field   = array( $DATE, $TIME, $MTVDEV, $MTLOC, $STATE, $CASH_STATUS_LOW );
            $STATUS_CHANGE = TRUE;
            
            # Run insert function
            $result = $this->fn_insert_record( $table, $key_field, $value_field );
            if ( $result === false ) $this->fn_error_log( ERROR_ON_QUERY . " : $error : " . mysql_error() );
            
            # Send Alert Mail for ATM Status Change
            if ( $this->LOG_MAIL && $STATE <> '1' && $DIFF['minutes'] >= THRESHOLD_DOWNTIME ) 
            {
                $this->fn_send_mail( date( 'Y-m-d H:i:s' )." EuroMIS Alert : ATM $MTVDEV ($MTLOC) OFFLINE", "ATM $MTVDEV on $MTLOC is indication problem, status is OFFLINE for ".$DIFF['minutes']." minutes." );
            }                    
            
            # Send Alert Mail for ATM Cash Status Change
            if ( $this->LOG_MAIL && $CASH_STATUS < CASH_LOW_THRESHOLD ) 
            {
                $this->fn_send_mail( date( 'Y-m-d H:i:s' )." EuroMIS Alert : ATM $MTVDEV ($MTLOC) CASH LOW", "ATM $MTVDEV on $MTLOC is indication cash low. Cash status is $CASH_STATUS%.");
            }
            
        }
        
        # Return 1 if status has changed
        if( $STATUS_CHANGE === FALSE )
        { return 0; }
        else
        { return 1; }
    }                             
               
    ##################################################### EUROMIS LOG INSERT FUNCTION #####################################################
    
}                                  

?>