<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 2.0.0
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license GPL versions free/trial/pro
* @author http://www.pages-and-items.com
* @translation Pasi Paunu
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
<h1>Ohjeet moduulien käyttöoikeuksien asettamiseen</h1>
<ul>
	<li><a href="#add">Moduulin lisäys Frontend-User-Access moduuliin</a></li>
	<li><a href="#copy">Frontend-User-Access moduulin kopiointi</a></li>
	<li><a href="#set">Rajoitusten asettaminen moduuleille</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">Ylös</a>Moduulin lisäys Frontend-User-Access moduuliin</h2>
<p>Rajoittaaksesi moduuleihin pääsyä ko. moduulin tulee olla ladattu Frontend-User-Access moduulissa (Valitettavasti Joomla ei tarjoa minkäänlaisia tapahtumankäsittelijöitä suoraan moduulien pääsyrajoitusten asettamiseen). Frontend-User-Access moduuli toimii tietynlaisena käyttäjäoikeuksien "säiliönä" mahdollistaen moduulin piilottamisen jos käyttäjällä ei ole siihen riittäviä oikeuksia. Tästä syystä Frontend-User-Access moduuli tulee konfiguroida niin, että se itse lataa ko. moduulin johon käyttöoikeusrajoituksia halutaan soveltaa.</p>
<ol>
	<li>Mene <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Lisäosat' &gt; 'Moduuli Manageri'";
	}else{
		//joomla 1.0.x
		echo "'Moduulit' &gt; 'Sivustokohtaiset Moduulit'";
	}

	?></li>
	<li>Etsi moduuli listasta, johon haluat toteuttaa käyttörajoituksia. Huomaa 'ID' -sarakkeessa oleva numero.</li>
	<li>Avaa Frontend-User-Access moduuli.<br>
	    Jos olet vasta juuri asentanut moduulin sen nimi on 'Frontend-User-Access'. Jos olet vaihtanut moduulin nimen tai tehnyt siitä kopion etsi sarakkeesta 'type' kohtaa 'mod_frontend_user_access'. 
		If you have just installed the module, its module-name is 'Frontend-User-Access'. If you changed the name or just made a copy of the module, look in column 'type' (tyyppi) for 'mod_frontend_user_access'. Klikkaa moduulin otsikkoa.</li>
	<li>Editoi otsikko joksikin ymmärrettäväksi. Hyvänä käytäntönä on yleensä nimetä otsikko sen moduulin mukaan, jolle aiot soveltaa käyttöoikeuksien rajoituksia.</li>
	<li>Aseta 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Aktivoitu:'";
	}else{
		//joomla 1.0.x
		echo "'Julkaistu:'";
	}

	?> tilaan 'Kyllä'.</li>
	<li>Valitse moduulille paikka. Jos et ole varma, aseta 'left' (vasen).</li>	
	<li>Moduuliparametrien ('module parameters') alta kohdasta  'load module id' (lataa moduuli id), valitse se id-numero jonka otit muistiin kohdassa 2.</li>	
	<li>Klikkaa talleta 'save'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Aseta pois päältä";
	}else{
		//joomla 1.0.x
		echo "Älä julkaise";
	}

	?> moduuli(a), joka on nyt ladattu Frontend-User-Access moduuliin. Varmista että se ei näy muualla kuin Frontend-User-Access moduulissa.</li>
	<li>Piilota upotetun moduulin otsikko.
	</li>
</ol>


<p>Frontend-User-Access moduuli voi ladata ainoastaan yhden moduulin. Tästä syystä sinun tarvitsee tehdä kopio Frontend-User-Access moduulista jokaista muuta moduulia varten johon haluat soveltaa käyttöoikeusrajoituksia. Jos tarvitset useampia Frontend-User-Access moduuleita, mene Moduuli Manageriin 'Module Manager' ja kopioi jokin Frontend-User-Access moduuleista. Seuraavaksi kerron miten.</p>

<a name="copy"></a>
<h2><a href="#top">Ylös</a>Frontend-User-Access moduulin kopiointi</h2>

<ol>
	<li>Mene <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Lisäosat' &gt; 'Moduuli Manageri'";
	}else{
		//joomla 1.0.x
		echo "'Moduulit' &gt; 'Sivusto Moduulit'";
	}

	?></li>
	<li>Etsi Frontend-User-Access moduuli. Etsi sarakkeesta 'type' (tyyppi) kohtaa 'mod_frontend_user_access'. </li>
	<li>Valitse moduuli klikkaamalla moduulin nimen vieressä olevaa valintalaatikkoa.</li>
	<li>Klikkaa oikeassa ylänurkassa olevasta työkalupalkista 'copy' (kopioi) -nappia.<br>
	Moduuli on nyt kopioitu. Otsikoksi tulee 'Copy of' ja moduulin vanha nimi.
	</li>
	<li>Klikkaa kopioidun moduulin nimeä.</li>
		<li>Aseta 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Aktivoitu:'";
	}else{
		//joomla 1.0.x
		echo "'Julkaistu:'";
	}

	?> tilaan 'Kyllä'.</li>
	<li>Valitse moduulille paikka. Jos et ole varma, aseta 'left' (vasen). <br>
	</li>	
	<li>Aseta moduuliparametrien 'module parameters' alta kohdasta 'load module id' sen moduulin id-numero jonka haluat ottaa mukaan. </li>	
	<li>Klikkaa talleta 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">Ylös</a>Rajoitusten asettaminen moduuleille</h2>

<ol>
	<li>Mene Komponentit 'Components' &gt; 'Frontend-User-Access'.</li>
	<li>Klikkaa 'module access'. <br>
	</li>
	<li>Aseta käyttöoikeudet tai rajoitukset jokaiselle moduulille sekä jokaiselle käyttäjäryhmälle.</li>
	<li>Klikkaa talleta 'save'.</li>
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