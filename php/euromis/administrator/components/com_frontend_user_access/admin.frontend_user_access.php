<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 2.1.0
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license GPL versions free/trial/pro
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

//no direct access
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Restricted access');
}

//globals
global $task, $sub_task, $my, $database;

//get vars
$task = JRequest::getVar('task', '');
$sub_task = JRequest::getVar('sub_task', '');

//include class
require_once(dirname(__FILE__).'/class.php');
$class_fua = new class_fua();	

//redirect if trialversion is expired
if(!$class_fua->fua_check_trial_version() && $task!='expired'){			
	$class_fua->redirect_to_url("index2.php?option=com_frontend_user_access&task=expired");			
}

//set default
if(!$task){	
	$url = 'index2.php?option=com_frontend_user_access&task='.$class_fua->fua_config['default_tab'];	
	$mainframe->redirect($url);	
}

$task_functions_array = array('components_save','users_save','usergroup_save','usergroup_delete','url_save','access_items_save','access_sections_save','access_categories_save','config_save','url_delete','url_new_save','modules_save','instructions_modules','menuaccess_save');
if (in_array($task, $task_functions_array)){
	//do function
	$class_fua->$task();	
}else{	
	//get admin page
	$class_fua->set_title();
	require_once(dirname(__FILE__).'/admin/'.$task.'.php');	
}

?>