<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_monitoring";
$script_name        = "mod_monitoring.php";
$script_helper_name = "mod_monitoring_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}

# Load javascript
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/redmond/jquery-ui-1.7.2.custom.css');                            
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/inettuts/inettuts.css');                            
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/inettuts/inettuts.js.css');                            

# Get username
$user =& JFactory::getUser();
$username = $user->name; 

?>
<script type="text/javascript">

$(document).ready(function()
{
    
    var row_module   = $('#select_mr_module_history').val();
    var row_node     = $('#select_mr_node_history').val();
    var row_itm_atm  = $('#select_itm_atm_history').val();
    var row_itm_node = $('#select_itm_node_history').val();
    
    // $('#monitor_mr_module').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 1});
    $('#monitor_mr_node').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 2});
    $('#monitor_mr_module_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 3, row: row_module});
    $('#monitor_mr_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 4, row: row_node});
    $('#monitor_itm_node').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 5});
    $('#monitor_itm_atm').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 6});
    $('#monitor_itm_atm_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 7, row: row_itm_atm});
    $('#monitor_itm_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 8, row: row_itm_node});        
    $('#mr_transaction_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 9, row: row_itm_node});        
    $('#atm_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 10, row: row_itm_node});        
    $('#atm_transaction_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 11, row: row_itm_node});
        
    var refreshId = setInterval(function() 
    {
        var row_module   = $('#select_mr_module_history').val();
        var row_node     = $('#select_mr_node_history').val();
        var row_itm_atm  = $('#select_itm_atm_history').val();
        var row_itm_node = $('#select_itm_node_history').val();
        
        // $('#monitor_mr_module').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 1});
        $('#monitor_mr_node').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 2});
        $('#monitor_mr_module_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 3, row: row_module});
        $('#monitor_mr_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 4, row: row_node});
        $('#monitor_itm_node').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 5});
        $('#monitor_itm_atm').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 6});
        $('#monitor_itm_atm_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 7, row: row_itm_atm});
        $('#monitor_itm_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 8, row: row_itm_node});  
        $('#mr_transaction_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 9, row: row_itm_node});          
        $('#atm_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 10, row: row_itm_node});   
        $('#atm_transaction_info').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 11, row: row_itm_node}); 
        
    }, 10000);

    $('#select_mr_module_history').change(function() {       
        var row_node = $('#select_mr_module_history').val();
        
        $('#monitor_mr_module_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 3, row: row_module});        
    });            
    
    $('#select_mr_node_history').change(function() {       
        var row_node = $('#select_mr_node_history').val();
        
        $('#monitor_mr_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 4, row: row_node});        
    });            

    $('#select_itm_atm_history').change(function() {       
        var row_itm_atm = $('#select_itm_atm_history').val();
        
        $('#monitor_itm_atm_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 7, row: row_itm_atm});        
    });            

    $('#select_itm_node_history').change(function() {       
        var row_itm_node = $('#select_itm_node_history').val();
        
        $('#monitor_itm_node_history').load('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>', {t: 8, row: row_itm_node});        
    });            
    
});

</script>

<div id="columns">

        <ul id="column1" class="column">
            <li class="widget color-white" id="intro">
                <div class="widget-head">
                    <h3><?php echo PAGE_TITLE_12; ?></h3>
                </div>            
            </li>                                
            <li class="widget color-green">
                <div class="widget-head">
                    <h3>ATM Info</h3>
                </div>
                <div class="widget-content">
                    <div id="atm_info"></div>
                </div>
            </li>
            <li class="widget color-green">
                <div class="widget-head">
                    <h3>MR Transaction Info</h3>
                </div>
                <div class="widget-content">
                    <div id="mr_transaction_info"></div>
                </div>
            </li>
            <li class="widget color-green">
                <div class="widget-head">
                    <h3>ATM Transaction Info</h3>
                </div>
                <div class="widget-content">
                    <div id="atm_transaction_info"></div>
                </div>
            </li>            
        </ul>

        <ul id="column2" class="column">
            <li class="widget color-yellow">  
                <div class="widget-head">
                    <h3>Mobile Recharge Module</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_mr_module"></div>
                </div>
            </li>
            <li class="widget color-yellow">  
                <div class="widget-head">
                    <h3>Mobile Recharge Node</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_mr_node"></div>
                </div>
            </li>
            <li class="widget color-yellow">  
                <div class="widget-head">
                    <h3>ITM ATM Node</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_itm_node"></div>
                </div>
            </li>
            <li class="widget color-yellow">  
                <div class="widget-head">
                    <h3>ITM ATM Status</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_itm_atm"></div>
                </div>
            </li>            
        </ul>
        
        <ul id="column3" class="column">
            <li class="widget color-white">  
                <div class="widget-head">
                    <h3>Mobile Recharge Module History</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_mr_module_history"></div>
                    <center>
                    Row Count
                    <select class="select_monitoring" id="select_mr_module_history">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    </select>
                    </center>     
                    <br />               
                </div>
            </li>
            <li class="widget color-white">  
                <div class="widget-head">
                    <h3>Mobile Recharge Node History</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_mr_node_history"></div>
                    <center>
                    Row Count
                    <select class="select_monitoring" id="select_mr_node_history">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    </select>
                    </center>
                    <br />
                </div>
            </li>            
            <li class="widget color-white">  
                <div class="widget-head">
                    <h3>ITM ATM Status History</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_itm_atm_history"></div>
                    <center>
                    Row Count
                    <select class="select_monitoring" id="select_itm_atm_history">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    </select>
                    </center>
                    <br />
                </div>
            </li>            
            <li class="widget color-white">  
                <div class="widget-head">
                    <h3>ITM NODE Status History</h3>
                </div>
                <div class="widget-content">
                    <div id="monitor_itm_node_history"></div>
                    <center>
                    Row Count
                    <select class="select_monitoring" id="select_itm_node_history">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    </select>
                    </center>
                    <br />
                </div>
            </li>            
        </ul>
        
</div>

<script type="text/javascript" src="<?php echo JURI::root(true)."/".ROOT_FOLDER.'/includes/js/inettuts/jquery-ui-personalized-1.6rc2.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::root(true)."/".ROOT_FOLDER.'/includes/js/inettuts/inettuts.js'; ?>"></script>