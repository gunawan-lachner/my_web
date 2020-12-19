<?php
/**
* @csomag Frontend-User-Access (com_frontend_user_access)
* @verzio 2.0.1
* @copyright Szerz&#337;i jogok (C) 2008 Carsten Engel. Minden jog fenntartva.
* @license GPL verzi&oacute;k ingyenes/id&#337;korl&aacute;tos/pro
* @szerzõ weboldala http://www.pages-and-items.com
* @joomla a Joomla ingyenes szoftver
*/

//nincs kozvetlen hozzaferes
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
<h1>&Uacute;tmutat&oacute; a modulok hozz&aacute;f&eacute;r&eacute;si korl&aacute;toz&aacute;sainak be&aacute;ll&iacute;t&aacute;s&aacute;hoz</h1>
<ul>
	<li><a href="#add">Modul hozz&aacute;ad&aacute;sa a Frontend-User-Access modulhoz</a></li>
	<li><a href="#copy">Frontend-User-Access modul m&aacute;sol&aacute;sa</a></li>
	<li><a href="#set">Modulok hozz&aacute;f&eacute;r&eacute;s korl&aacute;toz&aacute;s&aacute;nak be&aacute;ll&iacute;t&aacute;sa</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">Elej&eacute;re</a>&Uacute;j modul hozz&aacute;ad&aacute;sa a Frontend-User-Access modulhoz</h2>
