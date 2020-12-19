<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_report";
$script_name        = "mod_report_mr_mis_registration_report.php";
$script_helper_name = "mod_report_mr_mis_registration_report_create.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.maskedinput-1.2.2.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.core.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.datepicker.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.widget.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.progressbar.js"></script>');

$document->addCustomTag('<link rel="stylesheet" type="text/css" href="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/css/ui-lightness/jquery.ui.all.css" />');

# Get username
$user =& JFactory::getUser();
$username = $user->name; 

# Create random number for unique ID
$random = mt_rand();

?>

<script type="text/javascript">

var running = false;                          

function doRewrite() {
    if (running) {                                       
        $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, random: '<?php echo $random; ?>'}, function(count){

            var progress   = count.split(',');
            var percentage = parseInt( parseInt(progress[0]) / parseInt(progress[1]) * 100 );

            if( parseInt(progress[0]) == 99999 ) 
            { 
                running = false; 
                $('#progress').html('<strong>Create File Progress : DONE</strong>'); 
                $('#progress_bar').progressbar({value: 100});
                $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, random: '<?php echo $random; ?>'});
            }
            else if( parseInt(progress[0]) != 0 ) 
            {
                $('#progress').html('<strong>Create File Progress : ' + percentage + '%</strong>');
                $('#progress_bar').progressbar({value: percentage});                                                                      
            }            

        });
        setTimeout("doRewrite()", 1000);        
    }
}

$(document).ready(function()
{          
    $('#progress_bar').progressbar({value: 0});
    $('#progress_bar').hide();
    
    $('#date_from').datepicker({ dateFormat: 'yy-mm-dd' });        
    $('#date_from').mask('9999-99-99');     

    $('#date_to').datepicker({ dateFormat: 'yy-mm-dd' });        
    $('#date_to').mask('9999-99-99');     
    
    $('#process').click(function(){       
        $('#progress').html('<strong>Initializing Creating File...</strong>');
        $('#progress_bar').progressbar({value: 0});
        $('#progress_bar').show();
        running = true;
        doRewrite();          
    });             
}); 
</script>

<center>
<div id="page0">

<div id="page_title"><?php echo PAGE_TITLE_7; ?></div>

<div class="module-blueboxshadow">
<div><div><div><div>

<form action="<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>" method="post">
<table cellpadding="5">

<tr align="left">
<td width="100"><strong>Bank</strong></td><td width="3">:</td>
<td colspan="4">
<select name="bank_id" id="bank_id">
<?php 
    $SQL           = "SELECT ParticipantId, Description FROM Participants ORDER BY ParticipantId";
    $MR_CONNECTION = $euromis->fn_mr_sql();
    $result        = odbc_exec( $MR_CONNECTION, $SQL );

    while( odbc_fetch_row( $result ) )
    {                 
        $PARTICIPANT_ID = odbc_result( $result, 1 );
        $DESCRIPTION    = odbc_result( $result, 2 );
                
        echo "<option value=\"$PARTICIPANT_ID\">$DESCRIPTION</option>\r\n";   
    }                
?>
</select>
</td>
</tr>

<tr align="left">
<td width="100"><strong>From Date</strong></td><td>:</td>
<td>
<input type="text" name="date_from" id="date_from" size="8">
</td>
<td width="100"><strong>To Date</strong></td><td>:</td>
<td>
<input type="text" name="date_to" id="date_to" size="8">
</td>
</tr>

<tr>
<td align="center" colspan="6"><input type="submit" name="process" id="process" value="Create Report File"></td>
</tr>

<input type="hidden" name="random" value="<?php echo $random; ?>">
<input type="hidden" name="t" value="1">

</table>
</form>

</div></div></div></div></div>

<div id="progress"></div>
<br>
<div id="progress_bar"></div>

</div>
</center>