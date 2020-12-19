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
<h1>Navodila za nastavitve omejitv dostopa na modulih</h1>
<ul>
	<li><a href="#add">dodajanje modula v Frontend-User-Access modul</a></li>
	<li><a href="#copy">kopiranje Frontend-User-Access modula</a></li>
	<li><a href="#set">določanje omejitev za dostop do modulov</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">Na vrh</a>Dodajanje modula v Frontend-User-Access modul</h2>
<p>Če želite omejiti dostop do modula, mora biti modul naložen v Frontend-User-Access modul (Joomla žal nima nobenih dodatkov za neposredno omejitev dostopa do modulov). Frontend-User-Access modul bo deloval kot ovoj za uprabnikov dostop, modul se vidi kadar ima uporabnik dostop, kadar uporabnik nima dostopa se modul ne vidi. Torej morate konfigurirati Fronend-User-Access modul tako, da nastavite modul v modul, ki ga želite prikazati. </p>
<ol>
	<li>Pojdite v<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Razširitve' &gt; 'Upravitelj modulov'";
	}else{
		//joomla 1.0.x
		echo "'Moduli' &gt; 'Moduli strani'";
	}

	?></li>
	<li>Poiščite modul za katerega želite omejiti dostop. Poiščite ID modula v stolpcu ID.</li>
	<li>Odprite Frontend-User-Access modul.<br>
		Če ste pravkar namestili modul, je ime modula "Frontend-User-Access". Če ste spremenili ime, ali pa je kopija modula, poglejte v stolpcu "Tip" za "mod_frontend_user_access". Kliknite na naslov modula.</li>
	<li>Uredite naslov modula na nekaj smiselnega. Najbolje, da uporabite naslov modula, ki mu želiti omejiti dostop.. </li>
	<li>Namestite 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Omogočen:'";
	}else{
		//joomla 1.0.x
		echo "'Objavljen:'";
	}

	?> na 'Da'.</li>
	<li>Izberite pozicijo modula. Če je na novo instaliran je to pozicilja "levi - left".</li>	
	<li>Pod "parametni modula" v okence "ID modula" vpišite ID, ki ste ga zabeležili v koraku 2. </li>	
	<li>Kliknite 'shrani'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Onemogočite";
	}else{
		//joomla 1.0.x
		echo "Odjavite";
	}

	?> modul, ki je sedaj naložen v Frontend-User-Access modul. Prepričajte se, da ta modul ni objavljen nikjer drugje ko v Frontend-User-Access modulu. </li>
	<li>Skrijte naslov vgrajenega modula.
	</li>
</ol>


<p>V Frontend-User-Access modul lahko vstavite le en modul. Če želite vstaviti nov modul v Frontend-User-Access modul, morate narediti kopijo Frontend-User-Access modula in v kopijo vstaviti modul, ki mu želite omejiti dostop. Če potrebujete več Frontend-User-Access modulov, pojdite v "Upravitelj modulov" in kopirajte Frontend-User-Access modul. Tukaj so navodila koko kopirate modul. </p>

<a name="copy"></a>
<h2><a href="#top">Na vrh</a>Kopiranje Frontend-User-Access modula</h2>

<ol>
	<li>Pojdite v <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Razširitve' &gt; 'Upravitelj modulov'";
	}else{
		//joomla 1.0.x
		echo "'Moduli' &gt; 'Moduli strani'";
	}

	?></li>
	<li>Poiščite Frontend-User-Access modul. Poglejte v stolpec 'tip' kje je 'mod_frontend_user_access'. </li>
	<li>Izberete modul, tako za obkljukate polje poleg imena modula. </li>
	<li>Klkiknite v zgornjem desnem kotu na gumb "kopiraj".<br>
	Modul je sedaj kopiran. Naslov modula je "Kopija" ki mu sledi staro ime modula.</li>
	<li>Kliknite na ime kopiranega modula.  </li>
		<li>Namestite 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Omogočen:'";
	}else{
		//joomla 1.0.x
		echo "'Objavljen:'";
	}

	?> na 'Da'.</li>
	<li>Izberite pozicijo modula. Če je na novo instaliran je to pozicilja "levi - left". <br>
	</li>	
	<li>Pod "parametni modula" v okence "ID modula" vpišite ID modula, ki ga želite objaviti v tem Frontend-User-Access modulu. </li>	
	<li>Kliknite 'shrani'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">Na vrh</a>Nastavitve omejitev dostopa modulov</h2>

<ol>
	<li>Pojdite v 'Komponente' &gt; 'Frontend-User-Access'.</li>
	<li>Kliknite 'dostop modulov'. <br>
	</li>
	<li>Nastavite pravice dostopa ali omejitve za vsak modul in za vsako Uporabniško skupino posebej. </li>
	<li>Kliknite 'shrani'.</li>
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