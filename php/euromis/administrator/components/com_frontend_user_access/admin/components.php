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

if(!$class_fua->fua_config['display_components'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_components_info.'.</p>';	

//legend and message if reverse access	
$class_fua->reverse_access_warning('component_reverse_access');

//message if component access is not activated
if($class_fua->fua_config['use_componentaccess']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_nocomponentactive.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}	
		

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db->loadObjectList();

//get components access from db
$class_fua->db->setQuery("SELECT component_groupid FROM #__fua_components");
$access_components = $class_fua->db->loadResultArray();

//get components from database												
$class_fua->db->setQuery("SELECT * FROM #__components ORDER BY name"  );							
//$class_fua->db->setQuery("SELECT name, option FROM #__components"  ); why this does not work, I do not know
$components_db_all = $class_fua->db->loadObjectList();	



$components_db = array();
if(!defined('_JEXEC')){
	$components_db[] = array('Articles', 'com_content');
}
$components_options_gone = array();
foreach($components_db_all as $component_db_all){
	$component_name = $component_db_all->name;
	$component_option = $component_db_all->option;
	//filter out pi_itemtypes and com_cpanel
	if(!strpos($component_option, '_pi_itemtype_') && $component_option!='com_cpanel' && $component_option!='' && $component_option!='com_frontend_user_access' && $component_name!='Contact Categories' && $component_name!='Web Link Categories'){	
		//give com_category an option
		if($component_name=='Categories' || $component_name=='Manage Categories'){
			$component_option = 'com_categories';									
		}
		if(!in_array($component_option, $components_options_gone)){
			$components_options_gone[] = $component_option;
			$components_db[] = array($component_name, $component_option);
		}
	}
}	

//print_r($components_db);			
//echo count($components_db);
//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

//make javascript array from components
$javascript_array_components = 'var components = new Array(';
for($n = 0; $n < count($components_db); $n++){	
	if($n==0){
		$first = false;
	}else{
		$javascript_array_components .= ',';
	}
	$javascript_array_components .= "'".$components_db[$n][1]."'";
}	
$javascript_array_components .= ');';

//echo $javascript_array_components;
//echo $n;
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_components."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;		
	for (i = 0; i < components.length; i++){
		box_id = components[i]+'__'+usergroup_id;
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
		<input type="hidden" name="task" value="access_components" />		

<table class="adminlist">
	<tr>		
		<th align="left">&nbsp;
						
		</th>
		<?php			
			$class_fua->loop_usergroups($fua_usergroups);			
		?>			
	</tr>
		
	<?php
		
		//row with select_all checkboxes
		echo '<tr class="row0">';
		echo '<td align="left">'._fua_lang_selectall.'</td>';
		foreach($fua_usergroups as $fua_usergroup){
			echo '<td style="text-align:center;"><input type="checkbox" name="checkall[]" value="" id="checkall_'.$fua_usergroup->id.'" onclick="select_all('.$fua_usergroup->id.',this.id);" /></td>';
		}
		echo '</tr>';
				
		$k = 1;		
		$counter = 0;	
		for($n = 0; $n < count($components_db); $n++){			
			echo '<tr class="row'.$k.'"><td>'.$components_db[$n][0].' ('.$components_db[$n][1].')</td>';			
			foreach($fua_usergroups as $fua_usergroup){
				$checked = '';
				if (in_array($components_db[$n][1].'__'.$fua_usergroup->id, $access_components)) {
					$checked = 'checked="checked"';
				}
				echo '<td align="center"><input type="checkbox" name="componentsAccess[]" id="'.$components_db[$n][1].'__'.$fua_usergroup->id.'" value="'.$components_db[$n][1].'__'.$fua_usergroup->id.'" '.$checked.' /></td>';
			}
			echo '</tr>';
			if($k==1){
				$k = 0;
			}else{
				$k = 1;
			}			
			if($counter==15){
				echo '<tr><th>&nbsp;</th>';	
				$class_fua->loop_usergroups($fua_usergroups);
				echo '</tr>';
				$counter = 0;
			}
			$counter = $counter+1;	
		}
	
	?>
			
</table>
</form>
<?php
$class_fua->display_footer();
?>