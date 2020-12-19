<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_report";
$script_name        = "mod_report_btpn_edc_general_monthly_report.php";
$script_helper_name = "mod_report_btpn_edc_general_monthly_report_create.php";

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

<div id="page_title"><?php echo PAGE_TITLE_4; ?></div>

<div class="module-blueboxshadow">
<div><div><div><div>

<form action="<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>" method="post">
<table cellpadding="5">

<tr align="left">

<td width="100"><strong>Report Month</strong></td><td width="3">:</td>
<td>
<select name="report_month" id="report_month">
<?php
    for($i=1; $i<=12; $i++)
    {
        $month_no   = str_pad($i, 2, "0", STR_PAD_LEFT);
        $month_name = str_pad($i+1, 2, "0", STR_PAD_LEFT);
        $DATE       = $euromis->fn_dateCalc("2000-$month_name-01", "-1 month");
        
        $report_month_name = $euromis->fn_dateFormat($DATE, "F");
        
        if ( ($i + 1) == date("n") ) { $selected = 'selected'; } else { $selected = ''; }
        echo "<option value=\"$month_no\" $selected>$report_month_name</option>\r\n";
    }
?>
</select>
</td>

<td>
<select name="report_year" id="report_year">
<?php
    $year = date("Y");
    
    for($i=$year-3; $i<=$year; $i++)
    {        
        if ( $i == $year ) { $selected = 'selected'; } else { $selected = ''; }
        echo "<option value=\"$i\" $selected>$i</option>\r\n";
    }
?>
</select>
</td>

</tr>

<tr>      
<td align="center" colspan="4">
<input type="submit" name="process" id="process" value="Create Report">
<input type="hidden" name="random" value="<?php echo $random; ?>">
<input type="hidden" name="t" value="1">
</td>
</tr>

</table>
</form>

</div></div></div></div></div>    

<div id="progress"></div>
<br>
<div id="progress_bar"></div>

</div>
</center>