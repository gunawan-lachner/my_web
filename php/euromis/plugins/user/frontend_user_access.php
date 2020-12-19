<?php
/**
* @package plugin Admin-User-Access (user plugin for component Admin-User-Access)
* @version 1.1.0
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license GPL versions free/trail/pro 
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

//no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgUserFrontend_user_access extends JPlugin {

	function plgUserFrontend_user_access(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}	
	
	function onAfterStoreUser($user, $isnew, $success, $msg)
	{
		global $mainframe;	
		
		//get default usergroup from config
		if(file_exists(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php')){			
			include(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php');
		}
		$default_usergroup = intval($fua_config['default_usergroup']);
				
		if ($isnew && $default_usergroup!=0)
		{		
			$database = JFactory::getDBO();		
			$user_id = $user['id'];					
			$database->setQuery( "INSERT INTO #__fua_userindex SET user_id='$user_id', group_id='$default_usergroup' ");
			$database->query();
		}		
	}	
	
	function onAfterDeleteUser($user, $succes, $msg)
	{
		global $mainframe;
		
		$user_id = $user['id'];
		$database = JFactory::getDBO();	
		$database->setQuery("DELETE FROM #__fua_userindex WHERE user_id='$user_id'");
		$database->query();		 	
	}	
	
	function onLoginUser($user, $options)
	{
		global $mainframe;
		$database = JFactory::getDBO();	

		//$user_id = $user['id']; why on earth is the user id not parsed?	
		$user_email = $user['email'];	
		
		//get user id from email
		$database->setQuery("SELECT id "
		."FROM #__users  "
		."WHERE email='$user_email' "
		."LIMIT 1 "
		);
		$rows = $database->loadObjectList();
		$user_id = 0;
		foreach($rows as $row){	
			$user_id = $row->id;	
		}		
		
		//select fua-usergroup		
		$database->setQuery("SELECT group_id "
		."FROM #__fua_userindex  "
		."WHERE user_id='$user_id' "
		."LIMIT 1 "
		);
		$rows = $database->loadObjectList();
		$group_id = 0;
		foreach($rows as $row){	
			$group_id = $row->group_id;	
		}		
		
		//continue only if there is a group_id
		if($group_id){
			//get redirect url
			$database->setQuery("SELECT url "
			."FROM #__fua_usergroups  "
			."WHERE id='$group_id' "
			."LIMIT 1 "
			);
			$rows = $database->loadObjectList();
			$url = 0;
			foreach($rows as $row){	
				$url = $row->url;	
			}
			
			if($url){
				$mainframe->redirect($url);
			}		
		}else{
			//user is logged in but is not assigned to any usergroup
			if(file_exists(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php')){			
				include(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php');
			}			
			$redirect_url = 0;
			if($fua_config['redirect_url']){
				$redirect_url = $fua_config['redirect_url'];
			}	
			if($redirect_url){//workaround for if the var is not in the config yet		
				$mainframe->redirect($redirect_url);
			}
		}
		
		return true;
	}
}
?>