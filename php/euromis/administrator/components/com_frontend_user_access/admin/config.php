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

if($class_fua->user_type!='Super Administrator'){
	echo "<script> alert('you need to be logged in as a super administrator to edit the frontend_user_access config.'); window.history.go(-1); </script>";
	exit();
}

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

?>
<script src="../includes/js/overlib_mini.js" language="JavaScript" type="text/javascript"></script>
<script src="components/com_frontend_user_access/javascript/javascript.js" language="JavaScript" type="text/javascript"></script>
<link href="components/com_frontend_user_access/css/frontend_user_access2.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">

function submitbutton(pressbutton) {
	if (pressbutton == 'config_save') {
		submitform('config_save');
	}
	if (pressbutton == 'config_apply') {
		document.getElementById('sub_task').value = 'apply';
		submitform('config_save');
	}		
	if (pressbutton == 'cancel') {
		document.location.href = 'index2.php?option=com_frontend_user_access';		
	}
}

<?php

$tab = $class_fua->get_var('tab', false);	

if(!$tab){
	
	echo "cookie_value = getCookie('fua_tabs');"."\n";	
	echo "if(cookie_value!=null){"."\n";		
		echo "current_tab = cookie_value;"."\n";
	echo "}else{"."\n";		
		echo "setCookie('fua_tabs', 'general_settings', '', '', '', '');"."\n";
		echo "current_tab = 'general_settings';"."\n";
	echo "}"."\n";
}else{
	echo "setCookie('fua_tabs', '".$tab."', '', '', '', '');"."\n";
	echo "current_tab = '".$tab."';"."\n";
}

?>

function get_tab(tab){
	if(tab!=current_tab){
		new_tab = 'tab_'+tab;	
		document.getElementById(new_tab).className = 'on';
		old_tab = 'tab_'+current_tab;	
		document.getElementById(old_tab).className = 'none';
		document.getElementById(tab).style.display = 'block';	
		document.getElementById(current_tab).style.display = 'none';
		current_tab = tab;
		setCookie('fua_tabs', tab, '', '', '', '');
	}
}

function pi_config_menu_init(){
	current_tab_name = 'tab_'+current_tab;	
	document.getElementById(current_tab_name).className = 'on';
	document.getElementById(current_tab).style.display = 'block';	
}

if(window.addEventListener)window.addEventListener("load",pi_config_menu_init,false);else if(window.attachEvent)window.attachEvent("onload",pi_config_menu_init);

function set_classnames(content, wrappers_up, wrappers_down){
	document.getElementById('classname_wrapper_content').value = content;
	document.getElementById('classnames_wrappers_up').value = wrappers_up;
	document.getElementById('classnames_wrappers_down').value = wrappers_down;
}

</script>

