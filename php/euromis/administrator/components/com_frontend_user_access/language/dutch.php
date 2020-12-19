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

define('_fua_lang_usergroups',"gebruikersgroepen");
define('_fua_lang_users',"gebruikers");
define('_fua_lang_user',"beheerder");
define('_fua_lang_page_access',"pagina toegang");
define('_fua_lang_component_access',"componenten toegang");
define('_fua_lang_new',"nieuw");
define('_fua_lang_delete',"verwijderen");
define('_fua_lang_save',"opslaan");
define('_fua_lang_apply',"toepassen");
define('_fua_lang_cancel',"annuleren");
define('_fua_lang_usergroup_saved',"gebruikersgroep opgeslagen");
define('_fua_lang_select_item_to_delete',"selecteer item om te verwijderen");
define('_fua_lang_usergroup_deleted',"gebruikersgroep verwijderd");
define('_fua_lang_component_access_saved',"componenten toegang opgeslagen");
define('_fua_lang_userssaved',"beheerder(s) opgeslagen");
define('_fua_lang_please_select_user',"selecteer aub een beheerder");
define('_fua_lang_not_logout_super',"je kunt een super-administrator niet uitloggen");
define('_fua_lang_user_saved',"beheerder opgeslagen");
define('_fua_lang_user_edit',"beheerder bewerken");
define('_fua_lang_name',"naam");
define('_fua_lang_password',"wachtwoord");

