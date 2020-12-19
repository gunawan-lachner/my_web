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

class class_fua{

	var $fua_config;	
	var $task;	
	var $has_usergroups = false;
	var $db;
	var $user_type;
	var $bot_installed_system = false;
	var $bot_published_system = false;	
	var $bot_installed_content = false;
	var $bot_published_content = false;
	var $fua_demo_seconds_left;	
	var $version = '2.1.0';
	var $fua_version_type = 'pro';	//free trial or pro	
	
	//constructor
	function class_fua(){
		global $task, $database, $my;
		
		include(dirname(__FILE__).'/configuration.php');
		
		$this->fua_config = $fua_config;			
		$this->task = $task;
		$this->get_language();			
		
		//get database		
		$this->db = JFactory::getDBO();		
		
		//check if bot is installed		
		if(file_exists(dirname(__FILE__).'/../../../plugins/system/frontend_user_access_system.php')){
			$this->bot_installed_system = true;	
			//check if bot is published			
			$this->db->setQuery("SELECT published FROM #__plugins WHERE element='frontend_user_access_system' LIMIT 1");
			$rows = $this->db->loadObjectList();
			$row = $rows[0];						
			if($row->published==1){
				$this->bot_published_system = true;
			}		
		}		
		
		if(file_exists(dirname(__FILE__).'/../../../plugins/content/frontend_user_access_content.php')){
			$this->bot_installed_content = true;	
			//check if bot is published			
			$this->db->setQuery("SELECT published FROM #__plugins WHERE element='frontend_user_access_content' LIMIT 1");
			$rows = $this->db->loadObjectList();
			$row = $rows[0];						
			if($row->published==1){
				$this->bot_published_content = true;
			}		
		}
		
		//check for usergroups
		$usergroups = false;
		$this->db->setQuery("SELECT id FROM #__fua_usergroups LIMIT 1");
		$rows = $this->db->loadObjectList();		
		if($rows[0]!=''){
			$this->has_usergroups = true;
		}
		
		//set var user_type		
		$user =& JFactory::getUser();		
		$this->user_type = $user->get('usertype');
		
		//update tables if needed 
		//not in free version
		$this->update_tables();
					
	}
	
	function get_var($name, $default = null, $hash = 'default', $type = 'none', $mask = 0){	
		//make sure there is no $type
		if($type!='none' && $type!=''){			
			exit('don\'t use $type, it won\'t work in older versions');
		}
		if( defined('_JEXEC') ){
			//joomla 1.5
			$var = JRequest::getVar($name, $default, $hash, $type, $mask);
		}else{
			//joomla 1.0.x
			//do the thing with hash (cake anyone?)
			$hash = strtolower($hash);			
			switch ($hash) {
			case 'default':
				$hash = $_REQUEST;
				break;
			case 'get':
				$hash = $_GET;
				break;
			case 'post':
				$hash = $_POST;
				break;
			case 'files':
				exit('don\'t use FILES, it won\'t work in older versions');
				break;
			case 'method':
				exit('don\'t use METHOD, it won\'t work in older versions');
				break;
			}				
			$var = mosGetParam($hash, $name, $default, $mask);
		}
		return $var;
	}		
	
