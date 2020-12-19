<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_tools";
$script_name        = "mod_tools_isoparsing.php";
$script_helper_name = "mod_tools_isoparsing_helper.php";

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
    $('#edcsend').click(function() {
        var isomessage = $('#isomessage').val();
        
        $('#isoparse').text('');
        
        $('#isoparse').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 0, isomessage: isomessage});
        
    });            
});

</script>                                           

<div id="page_title"><?php echo PAGE_TITLE_10; ?></div>

<center>
<div id="page0">

<textarea cols="50" rows="5" id="isomessage"></textarea>

<table cellpadding="0" cellspacing="5" border="0">
<tr align="center"><td colspan="3"><input type="button" id="edcsend" value="Parse ISO message" /></td></tr>
</table>

<div id="isoparse"></div>

</div>
</center>