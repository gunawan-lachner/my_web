<?php

# Load the global function
require_once("../global/process-helper.php");
require_once("../includes/class.ConfigMagik.php");

# Create object
$euromis = new webapps();

$INI_Editor = new ConfigMagik( INI_SCHEDULER, TRUE, TRUE );
$INI_Editor->PROTECTED_MODE = false;

# Get post parameter for task
$task  = trim( $_POST['t'] );
$state = trim( $_POST['state'] );

# Choose task function
switch($task)
{               
    case 1: 
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MR_SMS' );    
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MR_SMS' );    
        break;
    }    
    break;    
    
    case 2:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MB_SMS' );        
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MB_SMS' );            
        break;
    }    
    break;    

    case 3:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MR_NODE' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MR_NODE' );            
        break;
    }        
    break;    

    case 4:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MR_MODULE' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MR_MODULE' );            
        break;
    }        
    break;    
    
    case 5:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'ITM_NODE' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'ITM_NODE' );            
        break;
    }            
    break;        
    
    case 6:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'ITM_ATM' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'ITM_ATM' );            
        break;
    }                
    break;        
    
    case 7:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MR_TRX' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MR_TRX' );            
        break;
    }                
    break;        

    case 8:     
    switch ( $state )
    {
        case 'ON' :
        $INI_Editor->set( 'ACTIVE', 1, 'MR_DT' );            
        break;
        
        case 'OFF':
        $INI_Editor->set( 'ACTIVE', 0, 'MR_DT' );            
        break;
    }                
    break;        
    
}

?>