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

if(!$class_fua->fua_config['display_categories'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_categories_info.'.</p>';	


//legend and message if reverse access	
$class_fua->reverse_access_warning('category_reverse_access');

//message in free version that these restrictions will not work in free version
$class_fua->not_in_free_version();

//message if category access is not activated	
if($class_fua->fua_config['categories_active']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_no_categories_active.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}				
		

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db-> loadObjectList();

//get category access from db
$class_fua->db->setQuery("SELECT category_groupid FROM #__fua_categories");
$access_categories = $class_fua->db->loadResultArray();

//get sections from db
$class_fua->db->setQuery("SELECT id, title FROM #__categories ORDER BY title");
$categories = $class_fua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();



	//make javascript array from sections
	$javascript_array_categories = 'var categories = new Array(';
	$first = true;
	foreach($categories as $category){		
		if($first){
			$first = false;
		}else{
			$javascript_array_categories .= ',';
		}
		$javascript_array_categories .= "'".$category->id."'";
	}	
	$javascript_array_categories .= ');';
		
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_categories."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;	
	for (i = 0; i < categories.length; i++){
		box_id = categories[i]+'__'+usergroup_id;
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
	<input type="hidden" name="task" value="categories" />		
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
		foreach($categories as $category){	
							
			echo '<tr class="row'.$k.'"><td>'.$category->title.'</td>';			
			foreach($fua_usergroups as $fua_usergroup){
				$checked = '';
				if (in_array($category->id.'__'.$fua_usergroup->id, $access_categories)) {
					$checked = 'checked="checked"';
				}
				echo '<td style="text-align:center;"><input type="checkbox" name="categoryAccess[]" id="'.$category->id.'__'.$fua_usergroup->id.'" value="'.$category->id.'__'.$fua_usergroup->id.'" '.$checked.' /></td>';
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