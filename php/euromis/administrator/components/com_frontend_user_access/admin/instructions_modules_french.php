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
<h1>Instructions pour configurer les restrictions d'acc&egrave;s aux modules</h1>
<ul>
	<li><a href="#add">ajouter un module au module Frontend-User-Access</a></li>
	<li><a href="#copy">copier un module Frontend-User-Access</a></li>
	<li><a href="#set">g&eacute;rer les restrictions d'acc&egrave;s aux modules</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>ajouter un module au module Frontend-User-Access</h2>
<p>Pour restreindre l'acc&egrave;s &agrave; un module, le module doit &ecirc;tre charg&eacute; avec un module Frontend-User-Access (malheureusement Joomla ne fourni pas d'assistance pour restreindre directement les acc&egrave;s aux modules). Le module Frontend-User-Access fonctionnera comme un programme d'acc&egrave;s des utilisateurs, permettant de cacher le module lorsque l'utilisateur n'y a pas acc&egrave;s. Vous devez donc configurer le module Frontend-User-Access de façon &agrave; ce qu'il charge le module dont vous voulez restreindre l'acc&egrave;s. </p>
<ol>
	<li>Allez &agrave; <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Cherchez le module dont vous voulez restreindre l'acc&egrave;s dans la liste. Notez son id dans la colonne 'ID'.</li>
	<li>Ouvrir un module Frontend-User-Access.<br>
		Si vous venez d'installer le module, son nom est 'Frontend-User-Access'. Si vous changez le nom ou si vous copiez simplement le module, cherchez dans la colonne 'type' le nom 'mod_frontend_user_access'. Clickez sur le titre du module.</li>
	<li>Nommez le avec un nom facile. Il est plus simple d'utiliser le titre du module dont vous voulez restreindre l'acc&egrave;s. </li>
	<li>R&eacute;glez 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> sur 'oui'.</li>
	<li>S&eacute;lectionnez une position pour le module. Si vous ne savez pas trop, s&eacute;lectionnez 'gauche'.</li>	
	<li>Sous 'parametres des modules' dans 'load module id' entrez l'id que vous avez not&eacute; &agrave; l'&eacute;tape 2. </li>	
	<li>Clickez sur 'sauver'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> le module qui est charg&eacute; dans le module Frontend-User-Access, afin d'&ecirc;tre sur qu'il ne soit visible nul part sauf dans le module Frontend-User-Access. </li>
</ol>


<p>Un module Frontend-User-Acces ne peut charger qu'un seul module. Vous devez donc faire une copie du module Frontend-User-Access pour chaque module dont vous voulez restreindre les acc&egrave;s. Si vous avez besoin de plus de modules Frontend-User-Access, allez dans le 'Module Manager' et copiez n'importe quel module Frontend-User-Access.</p>

<a name="copy"></a>
<h2><a href="#top">top</a>copier un module Frontend-User-Access</h2>

<ol>
	<li>Aller &agrave; <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Trouvez un module Frontend-User-Access. Cherchez 'mod_frontend_user_access' dans la colonne 'type'. </li>
	<li>S&eacute;lectionnez le module en cochant la case pr&egrave;s du nom du module. </li>
	<li>Clickez dans la barre d'outils en haut &agrave; droite sur 'copier'.<br>
	Le module sera donc copi&eacute;. Le titre sera 'Copie de ' suivi du nom de l'ancien module.</li>
	<li>Clickez sur le nom du module copi&eacute;.  </li>
		<li>r&eacute;glez 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> sur 'oui'.</li>
	<li>S&eacute;lectionnez une position pour le module. Si vous ne savez pas s&eacute;lectionnez  'gauche'. <br>
	</li>	
	<li>Sous 'parametres des modules' dans 'load module id' entrez l'id du module que vous voulez inclure. </li>	
	<li>Clickez 'sauver'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>g&eacute;rer les restrictions d'acc&egrave;s aux modules</h2>

<ol>
	<li>Allez &agrave; 'Composants' &gt; 'Frontend-User-Access'.</li>
	<li>Clickez 'acc&egrave;s aux modules'. <br>
	</li>
	<li>R&eacute;glez les droits ou restrictions d'acc&egrave;s pour chaque module et pour chaque groupe d'utilisateur. </li>
	<li>Clickez 'sauver'.</li>
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