define('_fua_lang_usergroup',"gebruikersgroep");
define('_fua_lang_new_user',"nieuwe beheerder");
define('_fua_lang_usergroup_edit',"gebruikersgroep wijzigen");
define('_fua_lang_name_usergroup',"naam gebruikersgroep");
define('_fua_lang_mail_usergroup_administrator',"mailadres(sen) hoofdgebruikers");
define('_fua_lang_separate_adresses',"Bij meer dan 1 emailadres, deze scheiden met een komma");
define('_fua_lang_usergroup_new',"nieuwe gebruikersgroep");
define('_fua_lang_new_page',"nieuwe content-pagina");
define('_fua_lang_new_page_tip',"gebruikers kunnen een nieuwe content-pagina aanmaken<br />(content-category-blog)");
define('_fua_lang_new_link_page',"nieuwe link pagina");
define('_fua_lang_new_link_page_tip',"gebruikers kunnen een nieuwe link-pagina aanmaken<br />(url)");
define('_fua_lang_publish_page',"pagina publiceren");
define('_fua_lang_publish_page_tip',"gebruikers kunnen een pagina publiseren zodat deze aan de voorkant van de website bekeken kan worden");
define('_fua_lang_page_trash',"verwijder pagina");
define('_fua_lang_page_trash_tip',"gebruikers kunnen paginas in de prullenbak doen (verwijderen)");
define('_fua_lang_page_move',"pagina verplaatsen");
define('_fua_lang_page_move_tip',"gebruikers kunnen paginas verplaatsen naar een andere lokatie in de menu-structuur van de website");
define('_fua_lang_notify_new_page',"geen bericht sturen bij nieuwe pagina");
define('_fua_lang_notify_new_page_tip',"Als aangevinkt, wordt er GEEN mailtje gestuurd naar de email adres(sen) van de gebruikersgroep (als geconfigureerd bij de eigenschappen van een gebruikersgroep) wanneer er een nieuwe pagina wordt opgeslagen door een van de gebruikers in deze groep.<br /><br />Als NIET aangevinkt wordt er WEL een mailtje gstuurd (als er minstens 1 email-adres is ingevoerd)");
define('_fua_lang_notify_edit_page',"geen bericht sturen bij pagina wijzigen");
define('_fua_lang_notify_edit_page_tip',"Als aangevinkt, wordt er GEEN mailtje gestuurd naar de email adres(sen) van de gebruikersgroep (als geconfigureerd bij de eigenschappen van een gebruikersgroep) wanneer er een nieuwe pagina wordt opgeslagen nadat deze is bewerkt door een van de gebruikers in deze groep.<br /><br />Als NIET aangevinkt wordt er WEL een mailtje gstuurd (als er minstens 1 email-adres is ingevoerd)");
define('_fua_lang_new_item',"nieuw item");
define('_fua_lang_new_item_tip',"gebruikers kunnen nieuwe items aanmaken");
define('_fua_lang_publish_item',"item publiceren");
define('_fua_lang_publish_item_tip',"gebruikers kunnen items publiceren");
define('_fua_lang_trash_item',"item verwijderen");
define('_fua_lang_trash_item_tip',"gebruikers kunnen individuele items in de prullenbak doen (verwijderen). Als een pagina wordt verwijderd, worden ook alle items op die pagina verwijderd, dus de rechten om een pagina weg te gooien overruled dit recht om items te verwijderen.");
define('_fua_lang_move_item',"item verplaatsen");
define('_fua_lang_move_item_tip',"gebruikers kunnen items naar andere paginas verplaatsen");
define('_fua_lang_notify_new_item',"geen bericht sturen bij nieuw item");
define('_fua_lang_notify_new_item_tip',"Als aangevinkt, wordt er GEEN mailtje gestuurd naar de email adres(sen) van de gebruikersgroep (als geconfigureerd bij de eigenschappen van een gebruikersgroep) wanneer er een nieuw item wordt opgeslagen door een van de gebruikers in deze groep.<br /><br />Als NIET aangevinkt wordt er WEL een mailtje gstuurd (als er minstens 1 email-adres is ingevoerd)");
define('_fua_lang_notify_edit_item',"geen bericht sturen bij item wijzigen");
define('_fua_lang_notify_edit_item_tip',"Als aangevinkt, wordt er GEEN mailtje gestuurd naar de email adres(sen) van de gebruikersgroep (als geconfigureerd bij de eigenschappen van een gebruikersgroep) wanneer er een item wordt opgeslagen nadat deze is bewerkt door een van de gebruikers in deze groep.<br /><br />Als NIET aangevinkt wordt er WEL een mailtje gstuurd (als er minstens 1 email-adres is ingevoerd)");
define('_fua_lang_no_access_component',"je hebt geen toegang tot dit component");
define('_fua_lang_sureuserdelete',"weet u zeker dat u deze beheerder(s) wilt verwijderen?");
define('_fua_lang_nonameentered',"u heeft geen naam ingevuld");
define('_fua_lang_noemailentered',"u heeft geen emailadres ingevuld");
define('_fua_lang_nousergroupselected',"u heeft geen gebruikersgroep geselecteerd");
define('_fua_lang_suredeleteusergroup',"weet u zeker dat u deze gebruikersgroep(en) wilt verwijderen?");
define('_fua_lang_noselectusergroups',"u heeft geen gebruikersgroep(en) geselecteerd");
define('_fua_lang_noselectusers',"u heeft geen beheerder(s) geselecteerd");
define('_fua_lang_suredeleteusers',"weet u zeker dat u deze beheerder(s) wilt verwijderen?");
define('_fua_lang_itemtype_access',"itemtype toegang");
define('_fua_lang_itemtypes_access_saved',"itemtype toegang opgeslagen");
define('_fua_lang_nopassword',"u heeft geen wachtwoord ingevuld");
define('_fua_lang_nousergroups',"er zijn geen gebruikersgroepen gedefinieerd");
define('_fua_lang_nousers',"er zijn geen gebruikers gevonden.<br />Maak nieuwe users met de ");
define('_fua_lang_user_new',"nieuwe beheerder");
define('_fua_lang_itemtypetext',"tekst");
define('_fua_lang_username',"gebruikersnaam");
define('_fua_lang_configsaved',"configuratie opgeslagen");
define('_fua_lang_showtab',"toon tabblad");
define('_fua_lang_general',"algemene instellingen");
define('_fua_lang_language',"taal");
define('_fua_lang_defaulttab',"default tabblad");
define('_fua_lang_useinpiuseraccess',"activeer in Frontend-User-Access");
define('_fua_lang_order',"volgorde");
define('_fua_lang_alias',"alias");
define('_fua_lang_componentname',"component-naam");
define('_fua_lang_box',"box aangevinkt");
define('_fua_lang_use_componentaccess',"activeer component-toegang-restricties");
define('_fua_lang_statuspi',"status van component Pages-and-Items");
define('_fua_lang_piinstalled',"component Pages-and-Items is geinstalleerd (com_pi_pages_and_items)");
define('_fua_lang_pinotinstalled',"WAARSCHUWING: component Pages-and-Items is niet geinstalleerd.");
define('_fua_lang_joomlagroup',"Joomlagroep");
define('_fua_lang_defaultjoomlagroup',"default Joomlagroep voor nieuwe beheerder");
define('_fua_lang_showjoomlagroup',"toon Joomlagroep selectbox");
define('_fua_lang_showjoomlagroup_tip',"toon Joomlagroep selectbox bij het aanmaken of wijzigen van een beheerder");
define('_fua_lang_disableselectbox',"Toon alleen Joomlagroep");
define('_fua_lang_config',"configuratie");
define('_fua_lang_version',"versie");
define('_fua_lang_commercial',"commerciele licentie");
define('_fua_lang_configwriteable',"is schrijfbaar");
define('_fua_lang_confignotwriteable',"is niet schrijfbaar");
define('_fua_lang_menus',"menu\'s");
define('_fua_lang_menus_tip',"menu\'s getoond op \'pagina toegang\'-pagina.");
define('_fua_lang_activate',"activeer restricties");
define('_fua_lang_activate_tip',"Als aangevinkt zijn restricties actief. Dit zet alle pagina/itemtype/component-toegang en actie(workflow) instellingen aan of uit.");
define('_fua_lang_tabs',"tabs");



