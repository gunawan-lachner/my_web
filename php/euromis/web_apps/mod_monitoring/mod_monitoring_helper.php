<?php

# Load the global function
require_once("../global/process-helper.php");
require_once("../includes/JAK8583.class.php");

# Create object
$euromis = new webapps();

# Get post parameter for task
$task = trim($_POST['t']);

# Choose task function
switch($task)
{
    # Monitoring MR Module
    case 1:              
    include_once( "monitoring/monitoring_mr_module.php" );           
    break;    
    
    # Monitoring MR Node
    case 2:
    include_once( "monitoring/monitoring_mr_node.php" );           
    break;

    # Monitoring MR Module History
    case 3:
    include_once( "monitoring/monitoring_mr_module_history.php" );           
    break;
        
    # Monitoring MR Node History
    case 4:
    include_once( "monitoring/monitoring_mr_node_history.php" );           
    break;
    
    # Monitoring ITM node
    case 5:    
    include_once( "monitoring/monitoring_itm_node.php" );           
    break;
    
    # Monitoring ITM ATM
    case 6:
    include_once( "monitoring/monitoring_itm_atm.php" );           
    break;       

    # Monitoring ITM ATM History
    case 7:
    include_once( "monitoring/monitoring_itm_atm_history.php" );
    break;    
        
    # Monitoring ITM Node History
    case 8:
    include_once( "monitoring/monitoring_itm_node_history.php" );
    break;    
    
    # Monitoring MR Transaction Info
    case 9:
    include_once( "monitoring/monitoring_mr_transaction_info.php" );
    break;    

    # Monitoring ATM Info
    case 10:
    include_once( "monitoring/monitoring_itm_atm_info.php" );
    break;    

    # Monitoring ATM Transaction Info
    case 11:
    include_once( "monitoring/monitoring_itm_atm_transaction_info.php" );
    break;    
	# Monitoring ATM Transaction Info
    case 12:
    include_once( "monitoring/monitoring_itm_nonatm_transaction_info.php" );
    break; 
    
}

?>