<form name="adminForm" method="post" action="">
	<input type="hidden" name="option" value="com_frontend_user_access" />
	<input type="hidden" name="task" value="config_save" />	
	<input type="hidden" name="sub_task" id="sub_task" value="" />		
	<div style="margin: 0 auto; width: 980px; text-align: left;">	
		<?php
			$class_fua->check_demo_time_left();
		?>
		<a href="index2.php?option=com_frontend_user_access">Frontend User Access</a>	&gt; <?php echo _fua_lang_config; ?>
		<h2>Frontend User Access configuration</h2>
		<?php			
			if(!is_writable(dirname(__FILE__).'/../configuration.php')){
					echo '<p class="warning">administrator/components/com_frontend_user_access/configuration.php '._fua_lang_confignotwriteable.'</p>';
			}
		?>		
		<ul id="fua_menu">				
			<li>
				<a id="tab_general_settings" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('general_settings');"><span><?php echo _fua_lang_general; ?></span></a>
			</li>
			<li>
				<a id="tab_users" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('users');"><span><?php echo _fua_lang_users; ?></span></a>
			</li>				
			<li>
				<a id="tab_item_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('item_access');"><span><?php echo _fua_lang_item_access; ?></span></a>
			</li>
			<li>
				<a id="tab_category_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('category_access');"><span><?php echo _fua_lang_category_access; ?></span></a>
			</li>
			<li>
				<a id="tab_section_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('section_access');"><span><?php echo _fua_lang_section_access; ?></span></a>
			</li>	
			<li>
				<a id="tab_module_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('module_access');"><span><?php echo _fua_lang_module_access; ?></span></a>
			</li>		
			<li>
				<a id="tab_component_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('component_access');"><span><?php echo _fua_lang_component_access; ?></span></a>
			</li>
			<!--
			<li>
				<a id="tab_url_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('url_access');"><span><?php echo _fua_lang_url_access; ?></span></a>
			</li>	
			-->	
			<li>
				<a id="tab_menu_access" onfocus="if(this.blur)this.blur();" href="javascript:get_tab('menu_access');"><span><?php echo _fua_lang_menu_access; ?></span></a>
			</li>		
		</ul>				
		<div id="general_settings">
		<table class="adminlist">			
			<tr>
				<th colspan="3" align="left">									
					<?php echo _fua_lang_general; ?>
				</th>
			</tr>
			<tr>		
				<td width="230">
					configuration.php				
				</td>
				<td>
					<?php 
					if(is_writable(dirname(__FILE__).'/../configuration.php')){
						echo '<span style="color: #5F9E30;">'._fua_lang_configwriteable.'</span>';
					}else{
						echo '<span style="color: red;">'._fua_lang_confignotwriteable.'</span>';
					}			
				?>					
				</td>
				<td width="400" style="white-space: nowrap;">
					administrator/components/com_frontend_user_access/configuration.php
				</td>
			</tr>
			<tr>		
				<td width="230">
					<?php echo _fua_lang_cache; ?>		
				</td>
				<td>
					<?php 
					 $config =& JFactory::getConfig();
        			if ($config->getValue('caching')){					
						echo '<span style="color: red;">'._fua_lang_is_enabled.'</span>';
					}else{
						echo '<span style="color: #5F9E30;">'._fua_lang_is_not_enabled.'</span>';
					}			
				?>					
				</td>
				<td width="400" style="white-space: nowrap;">
					<?php 
					echo _fua_lang_cache_info.'<br />'; 
					echo _fua_lang_cache_info2; 
					echo ' <a href="index.php?option=com_config">';
					echo _fua_lang_global_config;
					echo '</a> ';
					echo _fua_lang_cache_info3.'.'; 
					?>	
				</td>
			</tr>					
			<tr>		
				<td>
					<?php echo _fua_lang_statusbot; ?> (system)
				</td>
				<td>
					<?php 
					if($class_fua->bot_installed_system){
						echo '<div style="color: #5F9E30;">'._fua_lang_botinstalled.'</div>';				
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotinstalled.'</div>';
					}										
					if($class_fua->bot_published_system){
						echo '<div style="color: #5F9E30;">'._fua_lang_botpublished.'</div>';		
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotpublished.'</div>';
					}					
					?>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>			
			<tr>		
				<td>
					<?php echo _fua_lang_statusbot; ?> (content)
				</td>
				<td>
					<?php 
					if($class_fua->bot_installed_content){
						echo '<div style="color: #5F9E30;">'._fua_lang_botinstalled.'</div>';				
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotinstalled.'</div>';
					}
					if($class_fua->bot_published_content){
						echo '<div style="color: #5F9E30;">'._fua_lang_botpublished.'</div>';		
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotpublished.'</div>';
					}
					?>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>	
			<tr>		
				<td>
					<?php echo _fua_lang_statusbot; ?> (user)					
				</td>
				<td>					
					<?php 
					$plugin_installed = false;
					$plugin_enabled = false;
					
					//check if plugin is installed and published
					$class_fua->db->setQuery("SELECT published "
					."FROM #__plugins "
					."WHERE element='frontend_user_access' AND folder='user' "
					."LIMIT 1"					
					);
					$rows = $class_fua->db->loadObjectList();					
					foreach($rows as $row){	
						$plugin_installed = true;
						$plugin_enabled = $row->published;
					}
										
					if($plugin_installed){
						echo '<div style="color: #5F9E30;">'._fua_lang_botinstalled.'</div>';				
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotinstalled.'</div>';
					}
					if($plugin_enabled){
						echo '<div style="color: #5F9E30;">'._fua_lang_botpublished.'</div>';				
					}else{
						echo '<div style="color: red;">'._fua_lang_botnotpublished.'</div>';
					}				
					?>
				</td>
				<td>
					<?php
					if($class_fua->fua_version_type=='free'){
						echo '<span style="color: red;">'._fua_lang_not_in_free.'</span> ';
					}
					?>
				</td>
			</tr>							
			<tr>		
				<td>
					<?php echo _fua_lang_language.' '._fua_lang_backend; ?>
				</td>
				<td>
					<select name="language">
					<?php
						if( defined('_JEXEC') ){
							//joomla 1.5
							jimport( 'joomla.filesystem.folder' );
							$languages = JFolder::files(dirname(__FILE__).'/../language');
						}else{
							//joomla 1.0.x
							$languages = mosReadDirectory(dirname(__FILE__).'/../language');
						}						
						foreach($languages as $language){
							if($language!='index.html'){
								$language = str_replace('.php','',$language);
								$selected = '';
								if($language==$class_fua->fua_config['language']){
									$selected = ' selected="selected"';
								}
								echo '<option value="'.$language.'"'.$selected.'>'.$language.'</option>';
							}
						}
					?>
					</select>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_language.' '._fua_lang_frontend; ?>
				</td>
				<td>
					<select name="language_frontend">
					<?php
						if( defined('_JEXEC') ){
							//joomla 1.5
							jimport( 'joomla.filesystem.folder' );
							$languages = JFolder::files(dirname(__FILE__).'/../../../../components/com_frontend_user_access/language_frontend');
						}else{
							//joomla 1.0.x
							$languages = mosReadDirectory(dirname(__FILE__).'/../../../../components/com_frontend_user_access/language_frontend');
						}						
						foreach($languages as $language){
							if($language!='index.html'){
								$language = str_replace('.php','',$language);
								$selected = '';
								if($language==$class_fua->fua_config['language_frontend']){
									$selected = ' selected="selected"';
								}
								echo '<option value="'.$language.'"'.$selected.'>'.$language.'</option>';
							}
						}
					?>
					</select>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_defaulttab; ?>
				</td>
				<td>
					<select name="default_tab">
						<?php							
							echo '<option value="usergroups"';
							if($class_fua->fua_config['default_tab']=='usergroups'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_usergroups.'</option>';
							echo '<option value="users"';
							if($class_fua->fua_config['default_tab']=='users'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_users.'</option>';							
							echo '<option value="items"';
							if($class_fua->fua_config['default_tab']=='items'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_item_access.'</option>';
							echo '<option value="categories"';
							if($class_fua->fua_config['default_tab']=='categories'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_category_access.'</option>';	
							echo '<option value="sections"';
							if($class_fua->fua_config['default_tab']=='sections'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_section_access.'</option>';	
							echo '<option value="modules"';
							if($class_fua->fua_config['default_tab']=='modules'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_module_access.'</option>';						
							echo '<option value="components"';
							if($class_fua->fua_config['default_tab']=='components'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_component_access.'</option>';
							echo '<option value="menuaccess"';
							if($class_fua->fua_config['default_tab']=='menuaccess'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_menu_access.'</option>';
							/*	
							echo '<option value="url"';
							if($class_fua->fua_config['default_tab']=='url'){
								echo ' selected="selected"';
							}
							echo '>'._fua_lang_url_access.'</option>';
							*/											
						?>					
					</select>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<?php echo _fua_lang_show_tab; ?>
				</td>
			</tr>
						
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_usergroups" value="true" <?php if($class_fua->fua_config['display_usergroups']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_usergroups; ?></label>
				</td>
			</tr>			
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_users" value="true" <?php if($class_fua->fua_config['display_users']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_users; ?></label>
				</td>
			</tr>
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_items" value="true" <?php if($class_fua->fua_config['display_items']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_item_access; ?></label>			
				</td>
			</tr>
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_categories" value="true" <?php if($class_fua->fua_config['display_categories']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_category_access; ?></label>		
				</td>
			</tr>	
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_sections" value="true" <?php if($class_fua->fua_config['display_sections']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_section_access; ?></label>	
				</td>
			</tr>	
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_modules" value="true" <?php if($class_fua->fua_config['display_modules']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_module_access; ?></label>	
				</td>
			</tr>						
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_components" value="true" <?php if($class_fua->fua_config['display_components']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_component_access; ?></label>			
				</td>
			</tr>	
			<tr>		
				<td>&nbsp;
					
				</td>
				<td colspan="2">
					<label><input type="checkbox" name="display_menuaccess" value="true" <?php if($class_fua->fua_config['display_menuaccess']){echo 'checked="checked"';} ?> class="checkbox" /><?php echo _fua_lang_menu_access; ?></label>			
				</td>
			</tr>					
			<tr>		
				<td>
					<?php echo _fua_lang_version; ?>	
				</td>
				<td>
					<?php echo $class_fua->version; ?>
				</td>
				<td>&nbsp;
					
				</td>
			</tr>				
			<tr>		
				<td colspan="3">&nbsp;
					
				</td>
			</tr>
			</table>
			</div>
			<div id="users">
			<table class="adminlist">			
			<tr>
				<th colspan="3" align="left">
				
					<?php echo _fua_lang_users; ?>
				</th>
			</tr>
			<tr>		
				<td width="230">
					<?php echo _fua_lang_showjoomlagroup; ?>
				</td>
				<td colspan="2">
					<label><input type="radio" name="show_joomla_group_select" value="true" <?php if($class_fua->fua_config['show_joomla_group_select']=='1'){echo 'checked="checked"';} ?> class="radio" />				
					<?php echo _fua_lang_showjoomlagroup_tip; ?></label><br />
					<label><input type="radio" name="show_joomla_group_select" value="false" <?php if($class_fua->fua_config['show_joomla_group_select']=='0'){echo 'checked="checked"';} ?> class="radio" />	
					<?php echo _fua_lang_disableselectbox; ?></label>	
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_default_usergroup; ?>
				</td>
				<td>
					<select name="default_usergroup">
						<?php
						$class_fua->db->setQuery("SELECT id, name "
						."FROM #__fua_usergroups  "						
						."ORDER BY name ASC"
						);
						$rows = $class_fua->db->loadObjectList();
						if(count($rows)){	
							echo '<option value="0">'._fua_lang_none.'</option>';									
							foreach($rows as $row){	
								if($row->id!=9 && $row->id!=10){
									echo '<option value="'.$row->id.'"';
									if($class_fua->fua_config['default_usergroup']==$row->id){
										echo ' selected="selected"';
									}
									echo '>';							
									echo $row->name;
									echo '</option>';
								}	
							}
						}
						?>						
					</select> 
				</td>
				<td>
					<?php 
					if(count($rows)<3){
						echo '<span style="color: red;">'._fua_lang_nousergroups.'</span> ';
					}
					echo _fua_lang_default_usergroup_info; 
					if($class_fua->fua_version_type=='free'){
						echo '<br /><span style="color: red;">'._fua_lang_not_in_free.'</span> ';
					}
					?>
				</td>
			</tr>
			<tr>		
				<td>
					<?php 
					echo _fua_lang_redirect_after_login; 
					
					$redirect_url = '';
					if($class_fua->fua_config['redirect_url']){
						$redirect_url = $class_fua->fua_config['redirect_url'];
					}
					
					?>
				</td>
				<td width="350">
					<input type="text" name="redirect_url" value="<?php echo $redirect_url; ?>" style="width: 300px;" /><br />
					<?php echo _fua_lang_example; ?>: index.php?option=com_content&view=article&id=19&Itemid=27
				</td>
				<td>
					<?php 
					echo _fua_lang_redirect_after_login_info.'.'; 					
					if($class_fua->fua_version_type=='free'){
						echo '<br /><span style="color: red;">'._fua_lang_not_in_free.'</span> ';
					}
					?>
				</td>
			</tr>
			<tr>		
				<td colspan="3">&nbsp;
					
				</td>
			</tr>	
			</table>
			</div>				
			<div id="item_access">
			<table class="adminlist">						
			<tr>
				<th colspan="3" align="left">
					
					<?php echo _fua_lang_item_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_items_activate; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="items_active" value="true" <?php if($class_fua->fua_config['items_active']){echo 'checked="checked"';} ?> />
				</td>
				<td>&nbsp;
					
				</td>
			</tr>	
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="items_reverse_access" value="true" <?php if($class_fua->fua_config['items_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>	
			<tr>		
				<td>
					<?php echo _fua_lang_display_articles; ?>
				</td>
				<td colspan="2">									
					<label><input type="radio" name="items_display_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['items_display_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_item.']\''; ?></label><br />	
					<label><input type="radio" name="items_display_type" value="hide" class="radio" <?php if($class_fua->fua_config['items_display_type']=='hide'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_hide_article; ?></label>
					<div style="margin-left: 20px; border: 1px solid #ccc; padding: 10px;<?php if(defined('_JEXEC')){echo 'display: none;';} ?>">
						
						<?php echo '<b>'._fua_lang_joomla10_only.'</b><br />'._fua_lang_items_hide_info; ?>
						<div class="fua_wrapper">
							<!--<input type="button" value="Beez" onclick="set_classnames('div,article_row','','');" />&nbsp;&nbsp;
							<input type="button" value="JA_Purity" onclick="set_classnames('div,contentpaneopen','','span,article_separator');" />&nbsp;&nbsp;
							<input type="button" value="rhuk_milkyway" onclick="set_classnames('table,contentpaneopen','table,contentpaneopen','span,article_separator');" />&nbsp;&nbsp;-->
							<input type="button" value="rhuk_solarflare_ii" onclick="set_classnames('table,contentpaneopen','table,contentpaneopen','span,article_seperator');" />&nbsp;&nbsp;
							<input type="button" value="madeyourweb " onclick="set_classnames('table,contentpaneopen','table,contentpaneopen','span,article_seperator');" />
						</div>
						<?php echo _fua_lang_items_hide_info2; ?>
						<div class="fua_wrapper">
							<div class="sidestep">
								<input type="text" value="<?php echo $class_fua->fua_config['classnames_wrappers_up']; ?>" name="classnames_wrappers_up" id="classnames_wrappers_up" class="css_input" />
							</div>
							<div class="sidestep2">
								<?php echo _fua_lang_hide_wrappers_up; ?><br />
								table,contentpaneopen;table,contentpaneopen
							</div>
						</div>
						<div class="fua_wrapper">
							<div class="sidestep">
								<input type="text" value="<?php echo $class_fua->fua_config['classname_wrapper_content']; ?>" name="classname_wrapper_content" id="classname_wrapper_content" class="css_input" />
							</div>
							<div class="sidestep2">
								<?php echo _fua_lang_hide_wrapper_content; ?><br />
								div,contentpaneopen
							</div>
						</div>						
						<div class="fua_wrapper">
							<div class="sidestep">
								<input type="text" value="<?php echo $class_fua->fua_config['classnames_wrappers_down']; ?>" name="classnames_wrappers_down" id="classnames_wrappers_down" class="css_input"  />								
							</div>
							<div class="sidestep2">
								<?php echo _fua_lang_hide_wrappers_down; ?><br />
								div,rating;span,article_separator
							</div>
						</div>
						
					</div>
				</td>
			</tr>		
			<tr>		
				<td>
					<?php echo _fua_lang_messagetype_items; ?>
				</td>
				<td colspan="2">
					<label><input type="radio" name="items_message_type" value="alert" class="radio" <?php if($class_fua->fua_config['items_message_type']=='alert'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_alert; ?></label><br />
					<label><input type="radio" name="items_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['items_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_page.']\''; ?></label>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_messagetype_archive; ?>
				</td>
				<td colspan="2">
					<?php echo _fua_lang_messagetype_archive_info; ?>
				</td>
			</tr>					
			<tr>		
				<td colspan="3">&nbsp;
					
				</td>
			</tr>	
			</table>
			</div>			
			<div id="category_access">
			<?php $class_fua->not_in_free_version(); ?>
			<table class="adminlist">					
			<tr>
				<th colspan="3" align="left">
					
					<?php echo _fua_lang_category_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_activatecategories; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="categories_active" value="true" <?php if($class_fua->fua_config['categories_active']){echo 'checked="checked"';} ?> />
				</td>
				<td>
				</td>
			</tr>	
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="category_reverse_access" value="true" <?php if($class_fua->fua_config['category_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>			
			<tr>		
				<td>
					<?php echo _fua_lang_messagetype_category; ?>
				</td>
				<td colspan="2">					
					<label><input type="radio" name="category_message_type" value="alert" class="radio" <?php if($class_fua->fua_config['category_message_type']=='alert'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_alert; ?></label><br />
					<label><input type="radio" name="category_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['category_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_page.']\''; ?></label>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_display_other; ?>
				</td>
				<td colspan="2">
					<?php echo _fua_lang_see_article_access.' \''._fua_lang_display_articles.'\' '._fua_lang_on_tab; ?> <a href="javascript: get_tab('item_access');"><?php echo _fua_lang_item_access; ?></a>.
				</td>
			</tr>		
			<tr>		
				<td colspan="3">&nbsp;
					
				</td>
			</tr>
			</table>
			</div>	
			<div id="section_access">
			<?php $class_fua->not_in_free_version(); ?>
			<table class="adminlist">					
			<tr>
				<th colspan="3" align="left">
					
					<?php echo _fua_lang_section_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_sections_active; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="sections_active" value="true" <?php if($class_fua->fua_config['sections_active']){echo 'checked="checked"';} ?> />
				</td>
				<td>&nbsp;
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="sections_reverse_access" value="true" <?php if($class_fua->fua_config['sections_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_messagetype_section; ?>
				</td>
				<td colspan="2">					
					<label><input type="radio" name="section_message_type" value="alert" class="radio" <?php if($class_fua->fua_config['section_message_type']=='alert'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_alert; ?></label><br />
					<label><input type="radio" name="section_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['section_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_page.']\''; ?></label>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_display_other; ?>
				</td>
				<td colspan="2">
					<?php echo _fua_lang_see_article_access.' \''._fua_lang_display_articles.'\' '._fua_lang_on_tab; ?> <a href="javascript: get_tab('item_access');"><?php echo _fua_lang_item_access; ?></a>.
				</td>
			</tr>
			<tr>		
				<td colspan="3">&nbsp;
					
				</td>
			</tr>
			</table>
			</div>				
			<div id="module_access">
			<?php $class_fua->not_in_free_version(); ?>
			<table class="adminlist">						
			<tr>
				<th colspan="3" align="left">
					
					<?php echo _fua_lang_module_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_use_moduleaccess; ?>
				</td>
				<td>
					<input type="checkbox" name="modules_active" value="true" <?php if($class_fua->fua_config['modules_active']){echo 'checked="checked"';} ?> />
				</td>
				<td><?php
				echo _fua_lang_modules_info.'. <a href="index3.php?option=com_frontend_user_access&task=instructions_modules" onclick="window.open(this.href, \''._fua_lang_instructions.'\', \'height=400,width=600,fullscreen=no,location=yes,menubar=yes,status=yes,toolbar=yes,scrollbars=yes,resizable=yes\'); return false;">'._fua_lang_instructions.'</a> ('._fua_lang_opens_in_popup.')';	
				?>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="modules_reverse_access" value="true" <?php if($class_fua->fua_config['modules_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_modules_message_type; ?>
				</td>
				<td colspan="2">
					<label><input type="radio" name="modules_message_type" value="hide" class="radio" <?php if($class_fua->fua_config['modules_message_type']=='hide'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_hide_module; ?></label><br />
					
					<label><input type="radio" name="modules_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['modules_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_modules_message_type_text.': \'['._fua_lang_no_access_module.']\''; ?></label>
				</td>				
			</tr>
			<tr>
				<td colspan="3">&nbsp;
																								
				</td>
			</tr>			
			</table>
			</div>			
			<div id="component_access">			
			<table class="adminlist">						
			<tr>
				<th colspan="3" align="left">					
					<?php echo _fua_lang_component_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_use_componentaccess; ?>
				</td>
				<td>
					<input type="checkbox" name="use_componentaccess" value="true" <?php if($class_fua->fua_config['use_componentaccess']){echo 'checked="checked"';} ?> />
				</td>
				<td><?php echo _fua_lang_components_info; ?>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="component_reverse_access" value="true" <?php if($class_fua->fua_config['component_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_components_message_type; ?>
				</td>
				<td colspan="2">
					<label><input type="radio" name="components_message_type" value="alert" class="radio" <?php if($class_fua->fua_config['components_message_type']=='alert'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_alert; ?></label><br />
					
					<label><input type="radio" name="components_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['components_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_page.']\''; ?></label>
				</td>				
			</tr>
			<tr>
				<td colspan="3">&nbsp;
																								
				</td>
			</tr>			
			</table>
			</div>	
			<div id="menu_access">	
			<?php $class_fua->not_in_free_version(); ?>		
			<table class="adminlist">						
			<tr>
				<th colspan="3" align="left">					
					<?php echo _fua_lang_menu_access; ?>
				</th>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_use_menu_access; ?>
				</td>
				<td>
					<input type="checkbox" name="use_menuaccess" value="true" <?php if($class_fua->fua_config['use_menuaccess']){echo 'checked="checked"';} ?> />
				</td>
				<td><?php echo _fua_lang_menu_info; ?>
				</td>
			</tr>
			<tr>		
				<td>
					<?php echo _fua_lang_reverse_access; ?>
				</td>
				<td>
					<input type="checkbox" class="checkbox" name="menu_reverse_access" value="true" <?php if($class_fua->fua_config['menu_reverse_access']){echo 'checked="checked"';} ?> />
				</td>
				<td>
					<?php echo _fua_lang_reverse_access_info; ?>.					
				</td>
			</tr>
			<tr>		
				<td width="300">
					<?php echo _fua_lang_menuaccess_message_type; 
					
					//set default when updating
					if(!$class_fua->fua_config['menuaccess_message_type']){
						$class_fua->fua_config['menuaccess_message_type'] = 'text';
					}
					
					?>
				</td>
				<td colspan="2">
					<label><input type="radio" name="menuaccess_message_type" value="text" class="radio" <?php if($class_fua->fua_config['menuaccess_message_type']=='text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_menuaccess_message_type_text.': \''._fua_lang_no_access_page.'\' '._fua_lang_menuaccess_message_type_text2.'.'; ?></label><br />
					
					<label><input type="radio" name="menuaccess_message_type" value="alert" class="radio" <?php if($class_fua->fua_config['menuaccess_message_type']=='alert'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_alert; ?></label><br />
					
					<label><input type="radio" name="menuaccess_message_type" value="inline_text" class="radio" <?php if($class_fua->fua_config['menuaccess_message_type']=='inline_text'){echo 'checked="checked"';} ?> /><?php echo _fua_lang_components_message_type_inline_text.': \'['._fua_lang_no_access_page.']\''; ?></label>					
				</td>				
			</tr>			
			<tr>
				<td colspan="3">&nbsp;
																								
				</td>
			</tr>	
			<tr>		
				<td colspan="3">
					<?php echo _fua_lang_menus; ?>
				</td>				
			</tr>
			<tr>		
				<td>&nbsp;
								
				</td>
				<td colspan="2">
					<span class="sidestep2 b"><?php echo _fua_lang_name; ?></span><span class="b"><?php echo _fua_lang_order; ?></span>
				</td>
			</tr>
			<?php
			
			//loop through menutypes from config
			$counter = 1;
			$menus_from_config = $class_fua->fua_config['menutypes'];
			$menus_on_page = array();
			for($m = 0; $m < count($menus_from_config); $m++){
				$menu_type = $menus_from_config[$m][0];
				$menu_name = $menus_from_config[$m][1];
				if($menu_name){					
					echo '<tr>';
					echo '<td>&nbsp;</td>';
					echo '<td colspan="2">';
					echo '<span class="sidestep2">';
					echo '<label>';					
					echo '<input type="checkbox" class="checkbox" name="menutypes[m'.$m.'][menutype]" value="'.$menu_type.'" checked="checked" />';									
					echo $menu_name;
					echo '</label>';
					echo '</span>';					
					echo '<input type="hidden" name="menutypes[m'.$m.'][title]" value="'.$menu_name.'" />';
					echo '<input type="text" name="menutypes[m'.$m.'][order]" size="2" value="'.$counter.'" />';				
					echo '</td>';
					echo '</tr>';					
					array_push($menus_on_page, $menu_type);				
					$counter = $counter + 1;
				}	
			}
			
			//get all menutypes
			$menutypes_db = array();			
						
			$class_fua->db->setQuery("SELECT title, menutype FROM #__menu_types ORDER BY title ASC"  );
			$rows = $class_fua->db-> loadObjectList();
			
			foreach($rows as $row){					
				$new_menutype = array($row->menutype,$row->title);
				array_push($menutypes_db, $new_menutype);					
			}					
			
				
			//loop through menutypes from database						
			for($m = 0; $m < count($menutypes_db); $m++){
				if(!in_array($menutypes_db[$m][0], $menus_on_page)){	
					echo '<tr>';
					echo '<td>&nbsp;</td>';
					echo '<td  colspan="2">';
					echo '<span class="sidestep2">';
					echo '<label>';					
					echo '<input type="checkbox" class="checkbox" name="menutypes[m'.($counter-1).'][menutype]" value="'.$menutypes_db[$m][0].'" />';
					echo $menutypes_db[$m][1];
					echo '</label>';
					echo '</span>';
					echo '<input type="hidden" name="menutypes[m'.($counter-1).'][title]" value="'.$menutypes_db[$m][1].'" />';
					echo '<input type="text" name="menutypes[m'.($counter-1).'][order]" size="2" value="'.$counter.'" />';					
					echo '</td>';
					echo '</tr>';						
					$counter = $counter + 1;
				}
			}			
				
			?>		
			</table>
			</div>			
		</div>
</form>
<?php
$class_fua->display_footer();
?>