define('_fua_lang_activatepipage',"pagina-toegang restricties");



define('_fua_lang_edit_page',"bewerken content-pagina");
define('_fua_lang_edit_page_tip',"gebruikers kunnen een content-pagina bewerken<br />(content-category-blog)");
define('_fua_lang_categorylink',"category link");
define('_fua_lang_edit_pagelink',"bewerken link-pagina");
define('_fua_lang_edit_pagelink_tip',"gebruikers kunnen een link-pagina bewerken");
define('_fua_lang_edit_item',"items bewerken");
define('_fua_lang_edit_item_tip',"Als aangevinkt kunnen gebruikers items bewerken");
define('_fua_lang_image_upload',"afbeelding uploaden");
define('_fua_lang_image_upload_tip',"Als aangevinkt kunnen gebruikers afbeeldingen uploaden in de TinyMCE-afbeeldingen-popup (alleen als de TinyMCE-image-popup-modificatie is toegepast. zie Pages-and-Items-configuratie).<br /><br />WAARSCHUWING:<br />In Joomla 1.5 &gt; kunnen afbeeldingen ook met de knop onder de editor worden geupload. Dus als je niet wilt dat gebruikers afbeeldingen uploaden zal je ook die plugin moeten uitzetten (Editor Button - Image).");
define('_fua_lang_download_upload',"download upload");
define('_fua_lang_download_upload_tip',"Als aangevinkt kunnen gebruikers download-bestanden uploaden in de TinyMCE-link-popup <ul><li>alleen als TinyMCE-link-popup-modificatie is toegespast (zie Pages-and-Items-configuratie)</li></ul>");
define('_fua_lang_download_delete',"download verwijderen");
define('_fua_lang_download_delete_tip',"Als aangevinkt kunnen gebruikers download-bestanden verwijderen in de TinyMCE-link-popup <ul><li>alleen als TinyMCE-link-popup-modificatie is toegepast (zie Pages-and-Items-configuratie)</li></ul>");
define('_fua_lang_download_reset',"download hits teller op nul zetten");
define('_fua_lang_download_reset_tip',"Als aangevinkt kunnen gebruikers bij elke download de hits teller op nul zetten in de TinyMCE-link-popup <ul><li>alleen als TinyMCE-link-popup-modificatie is toegepast (zie Pages-and-Items-configuratie)</li></ul>");
define('_fua_lang_download_access',"download toegang instellen");
define('_fua_lang_download_access_tip',"Als aangevinkt kunnen gebruikers bij elke download de toegang-level instellen (iedereen/ingelogd/speciaal) in de TinyMCE-link-popup <ul><li>alleen als TinyMCE-link-popup-modificatie is toegespast (zie Pages-and-Items-configuratie)</li></ul>");
define('_fua_lang_download_select',"download selecteren");
define('_fua_lang_download_select_tip',"Als aangevinkt kunnen gebruikers downloads selecteren om een download-link te maken in de TinyMCE-link-popup <ul><li>alleen als TinyMCE-link-popup-modificatie is toegespast (zie Pages-and-Items-configuratie)</li></ul>");
define('_fua_lang_selectall',"[alles selecteren]");
define('_fua_lang_validkey',"licentie sleutel");
define('_fua_lang_enterkey',"licentie sleutel invoeren");
define('_fua_lang_keyisentered',"licentie sleutel is ingevoerd");
define('_fua_lang_keynotvalid',"licentie sleutel is niet geldig");
define('_fua_lang_validkey_tip',"Je kunt deze extensie onbeperkt gebruiken op 'localhost. Voor online kun je deze extensie een paar weken gebruiken. Heb je langer nodig voor testen of developen, download dan nieuwe versies van de site en installeer het component, de 2 plugins en de module opnieuw. Je hoeft niet alle toegangs-data opnieuw in te voeren, die blijft staan in de database. Als je een backup maakt van het configuratie-bestand hoef je Frontend-User-Access niet opnieuw te configureren.");
define('_fua_lang_nopagesactive',"Restricities op pagina toegang is niet geactiveerd. Je kunt dit activeren in de configuratie.");
define('_fua_lang_noitemtypeactive',"Restricities op itemtype toegang is niet geactiveerd. Je kunt dit activeren in de configuratie.");
define('_fua_lang_noworkflowactive',"Workflow is niet geactiveerd. Je kunt dit activeren in de configuratie.");
define('_fua_lang_nocomponentactive',"Restricities op componenten-toegang is niet geactiveerd");

