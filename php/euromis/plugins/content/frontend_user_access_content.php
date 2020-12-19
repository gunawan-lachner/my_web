<?php
/**
* @package plugin Frontend-User-Access (plugin for component Frontend-User-Access)
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
	
$mainframe->registerEvent( 'onPrepareContent', 'bot_frontend_user_access_article' );
$mainframe->registerEvent( 'onAfterDisplayContent', 'fua_hide_article_end' );

function fua_hide_article_end(){
	return 'frontend_user_access_hide_article_end';
}

function bot_frontend_user_access_article( &$row, &$params, $page=0 ){

	$option = JRequest::getVar('option', '');	
	$view = JRequest::getVar('view', '');	
	$layout = JRequest::getVar('layout', '');
	if(!($option=='com_content' && $view=='article' && ($layout=='default' || $layout==''))){	
		echo 'frontend_user_access_article_hide_start';	
	}
	
	//get configuration to see what needs to be done
	$fua_config = get_fua_config2();
	
	$row_id = 0;
	if (is_object( $row )) {
         if (isset( $row->id ))
         {
			$row_id = $row->id;
		}
	}
	
	if($fua_config['items_active'] || $fua_config['categories_active'] || $fua_config['sections_active']){

		$user_id = get_user_id2();
		$user_type = get_user_type2();		
		
		//get option
		if( defined('_JEXEC') ){
			//joomla 1.5
			$framework = '1.5.x';		
			$option = JRequest::getVar('option', '');	
			$view = JRequest::getVar('view', '');	
			$layout = JRequest::getVar('layout', '');				
		}else{
			//joomla 1.0.x	
			$framework = '1.0.x';	
			$option = mosGetParam( $_REQUEST, 'option', '' );	
			//$view = mosGetParam( $_REQUEST, 'view', '' );
			//$layout = mosGetParam( $_REQUEST, 'layout', '' );	
			$task = mosGetParam( $_REQUEST, 'task', '' );				
		}	
	
		if($user_type!='Super Administrator' && 
		//only check com_content
		($option=='com_content' && 
		//category blog
		(($framework=='1.5.x' && $view=='category' && $layout=='blog') ||
		($framework=='1.0.x' && $task=='blogcategory') ||
		//full item
		($framework=='1.5.x' && $view=='article' && $layout=='default') ||
		($framework=='1.0.x' && $task=='view') ||
		//archive, bots don't seem to be called in archive ?
		//($view=='archive')
		//frontpage
		($framework=='1.5.x' && $view=='frontpage') ||		
		//section blog
		($framework=='1.5.x' && $view=='section' && $layout=='blog') ||
		($framework=='1.0.x' && $task=='blogsection') 
		) 		
		) ||
		($framework=='1.0.x' && $option=='com_frontpage')		
		){
		
			//get database
			$database = get_database3();			
			
			//get usergroup					
			$fua_usergroup = get_usergroup_from_database2($user_id, $database);						
			
			//check item access
			if($fua_config['items_active']){
				
				$item_access_array = get_item_access_from_database2($database);	
				
				$item_right = $row_id.'__'.$fua_usergroup;	
				
				if($fua_config['items_reverse_access']){
					if(in_array($item_right, $item_access_array)){
						fua_no_access_article($row, $fua_config);			
					}
				}else{
					if(!in_array($item_right, $item_access_array)){
						fua_no_access_article($row, $fua_config);						
					}
				}
			}
			
			//take this out for free version
			//check category access
			if($fua_config['categories_active']){
					
				$category_access_array = get_category_access_from_database2($database);	
				
				
				$row_catid = 0;
				if (is_object( $row )) {
					 if (isset( $row->catid ))
					 {
						$row_catid = $row->catid;
					}
				}
				
				$category_right = $row_catid.'__'.$fua_usergroup;	###########################				
				
				if($fua_config['category_reverse_access']){
					if(in_array($category_right, $category_access_array)){
						fua_no_access_article($row, $fua_config);	
					}
				}else{
					if(!in_array($category_right, $category_access_array)){
						fua_no_access_article($row, $fua_config);							
					}
				}
			}
			
			//take this out for free version
			//check section access
			if($fua_config['sections_active']){

				
				$section_access_array = get_section_access_from_database2($database);	
				
				$row_sectionid = 0;
				if (is_object( $row )) {
					 if (isset( $row->sectionid ))
					 {
						$row_sectionid = $row->sectionid;
					}
				}
				
				$section_right = $row_sectionid.'__'.$fua_usergroup;	
				
				if($fua_config['sections_reverse_access']){
					if(in_array($section_right, $section_access_array)){
						fua_no_access_article($row, $fua_config);		
					}
				}else{
					if(!in_array($section_right, $section_access_array)){
						fua_no_access_article($row, $fua_config);			
					}
				}
			}
			
			
						
		}//end if no super administrator	
	}//end if anything needs checking	
}

function fua_no_access_article($row, $fua_config){
	get_language_frontend3($fua_config);
	//include class
	if(file_exists(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/class.php')){			
		require_once(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/class.php');
		$class_fua = new class_fua;
		if($class_fua->fua_check_trial_version()){
			if($fua_config['items_display_type']=='inline_text'){
				$row->text = '['._fua_lang_no_access_item2.']';
			}else{
				//hide completely				
				$row->title = '';
				$row->created='';
				$row->modified='';
				$row->author='';
				$row->text = '<br class="fua_article_hide" />';
			}	
		}
	}
	
}

function fua_include_custom_javascript($document, $fua_config){

	static $fua_include_custom_javascript;
	
	if(!$fua_include_custom_javascript){
		$javascript = '<script language="javascript" type="text/javascript">'."\n";
		$javascript .= '<!--'."\n";		
		$javascript .= 'var types = {'."\n";
		$javascript .= '"pattern":{'."\n";
		$javascript .= 'hook:{tagName:"br",className:"fua_article_hide",maxLevels:5},'."\n";
		if($fua_config['classnames_wrappers_up']){
			$javascript .= 'prev:[';
			$fua_prev_wrappers = explode(';',$fua_config['classnames_wrappers_up']);
			foreach($fua_prev_wrappers as $fua_prev_wrapper){
				$fua_prev_wrapper_array = explode(',',$fua_prev_wrapper);
				$javascript .= '{tagName:"';
				$javascript .= $fua_prev_wrapper_array[0];
				$javascript .= '",className:"';
				$javascript .= $fua_prev_wrapper_array[1];
				$javascript .= '"},';
			}
			$javascript .= '],'."\n";
		}
		$fua_content_wrapper_array = explode(',',$fua_config['classname_wrapper_content']);
		$javascript .= 'main:{tagName:"';
		$javascript .= $fua_content_wrapper_array[0];
		$javascript .= '",className:"';
		$javascript .= $fua_content_wrapper_array[1];
		$javascript .= '"},'."\n";
		if($fua_config['classnames_wrappers_down']){
			$javascript .= 'next:[';
			$fua_down_wrappers = explode(';',$fua_config['classnames_wrappers_down']);
			foreach($fua_down_wrappers as $fua_down_wrapper){
				$fua_down_wrappers_array = explode(',',$fua_down_wrapper);
				$javascript .= '{tagName:"';
				$javascript .= $fua_down_wrappers_array[0];
				$javascript .= '",className:"';
				$javascript .= $fua_down_wrappers_array[1];
				$javascript .= '"},';
			}
			$javascript .= '],'."\n";
		}					
		$javascript .= '}'."\n";
		$javascript .= '};'."\n";		
		$javascript .= '-->'."\n";
		$javascript .= '</script>'."\n";
		$document->addCustomTag($javascript);
		$fua_include_custom_javascript = 1;
	}
}	

function get_fua_config2(){

	static $fua_config;
	
	if(!$fua_config){
		include(dirname(__FILE__).'/../../administrator/components/com_frontend_user_access/configuration.php');				
	}
	
	return $fua_config;
}

function get_user_id2(){

	static $got_user_id, $user_id;
	
	if(!$got_user_id){		
		if(defined('_JEXEC')){
			//joomla 1.5
			$user =& JFactory::getUser();			
			$user_id = $user->get('id');								
		}else{
			//joomla 1.0.x	
			global $my;		
			$user_id = $my->id;										
		}	
		$got_user_id = 1;
	}
	return $user_id;
}

function get_user_type2(){

	static $got_user_type, $user_type;
	
	if(!$got_user_type){		
		if(defined('_JEXEC')){
			//joomla 1.5
			$user =& JFactory::getUser();			
			$user_type = $user->get('usertype');								
		}else{
			//joomla 1.0.x	
			global $my;		
			$user_type = $my->usertype;										
		}	
		$got_user_type = 1;
	}
	return $user_type;
}

function get_item_access_from_database2($database){

	static $item_access_array;
	
	if(!$item_access_array){	
		
		$database->setQuery("SELECT itemid_groupid FROM #__fua_items");
		$item_access_array = $database->loadResultArray();	
		
	}
	
	return $item_access_array;
}

//take this out for free version
function get_category_access_from_database2($database){

	static $category_access_array;
	
	if(!$category_access_array){	
		
		$database->setQuery("SELECT category_groupid FROM #__fua_categories");
		$category_access_array = $database->loadResultArray();	
		
	}
	
	return $category_access_array;
}

//take this out for free version
function get_section_access_from_database2($database){

	static $section_access_array;
	
	if(!$section_access_array){	
		
		$database->setQuery("SELECT section_groupid FROM #__fua_sections");
		$section_access_array = $database->loadResultArray();	
		
	}
	
	return $section_access_array;
}

function get_usergroup_from_database2($user_id, $database){

	static $fua_usergroup;
	
	if(!$fua_usergroup){
	
		if(!$user_id){
			//user is not logged in
			$fua_usergroup = '10';
		}else{
			$database->setQuery("SELECT group_id FROM #__fua_userindex WHERE user_id='$user_id' LIMIT 1 ");		
			$rows_group = $database->loadObjectList();			
			$row_group = $rows_group[0];
			$fua_usergroup = $row_group->group_id;	
			
			if(!$fua_usergroup){
				//user is logged in, but is not assigned to any usergroup, so make it 9
				$fua_usergroup = '9';
			}
		}	
	}	
	return $fua_usergroup;
}

function get_language_frontend3($fua_config){	
	
	$language_frontend = $fua_config['language_frontend'];	
	
	//include language, defaults to english
	if(file_exists(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php')){
		require_once(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/'.$language_frontend.'.php');
	}else{
		require_once(dirname(__FILE__).'/../../components/com_frontend_user_access/language_frontend/english.php');
	}
}

function get_database3(){
	global $database;
	//get database
	if( defined('_JEXEC') ){
		//joomla 1.5
		$database = JFactory::getDBO();
	}
	return $database;
}


?>