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

//get task
JRequest::getVar('params', 'task');

//display menubar
if($task=='usergroups'){
	JToolBarHelper::addNewX('usergroup',_fua_lang_new);
	JToolBarHelper::trash( 'usergroup_delete', _fua_lang_delete, '', '', $listSelect = true );
}

if($task=='usergroup'){
	JToolBarHelper::save( 'usergroup_save', _fua_lang_save );
	JToolBarHelper::cancel( 'usergroups', _fua_lang_cancel );
}

if($task=='users'){
	JToolBarHelper::save('users_save', _fua_lang_save);
}

if($task=='pages'){
	JToolBarHelper::save( 'access_pages_save', _fua_lang_save );
}	

if($task=='sections'){
	JToolBarHelper::save( 'access_sections_save', _fua_lang_save );
}

if($task=='categories'){
	JToolBarHelper::save( 'access_categories_save', _fua_lang_save );
}

if($task=='modules'){
	JToolBarHelper::save( 'modules_save', _fua_lang_save );
}

if($task=='components'){
	JToolBarHelper::save( 'components_save', _fua_lang_save );
}	

if($task=='config'){
	JToolBarHelper::save( 'config_save', _fua_lang_save );
	JToolBarHelper::apply( 'config_apply', _fua_lang_apply );
	JToolBarHelper::cancel( 'cancel', _fua_lang_cancel );
}

if($task=='key'){
	JToolBarHelper::save( 'key_save', _fua_lang_save );
}

if($task=='items'){
	JToolBarHelper::save( 'access_items_save', _fua_lang_save );
}

if($task=='url'){		
	JToolBarHelper::save( 'url_save', _fua_lang_save );
	JToolBarHelper::addNewX('url_new',_fua_lang_new);
	JToolBarHelper::trash( 'url_delete', _fua_lang_delete, '', '', $listSelect = true );
}

if($task=='url_new'){		
	JToolBarHelper::save( 'url_new_save', _fua_lang_save );
}

if($task=='menuaccess'){		
	JToolBarHelper::save( 'menuaccess_save', _fua_lang_save );
}


?>