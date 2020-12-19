<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_tools";
$script_name        = "mod_tools_get_serial_number_from_stan.php";
$script_helper_name = "mod_tools_get_serial_number_from_stan_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

# Load javascript
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/redmond/jquery-ui-1.7.2.custom.css');                            

# Get username
$user =& JFactory::getUser();
$username = $user->name; 

?>

<script language="javascript" type="text/javascript">  

$(document).ready(function()
{
    $('#process').click(function() {
        var requestlist = $('#requestlist').val();
        var t = $('#t').val();
        
        $('#requestdata').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: t, requestlist: requestlist});
        
    });            
});

</script>                                           

<div id="page_title"><?php echo PAGE_TITLE_17; ?></div>

<center>
<div id="page0">

<table cellpadding="0" cellspacing="5" border="0">

<tr>
<td align="center" colspan="3">Operator 
<select id="t">
<option value="0">Satelindo</option>
<option value="1">Non Satelindo</option>
</select>
</td>
</tr>

<tr>
<td align="center">STAN</td>
<td>
</td>
<td align="center">SERIAL NUMBER</td>
</tr>

<tr>
<td>
<textarea name="requestlist" id="requestlist" cols="20" rows="20" class="input"></textarea>
</td>
<td>
<input type="button" value="GET >>>" name="process" id="process"/>
</td>
<td>
<textarea name="requestdata" id="requestdata" cols="20" rows="20" class="input" readonly="true"></textarea>
</td>
</tr>

</table>

<div id="isoparse"></div>

</div>
</center>