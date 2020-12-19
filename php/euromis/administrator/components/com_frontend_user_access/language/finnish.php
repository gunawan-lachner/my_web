﻿<?php
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

define('_fua_lang_usergroups',"käyttäjäryhmät");
define('_fua_lang_users',"käyttäjät");
define('_fua_lang_user',"käyttäjä");
define('_fua_lang_component_access',"komponentin pääsyoikeus");
define('_fua_lang_new',"uusi");
define('_fua_lang_delete',"poista");
define('_fua_lang_save',"talleta");
define('_fua_lang_apply',"käytä");
define('_fua_lang_cancel',"peruuta");
define('_fua_lang_usergroup_saved',"käyttäjäryhmä talletettu");
define('_fua_lang_select_item_to_delete',"valitse poistettava asia");
define('_fua_lang_usergroup_deleted',"käyttäjäryhmä poistettu");
define('_fua_lang_component_access_saved',"komponentin pääsyrajoitukset talletettu");
define('_fua_lang_userssaved',"käyttäjä(t) talletettu");
define('_fua_lang_please_select_user',"ole hyvä ja valitse käyttäjä");
define('_fua_lang_user_saved',"käyttäjä talletettu");
define('_fua_lang_user_edit',"käyttäjän muokkaus");
define('_fua_lang_name',"nimi");
define('_fua_lang_password',"salasana");
define('_fua_lang_usergroup',"käyttäjäryhmä");
define('_fua_lang_new_user',"uusi käyttäjä");
define('_fua_lang_usergroup_edit',"käyttäjäryhmän muokkaus");
define('_fua_lang_name_usergroup',"nimeä käyttäjäryhmä");
define('_fua_lang_usergroup_new',"uusi käyttäjäryhmä");
define('_fua_lang_no_access_component',"sinulla ei ole oikeuksia tarkastella tätä komponenttia");
define('_fua_lang_sureuserdelete',"oletko varma että haluat poistaa tämän käyttäjän?");
define('_fua_lang_nonameentered',"anna jokin nimi");
define('_fua_lang_nousergroupselected',"valitse käyttäjäryhmä");
define('_fua_lang_suredeleteusergroup',"oletko varma että haluat poistaa tämän / nämä käyttäjäryhmät?");
define('_fua_lang_noselectusergroups',"et valinnut yhtäkään käyttäjäryhmää");
define('_fua_lang_noselectusers',"et valinnut yhtäkään käyttäjää");
define('_fua_lang_suredeleteusers',"oletko varma että haluat poistaa tämän / nämä käyttäjät?");
define('_fua_lang_nousergroups',"käyttäjäryhmiä ei ole määritelty");
define('_fua_lang_nousers',"hakua vastaavia käyttäjiä ei löytynyt.<br /> Tee uusia käyttäjiä ");
define('_fua_lang_user_new',"uusi käyttäjä");
define('_fua_lang_username',"käyttäjänimi");
define('_fua_lang_configsaved',"asetukset talletettu");
define('_fua_lang_showtab',"näytä välilehti");
define('_fua_lang_general',"yleiset asetukset");
define('_fua_lang_language',"kieli");
define('_fua_lang_defaulttab',"oletus välilehti");
define('_fua_lang_useinpiuseraccess',"käytä Frontend-User-Access:ssa");
define('_fua_lang_order',"järjestys");
define('_fua_lang_alias',"alias");
define('_fua_lang_componentname',"komponentti-nimi");
define('_fua_lang_use_componentaccess',"aktivoi komponenttin pääsyrajoitukset");
define('_fua_lang_joomlagroup',"Joomlaryhmä");
define('_fua_lang_showjoomlagroup',"näytä Joomlaryhmä valintalaatikko");
define('_fua_lang_showjoomlagroup_tip',"näytä Joomlaryhmä valintalaatikko, kun tehdään uusia käyttäjiä tai muokataan olemassa olevia");
define('_fua_lang_disableselectbox',"näytä vain Joomla ryhmä");
define('_fua_lang_config',"asetukset");
define('_fua_lang_version',"versio");
define('_fua_lang_commercial',"kaupallinen lisenssi");
define('_fua_lang_configwriteable',"ei kirjoitussuojattu");
define('_fua_lang_confignotwriteable',"kirjoitussuojattu");
define('_fua_lang_activate',"aktivoi rajoitukset");
define('_fua_lang_tabs',"välilehdet");
define('_fua_lang_selectall',"[valitse kaikki]");
define('_fua_lang_validkey',"lisenssiavain");
define('_fua_lang_enterkey',"syötä avain");
define('_fua_lang_keyisentered',"avain syötetty");
define('_fua_lang_keynotvalid',"avain ei kelpaa");
define('_fua_lang_validkey_tip',"Voit käyttää komponenttia testaamiseen sekä kehittämiseen 'localhost' -ympäristössä rajoittamattoman ajan, mutta online-tilassa lisäosan käyttöaika on rajoitettu kahteen viikkoon. Jos tarvitset lisäaikaa testaamiseen tai kehittämiseen, sinun tarvitsee vain ladata ja asentaa komponentti, plug-init sekä moduulit ohjelman kotisivuilta uudelleen uudelleen. Sinun ei tarvitse syöttää käyttäjäryhmien tietoja uudelleen, sillä ne säilyvät tietokannassa. Jos teet varmuuskopion asetustiedostosta sinun ei tarvitse uudelleen määritellä Frontend-User-Access:ssia.");
define('_fua_lang_nocomponentactive',"Rajoituksia komponentteihin ei ole aktivoitu.");
define('_fua_lang_on',"on");
define('_fua_lang_off',"off");
define('_fua_lang_top',"ylös");
define('_fua_lang_statusbot',"status plugin");
define('_fua_lang_botinstalled',"plugin on asennettu");
define('_fua_lang_botnotinstalled',"plugin ei ole asennettu installed");
define('_fua_lang_botpublished',"plugin on julkaistu");
define('_fua_lang_botnotpublished',"plugin ei ole julkaistu");
define('_fua_lang_not_published',"ei julkaistu");
define('_fua_lang_version_check',"version tarkistus");
define('_fua_lang_email',"sähköposti");
define('_fua_lang_description',"kuvaus");	 
define('_fua_lang_loggedin',"sisäänkirjautunut");	
define('_fua_lang_loggedin_description',"kaikki sisäänkirjautuneet käyttäjät joita ei ole osoitettu mihinkään käyttäjäryhmiin");	
define('_fua_lang_not_loggedin',"uloskirjautunut");
define('_fua_lang_not_loggedin_description',"kaikki käyttäjät jotka ovat uloskirjautuneet");
define('_fua_lang_components_message_type',"viestityyppi kun ei pääsyä komponenttiin");
define('_fua_lang_components_message_type_alert',"javascript hälytys, joka tuo takaisin edelliselle sivulle");
define('_fua_lang_components_message_type_inline_text',"välitön teksti");
define('_fua_lang_item_access',"artikkelin pääsyoikeus");
define('_fua_lang_items_activate',"aktivoi esinekäyttöoikeusrajoitukset");
define('_fua_lang_no_active_items',"Artikkelin käyttöoikeusrajoituksia ei ole aktivoitu");
//define('_fua_lang_item_message_type',"viestityyppi kun käyttäjällä ei oikeutta tarkastella artikkelia");
define('_fua_lang_item_access_saved',"artikkelin käyttöoikeusrajoitukset talletettu");
define('_fua_lang_category_access',"kategorian pääsyoikeus");
define('_fua_lang_activatecategories',"aktivoi kategorian käyttöoikeusrajoitukset");
define('_fua_lang_no_categories_active',"Kategorian käyttöoikeusrajoituksia ei ole aktivoitu");
define('_fua_lang_category_access_saved',"kategorian käyttöoikeusrajoitukset talletettu");
define('_fua_lang_section_access',"sektion pääsyoikeus");
define('_fua_lang_sections_active',"Aktivoi sektion käyttöoikeusrajoitukset");
define('_fua_lang_no_sections_active',"Sektion käyttöoikeusrajoituksia ei ole aktivoitu");
define('_fua_lang_section_access_saved',"sektion käyttöoikeusrajoitukset talletettu");
define('_fua_lang_activate_in_config',"Voit aktivoida tämän asetukset sivulta.");
define('_fua_lang_show_tab',"näytä välilehdet");
define('_fua_lang_url_access',"url pääsyoikeus");
define('_fua_lang_url_active',"aktivoi url käyttöoikeusrajoitukset");
define('_fua_lang_no_url_active',"url käyttöoikeusrajoituksia ei ole aktivoitu");
define('_fua_lang_url_access_saved',"url käyttöoikeusrajoitukset talletettu");
define('_fua_lang_sure_to_delete_url',"oletko varma että haluat poistaa tämän / nämä URL:n tai URL:t?");
define('_fua_lang_no_urls_selected',"Ei valittuna poistettavia URL:ja");
define('_fua_lang_url_deleted',"URL(a) poistettu");
define('_fua_lang_url_new',"new URL(s)");
define('_fua_lang_new_urls_saved',"uutta URL(a) talletettu");
define('_fua_lang_url_new_info',"vain mitä tulee domain-nimen jälkeen. esimerkiksi: 'index.php?option=com_content&view=category&layout=blog&id=36&Itemid=55' tai kun käytösä SEF-urlit 'index.php/lucid-dreams' ");
define('_fua_lang_url_message_type',"viestityyppi kun ei pääsyä urliin");
define('_fua_lang_demo_days_left',"tämä on koekäyttöversio. päivää jäljellä");
define('_fua_lang_demo_days_left_tip',"Jos haluat lisää aikaa komponentin kehittämiseen tai testaamiseen verkossa ilman oikeaa lisenssiavainta, tulee sinun vain ladata komponentti ja sen kaikki lisäosat uudelleen tuotteen kotisivuilta ja asentaa ne takaisin. Käyttäjäryhmien tietoja ei tarvitse syöttää uudelleen, sillä ne pysyvät tietokannassa tallessa. Jos teet varmuuskopion vielä asetustiedostosta ei sinun tarvitse määritellä Frontpage-User-Access:a uudelleen.");
define('_fua_lang_items_info',"Etusivuston artikkelikäyttöoikeudet tiettyihin artikkeleihin (com_content). Jos käyttäjällä ei ole oikeuksia, seuraavanlainen viesti näytetään artikkelin sisällössä");
define('_fua_lang_no_access_item',"Sinulla ei ole oikeuksia tarkastella tätä artikkelia");
define('_fua_lang_items_info2',"Voit vaihtaa tämän viestin kielitiedostosta");
define('_fua_lang_categories_info',"Etusivuston artikkelikäyttöoikeudet kaikille tietyn kategorian artikkeleille (com_content)");
define('_fua_lang_sections_info',"Etusivuston artikkelikäyttöoikeudet kaikille tietyn sektion artikkeleille (com_content)");
define('_fua_lang_reverse_access',"käänteinen pääsyoikeus");
define('_fua_lang_reverse_access_info',"Yleensä, kun valintalaatikko on rastitettu, käyttäjäryhmällä on pääsyoikeus. Kun käänteinen pääsyoikeus on aktivoitu rastitetut valintalaatikot määrittävät rajoituksia ja kaikki tyhjät valintalaatikot vapaata pääsyoikeutta");
define('_fua_lang_components_info',"Etusivuston komponentin pääsyoikeus");
define('_fua_lang_reverse_access_warning',"Käänteinen pääsyoikeus aktivoitu");
define('_fua_lang_usergroup_has_no_access',"usergroup has NO access");
define('_fua_lang_usergroup_has_access',"käyttäjäryhmällä on pääsyoikeus");
define('_fua_lang_message_type_none',"sisältöteksti korvataan tekstillä");
define('_fua_lang_messagetype_items',"viestityyppi kun ei oikeutta tarkastella täydessä näkymässä.");
define('_fua_lang_no_access_page',"sinulla ei ole oikeuksia tarkastella tätä sivua");
define('_fua_lang_messagetype_category',"viestityyppi kun ei oikeuksia kategoriaan kategoria-blogi- tai kategoria-listaulkoasussa tai artikkelin täydessä näkymässä");
define('_fua_lang_messagetype_section',"viestityyppi kun ei oikeuksia artikkeleihin sektioissa jos käytössä pelkkä sektio, sektio-blogi- tai sektiolistaulkoasu tai kun artikkelia tarkastellaan täydessä näkymässä");
define('_fua_lang_messagetype_archive',"älä käytä arkistoa tai kategoria-listaa!");
define('_fua_lang_messagetype_archive_info',"Valitettavasti tuntemattomista syistä johtuen artikkelien käyttörajoituksia ajava aliohjelma ei saa suorituspyyntöä artikkelitasolla arkistoa tai kategorialistaa käytettäessä Joomla-järjestelmässä. Siitä johtuen artikkelien käyttöoikeusrajoituksia ei voida toteuttaa arkisto tai kategorialista näkymissä. Kun artikkelia klikataan, käyttäjä viedään artikkelin täyteen näkymään, jossa artikkelin käyttöoikeusrajoitukset toimivat. Joten ongelma on vain arkistolistauksessa. Intro tekstin piilottaminen voisi olla hyvä vaihtoehto. Kun Menu Managerissa luodaan tai muokataan artikkeliarkistoa, voisi siellä olla vaihtoehtona piilottaa intro teksti, mutta ainakaan tällä hetkellä se ei toimi (Joomla 1.5.15 11-2009). Neuvon olemaan käyttämättä artikkelin käyttöoikeusrajoituksia arkistoissa ennen kuin tämä ominaisuus korjataan Joomlan tulevissa versioissa.");
define('_fua_lang_not_superadmin',"Kaikki käyttäjät paitsi 'super administrators' näytetään");
define('_fua_lang_backend',"takasivusto");
define('_fua_lang_frontend',"etusivusto");
define('_fua_lang_module_access',"moduulien pääsyoikeus");
define('_fua_lang_use_moduleaccess',"aktivoi moduulien käyttöoikeusrajoitukset");
define('_fua_lang_modules_message_type',"näytä, jos ei pääsyäoikeutta moduuliin");
define('_fua_lang_hide_module',"piilota moduuli");
define('_fua_lang_modules_message_type_text',"näytä tämä viesti moduulissa");
define('_fua_lang_no_access_module',"sinulla ei ole oikeutta tarkastella tätä moduulia");
define('_fua_lang_modules_info',"Etusivuston moduulikäyttöoikeus. Jokainen Frontend-User-Access moduuli voi ladata vain yhden moduulin itsensä lisäksi. Voit syöttää sen moduulin id-numeron jonka haluat lataavan Moduuli Managerista. Voit asettaa käyttöoikeusrajoituksia vain Frontend-User-Access moduuleille, joka toimii tietynlaisena käyttäjäoikeuksien säiliönä");
define('_fua_lang_no_modules_active',"moduulien käyttöoikeusrajoituksia ei ole aktivoitu");
define('_fua_lang_module_loading_module',"fua-moduuli lataa moduulia");
define('_fua_lang_no_module_assigned',"virheellinen moduulin id numero");
define('_fua_lang_module_access_saved',"moduulin pääsyoikeus talletettu");
define('_fua_lang_instructions',"ohjeet");
define('_fua_lang_opens_in_popup',"avaa ponnahdusikkunassa");
define('_fua_lang_display_articles',"näytä kun ei pääsyoikeutta artikkeliin");
define('_fua_lang_hide_article',"piilota artikkeli");
define('_fua_lang_display_other',"näytä kun ei pääsyoikeutta artikkeliin mistään muusta ulkoasusta");
define('_fua_lang_see_article_access',"katso vaihtoehto ");
define('_fua_lang_on_tab',"päällä välilehti");
define('_fua_lang_items_hide_info',"Piilottaaksesi artikkeli kokonaan Frontend-User-Access:n tarvitsee tietää mitä CSS-luokkanimiä on ulkoasuteemassa käytössä. Jos käytät jotain Joomlan tarjoamaa oletusulkoasun variaatiota, paina ulkoasunappulaa alapuolella.");
define('_fua_lang_items_hide_info2',"Jos käytössäsi on jokin muu ulkoasuteema, sinun tarvitsee tarkistaa sen lähdekoodista luokkanimet ja syöttää ne tähän. Mene sivustollasi sivulle, joka näyttää yhden tai useamman artikkelin ja tarkista HTML tuloste. Syötä sitten CSS-luokkanimet tulosteen kentistä.");
define('_fua_lang_hide_wrapper_content',"sisällön elementti- ja luokkanimisäiliö tai artikkelisäiliö. esimerkki:");
define('_fua_lang_hide_wrappers_up',"elementtien- ja luokkanimien sisarussäiliöt sisältösäiliön yläpuolella<br />Usein artikkeliotsikon tai nappien säiliö. Jos sellaista ei ole, jätä tyhjäksi. Jos niitä on useita järjestä ne aloittaen sisältösäiliöstä (content-wrapper). esimerkiksi:");
define('_fua_lang_hide_wrappers_down',"elementtien ja luokkanimien sisarussäiliöt sisältösäiliön alapuolella<br />Usein artikkelierottajan säiliö. Jos sellaista ei ole, jätä tyhjäksi. Jos niitä on useita järjestä ne aloittaen sisältösäiliöstä (content-wrapper). esimerkiksi:");
define('_fua_lang_filter',"filtteri");
define('_fua_lang_go',"mene");
define('_fua_lang_reset',"resetoi");
define('_fua_lang_all',"kaikki");
define('_fua_lang_joomla10_only',"Tämä piiloartikkelin asetus on vain Joomla 1.0:lle");
define('_fua_lang_not_in_free_version',"Näitä rajoituksia ei voida käyttää ilmaisessa versiossa. Testaa kokeiluaika versiota tai osta pro");
define('_fua_lang_default_usergroup',"default usergroup");
define('_fua_lang_default_usergroup_info',"default usergroup for new users. Works with Joomla user-manager, Joomla frontend, Community Builder and more.");
define('_fua_lang_none',"none");
define('_fua_lang_not_in_free',"Not in this free-version. Try the trial-version or buy the pro-version");
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