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

if(!$class_fua->fua_config['display_items'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

echo '<p>'._fua_lang_items_info.': \'['._fua_lang_no_access_item.']\'. '._fua_lang_items_info2.'.</p>';

//legend and message if reverse access	
$class_fua->reverse_access_warning('items_reverse_access');

//message if item access is not activated		
if($class_fua->fua_config['items_active']==false){				
	echo '<div style="color: red; text-align: left;">'._fua_lang_no_active_items.'. '._fua_lang_activate_in_config.'<br/><br/></div>';
}			

//get usergroups from db
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$fua_usergroups = $class_fua->db->loadObjectList();

//get item access from db
$class_fua->db->setQuery("SELECT itemid_groupid FROM #__fua_items");
$access_items = $class_fua->db->loadResultArray();

//get items from db
$class_fua->db->setQuery("SELECT id, title FROM #__content  WHERE state='-1' OR state='0' OR state='1' ORDER BY title");
$items = $class_fua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();



	//make javascript array from items
	$javascript_array_items = 'var items = new Array(';
	$first = true;
	foreach($items as $item){		
		if($first){
			$first = false;
		}else{
			$javascript_array_items .= ',';
		}
		$javascript_array_items .= "'".$item->id."'";
	}	
	$javascript_array_items .= ');';
		
?>
<script language="javascript" type="text/javascript">

<?php echo $javascript_array_items."\n"; ?>

function select_all(usergroup_id, select_all_id){
	action = document.getElementById(select_all_id).checked;	
	for (i = 0; i < items.length; i++){
		box_id = items[i]+'__'+usergroup_id;
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
	<input type="hidden" name="task" value="items" />		
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
		foreach($items as $item){						
			echo '<tr class="row'.$k.'"><td>'.$item->title;
			echo '</td>';			
			foreach($fua_usergroups as $fua_usergroup){
				$checked = '';
				if (in_array($item->id.'__'.$fua_usergroup->id, $access_items)) {
					$checked = 'checked="checked"';
				}
				echo '<td style="text-align:center;"><input type="checkbox" name="item_access[]" id="'.$item->id.'__'.$fua_usergroup->id.'" value="'.$item->id.'__'.$fua_usergroup->id.'" '.$checked.' /></td>';
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