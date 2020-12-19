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



define('_fua_lang_usergroups',"gruppi");

define('_fua_lang_users',"utenti");

define('_fua_lang_user',"utente");

define('_fua_lang_component_access',"component access");

define('_fua_lang_new',"nuovo");

define('_fua_lang_delete',"cancella");

define('_fua_lang_save',"salva");

define('_fua_lang_apply',"applica");

define('_fua_lang_cancel',"annulla");

define('_fua_lang_usergroup_saved',"gruppo salvato");

define('_fua_lang_select_item_to_delete',"seleziona l'oggetto da cancellare");

define('_fua_lang_usergroup_deleted',"gruppo cancellato");

define('_fua_lang_component_access_saved',"permessi di accesso del componente salvati");

define('_fua_lang_userssaved',"utente(i) salvato(i)");

define('_fua_lang_please_select_user',"seleziona un utente");

define('_fua_lang_user_saved',"utente salvato");

define('_fua_lang_user_edit',"modifica utente");

define('_fua_lang_name',"nome");

define('_fua_lang_password',"password");

define('_fua_lang_usergroup',"gruppo");

define('_fua_lang_new_user',"nuovo utente");

define('_fua_lang_usergroup_edit',"modifica gruppo");

define('_fua_lang_name_usergroup',"dai un nome al gruppo");

define('_fua_lang_usergroup_new',"nuovo gruppo");

define('_fua_lang_no_access_component',"accesso negato al componente");

define('_fua_lang_sureuserdelete',"vuoi veramente cancellare questo utente?");

define('_fua_lang_nonameentered',"è necessario immettere un nome");

define('_fua_lang_nousergroupselected',"è necessario selezionare un gruppo");

define('_fua_lang_suredeleteusergroup',"vuoi veramente cancellare questo/i gruppo/i?");

define('_fua_lang_noselectusergroups',"non è stato selezionato alcun gruppo");

define('_fua_lang_noselectusers',"non è stato selezionato alcun utente");

define('_fua_lang_suredeleteusers',"vuoi veramente cancellare questo/i utente/i?");

define('_fua_lang_nousergroups',"nessun gruppo ancora definito");

define('_fua_lang_nousers',"nessun utente trovato.<br /> Creare nuovi utenti con ");

define('_fua_lang_user_new',"Nuovo utente");

define('_fua_lang_username',"Nome utente");

define('_fua_lang_configsaved',"configurazione salvata");

define('_fua_lang_showtab',"mostra tab");

define('_fua_lang_general',"impostazioni generali");

define('_fua_lang_language',"lingua");

define('_fua_lang_defaulttab',"tab di default");

define('_fua_lang_useinpiuseraccess',"usa in 'Frontend-User-Access'");

define('_fua_lang_order',"ordinamento");

define('_fua_lang_alias',"alias");

define('_fua_lang_componentname',"nome del componente");

define('_fua_lang_use_componentaccess',"attiva permessi di accesso del componente");

define('_fua_lang_joomlagroup',"Gruppo predefinito di Joomla");

define('_fua_lang_showjoomlagroup',"mostra il selectbox del gruppo predefinito di Joomla");

define('_fua_lang_showjoomlagroup_tip',"mostra il selectbox del gruppo predefinito di Joomla quando si crea o modifica un utente");

define('_fua_lang_disableselectbox',"mostra soltanto il gruppo predefinito di Joomla");

define('_fua_lang_config',"configurazione");

define('_fua_lang_version',"versione");

define('_fua_lang_commercial',"licenza commerciale");

define('_fua_lang_configwriteable',"scrivibile");

define('_fua_lang_confignotwriteable',"non scrivibile");

define('_fua_lang_activate',"attiva permessi");

define('_fua_lang_tabs',"tab");

define('_fua_lang_selectall',"[seleziona tutto]");

define('_fua_lang_validkey',"codice di registrazione");

define('_fua_lang_enterkey',"inserire il codice di registrazione");

define('_fua_lang_keyisentered',"il codice di registrazione è stato inserito");

define('_fua_lang_keynotvalid',"codice di registrazione non valido");

