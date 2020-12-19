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
<h1>Instrukcja ustawień dla ograniczeń dostępu modułów</h1>
<ul>
	<li><a href="#add">Dodawanie modułu do Frontend-User-Acces</a></li>
	<li><a href="#copy">Kopiowanie Frontend-User-Access</a></li>
	<li><a href="#set">Ustaw ograniczenia dostępu dla modułu</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Dodawanie modułu do Frontend-User-Access</h2>
<p>By ograniczyć dostęp do modułu, moduł musi zostać dodany do Frontend-User-Access (niestety Joomla nie przewiduje obsługi ograniczania dostępu bezpośrednio do modułów). Frontend-User-Access będzie działał jako mający dostęp do wrapera, pozwoli to ukryć moduł jeżeli użytkownić nie bedzie miał dostępu. Dlatego trzeba odpowiednio skonfigurować Frontend-User-Access. </p>
<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Rozszerzenia' &gt; 'Moduły'";
	}else{
		//joomla 1.0.x
		echo "'Moduły' &gt; 'Moduły'";
	}

	?></li>
	<li>Znajdź moduł który chcesz ograniczyć i zapisz jego numer z kolumny ID.</li>
	<li>Otwórz Frontend-User-Access.<br>
		Jeśli masz zainstalowany tylko modułu, jego nazwa modułu jest Frontend-User-Access. Jeśli zmianiałeś nazwy lub wykonanałeś kopie modułu, poszukaj w kolumnie "typ" na "mod_frontend_user_access". Kliknij na tytuł modułu.</li>
	<li>Edytuj tytuł na jakiś sensowny. Najlepszy będzie tytuł modułu który ma mieć ograniczony dostęp. </li>
	<li>Ustaw
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Włączony:'";
	}else{
		//joomla 1.0.x
		echo "'Opublikowany:'";
	}

	?> to 'Tak'.</li>
	<li>Wybierz pozycje dla modułu. Jeśli jesteś nowy wybierz 'lewa'.</li>	
	<li>W sekcji "modułu parametry" na "załadować moduł id" wpisać ID zanotowane w kroku 2. </li>	
	<li>Kliknij 'zapisz'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Wyłącz";
	}else{
		//joomla 1.0.x
		echo "Odpublikuj";
	}

	?> moduł który jest teraz załadowany w Frontend-User-Access, tylko po to by upewnić się że nie wyświetla się nigdzie poza Frontend-User-Access. </li>
	<li>Ukryj tytuł załadowanego modułu.
	</li>
</ol>


<p>Frontend-User-Acces można załadować tylko jeden moduł. Tak więc musisz wykonać kopię Frontend-User-Acces dla każdego kolejnego modułu, w którym chcesz ograniczyć dostęp. Jeśli potrzebujesz więcej Frontend-User-Acces, przejdź do "Moduły" i skopiować Frontend-User-Acces. Oto w jaki sposób. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>Kopiowanie Frontend-User-Access</h2>

<ol>
	<li>Przejdź do <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Rozszerzenia' &gt; 'Moduły'";
	}else{
		//joomla 1.0.x
		echo "'Moduły' &gt; 'Moduły'";
	}

	?></li>
	<li>Znajdź Frontend-User-Access. Szukaj w kolumnie 'typ' dla 'mod_frontend_user_access'. </li>
	<li>Zaznacz moduł daszkiem po lewej stronie</li>
	<li>Kliknij u góry w prawym rogu 'kopiuj'.<br>
	Moduł został skopiowany. Skopiowany moduł nazywa się 'kopia z' + stara nazwa modułu.</li>
	<li>Kliknij na nazwe nowego modułu.</li>
		<li>Ustaw
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Włączony:'";
	}else{
		//joomla 1.0.x
		echo "'Opublikowany:'";
	}

	?> to 'Tak'.</li>
	<li>Wybierz pozycje dla modułu. Jeśli jesteś nowy wybierz 'lewa'.</li>	
	<li>W sekcji "modułu parametry" na "załadować moduł id" wpisać ID zanotowane w kroku 2. </li>	
	<li>Kliknij 'zapisz'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Ustaw ograniczenia dostępu dla modułu</h2>

<ol>
	<li>Idź do 'Komponenty' &gt; 'Frontend-User-Access'.</li>
	<li>Kliknij 'dostęp do modułów'. <br>
	</li>
	<li>Ustaw prawa które grupy użytkowników mają dostęp do poszczególnych modułów. </li>
	<li>Kliknij 'zapisz'.</li>
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