define('_fua_lang_on',"aan");
define('_fua_lang_off',"uit");


define('_fua_lang_sections',"sectie toegang");
define('_fua_lang_activatesections',"activeer sectie restricties");
define('_fua_lang_activatesections_tip',"Als aangevinkt zijn de sectie-restricties geactiveerd voor:<ul><li>component Pages-and-Items</li><li>Joomla frontend, bij wijzigen of maken van een com_content item, worden in de sectie-select alleen de secties getoond waar de beheerder toegang toe heeft (je kunt de sectie-select-optie \'niet gecategoriseerd\' weghalen bij de instellingen voor workflow). Joomla 1.0.x heeft geen sectie-select op de item-edit-pagina.</li><li>Joomla frontend, bij wijzigen van een com_content item, is de toegang tot de item-edit-pagina beperkt tot de gebruikers die toegang hebben tot de sectie waar het item bij hoort</li></ul>");
define('_fua_lang_nosectionsactive',"Restricities op sectie toegang is niet geactiveerd. Je kunt dit activeren in de configuratie.");


define('_fua_lang_activateitems',"activeer item-toegang-restricties");
define('_fua_lang_activateitems_tip',"Als aangevinkt zijn de item-toegang-restricties geactiveerd voor:<ul><li>component Pages-and-Items</li><li>Joomla frontend en backend bij het wijzigen van com_content items wordt de item-edit-pagina toegang gecontroleerd</li></ul>");


