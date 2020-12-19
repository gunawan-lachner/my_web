<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 1.0.3
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license commercial license 
* @author http://www.pages-and-items.com
* @joomla Joomla is Free Software
* @translated to Romanian by El Severo
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
<h1>Instruc&#355;iuni pentru stabilirea restric&#355;iilor de acces pe module</h1>
<ul>
	<li><a href="#add">modul de a ad&#259;uga un modul folosind Frontend-User-Access</a></li>
  <li><a href="#copy">copierea unui modul de pe site folosind Frontend-User-Access</a></li>
  <li><a href="#set">seteaz&#259; restric&#355;iile de acces pentru module</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Adaug&#259; un modul modulului Frontend-User-Access</h2>
<p>Pentru a restric&#355;iona accesul la un modul, modulul trebuie s&#259; fie &icirc;nc&#259;rcat &icirc;n modulul Frontend-User-Access (din p&#259;cate Joomla nu ofer&#259; nici un manipulant care s&#259; restric&#355;ioneze accesul direct al modulelor.) Modulul The Frontend-User-Access va func&#355;iona ca un &icirc;nveli&#351; acces-utilizator, permi&#355;&acirc;nd modulului s&#259; fie ascuns c&acirc;nd un utilizator nu are acces. Deci, trebuie s&#259; configura&#355;i modulul Frontend-User-Access astfel va prelua modulul c&#259;ruia &icirc;i dori&#355;i restric&#355;ionarea. </p>
<ol>
	<li>Merge&#355;i  la <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensii' &gt; 'Manager Module'";
	}else{
		//joomla 1.0.x
		echo "'Module' &gt; 'Modulele Site-ului'";
	}

	?></li>
	<li>G&#259;si&#355;i modulul c&#259;ruita &icirc;i dori&#355;i restric&#355;ionarea accesul &icirc;n list&#259;. Nota&#355;i-v&#259; id-ul &icirc;n coloana 'ID'.</li>
<li>Deschide&#355;i un modulul Frontend-User-Access.<br>
		Dac&#259; tocmai a&#355;i reinstalat modulul, numele modulului e  'Frontend-User-Access'. Dac&#259; a&#355;i modificat numele sau pur &#351;i simplu a&#355;i f&#259;cut o copie modulului, uita&#355;i-v&#259; &icirc;n coloana  'type' pentru 'mod_frontend_user_access'. D&#259; click pe titlul modulului.</li>
	<li>Editeaz&#259; titlul pun&acirc;nd ceva text. Cel mai indicat e s&#259; intoruduce-&#355;i numele modulului c&#259;ruita &icirc;i ve&#355;i restric&#355;iona accesul. </li>
  <li>Seta&#355;i 
  <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Activat:'";
	}else{
		//joomla 1.0.x
		echo "'Publicat:'";
	}

	?> cu 'Yes'.</li>
	<li>Selecta&#355;i pozi&#355;ie modulului. Dac&#259; nu &#351;ti&#355;i ce pozi&#355;ie selecta&#355;i  'left'.</li>	
  <li>Sub 'parametrii modulului' la '&icirc;ncarc&#259; id-ul modului' introduce&#355;i id-ul pe care l-a&#355;i not &icirc;n pasul 2. </li>	
  <li>Da&#355;i click pe 'save'.</li>
	<li>Modulul <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Dezactivat";
	}else{
		//joomla 1.0.x
		echo "Nepublicat";
	}

	?>
    care acum este procesat &icirc;n modulul  Frontend-User-Access, asigura&#355;i-v&#259; c&#259; nu va ap&#259;rea &icirc;n orice alt loc &icirc;n afar&#259; de modulul Frontend-User-Access. </li>
  <li>Ascunde titlul modulului &icirc;ncorporat.	</li>
</ol>


<p>A Frontend-User-Acces module can only load one module. So you have to make a copy of a Frontend-User-Access module for each module you want to restrict access to. If you need more Frontend-User-Access modules, go to the 'Module Manager' and copy any Frontend-User-Access module. Here is how. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>Copierea unui modul  Frontend-User-Access</h2>

<ol>
	<li>Merge&#355;i la <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensii' &gt; 'Manager Module'";
	}else{
		//joomla 1.0.x
		echo "'Module' &gt; 'Modulele Site-ului'";
	}

	?></li>
	<li>C&#259;uta&#355;i un modul  Frontend-User-Access. Uita&#355;i-v&#259; la coloana 'type' la 'mod_frontend_user_access'. </li>
	<li>Selecta&#355;i modulul bif&acirc;nd c&#259;su&#355;a din dreptul numelui modulului. </li>
  <li>Da&#355;i click &icirc;n bara din partea de sus-dreapta pe butonul 'copy'.<br>
	Modulul e acum copiat. Titlul va fi  'Copy of ' urmat de numele modulului copiat.</li>
  <li>Da&#355;i click pe numele modulului copiat.  </li>
  <li>Seta&#355;i 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> cu 'Yes'.</li>
	<li>Selecta&#355;i pozi&#355;ia modulului. Dac&#259; nu sunte&#355;i sigur selecta&#355;i 'left'. <br>
	</li>	
  <li>Sub  'parametrii modulului' la '&icirc;ncarc&#259; id-ul modului' introduce-&#355;i id-ul modulului c&#259;ruia &icirc;i dori&#355;i includerea. </li>	
  <li>Da&#355; click pe 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Setare acces al restric&#355;iilor pentru module</h2>

<ol>
	<li>Merge&#355;i la  'Componente' &gt; 'Frontend-User-Access'.</li>
  <li>Da&#355;i click pe 'module access'. <br>
	</li>
  <li>Seta&#355;i drepturile de acces sau restric&#355;iile pentru fiecare modul, pentru fiecare grup de utilizatori. </li>
  <li>Da&#355;i click pe 'save'.</li>
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