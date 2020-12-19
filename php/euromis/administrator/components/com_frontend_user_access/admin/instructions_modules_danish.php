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
<h1>Instruktioner for indstilling af adgangs restriktioner p&aring; moduler</h1>
<ul>
	<li><a href="#add">tilf&oslash;j modul til Frontend-Bruger-Adgang modul</a></li>
	<li><a href="#copy">kopiering af Frontend-Bruger-Adgang modul</a></li>
	<li><a href="#set">indstil adgangs restriktioner for modulet</a></li>
</ul>
	
<a name="tilf&oslash;"></a>
<h2><a href="#top">top</a>Tilf&oslash;j modul til Frontend-Bruger-Adgang modul</h2>
<p>For at restriktere et modul, bliver modulet n&oslash;d til at blive lastet inden i et Frontend-Bruger-Adgangs modul (desv&aelig;rre giver Joomla ingen muligheder for at restriktere direkte adgang til moduler). Frontend-Bruger-Adgangs modulet vil virke som en bruger-adgangs wrapper, der tillader at skjule modulet n&aring;r bruger ikke har adgang. So du skal konfigurere et Frontend-Bruger-Adgangs modul, s&aring; det laster det modul du vil restriktere adgang til. </p>
<ol>
	<li>G&aring; til <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Find det modul du vil restriktere adgang til i listen. Noter id som findes i kolonnen 'ID'.</li>
	<li>&Aring;ben et Frontend-Bruger-Adgangs modul.<br>
		Hvis du lige har installeret modulet, er modul-navnet 'Frontend-Bruger-Adgang'. Hvis du har &aelig;ndret navnet eller lige har lavet en kopi af modulet, kig i 'type' for 'mod_frontend_user_access'. Klik p&aring; modulets titel.</li>
	<li>Navngiv titlen til noget sensibelt. Det er bedst at bruge titlen af modulet du vil restriktere adgang til. </li>
	<li>Indstil 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'T&aelig;ndt:'";
	}else{
		//joomla 1.0.x
		echo "'Publiceret:'";
	}

	?> til 'Ja'.</li>
	<li>V&aelig;lg position for modulet. Hvis du er ny til dette, v&aelig;lg 'h&oslash;jre'.</li>	
	<li>Under 'modul parameter' i 'last modul id' indtast den id du noteret i skridt 2. </li>	
	<li>Klik 'gem'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Slukket";
	}else{
		//joomla 1.0.x
		echo "Afpublicer";
	}

	?> modulet som nu er lastet i Frontend-Bruger-Adgang modul, bare for at v&aelig;re sikker p&aring; at det ikke vises andre steder, andet end inden i Frontend-Bruger-Adgang modulet. </li>
	<li>Skjul titlen af det indsatte modul.
	</li>
</ol>


<p>Et Frontend-Bruger-Adgang modul kan kun laste et modul. S&aring; du skal lave en kopi af Frontend-Bruger-Adgang modul for ethvert modul du vil restriktere adgang til. Hvis du har brug for yderligere Frontend-Bruger-Adgang moduler, g&aring; til 'Modul Manager' og kopier et Frontend-Bruger-Adgang modul. Det g&oslash;res p&aring; denne vis. </p>

<a name="kopi"></a>
<h2><a href="#top">top</a>Kopiering af et Frontend-Bruger-Adgang modul</h2>

<ol>
	<li>G&aring; til <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Find et Frontend-Bruger-Adgang modul. Kig i kolonnen 'type' efter 'mod_frontend_user_access'. </li>
	<li>V&aelig;lg modulet ved at klikke i boksen ved siden af modulets navn. </li>
	<li>Klik p&aring; 'kopi' in den h&oslash;jre &oslash;verste v&aelig;rkt&oslash;jslinie.<br>
	Modulet er nu blevet kopieret. Titlen vil v&aelig;re 'Kopi af' efterfulgt a det gamle modul navn.</li>
	<li>Klik p&aring; det kopieret moduls navn. </li>
		<li>Indstil 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'T&aelig;ndt:'";
	}else{
		//joomla 1.0.x
		echo "'Publiceret:'";
	}

	?> til 'Ja'.</li>
	<li>V&aelig;lg position for modulet. Hvis du er ny til dette, v&aelig;lg 'h&oslash;jre'. <br>
	</li>	
	<li>Under 'modul parameter' i 'last modul id' indtast id af det modul du vil inkludere. </li>	
	<li>Klik 'gem'.</li>
</ol>

<a name="indstil"></a>
<h2><a href="#top">top</a>Indstil adgangs restriktioner for moduler</h2>

<ol>
	<li>Go to 'Komponenter' &gt; 'Frontend-Bruger-Adgang'.</li>
	<li>Click 'modul adgang'. <br>
	</li>
	<li>Indstil adgangs rettigheder eller restriktioner for hvert modul og for hver brugergruppe. </li>
	<li>Klik 'gem'.</li>
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