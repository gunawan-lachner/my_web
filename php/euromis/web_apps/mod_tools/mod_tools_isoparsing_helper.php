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
    # Display file type select
    case 0:                     
    $isomessage = $_POST['isomessage'];
                  
    $ISOlog = "";
    
    $iso = new JAK8583();
                
    $message  = $iso->getISO();

    $iso->addISO($isomessage);
    $message_response = "MTI: " . $iso->getMTI() . "\r\n";
    $message_response .= "Data Element: \r\n"; 
    $message_response .= $euromis->fn_get_data_element($iso->getData());
    
    $ISOlog = '<textarea cols="50" rows="15">'.$message_response.'</textarea>';    
            
    echo $ISOlog;
    
    break;    
}

?>