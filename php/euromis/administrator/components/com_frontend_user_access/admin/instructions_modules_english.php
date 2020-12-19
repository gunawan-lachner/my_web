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

?>
<style type="text/css">
h2 a{
	margin-right: 20px;
	font-size: 0.8em;
}
</style>
<a name="top"></a>
<h1>Instructions for setting access restrictions on modules</h1>
<ul>
	<li><a href="#add">add module to Frontend-User-Access module</a></li>
	<li><a href="#copy">copying a Frontend-User-Access module</a></li>
	<li><a href="#set">set access restrictions for modules</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Add module to Frontend-User-Access module</h2>
<p>To restrict access to a module, the module needs to be loaded within a Frontend-User-Access module (unfortunately Joomla does not provide any event-handlers for restricting access to modules directly). The Frontend-User-Access module will work as a user-access wrapper, alowing the module to be hidden when the user has no access. So you need to configure a Frontend-User-Access module so it loads the module you want to ristrict access to. </p>
<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Find the module you want to restrict access to in the list. Take note of the id in the column 'ID'.</li>
	<li>Open a Frontend-User-Access module.<br>
		If you have just installed the module, its module-name is 'Frontend-User-Access'. If you changed the name or just made a copy of the module, look in column 'type' for 'mod_frontend_user_access'. Click on the module's title.</li>
	<li>Edit the title to something sensible. Best use the title of the module which you are going to restrict access to. </li>
	<li>Set 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> to 'Yes'.</li>
	<li>Select a position for the module. If you are new to this select 'left'.</li>	
	<li>Under 'module parameters' at 'load module id' enter the id you noted in step 2. </li>	
	<li>Click 'save'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> the module which is now loaded in the Frontend-User-Access module, just to make sure it does not show anywhere  except within the Frontend-User-Access module. </li>
	<li>Hide the title of the embedded module.
	</li>
</ol>


<p>A Frontend-User-Acces module can only load one module. So you have to make a copy of a Frontend-User-Access module for each module you want to restrict access to. If you need more Frontend-User-Access modules, go to the 'Module Manager' and copy any Frontend-User-Access module. Here is how. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>Copying a Frontend-User-Access module</h2>

<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Find a Frontend-User-Access module. Look in column 'type' for 'mod_frontend_user_access'. </li>
	<li>Select the module by selecting the box next to the module's name. </li>
	<li>Click in the top-right toolbar on 'copy'.<br>
	The module has now been copied. The title will be 'Copy of ' followed by the old module name.</li>
	<li>Click on the copied module's name.  </li>
		<li>Set 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> to 'Yes'.</li>
	<li>Select a position for the module. If you are new to this select 'left'. <br>
	</li>	
	<li>Under 'module parameters' at 'load module id' enter the id of the module you want to include. </li>	
	<li>Click 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Set access restrictions for modules</h2>

<ol>
	<li>Go to 'Components' &gt; 'Frontend-User-Access'.</li>
	<li>Click 'module access'. <br>
	</li>
	<li>Set access rights or restrictions for each module and for each usergroup. </li>
	<li>Click 'save'.</li>
</ol>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br /><br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />