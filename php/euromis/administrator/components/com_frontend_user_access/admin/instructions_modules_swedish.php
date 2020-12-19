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
<h1>Instruktioner f&ouml;r att registrera beh&ouml;righeter f&ouml;r moduler</h1>
<ul>
	<li><a href="#add">l&auml;gg till modul till Frontend-User-Access modul</a></li>
	<li><a href="#copy">kopiera en Frontend-User-Access modul</a></li>
	<li><a href="#set">s&auml;tt beh&ouml;righeter f&ouml;r moduler</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">topp</a>L&auml;gg till modul till Frontend-User-Access modul</h2>
<p>F&ouml;r att begr&auml;nsa beh&ouml;righeter till en modul m&aring;ste modulen vara laddad i en Frontend-User-Access modul (tyv&auml;rr s&aring; finns det inga m&ouml;jligheter i Joomla att direkt begr&auml;nsa beh&ouml;righeter till moduler). Frontend-User-Access modulen fungerar som en user-access wrapper (omslag), som g&ouml;r s&aring; att modulen inte syns om anv&auml;ndaren inte har korrekt beh&ouml;righet. S&aring; du m&aring;ste konfigurera en Frontend-User-Access modul s&aring; den laddar den modul du &ouml;nskar begr&auml;nsa beh&ouml;righeter till. </p>
<ol>
	<li>G&aring; till <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Till&auml;gg' &gt; 'Modul hanterare'";
	}else{
		//joomla 1.0.x
		echo "'Moduler' &gt; 'Webplatsens moduler'";
	}

	?></li>
	<li>V&auml;lj den modul som du vill begr&auml;nsa beh&ouml;righeter till i listan. Notera id i kolumnen 'ID'.</li>
	<li>&Ouml;ppna en Frontend-User-Access modul.<br>
		Om du just har installerat modulen, &auml;r dess modulnamn 'Frontend-User-Access'. Om du bytt namn eller just gjort en kopia av modulen, s&aring; titta i kolumnen 'type' efter 'mod_frontend_user_access'. Klicka p&aring; modulens titel.</li>
	<li>&Auml;ndra titeln till n&aring;got l&auml;mpligt p&aring; modulen som du kommer att &auml;ndra beh&ouml;righeter p&aring;. </li>
	<li>S&auml;tt 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> till 'Ja'.</li>
	<li>V&auml;lj en position f&ouml;r modulen. Om du k&auml;nner dej os&auml;ker p&aring; detta, 'v&auml;nster'.</li>	
	<li>Under 'module parameters' vid 'load module id' l&auml;gg in det id som du noterade i steg 2. </li>	
	<li>Klicka p&aring; 'spara'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?> modulen som nu &auml;r laddad i Frontend-User-Access modulen, f&ouml;r att vara s&auml;ker p&aring; att den inte syns n&aring;gonstans f&ouml;rutom i Frontend-User-Access modulen. </li>
	<li>G&ouml;m titeln p&aring; den inb&auml;ddade modulen.
	</li>
</ol>


<p>En Frontend-User-Acces modul kan bara ladda en modul. S&aring; du m&aring;ste skapa en kopia av en Frontend-User-Access modul f&ouml;r varje modul som du &ouml;nskar begr&auml;nsa beh&ouml;righeter till. Om du beh&ouml;ver flera Frontend-User-Access moduler, g&aring; till 'Module Manager' och kopiera en Frontend-User-Access modul. S&aring; h&auml;r g&ouml;r du. </p>

<a name="copy"></a>
<h2><a href="#top">topp</a>Kopiera en Frontend-User-Access modul</h2>

<ol>

	<li>G&aring; till <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Till&auml;gg' &gt; 'Modulhanterare'";
	}else{
		//joomla 1.0.x
		echo "'Moduler' &gt; 'Sajtens moduler'";
	}

	?></li>
	<li>V&auml;lj en Frontend-User-Access modul. S&ouml;k i kolumnen 'type' efter 'mod_frontend_user_access'. </li>
	<li>V&auml;lj modulen genom att bocka i rutan bredvid modulnamnet. </li>
	<li>Klicka i  'copy' i verktygsf&auml;ltet uppe till h&ouml;ger.<br>
	Modulen &auml;r nu kopierad. Titeln &auml;r 'Copy of ' f&ouml;ljd av det gamla modul namnet.</li>
	<li>Klicka p&aring; den kopierade modulens namn.  </li>
		<li>S&auml;tt 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Aktiverad:'";
	}else{
		//joomla 1.0.x
		echo "'Publicerad:'";
	}

	?> till 'Ja'.</li>
	<li>V&auml;lj en position f&ouml;r modulen. Om du &auml;r os&auml;ker v&auml;lj 'left'. <br>
	</li>	
	<li>Under 'module parameters' vid 'load module id' skriv in det id som modulen som du vill inkludera har. </li>	
	<li>Klicka p&aring; 'spara'.</li>

</ol>

<a name="set"></a>
<h2><a href="#top">topp</a>S&auml;tta beh&ouml;righeter f&ouml;r moduler</h2>

<ol>
	<li>G&aring; till 'Components' &gt; 'Frontend-User-Access'.</li>
	<li>Klicka p&aring; 'module access'. <br>
	</li>
	<li>S&auml;tta beh&ouml;righeter f&ouml;r varje modul och f&ouml;r varje anv&auml;ndargrupp. </li>
	<li>Klicka p&aring; 'save'.</li>
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