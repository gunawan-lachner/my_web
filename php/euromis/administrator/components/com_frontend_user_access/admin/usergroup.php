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

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

//get id
if( defined('_JEXEC') ){
	//joomla 1.5
	$id = JRequest::getVar('id', '', 'get');
}else{
	//joomla 1.0.x
	mosGetParam( $_GET, 'id', '' );
}

if($sub_task == 'new'){
	//new usergroup
	
	$id = '';
	$name = '';	
	$description = '';
	$url = '';
	
	//end new usergroup
}else{
	//edit usergroup
	
	//get data
	$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups WHERE id='$id' LIMIT 1");
	$rows = $class_fua->db->loadObjectList();
	$row = $rows[0];
	$name = stripslashes($row->name);	
	$description = stripslashes($row->description);	
	$url = stripslashes($row->url);	
	
	//end edit usergroup
}

?>

<script language="JavaScript" type="text/javascript">

function submitbutton(pressbutton) {		
	if (pressbutton == 'usergroups') {		
			submitform( pressbutton );			
		}
	if (pressbutton == 'usergroup_save') {	
		if (document.getElementById('name').value == '') {			
			alert('<?php echo _fua_lang_nonameentered; ?>');
			return;
		} else {
			submitform('usergroup_save');
		}
	}
}

</script>

<form name="adminForm" method="post" action="">
		<input type="hidden" name="option" value="com_frontend_user_access" />
		<input type="hidden" name="task" value="usergroup_save" />
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table class="adminlist">
	<tr>
		<th colspan="2">
			<?php 
				if($sub_task == 'new'){ 
					echo _fua_lang_usergroup_new; 
				}else{
					echo _fua_lang_usergroup_edit; 
				}
			?>
		</th>
	</tr>
	<tr>
		<td width="300">
			<?php echo _fua_lang_name_usergroup; ?>
		</td>
		<td>
			<input name="name" id="name" type="text" value="<?php echo $name; ?>" class="text_area" style="width: 300px;" />
		</td>
	</tr>	
	<tr>
		<td width="300">
			<?php echo _fua_lang_description; ?>
		</td>
		<td>
			<textarea name="description" cols="20" rows="5" class="text_area" style="width: 300px;"><?php echo $description; ?></textarea>
		</td>
	</tr>
	<tr>
		<td width="300">
			<?php echo _fua_lang_redirect_after_login; ?>
		</td>
		<td>
			<input name="url" type="text" value="<?php echo $url; ?>" class="text_area" style="width: 300px;" />
			<br />
			<?php echo _fua_lang_example; ?>: index.php?option=com_content&amp;view=article&amp;id=19&amp;Itemid=27
		</td>
	</tr>	
</table>
</form>	 
<?php
$class_fua->display_footer();
?>