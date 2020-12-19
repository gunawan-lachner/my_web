<?php
/**
* @package system plugin Frontend-User-Access (plugin for component Frontend-User-Access)
* @version 2.1.1
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license GPL
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//this file contains a temporary workaround to make this class work without the MVC model
//in the MVC model the filenames will have to be without underscore and the component
//does not yet work with that. So to overcome this transition period
//this is a workaround to keep everything working untill version 3 comes out, which will be all MVC modelled

//jimport( 'joomla.plugin.plugin' );

//class plgSystemFrontenduseraccesssystem extends JPlugin
class plgSystemFrontenduseraccesssystem{

	var $database;
	var $fua_config;
	var $user_id;
	var $user_type;
	
	function plgSystemFrontenduseraccesssystem() {
		//parent::__construct($subject, $config);
		$this->database = JFactory::getDBO();
		
		//get config
		$fua_config = '';
		if(file_exists(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php')){
			include(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php');		
		}	
		$this->fua_config = $fua_config;
		
		//get user id
		$user =& JFactory::getUser();		
		$this->user_id = $user->get('id');
		$this->user_type = $user->get('usertype');
	}
	
	/*
	function onBeforeDisplayContent(){		
		$this->bot_frontend_user_access_page();
	}
	
	function onAfterRender(){
		$this->work_on_buffer();
		$this->fua_check_page_access();		
	}
	*/

	function work_on_buffer(){
		//get buffer
		$buffer = JResponse::getBody();	
		
		//check if any article needs hiding
		$pos = 0;
		$pos = strpos($buffer, '<br class="fua_article_hide"');
		if($pos){	
			//some articles need hiding
			$regex = "/frontend_user_access_article_hide_start(.*?)frontend_user_access_hide_article_end/is";
			preg_match_all($regex, $buffer, $matches); 		
			
			for($n = 0; $n < count($matches[0]); $n++){			
				if(strpos($matches[0][$n],'class="fua_article_hide"')){				
					//check trial version						
					if(file_exists(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/class.php')){			
						require_once(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/class.php');
						$class_fua = new class_fua;
						if($class_fua->fua_check_trial_version()){
							//hide the actual article
							$buffer = str_replace($matches[0][$n],'',$buffer);
						}
					}				
				}
			}		
		}
		
		//take out all temp-texts
		$buffer = str_replace('frontend_user_access_article_hide_start','',$buffer);
		$buffer = str_replace('frontend_user_access_hide_article_end','',$buffer);
		
		//write buffer
		JResponse::setBody($buffer); 	
		
		if(!strpos($_SERVER['REQUEST_URI'], 'administrator')){
			//only do stuff at the frontend			
			
			if($this->fua_config['use_componentaccess']){
				
				
				if($this->user_type!='Super Administrator'){
					
					//get usergroup					
					$fua_usergroup = $this->get_usergroup_from_database();	
					
					$option = JRequest::getVar('option', '');
					
					//get component access data
					$this->database->setQuery("SELECT component_groupid FROM #__fua_components");
					$fua_component_access_rights = $this->database->loadResultArray();	
					
					$fua_component_right = $option.'__'.$fua_usergroup;				
					
					$fua_component_access = true;
					
					//check component permisson					
					if($this->fua_config['component_reverse_access']){
						if(in_array($fua_component_right, $fua_component_access_rights) && $option!='com_frontend_user_access'){	
							$fua_component_access = false;									
						}
					}else{
						if(!in_array($fua_component_right, $fua_component_access_rights) && $option!='com_frontend_user_access'){	
							$fua_component_access = false;									
						}
					}
					
					//if user has no component-access-permission
					if(!$fua_component_access){
						if($this->fua_config['components_message_type']=='alert'){	
							$this->get_language_frontend();
							$this->do_alert(_fua_lang_no_access_page2);	
						}else{
							//get menu-item and live site							
							$menu_item = JRequest::getVar('Itemid', '');	
							$live_site = JURI::root();							
													
							$url = $live_site.'/index.php?option=com_frontend_user_access&task=no_access&Itemid='.$menu_item;
							
							global $mainframe;
							$mainframe->redirect($url);
							
						}
					}
				}
			}	
		}
	}
	
	function fua_check_page_access(){
	
		if(!strpos($_SERVER['REQUEST_URI'], 'administrator')){
			//only do this at the frontend
			
			static $page_access_checked;
			
			if(!$page_access_checked){
				global $mainframe;
				$menu_id = JRequest::getVar('Itemid', '');
				
				if($menu_id && $this->fua_config['use_menuaccess'] && $this->user_type!='Super Administrator'){		
					//echo 'sfrdvs';						
					
					//get usergroup
					$fua_usergroup = $this->get_usergroup_from_database();
					
					$menu_access_array = $this->get_menu_access_from_database();			
					
					$menu_right = $menu_id.'_'.$fua_usergroup;								
					
					$fua_menu_access = true;
					if($this->fua_config['menu_reverse_access']){
						if(in_array($menu_right, $menu_access_array)){
							$fua_menu_access = false;
						}
					}else{
						if(!in_array($menu_right, $menu_access_array)){
							$fua_menu_access = false;	
						}
					}	
					
					//if no access
					if(!$fua_menu_access){						
						if($this->fua_config['menuaccess_message_type']=='alert'){	
							$this->get_language_frontend();
							$this->do_alert(_fua_lang_no_access_page2);	
						}elseif($this->fua_config['menuaccess_message_type']=='inline_text'){				
							$url = JURI::root().'index.php?option=com_frontend_user_access&task=no_access';								
							$mainframe->redirect($url);			
						}elseif($this->fua_config['menuaccess_message_type']=='text'){											
							$url = JURI::root().'index.php?option=com_frontend_user_access&task=no_access&tmpl=component';								
							$mainframe->redirect($url);			
						}
					}
				
				}
				$page_access_checked = 1;
			}
		}
	}
	
	//function bot_frontend_user_access_page( &$row, &$params, $page=0 ){
	function bot_frontend_user_access_page(){
		global $mainframe;
		static $bot_comp_and_url_done;
		
		if(!$bot_comp_and_url_done){
		
			//make sure page is not cached
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
			
			if($this->fua_config['use_componentaccess'] || 
			($this->fua_config['items_active'] && ($this->fua_config['items_message_type']=='alert' || $this->fua_config['items_message_type']=='inline_text')) ||
			($this->fua_config['categories_active'] && ($this->fua_config['category_message_type']=='alert' || $this->fua_config['category_message_type']=='inline_text')) ||
			($this->fua_config['sections_active'] && ($this->fua_config['section_message_type']=='alert' || $this->fua_config['section_message_type']=='inline_text'))
			){	
					
				if($this->user_type!='Super Administrator'){					
					
					//get usergroup					
					$fua_usergroup = $this->get_usergroup_from_database();					
					
					//get option							
					$option = JRequest::getVar('option', '');									
					
					//start checking item full view access				
					if($option=='com_content' &&
					($this->fua_config['items_active'] && ($this->fua_config['items_message_type']=='alert' || $this->fua_config['items_message_type']=='inline_text')) ||
					($this->fua_config['categories_active'] && ($this->fua_config['category_message_type']=='alert' || $this->fua_config['category_message_type']=='inline_text')) ||
					($this->fua_config['sections_active'] && ($this->fua_config['section_message_type']=='alert' || $this->fua_config['section_message_type']=='inline_text')) 				
					){	
									
						
						//get vars						
						$view = JRequest::getVar('view', '');	
						$layout = JRequest::getVar('layout', '');
						$item_id_temp = JRequest::getVar('id', '');	
						if(strpos($item_id_temp, ':')){
							$pos_item_id = strpos($item_id_temp, ':');
							$item_id = intval(substr($item_id_temp, 0, $pos_item_id));	
						}else{
							$item_id = intval($item_id_temp);	
						}			
										
						
						//check if full view
						if($option=='com_content' && 
						($view=='article' && ($layout=='default' || $layout=='')) 						
						){									
						
							$fua_full_item_access = true;
							
							//check item access
							if($this->fua_config['items_active']){
							
								$item_access_array = $this->get_item_access_from_database();	
						
								$item_right = $item_id.'__'.$fua_usergroup;								
								
								if($this->fua_config['items_reverse_access']){
									if(in_array($item_right, $item_access_array)){
										$fua_full_item_access = false;
									}
								}else{
									if(!in_array($item_right, $item_access_array)){
										$fua_full_item_access = false;	
									}
								}							
							}//end item access
							
							
							//check category access
							if($this->fua_config['categories_active']){
							
								$category_access_array = $this->get_category_access_from_database();	
															
								//get category id of item
								$this->database->setQuery("SELECT catid "
								."FROM #__content "
								."WHERE id='$item_id' "
								."LIMIT 1 "
								);
								$fua_category_rows = $this->database->loadObjectList();
								$category_id = '';
								foreach($fua_category_rows as $fua_category_row){	
									$category_id = $fua_category_row->catid;	
								}
						
								$category_right = $category_id.'__'.$fua_usergroup;	
										
								if($this->fua_config['category_reverse_access']){
									if(in_array($category_right, $category_access_array)){
										$fua_full_item_access = false;
									}
								}else{
									if(!in_array($category_right, $category_access_array)){
										$fua_full_item_access = false;	
									}
								}
													
							}//end category access						
							
								
							//if no access
							if(!$fua_full_item_access){						
								if($this->fua_config['items_message_type']=='alert'){	
									$this->get_language_frontend();
									$this->do_alert(_fua_lang_no_access_page2);	
								}elseif($this->fua_config['items_message_type']=='inline_text'){
									//get menu-item	
									$menu_item = JRequest::getVar('Itemid', '');
									$live_site = JURI::root();									
									
									$url = $live_site.'index.php?option=com_frontend_user_access&task=no_access&Itemid='.$menu_item;										
									$mainframe->redirect($url);									
								}
							}						
						}					
					}
					//end checking item full view access
					
					
				}//end if no super administrator	
			}//end if anything needs checking
			$bot_comp_and_url_done = 1;
		}//end if only do this once
	}	
	
	function get_item_access_from_database(){
	
		static $item_access_array;
		
		if(!$item_access_array){	
			
			$this->database->setQuery("SELECT itemid_groupid FROM #__fua_items ");
			$item_access_array = $this->database->loadResultArray();	
			
		}
		
		return $item_access_array;
	}
	
	function get_category_access_from_database(){
	
		static $category_access_array;
		
		if(!$category_access_array){	
			
			$this->database->setQuery("SELECT category_groupid FROM #__fua_categories ");
			$category_access_array = $this->database->loadResultArray();	
			
		}
		
		return $category_access_array;
	}
	
	function get_menu_access_from_database(){
	
		static $menu_access_array;
		
		if(!$menu_access_array){	
			
			$this->database->setQuery("SELECT menuid_groupid FROM #__fua_menuaccess ");
			$menu_access_array = $this->database->loadResultArray();	
			
		}
		
		return $menu_access_array;
	}
	
	
	
	function get_usergroup_from_database(){
	
		static $fua_usergroup;
		
		if(!$fua_usergroup){
		
			if(!$this->user_id){
				//user is not logged in
				$fua_usergroup = '10';
			}else{
				$user_id = $this->user_id;
				$this->database->setQuery("SELECT group_id FROM #__fua_userindex WHERE user_id='$user_id' LIMIT 1 ");		
				$rows_group = $this->database->loadObjectList();	
				$fua_usergroup = false;		
				foreach($rows_group as $row_group){
					$fua_usergroup = $row_group->group_id;	
				}
				
				if(!$fua_usergroup){
					//user is logged in, but is not assigned to any usergroup, so make it 9
					$fua_usergroup = '9';
				}
			}	
		}	
		return $fua_usergroup;
	}
	
	function do_alert($message){
		echo "<script>alert('".addslashes(html_entity_decode($message))."'); window.history.go(-1); </script>";
		exit('<html><body><noscript>'.$message.'</noscript></body></html>');
	}
	
	function get_language_frontend(){	
		
		$language_frontend = $this->fua_config['language_frontend'];	
		
		//include language, defaults to english
		if(file_exists(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php')){
			require_once(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php');
		}else{
			require_once(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/english.php');
		}
	}
	
}

function bot_frontend_user_access_page(){
	$plgSystemFrontenduseraccesssystem = new plgSystemFrontenduseraccesssystem;
	$plgSystemFrontenduseraccesssystem->bot_frontend_user_access_page();
}

function work_on_buffer(){
	$plgSystemFrontenduseraccesssystem = new plgSystemFrontenduseraccesssystem;
	$plgSystemFrontenduseraccesssystem->work_on_buffer();
}

function fua_check_page_access(){
	$plgSystemFrontenduseraccesssystem = new plgSystemFrontenduseraccesssystem;
	$plgSystemFrontenduseraccesssystem->fua_check_page_access();
}

$mainframe->registerEvent( 'onBeforeDisplayContent', 'bot_frontend_user_access_page' );	
$mainframe->registerEvent( 'onAfterRender', 'work_on_buffer' );
$mainframe->registerEvent( 'onAfterRender', 'fua_check_page_access' );

?>