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

if(!$class_fua->fua_config['display_usergroups'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//header and nav
$class_fua->echo_header();

//get usergroups
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups WHERE (id!='9') AND (id!='10') ORDER BY name");
$rows = $class_fua->db->loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

?>

<script language="JavaScript" type="text/javascript">

function submitbutton(pressbutton) {
	if (pressbutton == 'usergroup') {	
		document.location.href = 'index2.php?option=com_frontend_user_access&task=usergroup&sub_task=new';		
	}		
	if (pressbutton == 'usergroup_delete') {
		if (document.adminForm.boxchecked.value == '0') {						
			alert('<?php echo _fua_lang_noselectusergroups; ?>');
			return;
		} else {
			if(confirm("<?php echo _fua_lang_suredeleteusergroup; ?>")){
				submitform('usergroup_delete');
			}
		}
	}
}


</script>

<form name="adminForm" method="post" action="">
		<input type="hidden" name="option" value="com_frontend_user_access" />
		<input type="hidden" name="task" id="task" value="usergroup" />
		<input type="hidden" name="boxchecked" value="0" />		
<table class="adminlist">
	<tr>
		<th width="5" align="left">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />			
		</th>
		<th align="left">
			<?php echo _fua_lang_usergroups; ?>
		</th>
		<th align="left">
			<?php echo _fua_lang_description; ?>
		</th>
	</tr>	

<?php


$k = 0;	
for($i=0; $i < count( $rows ); $i++) {
	$row = $rows[$i];		
	echo '<tr class="row'.$k.'"><td><input type="checkbox" id="cb'.$i.'" name="cid[]" value="'.$row->id.'" onclick="isChecked(this.checked);" /></td><td><a href="index2.php?option=com_frontend_user_access&amp;task=usergroup&amp;id='.$row->id.'">'.stripslashes($row->name).'</a></td>';
	echo '<td>';
	echo stripslashes($row->description);
	echo '</td>';
	echo '</tr>';
	if($k==1){
		$k = 0;
	}else{
		$k = 1;
	}	
}
if(count($rows)==0){
	echo '<tr><td colspan="3">'._fua_lang_nousergroups.'</td></tr>';
}

?>

	</tr>
</table>
</form>
<?php
$class_fua->display_footer();
?>