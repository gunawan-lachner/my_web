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

if(!$class_fua->fua_config['display_modules'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_modules_info.'. <a href="index3.php?option=com_frontend_user_access&task=instructions_modules" onclick="window.open(this.href, \''._fua_lang_instructions.'\', \'height=400,width=600,fullscreen=no,location=yes,menubar=yes,status=yes,toolbar=yes,scrollbars=yes,resizable=yes\'); return false;">'._fua_lang_instructions.'</a> ('._fua_lang_opens_in_popup.')</p>';

//legend and message if reverse access	
$class_fua->reverse_access_warning('modules_reverse_access');

//message in free version that these restrictions will not work in free version
$class_fua->not_in_free_version();

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db->loadObjectList();

//get module access from db
$class_fua->db->setQuery("SELECT module_groupid FROM #__fua_modules");
$access_modules = $class_fua->db->loadResultArray();

//get fua wrapper modules from database												
$class_fua->db->setQuery("SELECT id, title, params FROM #__modules WHERE module='mod_frontend_user_access' ORDER BY title");
$fua_modules_object = $class_fua->db->loadObjectList();	



$fua_modules_array = array();
foreach($fua_modules_object as $fua_module){
	$fua_module_id = $fua_module->id;
	$fua_module_title = $fua_module->title;	
	//get the id of the module to load in the wrapper
	$fua_module_params_temp = $fua_module->params;
	$fua_module_params = explode( "\n", $fua_module_params_temp);
	if(count($fua_module_params)>1){
		for($n = 0; $n < 3; $n++){		
			list($var,$value) = split('=',$fua_module_params[$n]); 
			$values[$var] = trim($value);	
		}	
		$fua_module_load_id = $values['fua_load_mod_id'];	
	}else{
		$fua_module_load_id = '';
	}	
	$fua_load_module_title = $class_fua->get_load_module_title($fua_module_load_id);	
	$fua_modules_array[] = array($fua_module_id, $fua_module_title, $fua_module_load_id, $fua_load_module_title);	
}

//message if component access is not activated
if($class_fua->fua_config['modules_active']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_no_modules_active.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}	

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

//make javascript array from components
$javascript_array_modules = 'var modules = new Array(';
for($n = 0; $n < count($fua_modules_array); $n++){	
	if($n==0){
		$first = false;
	}else{
		$javascript_array_modules .= ',';
	}
	$javascript_array_modules .= "'".$fua_modules_array[$n][0]."'";
}	
$javascript_array_modules .= ');';

//echo $javascript_array_modules;
//echo $n;
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_modules."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;		
	for (i = 0; i < modules.length; i++){
		box_id = modules[i]+'__'+usergroup_id;
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
		<input type="hidden" name="task" value="access_modules" />		

<table class="adminlist">
	<tr>		
		<th align="left"><?php echo _fua_lang_module_loading_module; ?>	
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
		for($n = 0; $n < count($fua_modules_array); $n++){			
			echo '<tr class="row'.$k.'"><td>['.$fua_modules_array[$n][0].'] '.$fua_modules_array[$n][1].' (';
			if($fua_modules_array[$n][2]!=''){
				echo ' ['.$fua_modules_array[$n][2].'] ';
			}
			echo $fua_modules_array[$n][3].')</td>';			
			foreach($fua_usergroups as $fua_usergroup){
				$checked = '';
				if (in_array($fua_modules_array[$n][0].'__'.$fua_usergroup->id, $access_modules)) {
					$checked = 'checked="checked"';
				}
				echo '<td align="center"><input type="checkbox" name="module_access[]" id="'.$fua_modules_array[$n][0].'__'.$fua_usergroup->id.'" value="'.$fua_modules_array[$n][0].'__'.$fua_usergroup->id.'" '.$checked.' /></td>';
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