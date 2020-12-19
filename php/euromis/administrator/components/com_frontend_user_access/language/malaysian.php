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

define('_fua_lang_usergroups',"kumpulan pengguna");
define('_fua_lang_users',"pengguna-pengguna");
define('_fua_lang_user',"pengguna");
define('_fua_lang_component_access',"aksess komponen");
define('_fua_lang_new',"baru");
define('_fua_lang_delete',"buang");
define('_fua_lang_save',"simpan");
define('_fua_lang_apply',"kemaskini");
define('_fua_lang_cancel',"batal");
define('_fua_lang_usergroup_saved',"kumpulan pengguna telah disimpan");
define('_fua_lang_select_item_to_delete',"pilih item untuk dibuang");
define('_fua_lang_usergroup_deleted',"kumpulan pengguna telah dibuang");
define('_fua_lang_component_access_saved',"syarat aksess komponen telah disimpan");
define('_fua_lang_userssaved',"pengguna(-pengguna) telah disimpan");
define('_fua_lang_please_select_user',"sila pilih pengguna");
define('_fua_lang_user_saved',"pengguna telah disimpan");
define('_fua_lang_user_edit',"pengguna telah diubah");
define('_fua_lang_name',"nama");
define('_fua_lang_password',"kata laluan");
define('_fua_lang_usergroup',"kumpulan pengguna");
define('_fua_lang_new_user',"pengguna baru");
define('_fua_lang_usergroup_edit',"ubah kumpulan pengguna");
define('_fua_lang_name_usergroup',"nama kumpulan pengguna");
define('_fua_lang_usergroup_new',"kumpulan pengguna baru");
define('_fua_lang_no_access_component',"anda tidak dibenarkan mengaksess komponen ini");
define('_fua_lang_sureuserdelete',"adakah anda pasti untuk membuang pengguna ini?");
define('_fua_lang_nonameentered',"anda perlu memasukkan nama");
define('_fua_lang_nousergroupselected',"anda perlu memilih satu kumpulan pengguna");
define('_fua_lang_suredeleteusergroup',"adakah anda pasti untuk membuang kumpulan(-kumpulan) pengguna ini?");
define('_fua_lang_noselectusergroups',"anda belum memilih kumpulan pengguna");
define('_fua_lang_noselectusers',"anda belum memilih pengguna(-pengguna)");
define('_fua_lang_suredeleteusers',"adakah anda pasti untuk membuang pengguna(-pengguna) ini?");
define('_fua_lang_nousergroups',"tiada kumpulan pengguna yang wujud");
define('_fua_lang_nousers',"tiada pengguna yang dijumpai.<br /> Sila cipta pengguna baru dengan ");
define('_fua_lang_user_new',"pengguna baru");
define('_fua_lang_username',"username");
define('_fua_lang_configsaved',"konfigurasi telah disimpan");
define('_fua_lang_showtab',"tunjukkan tab");
define('_fua_lang_general',"konfigurasi am");
define('_fua_lang_language',"bahasa");
define('_fua_lang_defaulttab',"tab asal");
define('_fua_lang_useinpiuseraccess',"use in Frontend-User-Access");
define('_fua_lang_order',"susun");
define('_fua_lang_alias',"gelaran");
define('_fua_lang_componentname',"nama-komponen");
define('_fua_lang_use_componentaccess',"aktifkan syarat-aksess-komponen");
define('_fua_lang_joomlagroup',"Kumpulan Joomla");
define('_fua_lang_showjoomlagroup',"tunjukkan pilihan Kumpulan Joomla");
define('_fua_lang_showjoomlagroup_tip',"tunjukkan kotak pilihan kumpulan Joomla apabila mencipta pengguna baru atau mengubah pengguna.");
define('_fua_lang_disableselectbox',"hanya tunjukkan kumpulan Joomla");
define('_fua_lang_config',"konfigurasi");
define('_fua_lang_version',"versi");
define('_fua_lang_commercial',"lesen komersil");
define('_fua_lang_configwriteable',"boleh ditulis");
define('_fua_lang_confignotwriteable',"tidak boleh ditulis");
define('_fua_lang_activate',"aktifkan syarat");
define('_fua_lang_tabs',"tab");
define('_fua_lang_selectall',"[pilih semua]");
define('_fua_lang_validkey',"kunci lesen");
define('_fua_lang_enterkey',"masukkan kunci");
define('_fua_lang_keyisentered',"kunci telah dimasukkan");
define('_fua_lang_keynotvalid',"kunci tidak betul");
define('_fua_lang_validkey_tip',"Untuk percubaan dan pembangunan, anda boleh menggunakan komponen ini pada 'localhost' tanpa kekangan masa, namun untuk sistem yang telah berada di atas talian, ia hanya berfungsi untuk beberapa minggu sahaja. Jika lebih masa diperlukan, sila muat turun semula versi baru komponen, plugin serta modul ini dan pasang semula semua kesemuanya. Maklumat kumpulan pengguna tidak perlu dimasukkan semula, ia akan kekal pada pengkalan data. Jika anda telah membuat bakup fail konfigurasi, anda tidak perlu mengkonfigurasi semula Frontend-User-Access.");
define('_fua_lang_nocomponentactive',"Syarat pada komponen tidak diaktifkan");
define('_fua_lang_on',"aktifkan");
define('_fua_lang_off',"hentikan");
define('_fua_lang_top',"atas");
define('_fua_lang_statusbot',"status plugin");
define('_fua_lang_botinstalled',"plugin telah dipasang");
define('_fua_lang_botnotinstalled',"plugin belum dipasang");
define('_fua_lang_botpublished',"plugin telah dihidupkan");
define('_fua_lang_botnotpublished',"plugin tidak dihidupkan");
define('_fua_lang_not_published',"tidak dihidupkan");
define('_fua_lang_version_check',"semak versi");
define('_fua_lang_email',"email");
define('_fua_lang_description',"diskripsi");	 
define('_fua_lang_loggedin',"sudah 'logged in'");	
define('_fua_lang_loggedin_description',"semua pengguna yang telah 'logged in' dan belum memasuki mana-mana kumpulan pengguna");	
define('_fua_lang_not_loggedin',"sudah 'logged in'");
define('_fua_lang_not_loggedin_description',"semua pengguna yang belum 'logged in'");
define('_fua_lang_components_message_type',"jenis mesej apabila pengguna tidak dibenarkan mengaksess komponen");
define('_fua_lang_components_message_type_alert',"amaran javascript, yang mengaitkan dengan muka sebelumnya");
define('_fua_lang_components_message_type_inline_text',"teks 'inline'");
define('_fua_lang_item_access',"aksess artikel");
define('_fua_lang_items_activate',"aktifkan syarat aksess item");
define('_fua_lang_no_active_items',"Syarat aksess artikel tidak aktif");
//define('_fua_lang_item_message_type',"jenis mesej jika tiada aksess kepada artikel");
define('_fua_lang_item_access_saved',"syarat aksess artikel telah disimpan");
define('_fua_lang_category_access',"aksess kategori");
define('_fua_lang_activatecategories',"aktifkan syarat aksess kategori");
define('_fua_lang_no_categories_active',"Syarat aksess kategori tidak aktif");
define('_fua_lang_category_access_saved',"syarat aksess kategori telah disimpan");
define('_fua_lang_section_access',"aksess seksyen");
define('_fua_lang_sections_active',"aktifkan syarat aksess seksyen");
define('_fua_lang_no_sections_active',"Syarat aksess seksyen tidak aktif");
define('_fua_lang_section_access_saved',"syarat aksess seksyen telah disimpan");
define('_fua_lang_activate_in_config',"Anda boleh mengaktifkan ini pada muka konfigurasi.");
define('_fua_lang_show_tab',"tunjukkan tab");
define('_fua_lang_url_access',"aksess url");
define('_fua_lang_url_active',"aktifkan syarat aksess url");
define('_fua_lang_no_url_active',"syarat aksess url tidak aktif");
define('_fua_lang_url_access_saved',"syarat aksess url telah disimpan");
define('_fua_lang_sure_to_delete_url',"adakah anda pasti untuk membuang url(-url) ini?");
define('_fua_lang_no_urls_selected',"tiada url(-url) yang dipilih untuk pembuangan");
define('_fua_lang_url_deleted',"URL(-URL) telah dibuang");
define('_fua_lang_url_new',"URL(-URL) baru");
define('_fua_lang_new_urls_saved',"URL(-URL) baru telah disimpan");
define('_fua_lang_url_new_info',"masukkan hanya URL, abaikan domain name. contoh: 'index.php?option=com_content&view=category&layout=blog&id=36&Itemid=55' atau format URL: 'index.php/lucid-dreams' jika menggunakan SEF");
define('_fua_lang_url_message_type',"jenis mesej jika tiada aksess kepada URL");
define('_fua_lang_demo_days_left',"ini adalah versi percubaan. jumlah hari yang tinggal");
define('_fua_lang_demo_days_left_tip',"Jika lebih masa diperlukan untuk pembangunan atau percubaan atas talian (bukan 'localhost') tanpa menggunakan kunci lesen, sila muat turun semula versi baru komponen, plugin serta modul ini dan pasang semula semua kesemuanya. Maklumat kumpulan pengguna tidak perlu dimasukkan semula, ia akan kekal pada pengkalan data. Jika anda telah membuat bakup fail konfigurasi, anda tidak perlu mengkonfigurasi semula Frontend-User-Access.");
define('_fua_lang_items_info',"Aksess muka depan untuk artikel tertentu (com_content). Jika pengguna tiada aksess, mesej ini akan dikeluarkan menggantikan artikel tersebut");
define('_fua_lang_no_access_item',"Anda tidak dibenarkan melihat item ini");
define('_fua_lang_items_info2',"Anda boleh mengubah mesej ini pada fail bahasa");
define('_fua_lang_categories_info',"Aksess muka depan untuk semua artikel dalah kategori tertentu (com_content)");
define('_fua_lang_sections_info',"Aksess muka depan untuk semua artikel dalah seksyen tertentu (com_content)");
define('_fua_lang_reverse_access',"aksess 'reverse'");
define('_fua_lang_reverse_access_info',"Biasanya, jika kotak bertanda, kumpulan pengguna akan mendapat aksess. Namun, apabila aksess 'reverse' diaktifkan, aksess akan ditutup pada kotak yang bertanda dan sebaliknya");
define('_fua_lang_components_info',"Aksess komponen pada muka depan");
define('_fua_lang_reverse_access_warning',"Aksess 'reverse' telah diaktifkan");
define('_fua_lang_usergroup_has_no_access',"kumpulan pengguna TIDAK mempunya aksess");
define('_fua_lang_usergroup_has_access',"kumpulan pengguna mempunya aksess");
define('_fua_lang_message_type_none',"teks isi kandungan diganti dengan");
define('_fua_lang_messagetype_items',"jenis mesej yang dipaparkan apabila tiada aksess penuh untuk membaca artikel");
define('_fua_lang_no_access_page',"anda tidak dibenarkan melihat muka ini");
define('_fua_lang_messagetype_category',"jenis mesej yang dipaparkan apabila tiada aksess penuh kepada kategori, sama ada pada 'layout' 'category-blog' atau 'category-list' atau artikel pada pandangan penuh");
define('_fua_lang_messagetype_section',"jenis mesej yang dipaparkan apabila tiada aksess kepada seksyen, 'layout' 'section-blog' atau artikel pada pandangan penuh");
define('_fua_lang_messagetype_archive',"jangan gunakan 'archive' dan 'category-list'!");
define('_fua_lang_messagetype_archive_info',"Maaf, tanpa sebab yang diketahui, bot yang digunakan untuk menghadkan aksess kepada artikel tidak dipanggil pada 'archive' and 'category-list' pada tahap artikel oleh sistem Joomla. Oleh itu, tiada kawalan aksess boleh dikenakan pada 'archive' dan 'category-list-view'. Apabila ditandakan, pengguna akan dibawa pada pandangan penuh artikel, yang mana akan mengaktifkan syarat-syarat kekangan. Maka, masalah hanya timbul pada 'archive-list'. Jalan keluar dari masalah ini adalah dengan menyembunyikan 'intro-text'. Dalam 'menu-manager', terdapat pilihan untuk menyembunyikan 'intro-text' ketika sesebuah artikel dicipta atau diubah, tetapi ia tidak berfungsi (Joomla 1.5.15 11-2009). Jadi, kami tidak menggalakkan anda membuat kawalan kekangan terhadap 'archive' sehingga masalah ini diperbaiki pada versi Joomla terbaru.");
define('_fua_lang_not_superadmin',"Ditunjukkan adalah semua pengguna kecuali 'super administrators'");
define('_fua_lang_backend',"aksess belakang");
define('_fua_lang_frontend',"aksess depan");
define('_fua_lang_module_access',"aksess modul");
define('_fua_lang_use_moduleaccess',"aktifkan syarat aksess modul");
define('_fua_lang_modules_message_type',"paparkan jika tiada aksess terhadap modul");
define('_fua_lang_hide_module',"sorokkan modul");
define('_fua_lang_modules_message_type_text',"paparkan mesej ini pada modul");
define('_fua_lang_no_access_module',"anda tidak dibenarkan melihat modul ini");
define('_fua_lang_modules_info',"Aksess muka depan modul. Setiap modul Frontend-User-Access boleh memanggil modul yang lain. Anda boleh masukkan id modul yang ingin dipanggil didalam 'module manager'. Anda hanya boleh mengkonfigurasi kebenaran aksess terhadap modul-modul Frontend-User-Access sahaja, yang akan berfungsi sebagai 'wrapper' aksess pengguna");
define('_fua_lang_no_modules_active',"syarat aksess modul tidak aktif");
define('_fua_lang_module_loading_module',"fua-modul memanggil modul");
define('_fua_lang_no_module_assigned',"tiada id modul yang betul telah dimasukkan");
define('_fua_lang_module_access_saved',"syarat aksess modul telah disimpan");
define('_fua_lang_instructions',"tatacara");
define('_fua_lang_opens_in_popup',"buka dalam 'popup'");
define('_fua_lang_display_articles',"paparan apabila tiada aksess terhadap artikel");
define('_fua_lang_hide_article',"sorokkan artikel");
define('_fua_lang_display_other',"paparan apabila tiada aksess terhadap artikel pada 'layout' yang lain");
define('_fua_lang_see_article_access',"lihat pilihan ");
define('_fua_lang_on_tab',"pada tab");
define('_fua_lang_items_hide_info',"Untuk menyorokkan artikel sepenuhnya, Frontend-User-Access perlu mengetahui nama kelas CSS yang digunapakai pada 'template' anda. Jika anda menggunakan 'template' asal yang diberikan oleh Joomla, sila klik butan 'template' dibawah.");
define('_fua_lang_items_hide_info2',"Jika ada menggunakan 'template' yang lain, sila periksa kod dan masukkan nama kelas di sini. Pada laman anda, sila oergi ke sebuah muka yang menunjukkan sekurang-kurangnya satu artikel dan periksa kod HTMLnya. Sila masukkan nama kelas CSS di dalam ruang yang disediakan.");
define('_fua_lang_hide_wrapper_content',"elemen dan nama 'wrapper' kelas terhadap isi kandungan atau 'wrapper' artikel. contoh:");
define('_fua_lang_hide_wrappers_up',"elemen dan nama kelas 'wrapper' atas kepada wrapper kandungan<br />Selalunya adalah samaada 'wrapper' untuk tajuk artikel atau 'wrapper' untuk butang. Jika tiada, sila tinggalkan ruang kosong. Jika terdapat lebih banyak, susun ia bermula dengan 'wrapper' isi kandungan. contoh:");
define('_fua_lang_hide_wrappers_down',"elemen dan nama kelas 'wrapper' adik beradik dibawah 'wrapper' isi kandungan<br />Selalunya adalah 'wrapper' untuk pemisah artikel. Jika tiada, tinggalkan ruang kosong. Jika lebih banyak, susun mereka bermula dengan 'wrapper' isi kandungan. contoh:");
define('_fua_lang_filter',"tapis");
define('_fua_lang_go',"pergi");
define('_fua_lang_reset',"reset");
define('_fua_lang_all',"semua");
define('_fua_lang_joomla10_only',"Konfigurasi menyorokkan artikel ini hanya untuk Joomla 1.0");
define('_fua_lang_not_in_free_version',"Syarat-syarat aksess ini tidak boleh digunakan dalam versi percuma. Anda boleh gunakan hanya pada versi percubaan atau dapatkan versi pro");
define('_fua_lang_default_usergroup',"kumpulan pengguna asal");
define('_fua_lang_default_usergroup_info',"kumpulan pengguna asal untuk pengguna baru. Boleh digunakan bersama pengurusan pengguna Joomla, aksess depan Joomla, Community Builder dan banyak lagi.");
define('_fua_lang_none',"tiada");
define('_fua_lang_not_in_free',"Tiada dalam versi percuma. Dapatkan versi percubaan atau beli versi pro.");
################
//added 2.1.0
define('_fua_lang_menu_access',"aksess menu/muka");
define('_fua_lang_use_menu_access',"aktifkan syarat aksess menu/muka");
define('_fua_lang_menu_info',"Jika pengguna tidak mempunyai aksess ke sesebuah 'menu-item', 'menu-item' tersebut akan tersorok pada modul menu Frontend-User-Access dan pengguna tersebut tidak mempunyai aksess ke muka yang terpaut dengan 'menu-item'. Kekangan pada muka hanya boleh berfungsi apabila 'Itemid' dimasukkan sekali dalam URL (atau dalam URL SEF). Jadi, kekangan tidak berfungsi jika 'Itemid' diambil dari URL. Maka, anda dinasihatkan untuk menggunakan 'search-engine-friendly urls', supaya pengguna tidak dapat mengubah URL.");
define('_fua_lang_no_active_menu',"Syarat aksess 'menu-items'/muka tidak aktif");
define('_fua_lang_menus',"menu-menu");
define('_fua_lang_menu_access_saved',"aksess menu/muka telah tersimpan");
define('_fua_lang_menuaccess_message_type',"jenis mesej apabila tiada aksess ke 'menu-item'/muka");
define('_fua_lang_menuaccess_message_type_text',"hanya teks ini");
define('_fua_lang_menuaccess_message_type_text2',"dengan pautan kembali ke muka sebelumnya");
define('_fua_lang_cache',"cache Joomla");
define('_fua_lang_cache_info',"Cache Joomla perlu dinyahaktifkan untuk kekangan isi kandungan(artikel, kategori, seksyen).");
define('_fua_lang_cache_info2',"Anda boleh mengkonfigurasikan ini dalam");
define('_fua_lang_global_config',"konfigurasi global");
define('_fua_lang_cache_info3',"pada tab 'Sistem'");
define('_fua_lang_is_enabled',"aktif");
define('_fua_lang_is_not_enabled',"tidak aktif");
define('_fua_lang_redirect_after_login',"URL halaan selepas 'login' pada muka depan");
define('_fua_lang_example',"contoh");
define('_fua_lang_redirect_after_login_info',"URL halaan selepas 'login' pada muka depan laman ini bagi pengguna yang tidak ditetapkan pada mana-mana kumpulan pengguna Frontend-User-Access. Untuk menghalakan pengguna-pengguna yang telah ditetapkan kumpulan pengguna, sila masukkan URL di dalam pengurusan kumpulan pengguna 'Frontend-User-Access'");
?>