define('_fua_lang_validkey_tip',"Per test e sviluppo l'uso di questo componente non ha limitazioni temporali su 'localhost'. Per test e sviluppo in produzione l'uso di questo componente è limitato ad alcune settimane. È possibile scaricare e reinstallare una nuova versione del componente, dei plug-in e del modulo se si ha necessità di test e sviluppo ulteriore. I dati sui gruppi e relativi permessi impostati non vengono persi in seguito a tale reinstallazione. Anche un eventuale backup del file di configurazione non comporta la perdita della configurazione personalizzata del Frontend-User-Access.");

define('_fua_lang_nocomponentactive',"I permessi dei componenti non sono attivi");

define('_fua_lang_on',"acceso");

define('_fua_lang_off',"spento");

define('_fua_lang_top',"su");

define('_fua_lang_statusbot',"plugin di stato");

define('_fua_lang_botinstalled',"il plugin è installato");

define('_fua_lang_botnotinstalled',"il plugin non è installato");

define('_fua_lang_botpublished',"il plugin è pubblicato");

define('_fua_lang_botnotpublished',"il plugin non è pubblicato");

define('_fua_lang_not_published',"non pubblicato");

define('_fua_lang_version_check',"verifica versione");

define('_fua_lang_email',"email");

define('_fua_lang_description',"descrizione");	 

define('_fua_lang_loggedin',"loggato");	

define('_fua_lang_loggedin_description',"utenti loggati non assegnati ad alcun gruppo");	

define('_fua_lang_not_loggedin',"non loggati");

define('_fua_lang_not_loggedin_description',"utenti non loggati");

define('_fua_lang_components_message_type',"messaggio mostrato quando l'accesso al componente è negato");

define('_fua_lang_components_message_type_alert',"avviso javascript, che invia alla pagina precedente");

define('_fua_lang_components_message_type_inline_text',"testo in linea");

define('_fua_lang_item_access',"permessi per articolo");

define('_fua_lang_items_activate',"attivare permessi per l'oggetto");

define('_fua_lang_no_active_items',"Permessi per l'articolo non attivi");

//define('_fua_lang_item_message_type',"messaggio mostrato quando l'accesso all'articolo è negato");

define('_fua_lang_item_access_saved',"permessi per l'articolo salvati");

define('_fua_lang_category_access',"permessi per categoria");

define('_fua_lang_activatecategories',"attivare permessi per categoria");

define('_fua_lang_no_categories_active',"Permessi per categoria non attivi");

define('_fua_lang_category_access_saved',"permessi per categoria salvati");

define('_fua_lang_section_access',"permessi per sezione");

define('_fua_lang_sections_active',"attivare permessi per sezione");

define('_fua_lang_no_sections_active',"Permessi per sezione non attivi");

define('_fua_lang_section_access_saved',"permessi per sezione salvati");

define('_fua_lang_activate_in_config',"Per attivare andare nella pagina di configurazione.");

define('_fua_lang_show_tab',"mostra tab");

define('_fua_lang_url_access',"permessi url");

define('_fua_lang_url_active',"attivare permessi url");

define('_fua_lang_no_url_active',"permessi url non attivi");

define('_fua_lang_url_access_saved',"permessi url salvati");

define('_fua_lang_sure_to_delete_url',"confermi la cancellazione di questo/i URL?");

define('_fua_lang_no_urls_selected',"nessun URL selezionato da cancellare");

define('_fua_lang_url_deleted',"URL cancellato/i");

define('_fua_lang_url_new',"nuovo/i URL");

define('_fua_lang_new_urls_saved',"nuovo/i URL salvato/i");

define('_fua_lang_url_new_info',"inserire soltanto ciò che appare dopo il nome di dominio. P. es.: 'index.php?option=com_content&view=category&layout=blog&id=36&Itemid=55' o con SEF-url 'index.php/lucid-dreams' ");

define('_fua_lang_url_message_type',"messaggio mostrato quando l'accesso all'url è negato");

define('_fua_lang_demo_days_left',"versione di prova. Giorni rimanenti");

define('_fua_lang_demo_days_left_tip',"Se si ha bisogno di ulteriore tempo per il test o lo sviluppo di questo componente in produzione senza un codice di registrazione basta scaricare una nuova versione di prova e reinstallare componente, plugin e modulo di Frontend-User-Access. I dati inseriti non vengono cancellati. Non è necessario riconfigurare il componente in caso di backup del file di configurazione.");

