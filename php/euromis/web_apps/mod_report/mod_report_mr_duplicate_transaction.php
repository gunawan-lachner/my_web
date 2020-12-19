<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_report";
$script_name        = "mod_report_mr_duplicate_transaction.php";
$script_helper_name = "mod_report_mr_duplicate_transaction_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.maskedinput-1.2.2.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.core.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.datepicker.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.widget.js"></script>');

$document->addCustomTag('<link rel="stylesheet" type="text/css" href="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/css/ui-lightness/jquery.ui.all.css" />');

# Get username
$user =& JFactory::getUser();
$username = $user->name; 

?>

<script type="text/javascript">

$(document).ready(function()
{          
    $('#date_from').datepicker({ dateFormat: 'yy-mm-dd' });        
    $('#date_from').mask('9999-99-99');     

    $('#date_to').datepicker({ dateFormat: 'yy-mm-dd' });        
    $('#date_to').mask('9999-99-99');     
    
    $('#process').click(function() {
        var date_from = $('#date_from').val();
        var date_to   = $('#date_to').val();
        
        $('#check_result').text('');
        
        $('#check_result').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 0, date_from: date_from, date_to: date_to});
        
    });            
}); 
</script>

<center>
<div id="page0">

<div id="page_title"><?php echo PAGE_TITLE_20; ?></div>

<div class="module-blueboxshadow">
<div><div><div><div>

<table cellpadding="5">

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
<td align="center" colspan="6"><input type="submit" name="process" id="process" value="Check!"></td>
</tr>

<tr>
<td align="center" colspan="6"><textarea cols="50" rows="10" id="check_result"></textarea></td>
</tr>

</table>

</div></div></div></div></div>

<div id="progress"></div>
<br>
<div id="progress_bar"></div>

</div>
</center>