define('_fua_lang_top',"top");
define('_fua_lang_new_item_frontend',"nieuw item voorkant");
define('_fua_lang_new_item_frontend_tip',"gebruikers kunnen een nieuw item maken vanaf de voorkant van de site. Waarschuwing: als een beheerder een nieuw item maakt kan deze de categorie en sectie selecteren voor het item. Dus als je sectie of pagina restricties gebruikt, deze optie NIET aanvinken!");
define('_fua_lang_edit_item_frontend',"item bewerken voorkant");
define('_fua_lang_edit_item_frontend_tip',"gebruikers kunnen een item bewerken vanaf de voorkant van de site. Waarschuwing: als een beheerder een item bewerkt, kan deze de categorie en sectie selecteren voor het item. Dus als je sectie of pagina restricties gebruikt, deze optie NIET aanvinken!");
define('_fua_lang_new_weblink_frontend',"nieuwe weblink voorkant");
define('_fua_lang_new_weblink_frontend_tip',"gebruikers kunnen een nieuwe weblink maken vanaf de voorkant van de site.");
define('_fua_lang_statusbot',"status plugin");
define('_fua_lang_botinstalled',"plugin is geinstalleerd");
define('_fua_lang_botnotinstalled',"plugin is niet geinstalleerd");
define('_fua_lang_botpublished',"plugin is geactiveerd");
define('_fua_lang_botnotpublished',"plugin is niet geactiveerd");
define('_fua_lang_noitemaccessactive',"Restricties op item toegang is niet geactiveerd. Je kunt dit activeren in de configuratie.");
define('_fua_lang_display_itemtype_in_list',"toon itemtype in item-lijst op pagina 'item toegang'");
define('_fua_lang_pages_info',"Pagina toegang restricties. Kan gebruikt worden met component Pages-and-Items en Joomla frontend en backend bij het maken en bewerken van content-items binnen com_content.");
define('_fua_lang_itemtype_info',"Itemtype toegang restricties voor itemtypes in component Pages-and-Items");
define('_fua_lang_item_info',"Item toegang restricties.");
define('_fua_lang_sections_info',"Sectie toegang restricties. Kan gebruikt worden met component Pages-and-Items en Joomla frontend en backend bij het maken en bewerken van content-items binnen com_content.");
define('_fua_lang_not_published',"niet gepubliseerd");
define('_fua_lang_hide_sec_uncategorized_option',"verberg sectie niet gecategoriseerd optie");
define('_fua_lang_hide_sec_uncategorized_option_tip',"Bij het maken of bewerken van een item vanaf de voorkant van de site, bij de sectie select, verberg de optie \'niet gecategoriseerd\'. Joomla 1.0.x heeft geen sectie-select op de item-edit-pagina.");
define('_fua_lang_hide_sec_uncategorized_option_backend',"verberg sectie niet gecategoriseerd optie");
define('_fua_lang_hide_sec_uncategorized_option_backend_tip',"Bij het maken of bewerken van een item aan de acherkant van de site(admin), bij de sectie select, verberg de optie \'niet gecategoriseerd\'. In Joomla 1.0.x is die optie er niet in de sectie select.");
define('_fua_lang_categories',"categorie toegang");
define('_fua_lang_activatecategories',"activeer categorie toegang restricties");
define('_fua_lang_activatecategories_tip',"activeer categorie toegang restricties in Joomla\'s frontend en backend, bij het maken en bewerken van content-items binnen com_content");
define('_fua_lang_category_access_saved',"categorie toegang opgeslagen");
define('_fua_lang_no_item_access',"je hebt geen toestemming dit item te bewerken");
define('_fua_lang_no_section_item_access',"je hebt geen toestemming om een nieuw item te maken of bewerken in deze sectie.");
define('_fua_lang_no_category_item_access',"je hebt geen toestemming om een nieuw item te maken of bewerken in deze categorie.");
define('_fua_lang_new_item_backend',"nieuw item backend");
define('_fua_lang_new_item_backend_tip',"gebruikers kunnen een nieuw item maken in de backend");
define('_fua_lang_edit_item_backend',"item bewerken backend");
define('_fua_lang_edit_item_backend_tip',"gebruikers kunnen een item bewerken in de backend");
define('_fua_lang_no_item_new',"je hebt geen toestemming om een nieuw item te maken");
define('_fua_lang_no_categories_active',"Restricties op categorie toegang zijn niet geactiveerd. Je kunt dit activeren in de configuratie.");
define('_fua_lang_no_item_edit',"je hebt geen toestemming om een item te wijzigen");
define('_fua_lang_version_check',"versie check");
define('_fua_lang_email',"email");
define('_fua_lang_description',"beschrijving");	   
define('_fua_lang_loggedin',"ingelogd");	
define('_fua_lang_loggedin_description',"alle gebruikers die zijn ingelogd maar niet gekoppeld zijn aan een gebruikersgroep");	
define('_fua_lang_not_loggedin',"niet ingelogd");
define('_fua_lang_not_loggedin_description',"alle gebruikers die niet ingelogd zijn");
define('_fua_lang_components_message_type',"soort bericht bij geen toegang tot component");
define('_fua_lang_components_message_type_alert',"javascript alert, die terug linkt naar vorige pagina");
define('_fua_lang_components_message_type_inline_text',"inline tekst");
define('_fua_lang_item_access',"artikel toegang");
define('_fua_lang_items_activate',"activeer artikel toegang restricties");
define('_fua_lang_no_active_items',"artikel toegang restricties zijn niet geactiveerd");
//define('_fua_lang_item_message_type',"soort bericht als gebruiker geen toegang heeft tot artikel");
define('_fua_lang_item_access_saved',"artikel toegang restricties zijn opgeslagen");
define('_fua_lang_category_access',"categorie toegang");
define('_fua_lang_section_access',"sectie toegang");
define('_fua_lang_sections_active',"activeer sectie toegang restricties");
define('_fua_lang_no_sections_active',"sectie toegang restricties zijn niet geactiveerd");
define('_fua_lang_section_access_saved',"sectie toegang restricties zijn opgeslagen");
define('_fua_lang_activate_in_config',"Je kunt dit activeren op de configuratie-pagina");
define('_fua_lang_show_tab',"toon tabbladen");
define('_fua_lang_url_access',"url toegang");
define('_fua_lang_url_active',"activate url access restrictions");
define('_fua_lang_no_url_active',"url access restrictions are not activated");
define('_fua_lang_url_access_saved',"url access restrictions are saved");
define('_fua_lang_sure_to_delete_url',"weet je zeker dat je deze URL(s) wilt verwijderen?");
define('_fua_lang_no_urls_selected',"er zijn geen URL(s) geselecteerd om te verwijderen");
define('_fua_lang_url_deleted',"URL(s) verwijderd");
define('_fua_lang_url_new',"nieuwe URL(s)");
define('_fua_lang_new_urls_saved',"new URL(s) opgeslagen");
define('_fua_lang_url_new_info',"only enter what comes after the domain-name. example: 'index.php?option=com_content&view=category&layout=blog&id=36&Itemid=55' or when using SEF-url's 'index.php/lucid-dreams' ");
define('_fua_lang_url_message_type',"soort bericht bij geen toegang tot url");
define('_fua_lang_demo_days_left',"dit is een test-versie. dagen over");
define('_fua_lang_demo_days_left_tip',"Als je meer tijd nodig hebt voor het developen of testen van deze extensie online zonder een geldige licentie-sleutel, download dan een nieuwe versies van de site en herinstalleer component, de 2 plugins en de module Frontend-User-Access. Je hoeft de gebruikers restricties niet opnieuw in te voeren. Als je een backup maakt van het configuratie-bestand hoef je niet alles te her-configureren.");
define('_fua_lang_items_info',"Frontend artikelen toegang voor specifieke artikelen (com_content). Als de gebruiker geen toegang heeft staat de volgende boodschap in de content van het artikel");
define('_fua_lang_no_access_item',"Je hebt geen toegang tot dit artikel");
define('_fua_lang_items_info2',"Je kunt deze boodschap aanpassen in het taal bestand");
define('_fua_lang_categories_info',"Frontend artikelen toegang voor specifieke categori&euml;n (com_content)");

