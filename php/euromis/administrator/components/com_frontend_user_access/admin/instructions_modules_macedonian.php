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
<h1>Објаснувања за поставување на ограничувања за пристап кон модулите</h1>
<ul>
	<li><a href="#add">додади модул кон Frontend-User-Access модул</a></li>
	<li><a href="#copy">копирање на Frontend-User-Access модул</a></li>
	<li><a href="#set">поставки за ограничен пристап за модулите</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Додади модул кон Frontend-User-Access модулот</h2>
<p>За да го ограничиш пристапот кон модулот, модулот треба да е вчитан од Frontend-User-Access модулот (за несреќа Joomla не предвидува никаков сет на случувања за директна рестрикција на пристап кон модулите). Модулот Frontend-User-Access will работи како обвивка за процесот корисник-пристап, и дозволува модулот да е скриен кога корисникот нема привилегија за пристап. Значи треба да го поставиш модулот Frontend-User-Access така да ги вчита сите модули кои сакаш да ги контролираш. </p>
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
	<li>Пронајди го модулот за кој ќе ограничиш пристап во листата. Запомни ја вредноста од колона 'ID'.</li>
	<li>Отвори го модулот Frontend-User-Access.<br>
		Ако си го прифатил предложеното име, неговото име е 'Frontend-User-Access'. Ако си одбрал некое друго име, или само си го копирал постојниот модул, погледни во 'type' за 'mod_frontend_user_access'. Кликни на насловот на модулот.</li>
	<li>Одбери за наслов нешто прифатливо. Најдобро тоа да е наслов на модулот кој ќе го ограничуваш. </li>
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
	<li>Одбери локација за модулот. Ако си почетник само одбери 'left'.</li>	
	<li>Кај 'module parameters' во 'load module id' внеси го 'id' кој го помниш од чекор 2. </li>	
	<li>Одбери 'save'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> за модулот кој токму сега е вчитан во модулот Frontend-User-Access, само поведи сметка да не се појавува уште некаде освен во модулот Frontend-User-Access. </li>
	<li>Сокри го насловот на вчитаниот модул.
	</li>
</ol>


<p>Модулот Frontend-User-Acces може може да вчита само еден модул. Но ти можеш да направиш нова копија на постојниот Frontend-User-Access модул за секој друг модул кој сакаш да го контролираш. Ако сакаш уште Frontend-User-Access модули, оди во 'Module Manager' и направи копија на било кој Frontend-User-Access модул. Еве како. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>копирање на Frontend-User-Access модулот</h2>

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
	<li>Пронајди го Frontend-User-Access модулот. Погледни во колоната 'type' за 'mod_frontend_user_access'. </li>
	<li>Одбери модул со селектирање на кутивчето веднаш до името на модулот. </li>
	<li>Притисни на 'copy' во горе десно.<br>
	Модулот е веќе копиран. Името ќе му биде 'Copy of ' следено со името на модулот.</li>
	<li>Притисни на сега копираното име на модулот.  </li>
		<li>Намести
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> за 'Yes'.</li>
	<li>Одбери ја локацијата на модулот. Ако си почетник само одбери 'left'. <br>
	</li>	
	<li>Под 'module parameters' за 'load module id' внеси го id-бројот на модулот кој ќе го ограничуваш. </li>	
	<li>Одбери 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>ПОставање на ограничување за пристап за модулите</h2>

<ol>
	<li>Оди во 'Components' &gt; 'Frontend-User-Access'.</li>
	<li>Одбери 'module access'. <br>
	</li>
	<li>Постави ги пристапните права за секој модул и за секоја корисничка група. </li>
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