	function echo_header(){	
	
		$this->check_demo_time_left();
				   
		if($this->user_type=='Super Administrator'){
			echo '<div id="config_link"><a href="index2.php?option=com_frontend_user_access&amp;task=config">'._fua_lang_config.'</a></div>'."\n";
		}		
		
		echo '<script src="../includes/js/overlib_mini.js" language="JavaScript" type="text/javascript"></script>'."\n";
		echo '<link href="components/com_frontend_user_access/css/frontend_user_access2.css" rel="stylesheet" type="text/css" />'."\n";
			
		echo '<ul id="fua_menu">';
		if($this->fua_config['display_usergroups']){	
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=usergroups"';
			if($this->task=='usergroups' || $this->task=='usergroup'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_usergroups.'</span></a></li>';	
		}
		if($this->fua_config['display_users']){	
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=users"';
			if($this->task=='users' || $this->task=='user'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_users.'</span></a></li>';
		}
		if($this->fua_config['display_items']){				
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=items"';
			if($this->task=='items'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_item_access.'</span></a></li>';
		}
		if($this->fua_config['display_categories']){
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=categories"';
			if($this->task=='categories'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_category_access.'</span></a></li>';
		}
		if($this->fua_config['display_sections']){
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=sections"';
			if($this->task=='sections'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_section_access.'</span></a></li>';	
		}
		if($this->fua_config['display_modules']){
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=modules"';
			if($this->task=='modules'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_module_access.'</span></a></li>';	
		}
		if($this->fua_config['display_components']){		
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=components"';
			if($this->task=='components'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_component_access.'</span></a></li>';
		}	
		if($this->fua_config['display_menuaccess']){		
			echo '<li><a href="index2.php?option=com_frontend_user_access&amp;task=menuaccess"';
			if($this->task=='menuaccess'){
				echo 'class="on"';
			}
			echo '><span>'._fua_lang_menu_access.'</span></a></li>';
		}			
		echo '</ul>'."\n";		
		
		//message if there are no usergroups
		if(!$this->has_usergroups && $this->task!='usergroups' && $this->task!='usergroup'){
			echo '<div style="color: red; text-align: left;">'._fua_lang_nousergroups.'<br/><br/></div>';
		}				
		
		//message if bot is not installed	
		if(!$this->bot_installed_system){				
			echo '<div style="color: red; text-align: left;">'._fua_lang_botnotinstalled.' (system)<br/><br/></div>';
		}
		
		//message if bot is not published	
		if(!$this->bot_published_system){				
			echo '<div style="color: red; text-align: left;">'._fua_lang_botnotpublished.' (system)<br/><br/></div>';
		}	
		
		//message if bot is not installed	
		if(!$this->bot_installed_content){				
			echo '<div style="color: red; text-align: left;">'._fua_lang_botnotinstalled.' (content)<br/><br/></div>';
		}
		
		//message if bot is not published	
		if(!$this->bot_published_content){				
			echo '<div style="color: red; text-align: left;">'._fua_lang_botnotpublished.' (content)<br/><br/></div>';
		}			
	}		
	
	function usergroup_save(){			
		
		//get vars
		$id = $this->get_var('id', 0, 'post');
		$name = strip_tags($this->get_var('name', '', 'post'));
		$description = strip_tags($this->get_var('description', '', 'post'));
		$url = addslashes($this->get_var('url', '', 'post'));
		
		$name = addslashes($name);
		$description = addslashes($description);
		
		
		if($id==''){
			//new usergroup
			$this->db->setQuery( "INSERT INTO #__fua_usergroups SET name='$name', description='$description', url='$url' ");
			if (!$this->db->query()) {
				echo "<script> alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}
		}else{
			//edit usergroup
			$this->db->setQuery( "UPDATE #__fua_usergroups SET name='$name', description='$description', url='$url' WHERE id='$id' ");
			if (!$this->db->query()) {
				echo "<script> alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}
		}	
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=usergroups", _fua_lang_usergroup_saved);
	}	
	
	function usergroup_delete(){
				
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5
			$cid = JRequest::getVar('cid', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$cid = mosGetParam( $_POST, 'cid', array(0) );
		}
		
		if (!is_array($cid) || count($cid) < 1) {
			echo "<script> alert(_fua_lang_select_item_to_delete); window.history.go(-1);</script>";
			exit();
		}
		
		if (count($cid)){
			$ids = implode(',', $cid);			
			
			//update rows from user-index table which usergroup stops existing
			$this->db->setQuery("SELECT id FROM #__fua_userindex WHERE group_id IN ($ids)"  );
			$rows = $this->db ->loadObjectList();
			foreach($rows as $row){					
				$index_id = $row->id;
				$this->db->setQuery( "UPDATE #__fua_userindex SET group_id='0' WHERE id='$index_id'"	);
				if (!$this->db->query()) {
					echo "<script> alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
					exit();
				}	
			}		
			
			//delete usergroup
			$this->db->setQuery("DELETE FROM #__fua_usergroups WHERE id IN ($ids)");
		}
		if (!$this->db->query()){
			echo "<script> alert('".$this->db -> getErrorMsg()."'); window.history.go(-1); </script>";
		}
		
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=usergroups", _fua_lang_usergroup_deleted);
	}
	
	function components_save(){				
			
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5
			$components_access = JRequest::getVar('componentsAccess', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$components_access = mosGetParam( $_POST, 'componentsAccess', array(0) );
		}
		
		//empty table (no one has any rights)
		$this->empty_table('components');	
		
		//write component access		
		for($n = 0; $n < count($components_access); $n++){
			$component_right = $components_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_components SET component_groupid='$component_right'");
			if (!$this->db->query()) {
				echo "<script> alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}			
		}		
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=components", _fua_lang_component_access_saved);
	}	
	
	function empty_table($table_name){		
		
		if($table_name=='components' || $table_name=='sections' || $table_name=='categories' || $table_name=='userindex' || $table_name=='items' || $table_name=='modules' || $table_name=='menuaccess'){
			$this->db->setQuery("TRUNCATE TABLE #__fua_$table_name");
			if (!$this->db->query()){
				echo "<script> alert('".$this->db -> getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}
		}else{
			exit();
		}
	}		
	
	function config_save(){
				
		//check if writeable
		if(!is_writable(dirname(__FILE__).'/configuration.php')){
			echo "<script> alert('administrator/components/com_frontend_user_access/configuration.php "._fua_lang_confignotwriteable."'); window.history.go(-1); </script>";
			exit();
		}

		//get vars			
		$language = $this->get_var('language', 'english', 'post');
		$language_frontend = $this->get_var('language_frontend', 'english', 'post');
		$default_tab = $this->get_var('default_tab', 'false', 'post');					
		$show_joomla_group_select = $this->get_var('show_joomla_group_select', 'false', 'post');
		$default_usergroup = $this->get_var('default_usergroup', 0, 'post');
		$redirect_url = $this->get_var('redirect_url', '', 'post');
		$display_usergroups = $this->get_var('display_usergroups', 'false', 'post');
		$display_users = $this->get_var('display_users', 'false', 'post');	
		$display_items = $this->get_var('display_items', 'false', 'post');			
		$items_active = $this->get_var('items_active', 'false', 'post');
		$items_reverse_access = $this->get_var('items_reverse_access', 'false', 'post');		
		$classname_wrapper_content = $this->get_var('classname_wrapper_content', 'false', 'post');
		$classnames_wrappers_up = $this->get_var('classnames_wrappers_up', 'false', 'post');
		$classnames_wrappers_down = $this->get_var('classnames_wrappers_down', 'false', 'post');		
		$items_message_type = $this->get_var('items_message_type', 'alert', 'post');
		$items_display_type = $this->get_var('items_display_type', 'hide', 'post');	
		$display_categories = $this->get_var('display_categories', 'false', 'post');	
		$categories_active = $this->get_var('categories_active', 'false', 'post');
		$category_reverse_access = $this->get_var('category_reverse_access', 'false', 'post');
		$category_message_type = $this->get_var('category_message_type', 'alert', 'post');
		$display_sections = $this->get_var('display_sections', 'false', 'post');
		$sections_active = $this->get_var('sections_active', 'false', 'post');
		$sections_reverse_access = $this->get_var('sections_reverse_access', 'false', 'post');	
		$section_message_type = $this->get_var('section_message_type', 'alert', 'post');
		$display_modules = $this->get_var('display_modules', 'false', 'post');
		$modules_active = $this->get_var('modules_active', 'false', 'post');
		$modules_reverse_access = $this->get_var('modules_reverse_access', 'false', 'post');
		$modules_message_type = $this->get_var('modules_message_type', 'alert', 'post');		
		$display_components = $this->get_var('display_components', 'false', 'post');	
		$use_componentaccess = $this->get_var('use_componentaccess', 'false', 'post');	
		$component_reverse_access = $this->get_var('component_reverse_access', 'false', 'post');
		$components_message_type = $this->get_var('components_message_type', 'alert', 'post');	
		$display_url = $this->get_var('display_url', 'false', 'post');
		$url_active = $this->get_var('url_active', 'false', 'post');
		$url_message_type = $this->get_var('url_message_type', 'alert', 'post');
		$use_menuaccess = $this->get_var('use_menuaccess', 'false', 'post');
		$menu_reverse_access = $this->get_var('menu_reverse_access', 'false', 'post');	
		$display_menuaccess = $this->get_var('display_menuaccess', 'false', 'post');
		$menuaccess_message_type = $this->get_var('menuaccess_message_type', 'text', 'post');	
		
		
		
//get config together as string	
$config = '<?php

//no direct access
if(!defined(\'_VALID_MOS\') && !defined(\'_JEXEC\')){
	die(\'Restricted access\');
}

$fua_config[\'language\'] = \''.$language.'\';
$fua_config[\'language_frontend\'] = \''.$language_frontend.'\';
$fua_config[\'default_tab\'] = \''.$default_tab.'\';
$fua_config[\'show_joomla_group_select\'] = '.$show_joomla_group_select.';
$fua_config[\'default_usergroup\'] = '.$default_usergroup.';
$fua_config[\'redirect_url\'] = \''.$redirect_url.'\';
$fua_config[\'display_usergroups\'] = '.$display_usergroups.';
$fua_config[\'display_users\'] = '.$display_users.';
$fua_config[\'display_items\'] = '.$display_items.';
$fua_config[\'items_active\'] = '.$items_active.';
$fua_config[\'items_reverse_access\'] = '.$items_reverse_access.';
$fua_config[\'classname_wrapper_content\'] = \''.$classname_wrapper_content.'\';
$fua_config[\'classnames_wrappers_up\'] = \''.$classnames_wrappers_up.'\';
$fua_config[\'classnames_wrappers_down\'] = \''.$classnames_wrappers_down.'\';
$fua_config[\'items_message_type\'] = \''.$items_message_type.'\';
$fua_config[\'items_display_type\'] = \''.$items_display_type.'\';
$fua_config[\'display_categories\'] = '.$display_categories.';
$fua_config[\'categories_active\'] = '.$categories_active.';
$fua_config[\'category_reverse_access\'] = '.$category_reverse_access.';
$fua_config[\'category_message_type\'] = \''.$category_message_type.'\';
$fua_config[\'display_sections\'] = '.$display_sections.';
$fua_config[\'sections_active\'] = '.$sections_active.';
$fua_config[\'sections_reverse_access\'] = '.$sections_reverse_access.';
$fua_config[\'section_message_type\'] = \''.$section_message_type.'\';
$fua_config[\'display_modules\'] = '.$display_modules.';
$fua_config[\'modules_active\'] = '.$modules_active.';
$fua_config[\'modules_reverse_access\'] = '.$modules_reverse_access.';
$fua_config[\'modules_message_type\'] = \''.$modules_message_type.'\';
$fua_config[\'display_components\'] = '.$display_components.';
$fua_config[\'use_componentaccess\'] = '.$use_componentaccess.';
$fua_config[\'component_reverse_access\'] = '.$component_reverse_access.';
$fua_config[\'components_message_type\'] = \''.$components_message_type.'\';
$fua_config[\'display_url\'] = '.$display_url.';
$fua_config[\'url_active\'] = '.$url_active.';
$fua_config[\'url_message_type\'] = \''.$url_message_type.'\';
$fua_config[\'use_menuaccess\'] = '.$use_menuaccess.';
$fua_config[\'menu_reverse_access\'] = '.$menu_reverse_access.';
$fua_config[\'display_menuaccess\'] = '.$display_menuaccess.';
$fua_config[\'menuaccess_message_type\'] = \''.$menuaccess_message_type.'\';

';

//get menutypes
$menutypes = JRequest::getVar('menutypes', null, 'post', 'array');

//if menutype is not selected, take it out of array
//added the 'm' because of the problem with numerical indexes when unsetting in loop
$loops = count($menutypes);
for($n = 0; $n <= $loops; $n++){
	if(!isset($menutypes['m'.$n]['menutype'])){		
		unset($menutypes['m'.$n]);							
	} 	
}

//redo array to reset indexes
$temp = array();
foreach($menutypes as $menutype){	
	$temp[] = $menutype;
}
$menutypes = $temp;

//sort array by order
foreach ($menutypes as $key => $row) {
	$order[$key]  = $row['order'];    
}
$sort_order = SORT_ASC;
array_multisort($order, $sort_order, $menutypes);

//write menutypes array to config string
$config .= '$fua_config[\'menutypes\'] = array(';
if (is_array($menutypes)){	
	//foreach($menutypes as $menutype){
	for($n = 0; $n < count($menutypes); $n++){
		if($n!=0){
			$config .= ',';	
		}
		$config .= 'array(\''.$menutypes[$n]['menutype'].'\',\''.$menutypes[$n]['title'].'\')';
	}	
}
$config .= ');
?>';
		
		//check if writeable and open	
		if (!$fp = @fopen(dirname(__FILE__).'/../com_frontend_user_access/configuration.php', "wb")) {			
			die('The configuration file is not writable');
			return false;
		}	
		
		fputs($fp, $config, strlen($config));
		fclose ($fp);	
		
		//redirect
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5			
			$sub_task = JRequest::getVar('sub_task', '');			
		}else{
			//joomla 1.0.x			
			$sub_task = mosGetParam($_REQUEST, 'sub_task', '');			
		}		
		if($sub_task=='apply'){
			$url = 'index2.php?option=com_frontend_user_access&task=config';
		}else{
			$url = 'index2.php?option=com_frontend_user_access&task='.$default_tab;
		}	
		$this->redirect_to_url($url, _fua_lang_configsaved);
	}		

	function display_footer(){		
		echo '<div class="smallgrey" id="ua_footer"><a href="http://www.pages-and-items.com" target="_blank">Frontend-User-Access</a> &copy; '._fua_lang_version.' '.$this->version.' (';		
		echo $this->fua_version_type.' version)';
		if($this->fua_version_type!='trial' && $this->fua_version_type!='trial'){
			echo ' <a href="http://www.gnu.org/licenses/gpl-2.0.html" target="blank">GNU/GPL License</a></div>';
		}
	}			

	function users_save(){
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5
			$joomlagroups = JRequest::getVar('gid', null, 'post', 'array');	
			$user_ids = JRequest::getVar('user_id', null, 'post', 'array');	
			$usergroups = JRequest::getVar('usergroup', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$joomlagroups = mosGetParam( $_POST, 'gid', array(0));	
			$user_ids = mosGetParam( $_POST, 'user_id', array(0));	
			$usergroups = mosGetParam( $_POST, 'usergroup', array(0));
		}	
		
		//get users in userindex			
		$this->db->setQuery("SELECT user_id FROM #__fua_userindex ");
		$user_ids_index = $this->db->loadResultArray();		
		
		//update users				
		for($n = 0; $n < count($user_ids); $n++){
			$user_id = $user_ids[$n];
			if($this->fua_config['show_joomla_group_select']){												
				$gid_update = '';							
				$gid_update = 'gid=\''.$joomlagroups[$n].'\'';
				$joomla_group_id = $joomlagroups[$n];		
				switch ($joomlagroups[$n]) {
				case 18:
					$usertype = 'Registered';
					break;
				case 19:
					$usertype = 'Author';
					break;
				case 20:
					$usertype = 'Editor';
					break;
				case 21:
					$usertype = 'Publisher';
					break;
				case 23:
					$usertype = 'Manager';
					break;
				case 24:
					$usertype = 'Administrator';
					break;	
				}			
				$this->db->setQuery( "UPDATE #__users SET $gid_update , usertype='$usertype' WHERE id='$user_id'" );
				if (!$this->db->query()) {
					echo "<script> alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
					exit();
				}				
				
				//find aro id
				if(defined('_JEXEC')){
					//joomla 1.5
					$aro_id_column = 'id';
				}else{
					//joomla 1.0.x
					$aro_id_column = 'aro_id';
				}
				$this->db->setQuery("SELECT $aro_id_column "
				."FROM #__core_acl_aro "
				."WHERE value='$user_id' "			
				);
				$aros = $this->db->loadResultArray();
				$aro_id = $aros[0];
				
				//update aro id in aro group map
				$this->db->setQuery( "UPDATE #__core_acl_groups_aro_map SET group_id='$joomla_group_id' WHERE aro_id='$aro_id'" );
				$this->db->query();	
			}
			
			//update or insert user index
			$usergroup = $usergroups[$n];
			if(in_array($user_id, $user_ids_index)){						
				$this->db->setQuery( "UPDATE #__fua_userindex SET group_id='$usergroup' WHERE user_id='$user_id'" );
				$this->db->query();	
			}else{
				$this->db->setQuery( "INSERT INTO #__fua_userindex SET user_id='$user_id', group_id='$usergroup'");
				$this->db->query();
			}
									
		}				
		$this->redirect_to_url('index2.php?option=com_frontend_user_access&task=users', _fua_lang_userssaved);		
	}
	
	function spunk_up_headers_1_5(){
		if( defined('_JEXEC') ){
		//joomla 1.5
			$css = '<style type="text/css">
			
			th{	
				text-align: left;
				background: #F0F0F0;
				border-bottom: 1px solid #999999;
			}
			
			td{
				vertical-align: top;
			}
			
			</style>';
			echo $css;
		}
	}	
	
	function set_title(){
		if(defined('_JEXEC')){
			//joomla 1.5
			JToolBarHelper::title( JText::_( 'Frontend User Access' ), 'user.png' );
		}else{
			//joomla 1.0.x
			echo '<table class="adminheading"><tr><th class="user">Frontend User Access</th></tr></table>';
		}
	}	
	
	function redirect_to_url($url, $message){
		global $mainframe;
		
		if(defined('_JEXEC')){
			//joomla 1.5
			$mainframe->redirect($url, $message);
		}else{
			//joomla 1.0.x
			mosRedirect($url, $message);
		}
	}
	
	
	//take this out for free version
	function access_sections_save(){			
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5
			$section_access = JRequest::getVar('sectionAccess', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$section_access = mosGetParam( $_POST, 'sectionAccess', array(0) );
		}	
		
		//empty table (no one has any rights)
		$this->empty_table('sections');	
		
		//write sections access		
		for($n = 0; $n < count($section_access); $n++){
			$section_right = $section_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_sections SET section_groupid='$section_right'");
			if (!$this->db->query()) {
				echo "<script>alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}			
		}					
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=sections", _fua_lang_section_access_saved);
	}
	
	function access_items_save(){			
		//get vars
		
		if( defined('_JEXEC') ){
			//joomla 1.5
			$item_access = JRequest::getVar('item_access', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$item_access = mosGetParam( $_POST, 'item_access', array(0) );
		}	
				
		//empty table (no one has any rights)
		$this->empty_table('items');	
		
		//write item access		
		for($n = 0; $n < count($item_access); $n++){
			$item_right = $item_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_items SET itemid_groupid='$item_right'");
			if (!$this->db->query()) {
				echo "<script>alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}			
		}				
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=items", _fua_lang_item_access_saved);
	}
	
	//take this out for free version
	function access_categories_save(){
		//get vars
		if( defined('_JEXEC') ){
			//joomla 1.5
			$category_access = JRequest::getVar('categoryAccess', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$category_access = mosGetParam( $_POST, 'categoryAccess', array(0) );
		}	
		
		//empty table (no one has any rights)
		$this->empty_table('categories');	
		
		//write sections access		
		for($n = 0; $n < count($category_access); $n++){
			$category_right = $category_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_categories SET category_groupid='$category_right'");
			if (!$this->db->query()) {
				echo "<script>alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}			
		}					
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=categories", _fua_lang_category_access_saved);
	}		
	
	function loop_usergroups($usergroups){
		foreach($usergroups as $usergroup){
			if($usergroup->id=='9'){
				$name = _fua_lang_loggedin;
				$description = _fua_lang_loggedin_description;
			}elseif($usergroup->id=='10'){
				$name = _fua_lang_not_loggedin;
				$description = _fua_lang_not_loggedin_description;
			}else{
				$name = stripslashes($usergroup->name);
				$description = stripslashes($usergroup->description);
			}
			echo '<th style="text-align:center;"><span class="editlinktip" onmouseover="return overlib(\''.addslashes($description).'\', CAPTION, \''.addslashes($name).'\', BELOW, RIGHT, WIDTH, 400);" onmouseout="return nd();" >'.$name.'</span></th>';
		}
	}
		
	function check_demo_time_left(){			
		if($this->fua_version_type=='trial'){			
			echo '<p style="text-align: center;">';
			echo '<span class="editlinktip" onmouseover="return overlib(\''._fua_lang_demo_days_left_tip.'\', CAPTION, \'&nbsp;\', BELOW, RIGHT, WIDTH, 400);" onmouseout="return nd();" >'._fua_lang_demo_days_left.'</span>';
			echo ': ';
			if(round((($this->fua_demo_seconds_left/60)/60)/24)<=0){
				echo '0';
			}else{
				echo round((($this->fua_demo_seconds_left/60)/60)/24);
			}
			echo '</p>';
		}
	}	
	
	function reverse_access_warning($which){
		echo '<p>';
		echo '<input type="checkbox" name="fua_legend_box" id="fua_legend_box" value="" checked="checked" onclick="this.checked=true" onfocus="if(this.blur)this.blur();" class="checkbox" /> = ';
		if($this->fua_config[$which]){				
			echo _fua_lang_usergroup_has_no_access;
			echo '<img src="../includes/js/ThemeOffice/warning.png" class="warning_img" alt="be carefull" />'._fua_lang_reverse_access_warning;
		}else{
			echo _fua_lang_usergroup_has_access;
		}
		echo '</p>';
	}
	
	function fua_check_trial_version(){
		//config		
		$fua_trial_valid_until = 1253610091;				
		$fua_allow_localhost = true;
		//check trial time left		
		$fua_trial_seconds_left = $fua_trial_valid_until-time();
		//let class know demo time left			
		$this->fua_demo_seconds_left = $fua_trial_seconds_left;		
		//check the trialtime
		$fua_trial_still_valid = false;	
		if(
		//check localhost
		($fua_allow_localhost && ($_SERVER['SERVER_NAME']==='localhost' || $_SERVER['SERVER_NAME']==='127.0.0.1')) ||
		//check demo time 
		$fua_trial_seconds_left >= 0 ||
		//not a trial version
		$this->fua_version_type == 'free' || $this->fua_version_type == 'pro'
		){					
			$fua_trial_still_valid = true;								
		}
		return $fua_trial_still_valid;
	}	
	
	function get_load_module_title($module_id){		
		//get load module title											
		$this->db->setQuery("SELECT title FROM #__modules WHERE id='$module_id' LIMIT 1");
		$module_title_array = $this->db->loadResultArray();
		if(count($module_title_array)){
			$module_title = $module_title_array[0];
		}else{
			$module_title = _fua_lang_no_module_assigned;
		}
		return $module_title;	
	}

	//take this out for free version
	function modules_save(){			
		//get vars		
		if( defined('_JEXEC') ){
			//joomla 1.5
			$module_access = JRequest::getVar('module_access', null, 'post', 'array');		
		}else{
			//joomla 1.0.x
			$module_access = mosGetParam( $_POST, 'module_access', array(0) );
		}	
				
		//empty table (no one has any rights)
		$this->empty_table('modules');	
		
		//write item access		
		for($n = 0; $n < count($module_access); $n++){
			$module_right = $module_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_modules SET module_groupid='$module_right'");
			if (!$this->db->query()) {
				echo "<script>alert('".$this->db->getErrorMsg()."'); window.history.go(-1); </script>";
				exit();
			}			
		}				
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=modules", _fua_lang_module_access_saved);
	}
	
	function instructions_modules(){		
		require_once(dirname(__FILE__).'/admin/instructions_modules_'.$this->fua_config['language'].'.php');
	}
	
	function get_language(){
		require_once(dirname(__FILE__).'/language/'.$this->fua_config['language'].'.php');		
	}
	
	function not_in_free_version(){
		if($this->fua_version_type=='free'){
			echo '<p class="warning">'._fua_lang_not_in_free_version.'</p>';
		}
	}
	
	function menuaccess_save(){			
		
		
		$menu_access = JRequest::getVar('menu_access', null, 'post', 'array');		
		
		
		//empty table	
		$this->empty_table('menuaccess');	
		
		//write sections access		
		for($n = 0; $n < count($menu_access); $n++){
			$menu_access_row = $menu_access[$n];						
			$this->db->setQuery( "INSERT INTO #__fua_menuaccess SET menuid_groupid='$menu_access_row'");
			$this->db->query();			
		}	
						
		$this->redirect_to_url("index2.php?option=com_frontend_user_access&task=menuaccess", _fua_lang_menu_access_saved);
	}	
	
	//take out for free version
	function update_tables(){
		//only do this when in the admin
		if(strpos($_SERVER['REQUEST_URI'], 'administrator')){
			
			//create the menu access table
			$this->db->setQuery("CREATE TABLE IF NOT EXISTS #__fua_menuaccess (
			`id` int(11) NOT NULL auto_increment,
			`menuid_groupid` tinytext NOT NULL,
			PRIMARY KEY  (`id`)
			)");
			$this->db->query();
			
				
		
			//add url to usergroup table
			$this->db->setQuery("SHOW COLUMNS FROM #__fua_usergroups ");
			$columns = $this->db->loadResultArray();			
			if(!in_array('url', $columns)){
				$this->db->setQuery("ALTER TABLE #__fua_usergroups ADD `url` TINYTEXT NOT NULL ");	
				$this->db->query();		
			}
			
			
			
		}
	}


}//end class_fua







?>