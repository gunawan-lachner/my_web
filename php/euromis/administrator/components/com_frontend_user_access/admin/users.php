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

if(!$class_fua->fua_config['display_users'] && $class_fua->user_type!='Super Administrator'){
	die('Restricted access');
}

//$fua_pagination = $class_fua->get_var('fua_pagination', '');

//header and nav
$class_fua->echo_header();

global $fua_usergroups;

$where = array();
$where[] = "u.usertype!='Super Administrator'";

$search = $class_fua->get_var('search','','post');
if($search){
	$where[] = '((u.name LIKE '.$class_fua->db->Quote( '%'.$class_fua->db->getEscaped( $search, true ).'%', false ).') OR (u.username LIKE '.$class_fua->db->Quote( '%'.$class_fua->db->getEscaped( $search, true ).'%', false ).') OR (u.email LIKE '.$class_fua->db->Quote( '%'.$class_fua->db->getEscaped( $search, true ).'%', false ).'))';
}

$joomla_group_filter = $class_fua->get_var('joomla_group_filter','','post');
if($joomla_group_filter){
	$where[] = '(u.gid = '.$joomla_group_filter.')';
}

$usergroup_filter = $class_fua->get_var('usergroup_filter','','post');
if($usergroup_filter){
	$where[] = '(i.group_id = '.$usergroup_filter.')';
}

$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );

//get users from db
$class_fua->db->setQuery( "SELECT u.id, u.name, u.username, u.email, u.gid, i.group_id AS fua_usergroup"
. "\nFROM #__users AS u"		
. "\nLEFT JOIN #__fua_userindex AS i"
. "\nON i.user_id=u.id"
//. "\nWHERE u.usertype!='Super Administrator' "
. $where
. "\nORDER BY username"
//. "\nLIMIT 2, 2"
);		
$fua_users = $class_fua->db-> loadObjectList();

//spunk up headers in joomla 1.5
$class_fua->spunk_up_headers_1_5();

echo '<p>';
echo _fua_lang_not_superadmin;
echo '</p>';

?>

<div style="text-align: right;">
<form name="searchform" method="post" action="index2.php?option=com_frontend_user_access&task=users">
<?php
echo _fua_lang_filter; ?>:
<input type="text" name="search" id="search" value="<?php echo $search;?>" class="text_area" onchange="document.adminForm.submit();" />
<button onclick="this.form.submit();"><?php echo _fua_lang_go; ?></button>
<?php
$selected = 'selected="selected"';
echo _fua_lang_joomlagroup.': '; 
echo '<select name="joomla_group_filter" id="joomla_group_filter" onchange="document.searchform.submit();">';
echo '<option value="">'._fua_lang_all.'</option>';
echo '<option value="18"';
if($joomla_group_filter==18){
	echo $selected;
}
echo '>registered</option>';
echo '<option value="19"';
if($joomla_group_filter==19){
	echo $selected;
}
echo '>author</option>';
echo '<option value="20"';
if($joomla_group_filter==20){
	echo $selected;
}
echo '>editor</option>';
echo '<option value="21"';
if($joomla_group_filter==21){
	echo $selected;
}
echo '>publisher</option>';
echo '<option value="23"';
if($joomla_group_filter==23){
	echo $selected;
}
echo '>manager</option>';
echo '<option value="24"';
if($joomla_group_filter==24){
	echo $selected;
}
echo '>administrator</option>';
echo '</select>';


$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups ORDER BY name");
$usergroups = $class_fua->db-> loadObjectList();

echo ' '._fua_lang_usergroup.': '; 
echo '<select name="usergroup_filter" id="usergroup_filter" onchange="document.searchform.submit();">';
echo '<option value="">'._fua_lang_all.'</option>';
foreach($usergroups as $usergroup){		
	echo '<option value="'.$usergroup->id.'"';
	if($usergroup->id==$usergroup_filter){
		echo $selected;
	}	
	echo '>'.$usergroup->name.'</option>';						
}
echo '</select>';
?>
&nbsp;<button onclick="document.getElementById('search').value='';document.getElementById('joomla_group_filter').value='';document.getElementById('usergroup_filter').value='';this.form.submit();"><?php echo _fua_lang_reset; ?></button>
</form>
</div>

<form name="adminForm" method="post" action="">
		<input type="hidden" name="option" value="com_frontend_user_access" />
		<input type="hidden" name="task" value="users_save" />		

<table class="adminlist">
	<tr>
		<th align="left">
			<?php echo _fua_lang_user; ?>
		</th>
		<th align="left">
			<?php echo _fua_lang_username; ?>
		</th>
		<th align="left">
			<?php echo _fua_lang_email; ?>
		</th>		
		<th align="left">
			<?php echo _fua_lang_joomlagroup; ?>
		</th>		
		<th align="left">
			<?php echo _fua_lang_usergroup; ?>					
		</th>
	</tr>	

<?php

//get usergroups
$class_fua->db->setQuery("SELECT * FROM #__fua_usergroups WHERE (id!='9') AND (id!='10') ORDER BY name");
$fua_usergroups = $class_fua->db-> loadObjectList();

function getUsergroupName($usergroupId){
	global $fua_usergroups;

	foreach($fua_usergroups as $fua_usergroup){
		if($fua_usergroup->id==$usergroupId){	
			$usergroupName = $fua_usergroup->name;
			return $usergroupName;
		}	
	}	
}