define('_fua_lang_items_info',"Permessi frontend per articoli specifici (com_content). Se l'utente non ha accesso gli viene mostrato il seguente messaggio nel testo dell'articolo");

define('_fua_lang_no_access_item',"Accesso negato a questo articolo");

define('_fua_lang_items_info2',"Il messaggio  può essere modificato nel file della lingua");

define('_fua_lang_categories_info',"Permessi frontend per articoli di una specifica categoria (com_content)");

define('_fua_lang_sections_info',"Permessi frontend per articoli di una specifica sezione (com_content)");

define('_fua_lang_reverse_access',"permessi invertiti");

define('_fua_lang_reverse_access_info',"Normalmente l'accesso al gruppo è consentito se la casella è spuntata. Attivando i permessi invertiti le caselle spuntate  indicano accessi negati mentre tutte quelle vuote indicano permessi di accesso");

define('_fua_lang_components_info',"Permessi frontend per i componenti");

define('_fua_lang_reverse_access_warning',"Permessi invertiti attivati");

define('_fua_lang_usergroup_has_no_access',"il gruppo NON HA accesso");

define('_fua_lang_usergroup_has_access',"il gruppo ha l'accesso");

define('_fua_lang_message_type_none',"il testo contenuto viene sostituito da");

define('_fua_lang_messagetype_items',"messaggio mostrato quando non si ha accesso all'articolo in vista completa");

define('_fua_lang_no_access_page',"non hai privilegi sufficienti per vedere questa pagina");

define('_fua_lang_messagetype_category',"messaggio mostrato quando non si ha accesso alla categoria nel layout blog o lista oppure all'articolo in vista intera");

define('_fua_lang_messagetype_section',"messaggio mostrato quando non si ha accesso agli articoli di una data sezione nel layout sezione, blog sezione o all'articolo in vista intera");

define('_fua_lang_messagetype_archive',"non usare la Lista di articoli archiviati o l'aspetto categoria!");

define('_fua_lang_messagetype_archive_info',"Sfortunatamente, per ragioni ignote, l'impostazione dei permessi di accesso agli articoli non viene attivata da Joomla nelle liste di articoli archiviati o in aspetto categoria. In queste viste non vengono impostati permessi di accesso agli articoli e gli utenti accedono alla vista intera degli articoli. Una possibile alternativa può essere nascondere il testo introduttivo. Nel gestore dei menu è possibile attivare tale opzione ma non funziona (Joomla 1.5.15 11-2009). Occorrerà attendere una versione aggiornata di Joomla in cui venga corretto questo comportamento che di fatto impedisce l'uso dei permessi negli articoli archiviati.");

define('_fua_lang_not_superadmin',"Mostrati tutti gli utenti eccetto i super-amministratori");

define('_fua_lang_backend',"backend");

define('_fua_lang_frontend',"frontend");

define('_fua_lang_module_access',"Permessi per i moduli");

define('_fua_lang_use_moduleaccess',"attivare i permessi per i moduli");

define('_fua_lang_modules_message_type',"mostra quando l'accesso al modulo è negato");

define('_fua_lang_hide_module',"nascondi modulo");

define('_fua_lang_modules_message_type_text',"mostra questo messaggio nel modulo");

define('_fua_lang_no_access_module',"non hai privilegi sufficienti per visualizzare questo modulo");

define('_fua_lang_modules_info',"Permessi frontend per il modulo. Un 'Frontend-User-Access' può caricare un solo modulo. Puoi inserire l'id del modulo da caricare nel gestore dei moduli. Si possono assegnare i permessi soltanto ai moduli 'Frontend-User-Access', che funzionano come contenitori di login del loro contenuto costituito da moduli");

define('_fua_lang_no_modules_active',"permessi dei moduli non attivi");

define('_fua_lang_module_loading_module',"caricamento del modulo fua");

define('_fua_lang_no_module_assigned',"nessun id di modulo valido");

define('_fua_lang_module_access_saved',"permessi del modulo salvati");

