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

function com_install(){
	global $database, $mosConfig_db, $mosConfig_dbprefix, $mainframe;		
	
	if( defined('_JEXEC') ){
		//joomla 1.5
		$database = JFactory::getDBO();
	}		
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_components (
  `id` int(11) NOT NULL auto_increment,
  `component_groupid` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();
	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_items (
  `id` int(11) NOT NULL auto_increment,
  `itemid_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version
$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_sections (
   `id` int(11) NOT NULL auto_increment,
  `section_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version
$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_menuaccess (
   `id` int(11) NOT NULL auto_increment,
  `menuid_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version	
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_categories (
   `id` int(11) NOT NULL auto_increment,
  `category_groupid` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

//take this out for free version		
	$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_modules (
   `id` int(11) NOT NULL auto_increment,
  `module_groupid` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
)");
	$database->query();

	$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_usergroups (
	   `id` int(11) NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
   PRIMARY KEY  (`id`)
	)");
		$database->query();


//check if the default 2 usergroups are already there
$database->setQuery("SELECT id FROM #__fua_usergroups WHERE id='9' LIMIT 1 ");
$defaultgroups = $database -> loadObjectList();
if(count($defaultgroups)>0){
	$defaultgroup = $defaultgroups[0];
	$defaultgroup_id = $defaultgroup->id;
}else{
	$defaultgroup_id = 0;
}

//if the 2 default usergroups are not already there do insert
if($defaultgroup_id!='9'){
	$database->setQuery("INSERT INTO #__fua_usergroups (`id`, `name`, `description`) VALUES
	(9, 'logged in', 'all logged in users who have not been assigned to any usergroup'),
	(10, 'not logged in', 'all users whom are not logged in')
	");
	$database->query();
}

		
		$database->setQuery("CREATE TABLE IF NOT EXISTS #__fua_userindex (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
)");
$database->query();



if( defined('_JEXEC') ){
	//joomla 1.5
	$icon_path = 'components';
}else{
	//joomla 1.0.x
	$icon_path = '../administrator/components';
}

	//do icon
	$database->setQuery("UPDATE #__components SET admin_menu_img='$icon_path/com_frontend_user_access/images/icon.gif' WHERE link='option=com_frontend_user_access'");
	$database->query();
}

?>
<div style="width: 800px; text-align: left;">
	<h2>Frontend-User-Access</h2>	
	<p>
		Thank you for using Frontend-User-Access.		
	</p>
	<p>
		With Frontend-User-Access you can set frontend access restrictions to:
		<ul>
		<li>components</li>
		<li>modules</li>
		<li>articles (specific articles)</li>
		<li>articles by category</li>
		<li>articles by section</li>
		</ul>
	</p>
	<p>
		You can make as many usergroups as you need and assign users to them. There are 2 predefined usergroups which are very userfull: 
		<ul>
		<li>'not logged in'</li>
		<li>'logged in but not assigned to any usergroup'</li>
		</ul>
	</p>
	<p>
		You can configure for each restriction-type (components, modules, categories, sections etc.) to reverse the access, so any box ticked becomes a restriction instead of an access-right.
	</p>	
	<p>
		Check <a href="http://www.pages-and-items.com" target="_blank">www.pages-and-items.com</a> for:
	<ul>
			<li>updates</li>
			<li>support</li>
			<li>documentation</li>	
			<li>email notification service for updates and new extensions</li>		
	</ul>
	</p>
</div>