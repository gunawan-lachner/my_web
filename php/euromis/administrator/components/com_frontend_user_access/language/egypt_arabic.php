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

define('_fua_lang_usergroups',"مجموعات المستخدمين");
define('_fua_lang_users',"المستخدمين");
define('_fua_lang_user',"المستخدم");
define('_fua_lang_component_access',"تصريح دخول التطبيق");
define('_fua_lang_new',"جديد");
define('_fua_lang_delete',"حذف");
define('_fua_lang_save',"حفظ");
define('_fua_lang_apply',"حفظ ومشاهدة");
define('_fua_lang_cancel',"الغاء");
define('_fua_lang_usergroup_saved',"تم حفظ مجموعة المستخدمين");
define('_fua_lang_select_item_to_delete',"اختر عنصر للحذف");
define('_fua_lang_usergroup_deleted',"تم مسح مجموعة المستخدمين");
define('_fua_lang_component_access_saved',"تم حفظ التصاريح للتطبيق");
define('_fua_lang_userssaved',"تم حفظ المستخدم/المستخدمين");
define('_fua_lang_please_select_user',"من فضلك اختر مستخدم");
define('_fua_lang_user_saved',"تم حفظ المستخدم");
define('_fua_lang_user_edit',"تعديل المستخدم");
define('_fua_lang_name',"الأسم");
define('_fua_lang_password',"الباسورد");
define('_fua_lang_usergroup',"مجموعة المستخدمين");
define('_fua_lang_new_user',"مستخدم جديد");
define('_fua_lang_usergroup_edit',"تعديل مجموعة المستخدمين");
define('_fua_lang_name_usergroup',"اسم مجموعة المستخدمين");
define('_fua_lang_usergroup_new',"مجموعة مستخدمين جديدة");
define('_fua_lang_no_access_component',"غير مسموح لك بالدخول لهذا التطبيق");
define('_fua_lang_sureuserdelete',"هل انت متأكد من مسح هذا المستخدم؟");
define('_fua_lang_nonameentered',"يجب ادخال الاسم");
define('_fua_lang_nousergroupselected',"يجب اختيار مجموعة مستخدمين");
define('_fua_lang_suredeleteusergroup',"هل انت متأكد من مسح مجموعة/مجموعات المستحدمين؟");
define('_fua_lang_noselectusergroups',"انت لم تختر اى مجموعة/مجموعات مستخدمين");
define('_fua_lang_noselectusers',"انت لم تختر اى مستخدم/مستخدمين");
define('_fua_lang_suredeleteusers',"هل انت متأكد من مسح المستخدم/المستخدمين ؟");
define('_fua_lang_nousergroups',"لاتوجد مجموعات مستخدمين محددة");
define('_fua_lang_nousers',"no users where found matching your search.<br /> Make new users with the ");
define('_fua_lang_user_new',"مستخدم جديد");
define('_fua_lang_username',"اسم المستخدم");
define('_fua_lang_configsaved',"تم حفظ التعديلات");
define('_fua_lang_showtab',"اظهر التبويب");
define('_fua_lang_general',"الأعدادات الرئيسية");
define('_fua_lang_language',"اللغة");
define('_fua_lang_defaulttab',"التبويب الرئيسي");
define('_fua_lang_useinpiuseraccess',"استخدم فى Frontend-User-Access");
define('_fua_lang_order',"ترتيب");
define('_fua_lang_alias',"الأسم المستعار");
define('_fua_lang_componentname',"اسم التطبيق");
define('_fua_lang_use_componentaccess',"تنشيط التصاريح للتطبيق");
define('_fua_lang_joomlagroup',"مجموعة جوملة");
define('_fua_lang_showjoomlagroup',"عرض مربع الأختيار لمجموعة جوملة");
define('_fua_lang_showjoomlagroup_tip',"عرض مربع الأختيار لمجموعة جوملة عند تعيين او تعديل مستخدم");
define('_fua_lang_disableselectbox',"اعرض مجموعة جوملة فقط");
define('_fua_lang_config',"الأعدادات");
define('_fua_lang_version',"نسخة");
define('_fua_lang_commercial',"رخصة تجارية");
define('_fua_lang_configwriteable',"مسموح بالتعديل فيه");
define('_fua_lang_confignotwriteable',"غير مسموح بالتعديل فيه");
define('_fua_lang_activate',"تنشيط التصاريح");
define('_fua_lang_tabs',"تبويبات");
define('_fua_lang_selectall',"[اختيار الكل]");
define('_fua_lang_validkey',"رخصة البرنامج");
define('_fua_lang_enterkey',"ادخل كود الرخصة");
define('_fua_lang_keyisentered',"تم ادخال الكود");
define('_fua_lang_keynotvalid',"الكود غير صحيح");
define('_fua_lang_validkey_tip',"يمكنك استخدام هذا التطبيق على local host للتجريب والتطوير لمدة غير محدودة . هذا التطبيق محدود لأسابيع معدودة للتطوير والتجارب online . اذا كنت تريد المزيد من الوقت للتجريب ، فيمكنك تحميل نسخة جديدة من التطبيق وملحقاته واعادة تنصيبهم . لا احتياج لأدخال بيانات مجموعات المستخدمين مرة اخرى ، سيكونون محفوظون فى قاعدة البيانات . لو كنت محتفظ بنسخة احتياطية من الأعدادات فأنك غير محتاج لأعادة الأعدادات ل Frontend-User-Access  ");
define('_fua_lang_nocomponentactive',"التصاريح للتطبيقات غير منشطة");
define('_fua_lang_on',"مفعل");
define('_fua_lang_off',"غير مفعل");
define('_fua_lang_top',"اعلى");
define('_fua_lang_statusbot',"الحالة للملحق البرمجى");
define('_fua_lang_botinstalled',"الملحق البرمجى منصب");
define('_fua_lang_botnotinstalled',"الملحق البرمجى غير منصب");
define('_fua_lang_botpublished',"الملحق البرمجى منشور");
define('_fua_lang_botnotpublished',"الملحق البرمجى غير منشور");
define('_fua_lang_not_published',"غير منشور");
define('_fua_lang_version_check',"التأكد من النسخة");
define('_fua_lang_email',"الأيميل");
define('_fua_lang_description',"الوصف");	 
define('_fua_lang_loggedin',"على الموقع حاليا");	
define('_fua_lang_loggedin_description',"كل المستخدمين الذين على الموقع حاليا الغير منتسبين لأى مجموعات");	
define('_fua_lang_not_loggedin',"غير موجود على الموقع حاليا");
define('_fua_lang_not_loggedin_description',"كل المستخدمين الغير متواجدين على الموقع حاليا");
define('_fua_lang_components_message_type',"نوع الرسالة في حالة عدم الوصول إلى التطبيق");
define('_fua_lang_components_message_type_alert',"أنذار جافا سكريبت الذي يربط العودة إلى الصفحة السابقة");
define('_fua_lang_components_message_type_inline_text',"النص المحول");
define('_fua_lang_item_access',"الوصول للمقالة");
define('_fua_lang_items_activate',"تفعيل تصاريح الوصول للعنصر");
define('_fua_lang_no_active_items',"تصاريح الوصول للعنصر غير مفعله");
//define('_fua_lang_item_message_type',"نوع الرسالة عندما لا توجد صلاحيات للمستخدم للوصول الي المقالة");
define('_fua_lang_item_access_saved',"تم حفظ تصاريح الوصول للمقاله");
define('_fua_lang_category_access',"الوصول للقسم فرعى");
define('_fua_lang_activatecategories',"تفعيل تصاريح الوصول للقسم الفرعي");
define('_fua_lang_no_categories_active',"تصاريح الوصول للقسم الفرعي غير مفعلة");
define('_fua_lang_category_access_saved',"تم حفظ تصاريح الوصول للقسم الفرعي");
define('_fua_lang_section_access',"الوصول للقسم");
define('_fua_lang_sections_active',"تفعيل تصاريح الوصول للقسم");
define('_fua_lang_no_sections_active',"تصاريح الوصول للقسم غير مفعلة");
define('_fua_lang_section_access_saved',"تم حفظ تصاريح الوصول للقسم");
define('_fua_lang_activate_in_config',".يمكنك تفعيل هذا في الصفحة الاعدادات");
define('_fua_lang_show_tab',"اظهار التبويبات");
define('_fua_lang_url_access',"رابط الوصول");
define('_fua_lang_url_active',"تفعيل تصاريح رابط الوصول");
define('_fua_lang_no_url_active',"تصاريح رابط الوصول غير مفعلة");
define('_fua_lang_url_access_saved',"تم حفظ تصاريح رابط الوصول");
define('_fua_lang_sure_to_delete_url',"هل أنت متأكد أنك تريد حذف هذه الروابط؟");
define('_fua_lang_no_urls_selected',"لم يتم اختيار رابط للحذف");
define('_fua_lang_url_deleted',"تم حذف الروابط");
define('_fua_lang_url_new',"رابط جديد");
define('_fua_lang_new_urls_saved',"تم حفظ الروابط الجديده");
define('_fua_lang_url_new_info',"فقط أدخل ما بعد تسمية الموقع.مثال 'index.php?option=com_content&view=category&layout=blog&id=36&Itemid=55'او عند استخدام  SEF-URL's 'index.php/lucid-dreams'");
define('_fua_lang_url_message_type',"نوع الرسالة عندما لا يستطيعون الحصول على رابط");
define('_fua_lang_demo_days_left',"هذه هي النسخة التجريبية. الأيام المتبقية");
define('_fua_lang_demo_days_left_tip',"إذا كنت تحتاج إلى مزيد من الوقت للتطوير أو اختبار هذا التطبيق على الإنترنت بلا رخصة سليمة، فقط قم بتحميل نسخة تجريبيه جديدة ، وأعد تثبيت التطبيق ،كل من الملحق البرمجي والموديل Frontend-User-Access.ليس عليك ادخال صلاحيات المجموعات من جديد.إذا أخذت نسخة احتياطية لملف الاعدادات،ليس عليك إلى إعادة التهيئة.");
define('_fua_lang_items_info',"الوصول لمقالات محدة من خلال الواجهة الامامية (com_content).ستظهر هذة الرساله في محتوي المقالة اذا كان المستخدم ليس لديه صلاحيات الوصول");
define('_fua_lang_no_access_item',"ليس لديك الصلاحية لمشاهدة هذه المقالة");
define('_fua_lang_items_info2',"يمكنك تغيير هذه الرسالة في ملف اللغة");
define('_fua_lang_categories_info',"الوصول لكل المقالات بأقسام فرعية محددة من خلال الواجهة الامامية (com_content)");
define('_fua_lang_sections_info',"الوصول لكل المقالات بأقسام رئيسية محددة من خلال الواجهة الامامية (com_content)");
define('_fua_lang_reverse_access',"تغيير الوصول");
define('_fua_lang_reverse_access_info',"عادة ، عند اختيار مربع،مجموعات المستخدمين لها حق الوصول.عند  تنشيط عكس ذلك ، تصبح المربعات المختارة صلاحيات والغير مختاره تستطيع الوصول");
define('_fua_lang_components_info',"تطبيق وصول الواجهة الامامية");
define('_fua_lang_reverse_access_warning',"تغيير الوصول نشط");
define('_fua_lang_usergroup_has_no_access',"لا يوجد صلاحيات لمجموعات المستخدمين");
define('_fua_lang_usergroup_has_access',"يوجد صلاحيات لمجموعات المستخدمين");
define('_fua_lang_message_type_none',"تم تبديل محتوي النص بواسطة");
define('_fua_lang_messagetype_items',"نوع الرسالة عندما لا توجد صلاحيات الوصول للمقالة في الوضع الكامل");
define('_fua_lang_no_access_page',"ليس لديك الصلاحية لمشاهدة هذه الصفحة");
define('_fua_lang_messagetype_category',"نوع الرسالة في حالة عدم الوصول إلى القسم الفرعي او بلوج القسم الفرعي  أو فئة قائمة نسق أو المقالة على الوضع الكامل");
define('_fua_lang_messagetype_section',"نوع الرسالة في حالة عدم الوصول إلى القسم او بلوج القسم أو فئة قائمة نسق أو المقالة على الوضع الكامل");
define('_fua_lang_messagetype_archive',"لا تستخدم الارشيف  and category-list!");
define('_fua_lang_messagetype_archive_info',"نأسف‘لأسباب غير معلومة لايمكن الوصول للروبوت الخاص بصلاحيات الوصول للمقالات في الارشيف الخاص بمستوي المقالة في  نظام جومله.لذلك لايمكن فرض صلاحيات للمقالات بالارشيف.عند الضغط علي مقالة‘سيؤخذ  المستخدم للوضع الكامل لاظهار  المقالة والذي فيه تعمل صلاحيات المقالة.لذلك المشكلة محصوره في قائمة الارشيف.أخفاء نص المقدمة ممكن ان يكون بديل جيد.في  مدير القوائم‘عند أنشاء أو تعديل ارشيف قوائم‘هناك خيار لأخفاء نص المقدمة للمقالات‘ولكنه لا يعمل(Joomla 1.5.15 11-2009).لذلك ان كنت تفكر في استخدام صلاحيات المقالة و الارشيف‘ننصحك بقوه الا تقوم بذلك‘حتي يتم  أصلاح ذلك في الاصدارات الجديده لجومله.");
define('_fua_lang_not_superadmin',"جميع المستخدمين باستثناء 'السوبر مديري' معروضة");
define('_fua_lang_backend',"الخلفية");
define('_fua_lang_frontend',"الواجهة الامامية");
define('_fua_lang_module_access',"الوصول للموديل");
define('_fua_lang_use_moduleaccess',"تفعيل صلاحيات الوصول للموديل");
define('_fua_lang_modules_message_type',"العرض في حال عدم الوصول إلى الموديل");
define('_fua_lang_hide_module',"أخفاء الموديل");
define('_fua_lang_modules_message_type_text',"عرض هذه الرسالة في الموديل");
define('_fua_lang_no_access_module',"ليس لديك الصلاحيات لعرض هذا الموديل");
define('_fua_lang_modules_info',"موديل وصول الواجهة الامامية.كل من موديل Frontend-User-Access يمكن تحميل وحدة أخرى. يمكنك إدخال رقم الهوية التي ينبغي تحميلها في موديل المدير. يمكنك تعيين حق الوصول إلى موديل Frontend-User-Access التي ستقوم في ما بعد العمل كuser-access wrapper للموديل المحوي بداخلها");
define('_fua_lang_no_modules_active',"صلاحيات الوصول للموديل غير مفعلة");
define('_fua_lang_module_loading_module',"fua-module جاري تحميل الموديل");
define('_fua_lang_no_module_assigned',"لم يتم ادخال رقم هوية صحيح");
define('_fua_lang_module_access_saved',"تم حفظ صلاحيات الوصول للموديل");
define('_fua_lang_instructions',"تعليمات");
define('_fua_lang_opens_in_popup',"popup فتح في");
define('_fua_lang_display_articles',"العرض في حال عدم وجود صلاحيات الوصول للمقالة");
define('_fua_lang_hide_article',"إخفاء المقالة");
define('_fua_lang_display_other',"العرض في حال عدم وجود صلاحيات وصول لمقالة على أي مادة أخرى في التصميم");
define('_fua_lang_see_article_access',"انظر الخيار ");
define('_fua_lang_on_tab',"على علامة التبويب");
define('_fua_lang_items_hide_info',"لإخفاء المقالة تماما ، Frontend-User-Access يحتاج إلى معرفة أCSS class-names المستخدمة في القالب. إذا كنت تستخدم تغيير القوالب الافتراضية المنصوص عليها في Joomla destribution ، فقط اضغط على زر نموذج - تحت.
");
define('_fua_lang_items_hide_info2',"ذا كنت تستخدم أي قالب اخر، تحتاج إلى مراجعة الشفرة وأدخال اسم الطبقة هنا . على موقع الويب الخاص بك ، انتقل إلى الصفحة التي تظهر واحدة أو أكثر من المقالات وأفحص نتاجHTML.أدخل CSS classnames في الحفول المتاحة");
define('_fua_lang_hide_wrapper_content',"غلاف العنصر واسم الطبقةللمحتوي أو المقالة.مثال:");
define('_fua_lang_hide_wrappers_up',"لعنصر واسم الطبقة مغلفين فوق المحتوي المغلف<br /> غالبا التغليف لعنوان المقالة أو للأزرار.أذا لم يوجد‘اتركها فارغة.وأذا كان هناك الكثير‘رتبها بداية من المحتوي المغلف.مثال:");
define('_fua_lang_hide_wrappers_down',"العنصر واسم الطبقة مغلفين تحت المحتوي المغلف<br /> في أحيان لفصل المقالة.أذا لم يوجد‘اتركها فارغة.وأذا كان هناك الكثير‘رتبها بداية من المحتوي المغلف.مثال:");


define('_fua_lang_filter',"فلتر");
define('_fua_lang_go',"يذهب");
define('_fua_lang_reset',"إستعادة");
define('_fua_lang_all',"all");
define('_fua_lang_joomla10_only',"This hide-article configuration is only for Joomla 1.0");
define('_fua_lang_not_in_free_version',"These restrictions can not be used in this free-version. Try the trial-version or buy the pro-version");
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