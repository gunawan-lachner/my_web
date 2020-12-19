<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_scheduler";
$script_name        = "mod_scheduler.php";
$script_helper_name = "mod_scheduler_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}


# Load javascript
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/redmond/jquery-ui-1.7.2.custom.css');                            
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/ui.jqgrid.css');
                                                                                                                                               
# Get username
$user =& JFactory::getUser();
$username = $user->name; 
                                   
# Create random number for unique ID
$random = mt_rand();

# Get Parameters
$params = parse_ini_file( INI_SCHEDULER, TRUE );
                                   
?>

<div id="page_title"><?php echo PAGE_TITLE_11; ?></div>

<script language="javascript" type="text/javascript">  

$(document).ready(function(){

    $('#MR_TRX').click(function(){       
        
        if ( $('#MR_TRX').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'OFF'});
        }
        
    });                 

    $('#MR_DT').click(function(){       
        
        if ( $('#MR_DT').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'OFF'});
        }
        
    });                 
    
    $('#MR_SMS').click(function(){       
        
        if ( $('#MR_SMS').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 1, state: 'OFF'});
        }
        
    });                 

    $('#MB_SMS').click(function(){       
        
        if ( $('#MB_SMS').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, state: 'OFF'});
        }
        
    });                 

    $('#MR_NODE').click(function(){       
        
        if ( $('#MR_NODE').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 3, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 3, state: 'OFF'});
        }
        
    });                 

    $('#MR_MODULE').click(function(){       
        
        if ( $('#MR_MODULE').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 4, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 4, state: 'OFF'});
        }
        
    });                 
    
    $('#ITM_NODE').click(function(){       
        
        if ( $('#ITM_NODE').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 5, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 5, state: 'OFF'});
        }
        
    });                 

    $('#ITM_ATM').click(function(){       
        
        if ( $('#ITM_ATM').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 6, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 6, state: 'OFF'});
        }
        
    });                 

    $('#MR_TRX').click(function(){       
        
        if ( $('#MR_TRX').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 7, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 7, state: 'OFF'});
        }
        
    });                 

    $('#MR_DT').click(function(){       
        
        if ( $('#MR_DT').is(':checked') )
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 8, state: 'ON'});
        }
        else
        {
            $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 8, state: 'OFF'});
        }
        
    });                 
            
});        
    
</script>

<center>

<table cellpadding="5">

<tr align="left">
<td width="225"><strong>ITM MR AS400 Transactions</strong></td><td>:</td>
<td>
<input type="checkbox" id="MR_TRX" name="MR_TRX" <?php if ( $params['MR_TRX']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>ITM MR DT AS400</strong></td><td>:</td>
<td>
<input type="checkbox" id="MR_DT" name="MR_DT" <?php if ( $params['MR_DT']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>Mobile Recharge SMS Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="MR_SMS" name="MR_SMS" <?php if ( $params['MR_SMS']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>Mobile Banking SMS Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="MB_SMS" name="MB_SMS" <?php if ( $params['MB_SMS']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>Mobile Recharge Node Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="MR_NODE" name="MR_NODE" <?php if ( $params['MR_NODE']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>Mobile Recharge Module Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="MR_MODULE" name="MR_MODULE" <?php if ( $params['MR_MODULE']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>ITM Node Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="ITM_NODE" name="ITM_NODE" <?php if ( $params['ITM_NODE']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<tr align="left">
<td><strong>ITM ATM Logging</strong></td><td>:</td>
<td>
<input type="checkbox" id="ITM_ATM" name="ITM_ATM" <?php if ( $params['ITM_ATM']['ACTIVE'] == '1' ) { echo "checked"; } else { echo ""; } ?>>
</td>
</tr>

<input type="hidden" name="t" value="1">

</table>

<br>
<div id="page0">
<div id="progress"></div>
<br>
<div id="progress_bar"></div>
</div>

</center>
