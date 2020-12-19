<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 2.0.1
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license GPL versions free/trail/pro
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

//no direct access
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Restricted access');
}

$task = JRequest::getVar('task', '', 'get');


global $database, $mainframe, $my;

//get database for joomla 1.5
if(defined('_JEXEC')){	
	$database = JFactory::getDBO();
}

switch ($task) {
	case 'no_access':
	default:
		show_no_access_page();
		break;	
}

function show_no_access_page(){	
	get_language_frontend4();
	$tmpl = JRequest::getVar('tmpl', '', 'get');
	if($tmpl=='component'){
		echo '<div style="text-align: center; margin-top: 300px;">';
	}
	echo _fua_lang_no_access_page2;
	if($tmpl=='component'){
		$back = JText::_( 'back' );
		$back = str_replace('[','',$back);
		$back = str_replace(']','',$back);
		$back = strtolower($back);
		echo '<br /><a href="javascript:history.back()">'.$back.'</a>';
		echo '</div>';
	}
}

function get_language_frontend4(){

	include(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php');
	
	$language_frontend = $fua_config['language_frontend'];	
	
	//include language, defaults to english
	if(file_exists(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php')){
		include(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php');
	}else{
		include(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/english.php');
	}

}



?>