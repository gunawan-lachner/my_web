<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_tools";
$script_name        = "mod_tools_retrigger_ewidt.php";
$script_helper_name = "mod_tools_retrigger_ewidt_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

# Load javascript
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.core.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.widget.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.progressbar.js"></script>');
$document->addCustomTag('<link rel="stylesheet" type="text/css" href="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/css/ui-lightness/jquery.ui.all.css" />');

# Get username
$user =& JFactory::getUser();
$username = $user->name; 

?>
<script type="text/javascript">
$(document).ready(function()
{   
    $('#before').html('<img src="<?php echo ROOT_FOLDER."/".$script_folder."/"; ?>ajax-loader.gif">');
    $('#before').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1}, function(data){
        
        $('#process').attr("disabled", false);
        
    });
       
    $('#process').click(function(){
        
        $('#result').html('<img src="<?php echo ROOT_FOLDER."/".$script_folder."/"; ?>ajax-loader.gif">');
        $('#result').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2}, function(data){
        
            $('#process').attr("disabled", true);
        
        });
            
    });             
}); 
</script> 

<center>
<div id="page0">

<div id="page_title"><?php echo PAGE_TITLE_2; ?></div>

<div class="module-blueboxshadow">
<div><div><div><div>

<table cellpadding="5">

<tr align="center">
<td width="300">
<div id="before"></div>
</td>
</tr>

<tr align="center">
<td><input type="submit" name="process" id="process" value="Re-Trigger" disabled="disabled"></td>
</tr>

<tr align="center">
<td>
<div id="result"></div>
</td>
</tr>

</table>

</div></div></div></div></div>    

</div>
</center>