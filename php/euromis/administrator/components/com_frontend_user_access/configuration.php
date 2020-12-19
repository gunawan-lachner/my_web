<?php

//no direct access
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Restricted access');
}

$fua_config['language'] = 'english';
$fua_config['language_frontend'] = 'english';
$fua_config['default_tab'] = 'users';
$fua_config['show_joomla_group_select'] = true;
$fua_config['default_usergroup'] = 0;
$fua_config['redirect_url'] = 'index.php';
$fua_config['display_usergroups'] = true;
$fua_config['display_users'] = true;
$fua_config['display_items'] = false;
$fua_config['items_active'] = false;
$fua_config['items_reverse_access'] = false;
$fua_config['classname_wrapper_content'] = 'table,contentpaneopen';
$fua_config['classnames_wrappers_up'] = 'table,contentpaneopen';
$fua_config['classnames_wrappers_down'] = 'span,article_separator';
$fua_config['items_message_type'] = 'alert';
$fua_config['items_display_type'] = 'hide';
$fua_config['display_categories'] = false;
$fua_config['categories_active'] = false;
$fua_config['category_reverse_access'] = false;
$fua_config['category_message_type'] = 'alert';
$fua_config['display_sections'] = false;
$fua_config['sections_active'] = false;
$fua_config['sections_reverse_access'] = false;
$fua_config['section_message_type'] = 'alert';
$fua_config['display_modules'] = true;
$fua_config['modules_active'] = true;
$fua_config['modules_reverse_access'] = false;
$fua_config['modules_message_type'] = 'hide';
$fua_config['display_components'] = true;
$fua_config['use_componentaccess'] = true;
$fua_config['component_reverse_access'] = false;
$fua_config['components_message_type'] = 'inline_text';
$fua_config['display_url'] = false;
$fua_config['url_active'] = false;
$fua_config['url_message_type'] = 'alert';
$fua_config['use_menuaccess'] = true;
$fua_config['menu_reverse_access'] = false;
$fua_config['display_menuaccess'] = true;
$fua_config['menuaccess_message_type'] = 'inline_text';

$fua_config['menutypes'] = array(array('mainmenu','Main Menu'));
?>