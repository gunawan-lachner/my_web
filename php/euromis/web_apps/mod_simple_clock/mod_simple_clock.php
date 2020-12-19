<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

$euromis  = new webapps();
$document = &JFactory::getDocument();                              

if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

?>
<script language="javascript" type="text/javascript">   
$(document).ready(function()
{
    $('#simple-clock').load('<?php echo JURI::root(true)."/".ROOT_FOLDER; ?>/mod_simple_clock/mod_simple_clock_helper.php', {t: 0});
            
    var refreshId = setInterval(function() 
    {
        $('#simple-clock').load('<?php echo JURI::root(true)."/".ROOT_FOLDER; ?>/mod_simple_clock/mod_simple_clock_helper.php', {t: 0});
    }, 1000);
});
</script>

<table align="right">
<tr>
<td>
<div id="simple-clock"></div>
</td>
</tr>
</table>