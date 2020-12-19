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
<h1>Instructies voor  toegang restricties op  modules</h1>
<ul>
	<li><a href="#add">module toevoegen aan  Frontend-User-Access module</a></li>
	<li><a href="#copy">een Frontend-User-Access module kopieren</a></li>
	<li><a href="#set">toegang restricties instellen voor  modules</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Module toevoegen aan Frontend-User-Access module</h2>
<p>Om de toegang tot een module te kunnen instellen moet deze woden geladen binnen een Frontend-User-Access module (helaas geeft Joomla geen event-handlers om de toegang tot modules direct te kunnen regelen). De Frontend-User-Access module werkt als een container om de module die kan worden verborgen als de gebruiker geen toegang tot de module heeft die erin geladen worden. Dus moet je de  Frontend-User-Access module configureren dat ie de module laadt waar je toegangsrechten op wilt zetten. </p>
<ol>
	<li>Ga naar 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Vindt de module waar je toegangsrechten op wilt zetten in de lijst met modules. Noteer het id van de module door te kijken in de kolom  'ID'.</li>
	<li>Open een  Frontend-User-Access module.<br>
		Als je de module net hebt geinstalleerd, is de naam van de module 'Frontend-User-Access'. Als de naam eerder is gewijzigd, of je hebt een kopy van de module gemaakt, zoek dan in de kolom 'type' naar 'mod_frontend_user_access'. Klik op de module-naam. </li>
	<li>Wijzig de module naam in iets logisch. Misschien kun je het best de naam van de module gebruiken die je erin wilt gaan laden om toegang toe te beperken. </li>
	<li>Selecteer bij 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> 'Ja'.</li>
	<li>Selecteer een positie voor de module. Als je dit niet begrijpt kies dan 'left'.</li>	
	<li>Onder  'module parameters' by 'load module id' vul je het id in die je in stap 2 hebt opgeschreven. </li>	
	<li>Klik 'opslaan'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> de module die nu in de Frontend-User-Access module, dit om zeker te zijn dat de module nergens anders wordt getoond dan in de Frontend-User-Access module. </li>
	<li>Verberg de naam van de module die nu in de Frontend-User-Access module module geladen wordt, anders staan er 2 titels onder elkaar (niet nodig in Joomla 1.0.x).	</li>
</ol>


<p>Een Frontend-User-Acces module kan slecht 1 module laden. Dus je moet een kopie maken van een  Frontend-User-Access module voor elke module waar je toegangs rechten op wilt toepassen. Als je meer Frontend-User-Access modules nodig hebt, ga dan naar de  'Module Manager' en kopieer een  Frontend-User-Access module. Hier staat hoe je dat moet doen. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>Kopieer een Frontend-User-Access module</h2>

<ol>
	<li>Ga naar  <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Vind een Frontend-User-Access module. Zoek in de kolom 'type' naar 'mod_frontend_user_access'. </li>
	<li>Selecteer de  module door een vinkje te zetten naast de module naam. </li>
	<li>Klik in de toolbar rechtsboven op 'kopie'.<br>
	De module is nu gekopieerd. De naam van de nieuwe module begint met 'Kopie van' gevolgd door de oorspronkelijke naam.</li>
	<li>Klik op de gekopieerde module-naam.  </li>
		<li>Selecteer bij 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> 'Ja'.</li>
		<li>Selecteer een positie voor de module. Als je dit niet begrijpt kies dan 'left'.<br>
	</li>	
	<li>Onder  'module parameters' bij 'load module id' voer het id in van de module die erin geladen moet worden. </li>	
	<li>Klik 'opslaan'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Toegangs restricties instellen voor modules</h2>

<ol>
	<li>Ga naar  'Componenten' &gt; 'Frontend-User-Access'.</li>
	<li>Klik op  'module toegang'. <br>
	</li>
	<li>Vink vakjes aan om toegangs rechten of restricties te geven voor elke module en elke gebruikersgroep. </li>
	<li>Klik 'opslaan'.</li>
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