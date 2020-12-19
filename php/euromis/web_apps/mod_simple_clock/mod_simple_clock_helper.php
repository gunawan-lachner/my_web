<?php

# Load the global function
require_once("../global/process-helper.php");
            
$task = trim($_POST['t']);

switch($task)
{
    default:
    echo date("d F Y - H:i:s");
    break;
}
?>
