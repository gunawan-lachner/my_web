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

	die('Accesso negato');

}



?>

<style type="text/css">

h2 a{

	margin-right: 20px;

	font-size: 0.8em;

}

</style>

<a name="top"></a>

<h1>Istruzioni per impostare permessi di accesso ai moduli</h1>

<ul>

	<li><a href="#add">Aggiungi il modulo al 'Frontend-User-Access'</a></li>

	<li><a href="#copy">Copia un modulo 'Frontend-User-Access'</a></li>

	<li><a href="#set">Imposta permessi di accesso per il modulo</a></li>

</ul>

	

<a name="add"></a>

<h2><a href="#top">su</a>Aggiungi il modulo al 'Frontend-User-Access'</h2>

<p>Per limitare l'accesso ad un modulo questo deve essere caricato all'interno di un 'Frontend-User-Access' (sfortunatamente Joomla non fornisce alcun gestore di eventi che consenta la diretta limitazione di accesso ai moduli). Il 'Frontend-User-Access' si comporta come un contenitore di login che consente al modulo in esso caricato di essere nascosto se l'utente non è loggato. Occorre quindi configurare il 'Frontend-User-Access' in modo da caricare il modulo per il quale si vogliono impostare permessi di accesso. </p>

<ol>

	<li>Vai a <?php

	if(defined('_JEXEC')){

		//joomla 1.5

		echo "'Estensioni' &gt; 'Gestore Moduli'";

	}else{

		//joomla 1.0.x

		echo "'Moduli' &gt; 'Moduli del Sito'";

	}



	?></li>

	<li>Cerca il modulo a cui vuoi impostare dei permessi di accesso e prendi nota del suo id nell'omonima colonna (*).</li>

	<li>Apri un 'Frontend-User-Access'.<br>

		Una volta installato, il modulo prende il nome di 'Frontend-User-Access'. Se si è rinominato o si tratta di una copia di un modulo già esistente, occorre cercare nella colonna 'tipo' la stringa 'mod_frontend_user_access' e fare click sul nome del modulo.</li>

	<li>Modifica il nome in modo che sia facilmente rintracciabile. Per esempio usa il nome del modulo a cui si vogliono impostare i permessi. </li>

	<li>Imposta 

	<?php

	if(defined('_JEXEC')){

		//joomla 1.5

		echo "'Abilitato:'";

	}else{

		//joomla 1.0.x

		echo "'Pubblicato:'";

	}



	?> a 'Sì'.</li>

	<li>Seleziona la posizione del modulo. In caso di dubbi seleziona 'sinistra'.</li>	

	<li>Alla voce 'carica id del modulo' dei 'parametri del modulo' inserisci l'id annotato nel precedente punto (*). </li>	

	<li>Clicca su 'salva'.</li>

	<li><?php

	if(defined('_JEXEC')){

		//joomla 1.5

		echo "Disabilita";

	}else{

		//joomla 1.0.x

		echo "Non pubblicare";

	}



	?> il modulo adesso caricato nel modulo 'Frontend-User-Access', per accertarsi che esso appaia soltanto nel modulo Frontend-User-Access. </li>

	<li>Nascondi il titolo del modulo integrato.

	</li>

</ol>





<p>Un modulo Frontend-User-Access può caricare soltanto un modulo. Bisogna quindi duplicare il modulo Frontend-User-Access per ogni modulo a cui si vuole limitare l'accesso. Per fare ciò si deve andare nel 'Gestore Moduli' e fare una o più copie del modulo Frontend-User-Access. Ecco come. </p>



<a name="copy"></a>

<h2><a href="#top">top</a>Copia di un modulo Frontend-User-Access</h2>



<ol>

	<li>Vai a <?php

	if(defined('_JEXEC')){

		//joomla 1.5

		echo "'Estensioni' &gt; 'Gestore Moduli'";

	}else{

		//joomla 1.0.x

		echo "'Moduli' &gt; 'Moduli del Sito'";

	}



	?></li>

	<li>Trova un 'Frontend-User-Access' cercando nella colonna 'tipo' la stringa 'mod_frontend_user_access'. </li>

	<li>Seleziona il modulo cliccando sul rettangolo accanto al suo nome. </li>

	<li>Clicca su 'copia' nella barra degli strumenti in alto a destra.<br>

	Il modulo così copiato ha per titolo 'Copia di ' seguito dal nome del modulo padre.</li>

	<li>Clicca sul nome del modulo copiato.  </li>

		<li>Imposta 

	<?php

	if(defined('_JEXEC')){

		//joomla 1.5

		echo "'Abilitato:'";

	}else{

		//joomla 1.0.x

		echo "'Pubblicato:'";

	}



	?> a 'Sì'.</li>

	<li>Seleziona la posizione del modulo. In caso di dubbi seleziona 'sinistra'. <br>

	</li>	

	<li>Alla voce 'carica id del modulo' dei 'parametri del modulo' inserisci l'id del modulo che si vuole includere. </li>	

	<li>Clicca su 'salva'.</li>

</ol>



<a name="set"></a>

<h2><a href="#top">su</a>Imposta permessi per il modulo</h2>



<ol>

	<li>Vai a 'Componenti' &gt; 'Frontend-User-Access'.</li>

	<li>Clicca su 'Accesso al modulo'. <br>

	</li>

	<li>Imposta permessi di accesso per ciascun modulo e per ogni gruppo di utenti. </li>

	<li>Clicca su 'salva'.</li>

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