$k = 0;
for($i=0; $i < count( $fua_users ); $i++) {
	$row = $fua_users[$i];
	
	$usergroupName = getUsergroupName($row->fua_usergroup);		
	echo '<tr class="row'.$k.'"><td width="25%">'.$row->username.'</td><td>'.$row->name.'</td><td><a href="mailto:'.$row->email.'">'.$row->email;
	echo '</a></td>';	
	echo '<td>';
	if($class_fua->fua_config['show_joomla_group_select']){
		echo '<select name="gid[]">';
			echo '<option value="18"';
			if($row->gid==18){
				echo ' selected="selected"';
			}
			echo '>Registered</option>';
			echo '<option value="19"';
			if($row->gid==19){
				echo ' selected="selected"';
			}
			echo '>Author</option>';	
			echo '<option value="20"';
			if($row->gid==20){
				echo ' selected="selected"';
			}
			echo '>Editor</option>';
			echo '<option value="21"';
			if($row->gid==21){
				echo ' selected="selected"';
			}
			echo '>Publisher</option>';				
			echo '<option value="23"';
			if($row->gid==23){
				echo ' selected="selected"';
			}
			echo '>Manager</option>';			
			echo '<option value="24"';
			if($row->gid==24){
				echo ' selected="selected"';
			}
			echo '>Administrator</option>';		
		echo '</select>';
	}else{		
		if($row->gid==18){
			echo 'Registered';
		}else if($row->gid==19){
			echo 'Author';
		}else if($row->gid==20){
			echo 'Editor';		
		}else if($row->gid==21){
			echo 'Publisher';
		}else if($row->gid==23){
			echo 'Manager';		
		}else if($row->gid==24){
			echo 'Administrator';
		}
	}		
	echo '</td>';	
	echo '<td>';
	echo '<input type="hidden" name="user_id[]" value="'.$row->id.'" />';
	echo '<select name="usergroup[]">';
	echo '<option value="0"> --- </option>';
	foreach($fua_usergroups as $fua_usergroup){
		if($fua_usergroup->id==$row->fua_usergroup){
			$selected = ' selected="selected"';
		}else{
			$selected = '';
		}		
		echo '<option value="'.$fua_usergroup->id.'" '.$selected.'>'.$fua_usergroup->name.'</option>';						
	}				
	echo '</select>';
	echo '</td></tr>';
	
	if($k==1){
		$k = 0;
	}else{
		$k = 1;
	}
}
if(count($fua_users)==0){
	echo '<tr><td colspan="5">'._fua_lang_nousers.' <a href="index2.php?option=com_users&task=view">user manager</a>.</td></tr>';
}
?>
	
</table>
<?php
/*
echo $fua_pagination;
$total = count($fua_users);
$pages = ceil($total/2);
//echo 'pages='.$pages;
echo '<select name="fua_pagination" onchange="adminForm.submit();">';
for($n = 0; $n <= count($pages); $n++){
	echo '<option value="'.($n+1).'">';
	echo $n.' - '.($n+1).'00';
	echo '</option>';
}
echo '</select>';

$db =& JFactory::getDBO();
$app =& JFactory::getApplication();
$lim   = $mainframe->getUserStateFromRequest("$option.limit", 'limit', 14, 'int'); //I guess getUserStateFromRequest is for session or different reasons
$lim0  = JRequest::getVar('limitstart', 0, '', 'int');
$db->setQuery('SELECT SQL_CALC_FOUND_ROWS title FROM jos_content ',$lim0, $lim);
$rL=&$db->loadAssocList();
if (empty($rL)) {$app->enqueueMessage($db->getErrorMsg(),'error'); return;}  
else {
////Here the beauty starts
$db->setQuery('SELECT FOUND_ROWS();');  //no reloading the query! Just asking for total without limit
jimport('joomla.html.pagination');
$pageNav = new JPagination( $db->loadResult(), $lim0, $lim );
foreach($rL as $r) {
//your display code here
}
}
echo $pageNav->getListFooter(  ); //Displays a nice footer




$class_fua->db->setQuery("SELECT title "
."FROM #__content "
);
$rows = $class_fua->db->loadObjectList();

$test = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
$option = 'com_mycomp';
$total = count($test);
$app =& JFactory::getApplication();
$limit = $app->getUserStateFromRequest("global.list.limit", 'limit', $app->getCfg('list_limit'), 'int');
$limit = 5;
//$limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', 5 );
//$limit      = $app->getUserStateFromRequest( "viewlistlimit", 'limit', 5 );

$limitstart = $app->getUserStateFromRequest("{$option}.limitstart", 'limitstart', 0, 'int');
//$limitstart = JRequest::getVar('limitstart', 0, 'post', 'int');
//$limitstart = 10;

$levellimit = $app->getUserStateFromRequest("{$option}.limit", 'levellimit', 10, 'int'); 
echo 'total='.$total.'<br />';
echo 'limit='.$limit.'<br />';
echo 'limitstart='.$limitstart.'<br />';
echo 'levellimit='.$levellimit.'<br />';
echo 'option='.$option.'<br />'; 
if ($limitstart >= $total) $limitstart = 0;
jimport('joomla.html.pagination');



$pageNav = new JPagination( $total, $limitstart, $limit );
//$levellist = JHTML::_('select.integerList' , 1, 20, 1, 'levellimit', 'size="1" onchange="document.adminForm.submit();"', $levellimit);
//$levellist = JHTML::_('select.integerList' , 1, 20, 1, 'limit', 'size="1" onchange="document.adminForm.submit();"', $limit);
//$list = array_slice($list, $pageNav->limitstart, $pageNav->limit);

echo $pageNav->getListFooter();
//echo $pageNav->getLimitBox();
//echo $pageNav->getPagesLinks();
//echo '<input type="hidden" name="limitstart" value="0">';
//echo $pageNav->limitstart;
*/
?>
</form>
<?php

$class_fua->display_footer();
?>