define('_fua_lang_reverse_access',"toegangsrechten omdraaien");
define('_fua_lang_reverse_access_info',"Gewoonlijk, als een aanvinkvakje is aangevinkt, heeft een gebruikersgroep toegang. Als 'toegangsrechten omdraaien' is geactiveerd, worden alle aangevinkte vakjes restricties en alle aanvinkvakjes die niet zijn aangevinkt worden toegankelijk");
define('_fua_lang_components_info',"Frontend component toegang");
define('_fua_lang_usergroup_has_no_access',"gebruikersgroep heeft GEEN toegang");
define('_fua_lang_usergroup_has_access',"gebruikersgroep heeft toegang");
define('_fua_lang_message_type_none',"content-tekst wordt vervangen door");
define('_fua_lang_messagetype_items',"soort bericht bij geen toegang tot artikel in volledige weergave");
define('_fua_lang_no_access_page',"je hebt geen toestemming deze pagina te bekijken");
define('_fua_lang_messagetype_section',"soort bericht bij geen toegang tot artikel in sectie, in section or section-blog layout en bij weergave van het artikel in volledige weergave.");
define('_fua_lang_messagetype_archive',"archief en category-list niet gerbuiken!");
define('_fua_lang_messagetype_archive_info',"Helaas, door onduidelijke redenen, wordt er in een artikel-archief door Joomla geen bot aangeroepen op artikel-nivo. Daardoor kunnen er geen artikel-restricties op artikel-nivo zijn. Als een gerbuiker op een artikel klikt, gaat deze naar het artikel in volledige weergave, waar de toegang restrictie wel werkt. Dus het probleem is alleen in de archief-lijst. Een goede workaround zou zijn om de intro-tekst te verbergen, zodat alleen de titels zichtbaar zijn. In de menu-manager, bij het maken of bewerken van een artikel-archief, is een optie om de intro-tekst te verbergen, maar dit werkt niet (Joomla 1.5.15 11-1009). Dus, mocht je het idee hebben om artikel-toegang-restricties te gebruiken samen met het archief dan moet ik je dat helaas afraden, totdat dit gerepareerd wordt in een volgende versie van Joomla.");
define('_fua_lang_not_superadmin',"Alles gebruikers behalve 'super administrators' worden getoond");
define('_fua_lang_backend',"backend");
define('_fua_lang_frontend',"frontend");
define('_fua_lang_messagetype_category',"soort bericht bij geen toegang tot artikel in volledige weergave en in category-blog of category-list layout");
define('_fua_lang_module_access',"module toegang");
define('_fua_lang_use_moduleaccess',"activeer module toegang restricties");
define('_fua_lang_modules_message_type',"toon als geen toegang tot module");
define('_fua_lang_hide_module',"verberg module");
define('_fua_lang_modules_message_type_text',"toon deze boodschap in de module");
define('_fua_lang_no_access_module',"je hebt geen toestemming deze module te bekijken");
define('_fua_lang_modules_info',"Frontend module toegang. Elke Frontend-User-Access module kan 1 andere module laden. Welke module te laden kun je configureren in de module manager. Je kunt alleen toegangs rechten zetten op Frontend-User-Access modules");
define('_fua_lang_no_modules_active',"Restricities op pagina toegang is niet geactiveerd");
define('_fua_lang_module_loading_module',"fua-module laadt module");
define('_fua_lang_no_module_assigned',"geen juist module id toegekent");
define('_fua_lang_module_access_saved',"module toegang is opgeslagen");
define('_fua_lang_instructions',"instructies");
define('_fua_lang_opens_in_popup',"opent in popup");
define('_fua_lang_display_articles',"weergave als geen toegang tot artikel in blog view");
define('_fua_lang_hide_article',"verberg article");
define('_fua_lang_display_other',"weergave als geen toegang tot artikel in andere layout");
define('_fua_lang_see_article_access',"zie optie ");
define('_fua_lang_on_tab',"op tabblad");
define('_fua_lang_items_hide_info',"Om de artikelen volledig te verbergen, moet Frontend-User-Access de elementen en CSS clanamen weten die in jouw content-template gebruikt worden. Als je een variatie van een van de standaard Joomla templates gebruikt die in de Joomla distibutie worden meegeleverd, klik dan op een van de onderstaande template-knoppen.");
define('_fua_lang_items_hide_info2',"Als je een ander template gebruikt, bekijk dan de code en vul de HTML-elementen en CSS class-namen hier in. Ga naar een pagina waar 1 of meer artikelen staan op jouw site en bekijk de HTML output. Vul de HTML-elementen en hun class-namen in de onderstaande velden.");
define('_fua_lang_hide_wrapper_content',"element en classnaam van de container om de content (artikel-tekst) of element en classnaam van de container die om het gehele artikel staat. example:");
define('_fua_lang_hide_wrappers_up',"element en classnaam van de sibling container boven de content-container (sibling container is een container in hetzelfde nivo als de content container, dus niet dat de een in de ander genest is)<br />Meestal is dit de container voor de titel of conatiner voor pdf-print etc. knopjes. Als er geen containers zijn, laat dit dan leeg. Als er meerdere zijn, gebruik dan deze volgorde: begin bij de containers die het dichtste bij de content-container staan. voorbeeld:");
define('_fua_lang_hide_wrappers_down',"element en classnaam van de sibling container onder de content-container (sibling container is een container in hetzelfde nivo als de content container, dus niet dat de een in de ander genest is)<br />Meestal is dit de container voor een artikel-spacer. Als er geen containers zijn, laat dit dan leeg. Als er meerdere zijn, gebruik dan deze volgorde: begin bij de containers die het dichtste bij de content-container staan. voorbeeld:");
define('_fua_lang_filter',"filter");
define('_fua_lang_go',"go");
define('_fua_lang_reset',"reset");
define('_fua_lang_all',"alles");
define('_fua_lang_joomla10_only',"Deze configuratie on artikelen te verstoppen is alleen voor Joomla 1.0");
define('_fua_lang_not_in_free_version',"Deze functionaliteit kan niet worden gebruikt in de gratis versie. Probeer de gratis probeer versie of koop de pro-versie.");
define('_fua_lang_default_usergroup',"default gebruikersgroep");
define('_fua_lang_default_usergroup_info',"default gebruikersgroep voor nieuwe gebruikers. Werkt met de Joomla user-manager, Joomla frontend, Community Builder en veel meer.");
define('_fua_lang_none',"geen");
define('_fua_lang_not_in_free',"Niet in deze gratis versie. Probeer de trial-versie of koop de pro-versie");
################
//added 2.1.0
define('_fua_lang_menu_access',"menu/pagina toegang");
define('_fua_lang_use_menu_access',"activeer menu/pagina toegang restricties");
define('_fua_lang_menu_info',"Als een gebruiker geen toegang heeft tot een menu-item, wordt deze niet getoond in de Frontend-User-Access menu-module en de gebruiker heeft geen toegang tot de pagina van het menu-item. De restricties werken alleen als het Itemid in de url zit (ook in SEF-urls). Restricties werken niet als het Itemid uit de url gehaald wordt. Dus u wordt met klem aangeraden zoekmachine-vriendelijke-urls te gebruiken, zodat bezoekers niet de urls kunnen bewerken.");
define('_fua_lang_no_active_menu',"Restricties voor menu-items/pagina toegang is niet geactiveerd");
define('_fua_lang_menu_access_saved',"menu/pagina toegang opgeslagen");
define('_fua_lang_menuaccess_message_type',"soort bericht bij geen toegang tot menu-item/pagina");
define('_fua_lang_menuaccess_message_type_text',"aleen deze tekst");
define('_fua_lang_menuaccess_message_type_text2',"met een link terug naar de vorige pagina");
define('_fua_lang_cache',"Joomla cache");
define('_fua_lang_cache_info',"Joomla cache moet uit staan voor content-restricties (artikelen, categorien, secties).");
define('_fua_lang_cache_info2',"Dit kun je instellen in de");
define('_fua_lang_global_config',"Algemene instellingen");
define('_fua_lang_cache_info3',"op tabblad 'Systeem'");
define('_fua_lang_is_enabled',"is geactiveerd");
define('_fua_lang_is_not_enabled',"is niet geactiveerd");
define('_fua_lang_redirect_after_login',"redirect url na inloggen aan de frontend");
define('_fua_lang_example',"voorbeeld");
define('_fua_lang_redirect_after_login_info',"redirect url na inloggen aan de voorkant van de site, voor bezoekers die niet aan een Frontend-User-Access gebruikersgroep zijn gekoppeld. Om bezoekers te redirecten die wel aan een groep zijn gekoppeld, vul de url in bij de Frontend-User-Access-gebruikersgroep-manager voor elke gebruikersgroep");
?>