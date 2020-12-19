<?php
# Set default Time Zone
date_default_timezone_set("Asia/Jakarta");

# Set PHP Execution Time
set_time_limit(60);

# Change this variable to fit your desired character coding.
# $encoding = "iso-8859-1";
$encoding = "utf-8";

$joomlaversion ="15";  # (Should be 10 for joomla 1.0.x branch and 15 for joomla 1.5.x branch.)

# change this variable to reflect joomla instalation directory.
# define( "JOOMLADIR"      , "/var/www" ); # LINUX
define( "JOOMLADIR"      , "c:\\wamp\\www\\euromis\\" ); # For Windows Environment

#####################################################################################
## Don't change anything from here on, unless you know exactly what your're doing. ##
#####################################################################################
# define( "ROOT"           ,  "/var/www/" ); # LINUX
define( "ROOT"           ,   "c:\\wamp\\www" );
define( "WEB_FOLDER"     ,   "euromis" );
define( "ROOT_FOLDER"    ,   "web_apps" );
define( "INI_FOLDER"     ,   "ini_files" );
define( "DATABASE_TYPE"  ,   "maxsql" );
define( "UPLOAD_PATH"    ,   "/uploads" );
# define( "UPLOAD_FOLDER"  ,   ROOT."/".WEB_FOLDER."/uploads/" ); # LINUX
define( "UPLOAD_FOLDER"  ,   ROOT."\\".WEB_FOLDER."\\web_apps\\uploads\\" );
# define( "LOG"            ,   ROOT."/".WEB_FOLDER."/log/web_apps.txt" ); # LINUX
define( "LOG"            ,   ROOT."\\".WEB_FOLDER."\\web_apps\\log\\web_apps.txt" );
# define( "PROGRESS_FILE"  ,   ROOT."/".WEB_FOLDER."/tmp_files/_progress.tmp" ); # LINUX
define( "ERROR_LOG"      ,   ROOT."\\".WEB_FOLDER."\\web_apps\\log\\web_apps_error.txt" );
# define( "PROGRESS_FILE"  ,   ROOT."/".WEB_FOLDER."/tmp_files/_progress.tmp" ); # LINUX
define( "PROGRESS_FILE"  ,   ROOT."\\".WEB_FOLDER."\\web_apps\\tmp_files\\_progress.tmp" );
# define( "TMP_FILE"       ,   ROOT."/".WEB_FOLDER."/tmp_files/_temp.tmp" ); # LINUX
define( "TMP_FILE"       ,   ROOT."\\".WEB_FOLDER."\\web_apps\\tmp_files\\_temp.tmp" );
# define( "INI_SCHEDULER"  ,   ROOT."/".WEB_FOLDER."/ini_file/scheduler.ini" ); # LINUX
define( "INI_SCHEDULER"  ,   ROOT."\\".WEB_FOLDER."\\web_apps\\ini_file\\scheduler.ini" );


if ($joomlaversion=="15") {
  include_once(JOOMLADIR."configuration.php");
  $config=new JConfig;
  define( "PREFIX"   , $config->dbprefix );
  define( "OFFSET"   , $config->offset );
  define( "CACHEDIR" , $config->tmp_path );
  define( "DBUSER"   , $config->user );
  define( "DBPASS"   , $config->password );
  define( "DBNAME"   , $config->db );
  define( "DBHOST"   , $config->host );
  define( "LIVESITE" , $config->live_site );
  define( "SITENAME" , $config->sitename );
} else {
  include(JOOMLADIR."/configuration.php");
  define( "PREFIX"   , $mosConfig_dbprefix );
  define( "OFFSET"   , $mosConfig_offset );
  define( "CACHEDIR" , $mosConfig_cachepath );
  define( "DBUSER"   , $mosConfig_user );
  define( "DBPASS"   , $mosConfig_password );
  define( "DBNAME"   , $mosConfig_db );
  define( "DBHOST"   , $mosConfig_host );
  define( "LIVESITE" , $mosConfig_live_site );
  define( "SITENAME" , $mosConfig_sitename );
}


# DATABASE CONNECTION
define( "MB_DATABASE"              ,      "MB-SQL" );
define( "MB_USER"                  ,      "euromis" );
define( "MB_PASS"                  ,      "euromis" );

define( "MR_DATABASE"              ,      "MR-SQL" );
define( "MR_USER"                  ,      "euromis" );
define( "MR_PASS"                  ,      "euromis" );

define( "EWIDT_DATA_DATABASE"      ,      "EWIDT-DATA-SQL" );
define( "EWIDT_DATA2_DATABASE"     ,      "EWIDT-DATA2-SQL" );
define( "EWIDT_DATA_USER"          ,      "euromis" );
define( "EWIDT_DATA_PASS"          ,      "euromis" );

define( "EWIDT_DATA_MINER_DATABASE",      "EWIDT-DATA-MINER-SQL" );
define( "EWIDT_DATA_MINER_USER"    ,      "euromis" );
define( "EWIDT_DATA_MINER_PASS"    ,      "euromis" );

define( "EDC_DATABASE"             ,      "EDC-SQL" );
define( "EDC_USER"                 ,      "euromis" );
define( "EDC_PASS"                 ,      "euromis" );

define( "AS400MR_DATABASE"         ,      "AS400MR" );
define( "AS400MR_USER"             ,      "@ESN" );
define( "AS400MR_PASS"             ,      "CAKRA" );