define('_fua_lang_instructions',"istruzioni");

define('_fua_lang_opens_in_popup',"apri con un popup");

define('_fua_lang_display_articles',"mostra quando non si ha accesso all'articolo");

define('_fua_lang_hide_article',"nascondi articolo");

define('_fua_lang_display_other',"mostra quando non si ha accesso all'articolo in qualunque altro layout");

define('_fua_lang_see_article_access',"vedi opzione ");

define('_fua_lang_on_tab',"sul tab");

define('_fua_lang_items_hide_info',"Per nascondere completamente l'articolo, Frontend-User-Access necessita di sapere quali classi CSS sono adoperate nel tuo template. Se stai usando un template derivato da uno di quelli forniti con Joomla, premi il pulsante qui sotto.");

define('_fua_lang_items_hide_info2',"Se stai usando un template personale devi verificarne il codice ed inserire i nomi delle classi CSS qui. Nel tuo sito, vai ad una pagina contenente degli articoli e verifica il codice HTML. Quindi inserisci i nomi delle classi CSS nei relativi campi.");

define('_fua_lang_hide_wrapper_content',"elemento e nome della classe del contenuto o dell'articolo. P. es.:");

define('_fua_lang_hide_wrappers_up',"contenitori gemelli dello stesso contenitore-padre<br />Spesso il contenitore del titolo dell'articolo o dei pulsanti. Lasciare vuoto se assenti. Se ce ne sono diversi ordinarli a partire dal contenitore padre. P. es.:");

define('_fua_lang_filter',"filtro");

define('_fua_lang_go',"vai");

define('_fua_lang_reset',"reimposta");

define('_fua_lang_all',"tutto");

define('_fua_lang_joomla10_only',"Questa configurazione nascondi-articolo è disponibile solo per Joomla 1.0");

define('_fua_lang_not_in_free_version',"Restrizioni non disponibili nella versione gratuita. Provare la versione di prova o quella a pagamento");

define('_fua_lang_default_usergroup',"gruppo di default");

define('_fua_lang_default_usergroup_info',"gruppo di default per i nuovi utenti. Funziona con Joomla user-manager, Joomla frontend, Community Builder e altro.");

define('_fua_lang_none',"nessuno");

define('_fua_lang_not_in_free',"Non disponibile nella versione gratuita. Provare la versione di prova o quella a pagamento");

################
//added 2.1.0
define('_fua_lang_menu_access',"menu/page access");
define('_fua_lang_use_menu_access',"activate menu/page access restrictions");
define('_fua_lang_menu_info',"If user has no access to a menu-item, the menu-item will be hidden in the Frontend-User-Access menu-module and the user will have no access to the menu-item related page. The restrictions to the page only works when the Itemid is included in the url (or in SEF-urls). Obviously, restrictions will not work when the Itemid is taken from the url. So you are adviced to use search-engine-friendly urls, so users can not tamper with the url.");
define('_fua_lang_no_active_menu',"Restrictions to menu-items/pages is not activated");
define('_fua_lang_menus',"menus");
define('_fua_lang_menu_access_saved',"menu/page access saved");
define('_fua_lang_menuaccess_message_type',"message type when no access to menu-item/page");
define('_fua_lang_menuaccess_message_type_text',"just this text");
define('_fua_lang_menuaccess_message_type_text2',"with back link to the previous page");
define('_fua_lang_cache',"Joomla cache");
define('_fua_lang_cache_info',"Joomla cache should be disabled for content-restrictions (articles, categories, sections).");
define('_fua_lang_cache_info2',"You can set this in the");
define('_fua_lang_global_config',"global configuration");
define('_fua_lang_cache_info3',"on tab 'System'");
define('_fua_lang_is_enabled',"is enabled");
define('_fua_lang_is_not_enabled',"is disabled");
define('_fua_lang_redirect_after_login',"redirect url after login frontend");
define('_fua_lang_example',"example");
define('_fua_lang_redirect_after_login_info',"redirect url after login on the frontend of the site, for users who are not assigned to any Frontend-User-Access usergroups. To redirect users who are assigned to a usergroup, enter the url in the Frontend-User-Access-usergroup-manager for each usergroup"); 
?>