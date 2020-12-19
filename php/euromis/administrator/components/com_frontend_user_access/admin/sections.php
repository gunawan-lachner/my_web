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

if(!$class_fua->fua_config['display_sections'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_sections_info.'.</p>';	

//legend and message if reverse access	
$class_fua->reverse_access_warning('sections_reverse_access');

//message in free version that these restrictions will not work in free version
$class_fua->not_in_free_version();

//message if section access is not activated
if($class_fua->fua_config['sections_active']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_no_sections_active.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}	
		

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db-> loadObjectList();

//get section access from db
$class_fua->db->setQuery("SELECT section_groupid FROM #__fua_sections");
$access_sections = $class_fua->db->loadResultArray();

//get sections from db
$class_fua->db->setQuery("SELECT id, title FROM #__sections ORDER BY title");
$sections = $class_fua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();



	//make javascript array from sections
	$javascript_array_sections = 'var sections = new Array(';
	$first = true;
	foreach($sections as $section){		
		if($first){
			$first = false;
		}else{
			$javascript_array_sections .= ',';
		}
		$javascript_array_sections .= "'".$section->id."'";
	}	
	$javascript_array_sections .= ');';
		
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_sections."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;	
	for (i = 0; i < sections.length; i++){
		box_id = sections[i]+'__'+usergroup_id;
		if(action==true){
			document.getElementById(box_id).checked = true;
		}else{
			document.getElementById(box_id).checked = false;
		}
	}	
}

</script>
<form name="adminForm" method="post" action="">
	<input type="hidden" name="option" value="com_frontend_user_access" />
	<input type="hidden" name="task" value="sections" />		
<table class="adminlist">
	<tr>		
		<th align="left">&nbsp;
						
		</th>
		<?php			
			$class_fua->loop_usergroups($fua_usergroups);			
		?>			
	</tr>
		
	<?php
							
		$k = 1;		
		
		//row with select_all checkboxes
		echo '<tr class="row1">';
		echo '<td>'._fua_lang_selectall.'</td>';
		foreach($fua_usergroups as $fua_usergroup){
			echo '<td style="text-align:center;"><input type="checkbox" name="checkall[]" value="" id="checkall_'.$fua_usergroup->id.'" onclick="select_all('.$fua_usergroup->id.',this.id);" /></td>';
		}
		echo '</tr>';
			
		$counter = 0;		
		foreach($sections as $section){						
			echo '<tr class="row'.$k.'"><td>'.$section->title.'</td>';			
			foreach($fua_usergroups as $fua_usergroup){
				$checked = '';
				if (in_array($section->id.'__'.$fua_usergroup->id, $access_sections)) {
					$checked = 'checked="checked"';
				}
				echo '<td style="text-align:center;"><input type="checkbox" name="sectionAccess[]" id="'.$section->id.'__'.$fua_usergroup->id.'" value="'.$section->id.'__'.$fua_usergroup->id.'" '.$checked.' /></td>';
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