# TABLE
define( "ITM_ATM_HISTORY_TABLE"    ,      "ASID_MTHIST_VIEW" );
define( "ITM_NODE_HISTORY_TABLE"   ,      "ASID_NDHIST" );    
define( "EDC_RESPONSE_CODE"        ,      "euromis_a" );
define( "MR_SMS_TABLE"             ,      "euromis_b" );
define( "MB_SMS_TABLE"             ,      "euromis_c" );
define( "MR_AS400_TABLE"           ,      "euromis_d" );
define( "MR_NODE_TABLE"            ,      "euromis_e" );
define( "MR_MODULE_TABLE"          ,      "euromis_f" );
define( "ITM_NODE_TABLE"           ,      "euromis_g" );
define( "ITM_ATM_TABLE"            ,      "euromis_h" );
define( "RC_ITM_JUN_TABLE"         ,      "euromis_i" );
define( "MR_DT_AS400_TABLE"        ,      "euromis_j" );


# OTHER PARAMETERS
define( "SMTP_SERVER"              ,      '192.168.0.152' );
define( "SMTP_PORT"                ,      '25' );
define( "CASH_LOW_THRESHOLD"       ,      20 );
define( "THRESHOLD_DOWNTIME"       ,      2 );
define( "ERROR_ON_QUERY"           ,      "Query can not be processed!" );
define( "NO_ALERT"                 ,      "NO ALERT" );
define( "TIME_EXTENDED"            ,      360 );
define( "TRIM_CHARLIST"            ,      '\x00\x09\x20\x0a\x0b\x0d' );

### Start ###
# Updated By: Gunawan. MR_NODE_SKIP
#define( "MR_NODE_SKIP"             ,      "( 'ABL','CAK','SAT','GEF' )" );
define( "MR_NODE_SKIP"             ,      "( 'AXS','AXT','BPR','PMT' )" );
### End ###

### Start ###
# Updated By: Gunawan. ITM_ATM_NODE_SKIP
define( "ITM_ATM_NODE_SKIP"         ,      "( '%BTPN%' )" );
### End ###


define( "MR_MODULE_SKIP"           ,      "( 'DMO01','CMG01','ABL01','DDC01','NDC01','BSC01','FNC01','TCP02','IRT01','HSB01','X2502','X2505','X2503','RSM01','RTR01','RSU01','HCP01','LOG01','LOG02','SAT01','GEF01','TCP07','TCP08' )" );
#define( "EURONET_PIC_MAIL"         ,      "sandi.fajariadi@id.g4s.com" );
define( "EURONET_PIC_MAIL"         ,      "sandi.fajariadi@id.g4s.com;adi.purwanto@id.g4s.com;helpdesk@id.g4s.com;helpdesk-head@id.g4s.com" );
define( "EURONET_PIC"              ,
       '<table cellpadding="5" border="0" align="left">                
        <tr><td width="100">Yudi Nusdal</td><td>:</td><td></td></tr>
        <tr><td width="100">Agus Salim</td><td>:</td><td>0812 83621500</td></tr>                
        <tr><td width="100">Ikhwan</td><td>:</td><td>0819 32309419</td></tr>                
        <tr><td width="100">Sandi Fajariadi</td><td>:</td><td>0812 9979873</td></tr>                
        <tr><td width="100">Dolly Prasetia</td><td>:</td><td>0813 88597411</td></tr>
        <tr><td width="100">Saryani</td><td>:</td><td>0859 20792088</td></tr>
        </table>'
       );


# PAGE TITLE
define( "PAGE_TITLE_1"             ,      'DANAMON MONTHLY REPORT' );
define( "PAGE_TITLE_2"             ,      'RE-TRIGGER EWIDT TO UPDATE' );
define( "PAGE_TITLE_3"             ,      'RECHARGE USER HISTORY' );
define( "PAGE_TITLE_4"             ,      'BTPN EDC GENERAL MONTHLY REPORT' );
define( "PAGE_TITLE_5"             ,      'MOBILE RECHARGE SMS LOG' );
define( "PAGE_TITLE_6"             ,      'MOBILE BANKING SMS LOG' );
define( "PAGE_TITLE_7"             ,      'MOBILE RECHARGE MIS REGISTRATION REPORT' );
define( "PAGE_TITLE_8"             ,      'ATM MIS REPORT' );
define( "PAGE_TITLE_9"             ,      'MOBILE RECHARGE MIS TRANSACTION REPORT' );
define( "PAGE_TITLE_10"            ,      'ISO PARSING' );
define( "PAGE_TITLE_11"            ,      'SCHEDULER CONFIGURATION' );
define( "PAGE_TITLE_12"            ,      'EURONET MONITORING' );
define( "PAGE_TITLE_13"            ,      'AS400 MR TRANSACTION LOG' );
define( "PAGE_TITLE_14"            ,      'AS400 MR MODULE HISTORY LOG' );
define( "PAGE_TITLE_15"            ,      'AS400 MR NODE HISTORY LOG' );
define( "PAGE_TITLE_16"            ,      'AS400 MR SERIAL NUMBER LOG' );
define( "PAGE_TITLE_17"            ,      'GET SERIAL NUMBER FROM STAN' );
define( "PAGE_TITLE_18"            ,      'ITM NODE HISTORY LOG' );
define( "PAGE_TITLE_19"            ,      'ATM REPLENISHMENT STATUS' );
define( "PAGE_TITLE_20"            ,      'CITIBANK DUPLICATE TRANSACTION CHECK BY TERMINAL ID' );

?>