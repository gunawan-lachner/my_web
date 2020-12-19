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

if(!$class_fua->fua_config['display_menuaccess'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_menu_info.'.</p>';

//legend and message if reverse access	
$class_fua->reverse_access_warning('menu_reverse_access');

//message in free version that these restrictions will not work in free version
$class_fua->not_in_free_version();

//message if item access is not activated		
if($class_fua->fua_config['use_menuaccess']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_no_active_menu.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}			

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db->loadObjectList();

//get menu access from db
$class_fua->db->setQuery("SELECT menuid_groupid FROM #__fua_menuaccess");
$access_menuitems = $class_fua->db->loadResultArray();

//get menuitems from db
$class_fua->db->setQuery("SELECT id, menutype, name, parent, ordering FROM #__menu WHERE (published='0' OR published='1') ORDER BY ordering ASC");
$fua_menu_items = $class_fua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();
?>


<script language="javascript" type="text/javascript">

<?php


//make javascript arrays from menuItems per menutype
for($n = 0; $n < count($class_fua->fua_config['menutypes']); $n++){
	$javascript_menu = 'var menuarray_'.$class_fua->fua_config['menutypes'][$n][0].' = new Array(';
	$first = true;
	foreach($fua_menu_items as $page){
		if($page->menutype==$class_fua->fua_config['menutypes'][$n][0]){
			if($first){
				$first = false;
			}else{
				$javascript_menu .= ',';
			}
			$javascript_menu .= '"'.$page->id.'"';
		}
	}
	$javascript_menu .= ');';
	echo $javascript_menu."\n";
}

//make javascript array from usergroups
$javascript_array_usergroups = 'var usergroups = new Array(';
$first = true;
foreach($fua_usergroups as $usergroup){
	if($first){
		$first = false;
	}else{
		$javascript_array_usergroups .= ',';
	}
	$javascript_array_usergroups .= '"'.$usergroup->id.'"';
}
$javascript_array_usergroups .= ');';
echo $javascript_array_usergroups."\n";

?>

function select_all(menutype_array_name, usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;	
	pages = eval(menutype_array_name);	
	for (i = 0; i < pages.length; i++){
		box_id = pages[i]+'_0_'+usergroup_id;
		if(action==true){
			//alert(box_id);
			document.getElementById(box_id).checked = true;
		}else{
			document.getElementById(box_id).checked = false;
		}
	}	
}

</script>
<form name="adminForm" method="post" action="">
	<input type="hidden" name="option" value="com_frontend_user_access" />
	<input type="hidden" name="task" value="menuaccess" />		
<table class="adminlist">
	<tr>		
		<th align="left">&nbsp;
						
		</th>
		<?php			
			$class_fua->loop_usergroups($fua_usergroups);			
		?>
	</tr>
		
	<?php
							
$fua_page_access_superthing = new fua_page_access_superthing();
$fua_page_access_superthing->fua_page_access_init($fua_usergroups, $class_fua->fua_config, $fua_menu_items, $access_menuitems);
$fua_page_access_superthing->fua_echo_menus();
	
class fua_page_access_superthing{	
	
	var $usergroups;
	var $config;
	var $menu_items;
	var $fua_current_menu_type;	
	var $current_parent;
	var $page_access;
	
	function fua_page_access_init($fua_usergroups, $fua_config, $fua_menu_items, $access_menuitems){
		$this->usergroups = $fua_usergroups;
		$this->config = $fua_config;		
		$this->menu_items = $fua_menu_items;
		$this->page_access = $access_menuitems;
	}
	
	function fetch_menuitems($id, $menu_type) {		
		$menu = null;
		$menu = array();
		
		foreach($this->menu_items as $menuItem){
			if($menuItem->parent==$id && $menuItem->menutype==$menu_type){
				$itemArray = array($menuItem->id, $menuItem->name, $menuItem->parent);				
				array_push($menu, $itemArray);
			}
		}	
		return $menu;
	}

	function look_for_children($menu,$level) {
		if (!is_array($menu)) return;  
		$level = $level + 1;
		foreach ($menu as $m){
			$this->show_menu_item($m,$level);
		}  
		$level = $level - 1;   	
	}
	
	function show_menu_item($m,$level) {		
		$padding = $level*2;
		echo '<tr class="row1"><td style="text-align: left; padding-left: '.$padding.'0px">';
		echo $m[1];
		echo '</td>';
		foreach($this->usergroups as $usergroup){
			$checked = '';
			if (in_array($m[0].'_'.$usergroup->id, $this->page_access)) {
				$checked = 'checked="checked"';
			}
			echo '<td align="center"><input type="checkbox" name="menu_access[]" value="'.$m[0].'_'.$usergroup->id.'" id="'.$m[0].'_0_'.$usergroup->id.'" '.$checked.'  /></td>';
		}
		echo '</tr>';
		if ($menu = $this->fetch_menuitems($m[0],$this->fua_current_menu_type)){
			$this->look_for_children($menu,$level);
		}
	}
	
	function fua_echo_menus(){
		for($n = 0; $n < count($this->config['menutypes']); $n++){
			echo '<tr><td colspan="'.(count($this->usergroups)+1).'">&nbsp;</td></tr>';
			echo '<tr><td style="font-size: 1.5em; font-weight: bold;text-align: left;" colspan="'.(count($this->usergroups)+1).'">';
			echo $this->config['menutypes'][$n][1];
			echo '</td></tr>';
			$this->fua_current_menu_type = $this->config['menutypes'][$n][0];
			echo '<tr class="row1"><td>'._fua_lang_selectall.'</td>';
			foreach($this->usergroups as $usergroup){
				echo '<td align="center">';
				echo '<input type="checkbox" name="checkall[]" value="" id="'.$this->fua_current_menu_type.'_'.$usergroup->id.'" onclick="select_all(\'menuarray_'.$this->fua_current_menu_type.'\','.$usergroup->id.',this.id);" />';
				echo '</td>';
			}
			echo '</tr>';				
			$this->look_for_children($this->fetch_menuitems(0,$this->fua_current_menu_type),0);
		}
	}
	
	
}




?>	
</table>
</form>
<?php

$class_fua->display_footer();

?>