<p>Egy modul hozz&aacute;f&eacute;r&eacute;s&eacute;nek korl&aacute;toz&aacute;s&aacute;hoz az kell, hogy a modul be legyen t&ouml;ltve Frontend-User-Access modulk&eacute;nt. (A Joomla sajnos nem biztos&iacute;t semmilyen esem&eacute;ny-kezel&#337;t a modulok k&ouml;zvetlen hozz&aacute;f&eacute;r&eacute;s&eacute;nek a korl&aacute;toz&aacute;s&aacute;ra). A Frontend-User-Access modul &uacute;gy m&#369;k&ouml;dik, mint egy wrapper, beburkolja a felhaszn&aacute;l&oacute;i hozz&aacute;f&eacute;r&eacute;st. Ezzel lehet&#337;v&eacute; teszi, hogy a hozz&aacute;f&eacute;r&eacute;ssel nem rendelkez&#337;k sz&aacute;m&aacute;ra a modul rejtett marad. Ez&eacute;rt van sz&uuml;ks&eacute;g egy olyan Frontend-User-Access modul kialak&iacute;t&aacute;s&aacute;ra,  amely bet&ouml;lti azt a modult, amelynek a hozz&aacute;f&eacute;r&eacute;s&eacute;t korl&aacute;tozni k&iacute;v&aacute;njuk. </p>
<ol>
	<li>L&eacute;pjen be a men&uuml;be: <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'B&#337;v&iacute;tm&eacute;nyek' &gt; 'Modulkezel&#337;'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Keresse meg azt a modult a list&aacute;ban, amelynek a hozz&aacute;f&eacute;r&eacute;s&eacute;t korl&aacute;tozni k&iacute;v&aacute;nja. Jegyezze fel a modul egyedi azonos&iacute;t&oacute; sz&aacute;m&aacute;t az 'AZ' oszlopban.</li>
	<li>Nyisson meg egy Frontend-User-Access modult.<br>
		Ha &eacute;ppen el&#337;tte telep&iacute;tette a modult, akkor annak a modul-neve 'Frontend-User-Access'. Ha megv&aacute;ltoztatta a nev&eacute;t a modulnak vagy esetleg egy m&aacute;solatot k&eacute;sz&iacute;tett r&oacute;la, akkor keresse a 'mod_frontend_user_access' nevet a t&aacute;bl&aacute;zat 'T&iacute;pus' oszlop&aacute;ban. Kattintson a modul nev&eacute;re.</li>
	<li>Szerkessze &aacute;t a modulnevet valami &eacute;rthet&#337;bbre. A legjobb, ha annak a modulnak a nev&eacute;t haszn&aacute;lja, amelynek a hozz&aacute;f&eacute;r&eacute;s&eacute;t korl&aacute;tozni akarja. </li>
	<li>&Aacute;ll&iacute;tsa az
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enged&eacute;lyezett'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> &aacute;llapotot 'Igen'-re.</li>
	<li>V&aacute;lasszon poz&iacute;ci&oacute;t a modulnak. Ha ebben nem j&aacute;ratos, v&aacute;lassza a 'bal' pozici&oacute;t.</li>	
	<li>&Iacute;rja be a 'modul azonos&iacute;t&oacute; bet&ouml;lt&eacute;se' mez&#337;be a 'modul param&eacute;terek' alatt a modulazonos&iacute;t&oacute;t, amit feljegyzett a 2. l&eacute;p&eacute;sben.</li>	
	<li>Kattintson a 'Ment&eacute;s' gombra.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Tiltsa le";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> a modult, amelyet bet&ouml;lt&ouml;tt a Frontend-User-Access modulba, hogy biztos lehessen benne, hogy sehol m&aacute;shol nem fog megjelenni, csak a Frontend-User-Access modulban. </li>
	<li>Tiltsa le a be&aacute;gyazott modul c&iacute;m&eacute;nek megjelen&eacute;s&eacute;t.
	</li>
</ol>


<p>Egy Frontend-User-Acces modul egyszerre csak egy modult tud bet&ouml;lteni. Ez&eacute;rt, minden egyes modul eset&eacute;ben, amelynek a hozz&aacute;f&eacute;r&eacute;s&eacute;t korl&aacute;tozni k&iacute;v&aacute;nja, k&eacute;sz&iacute;tenie kell egy m&aacute;solatot egy Frontend-User-Access modulr&oacute;l. Ha t&ouml;bb  Frontend-User-Access modulra van sz&uuml;ks&eacute;ge, l&eacute;pjen be a 'Modulkezel&#337;'-be &eacute;s k&eacute;sz&iacute;tsen m&aacute;solatot b&aacute;rmely Frontend-User-Access modulr&oacute;l. Ez a k&ouml;vetkez&#337;k&eacute;ppen t&ouml;rt&eacute;nik. </p>

<a name="copy"></a>
<h2><a href="#top">Elej&eacute;re</a>Frontend-User-Access modul m&aacute;sol&aacute;sa</h2>

<ol>
	<li>L&eacute;pjen be a men&uuml;be: <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'B&#337;v&iacute;tm&eacute;nyek' &gt; 'Modulkezel&#337;'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>V&aacute;lasszon ki egy Frontend-User-Access modult. Keressen a 'mod_frontend_user_access' n&eacute;vre a 'T&iacute;pus' oszlopban. </li>
	<li>Jel&ouml;lje ki a modult a modul neve melletti jel&ouml;l&#337;n&eacute;gyzet kiv&aacute;laszt&aacute;s&aacute;val. </li>
	<li>Kattintson a jobb-fels&#337; eszk&ouml;zt&aacute;ron a 'M&aacute;sol&aacute;s' parancsra.<br>
	A modul m&aacute;sol&aacute;sa ezzel megt&ouml;rt&eacute;nt. A modul c&iacute;me a modul r&eacute;gi neve plusz az el&eacute;illesztett 'M&aacute;solat -' el&#337;tag lesz.</li>
	<li>Kattintson r&aacute; a lem&aacute;solt modul nev&eacute;re.  </li>
		<li>&Aacute;ll&iacute;tsa
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enged&eacute;lyezett'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> mez&#337;t 'Igen'-re.</li>
	<li>V&aacute;lasszon poz&iacute;ci&oacute;t a modulnak. Ha ebben nem j&aacute;ratos, v&aacute;lassza a 'bal' pozici&oacute;t. <br>
	</li>	
	<li>&Iacute;rja be a 'modul azonos&iacute;t&oacute; bet&ouml;lt&eacute;s' mez&#337;be a 'modul param&eacute;terek'-n&eacute;l annak a modulnak az azonos&iacute;t&oacute;j&aacute;t, amelyre korl&aacute;toz&aacute;st akar alkalmazni. </li>	
	<li>Kattintson a 'Ment&eacute;s' gombra.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">Elej&eacute;re</a>Modulok hozz&aacute;f&eacute;r&eacute;s korl&aacute;toz&aacute;s&aacute;nak be&aacute;ll&iacute;t&aacute;sa</h2>

<ol>
	<li>Menjen a 'Komponensek' men&uuml;ben &gt; a 'Frontend-User-Access'-hez.</li>
	<li>Kattintson a 'Modul hozz&aacute;f&eacute;r&eacute;s'-re. <br>
	</li>
	<li>&Aacute;ll&iacute;tsa be a hozz&aacute;f&eacute;r&eacute;si jogot vagy korl&aacute;toz&aacute;st az egyes felhaszn&aacute;l&oacute;i csoportokhoz tartoz&oacute; b&aacute;rmely modulra. </li>
	<li>Kattintson a 'Ment&eacute;s' gombra.</li>
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
