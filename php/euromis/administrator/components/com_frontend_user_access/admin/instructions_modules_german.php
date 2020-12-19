<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 1.0.0
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license commercial license
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
<h1>Anleitung f&uuml;r Zugriffsbeschr&auml;nkungen auf Einstellung in Modulen</h1>
<ul>
 <li><a href="#add">Modul zu Frontend-User-Access Modul hinzuf&uuml;gen</a></li>
 <li><a href="#copy">ein Frontend-User-Access Modul kopieren</a></li>
 <li><a href="#set">Zugriffsbeschr&auml;nkungen f&uuml;r Modul festlegen</a></li>
</ul>
 
<a name="add"></a>
<h2><a href="#top">Top</a>Modul zu Frontend-User-Access Modul hinzuf&uuml;gen</h2>
<p>Um Zugriff zu einem Modul zu beschr&auml;nken, muss das Modul innerhalb eines Frontend-User-Access Moduls geladen sein  (leider stellt Joomla nicht direkt event-handler zur Zugriffsbeschr&auml;nkung auf Module zur Verf&uuml;gung). Das Frontend-User-Access Modul wird als ein user-access wrapper funktionieren, und erm&ouml;glicht das Modul nicht anzuzeigen, wenn ein Benutzer keinen Zugriff hat. Also m&uuml;ssen Sie ein Frontend-User-Access Modul konfigurieren, sodass das Modul, auf den Sie den Zugriff beschr&auml;nken wollen, geladen wird. </p>
<ol>
 <li>Gehe zu <?php
 if(defined('_JEXEC')){
  //joomla 1.5
  echo "Erweiterung' &gt; 'Modul Manager'";
 }else{
  //joomla 1.0.x
  echo "'Module' &gt; 'Seiten Module'";
 }
 ?></li>
 <li>Finden Sie das Modul auf das Sie den Zugriff beschr&auml;ken m&ouml;chten in der Liste. Beachten Sie die ID in der Rubrik 'ID'.</li>
 <li>Ein Frontend-User-Access Modul &ouml;ffnen.<br>
  Wenn Sie das Modul gerade installiert haben, ist der Name des Moduls 'Frontend-User-Access'. Wenn Sie den Namen ver&auml;ndert haben oder nur eine Kopie des Moduls gemacht haben, sehen in der Rubrik 'type' nach 'mod_frontend_user_access' nach. Klicken Sie auf den Titel des Moduls.</li>
 <li>Bearbeiten Sie den Titel in etwas sinnvolles. Am besten benutzen Sie den Titel des Moduls, auf das Sie den Zugriff beschr&auml;nken m&ouml;chten. </li>
 <li>Einstellen
 <?php
 if(defined('_JEXEC')){
  //joomla 1.5
  echo "'Aktiviert:'";
 }else{
  //joomla 1.0.x
  echo "'Ver&ouml;ffentlicht:'";
 }
 ?> zu 'Ja'.</li>
 <li>Position f&uuml;r das Modul ausw&auml;hlen. Falls Sie hier neu sind, w&auml;hlen Sie 'links'.</li> 
 <li>Unter 'Modul Parameter' in 'Modul ID laden' geben Sie die in Schritt 2 vermerkte ID ein. </li> 
 <li>'Speichern' klicken.</li>
 <li><?php
 if(defined('_JEXEC')){
  //joomla 1.5
  echo "Deaktivieren";
 }else{
  //joomla 1.0.x
  echo "nicht ver&ouml;ffentlichen";
 }
 ?> Das Modul, das jetzt in dem Frontend-User-Access Modul geladen ist, nur um sicherzustellen, dass es nirgendwo au&szlig;er innerhalb des Frontend-User-Access Moduls angezeigt wird. </li>
</ol>

<p>Ein Frontend-User-Acces Modul kann nur in einem Modul geladen werden. Also m&uuml;ssen Sie eine Kopie des Frontend-User-Access Moduls f&uuml;r jedes Modul, bei dem Sie den Zugriff beschr&auml;nken wollen, machen . If you need more Frontend-User-Access modules, go to the 'Module Manager' and copy any Frontend-User-Access module. Dies funktioniert wie folgt. </p>
<a name="copy"></a>
<h2><a href="#top">Top</a>Frontend-User-Access Modul wird kopiert</h2>
<ol>
 <li>Gehe zu <?php
 if(defined('_JEXEC')){
  //joomla 1.5
  echo "'Erweiterungen' &gt; 'Modul Manager'";
 }else{
  //joomla 1.0.x
  echo "'Module' &gt; 'Seiten Module'";
 }
 ?></li>
 <li>Finden Sie ein Frontend-User-Access Modul. Sehen Sie in der Rubrik 'type' f&uuml;r 'mod_frontend_user_access'nach. </li>
 <li>W&auml;hlen Sie das Modul indem Sie das K&auml;stchen neben dem Namen des Moduls ausw&auml;hlen. </li>
 <li>In der Toolbar oben rechts 'Kopie'anklicken.<br>
 Das Modul wurde kopiert. Der Titel wird 'Kopie von ' gefolgt von dem alten Modulnamen sein.</li>
 <li>Klicken Sie auf den kopierten Namen des Moduls.  </li>
  <li>Einstellen
 <?php
 if(defined('_JEXEC')){
  //joomla 1.5
  echo "'Aktiviert:'";
 }else{
  //joomla 1.0.x
  echo "'Ver&ouml;ffentlicht:'";
 }
 ?> zu 'Ja'.</li>
 <li>W&auml;hlen Sie eine Position f&uuml;r das Modul aus. Falls dies neu f&uuml;r Sie ist w&auml;hlen Sie 'links'. <br>
 </li> 
 <li>Under 'module parameters' at 'load module id' enter the id of the module you want to include. </li> 
 <li>'Speichern' anklicken.</li>
</ol>
<a name="set"></a>
<h2><a href="#top">Top</a>Zugriffsbeschr&auml;nkungen f&uuml;r das Modul einstellen</h2>
<ol>
 <li>Gehe zu 'Komponenten' &gt; 'Frontend-User-Access'.</li>
 <li>'Modul Zugriff'anklicken. <br>
 </li>
 <li>Zugriffsrechte oder Beschr&auml;nkungen f&uuml;r jedes Modul und f&uuml;r jede Benutzergruppe einstellen. </li>
 <li>'Speichern' anklicken.</li>
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