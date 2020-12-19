<?php
/**
* @package Frontend-User-Access (com_frontend_user_access)
* @version 1.0.3
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license commercial license 
* @author http://www.joomlapi.com
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
<h1>تعليمات لوضع اعدادات صلاحيات وصول الموديل</h1>
<ul>
	<li><a href="#add">إضف الموديل إلى موديل Frontend-User-Access</a></li>
	<li><a href="#copy">جاري نسخ موديل Frontend-User-Access</a></li>
	<li><a href="#set">وضع صلاحيات الوصول غلي الموديل</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#أعلى">top</a>إضف الموديل إلى موديل Frontend-User-Access</h2>
<p>لوضع صلاحيات وصول إلى موديل ، الموديل يجب تحميل ضمن موديلFrontend-User-Access (للأسف جملة لا تقدم  اي تحكم لوضع صلاحيات وصول للموديلات مباشرة). فإن موديل Frontend-User-Access سوف يعمل ك user-access wrapper ، يسمح للموديل ان يكون مخفي عند عدم وجود صلاحيات وصول للمستخدم. لذا عليك تهيئة موديل Frontend-User-Access لتحميل الموديل الذي تريد وضع صلاحيات الوصول علية. </p>
<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'امتدادات' &gt; 'مدير الموديل'";
	}else{
		//joomla 1.0.x
		echo "'موديلات' &gt; 'موديلات الموقع'";
	}

	?></li>
	<li>ابحث عن الموديل الذي ترغب في وضع صلاحيات وصول له في القائمة.لاحظ رقم هويتة 'هوية'.</li>
	<li>فتح موديل Frontend-User-Access<br>
		إذا  كنت قد قمت بتركيب الموديل ، اسم الموديل 'Frontend-User-Access'. إذا قمت بتغيير او نسخ اسم الموديل  انظر في العمود 'نوع'  علي'mod_frontend_user_access'. اضغط على عنوان الموديل.</li>
	<li>عدل العنوان لاسم معقول. أفضل استخدم عنوان الموديل الذي سوف تضع لة صلاحيات وصول. </li>
	<li>Set 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'مفعلة:'";
	}else{
		//joomla 1.0.x
		echo "'منشور:'";
	}

	?> to 'Yes'.</li>
	<li>اختار مكان الموديل. إذا كنت جديدا على هذا اختار 'اليسار'.</li>	
	<li>تحت 'بارامترات الموديل 'في 'تحميل هوية الموديل' ادخل رقم معرف الهوية الذي كتبتة في الخطوة رقم 2. </li>	
	<li>اضغط 'حفظ'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "غير مفعلة";
	}else{
		//joomla 1.0.x
		echo "غير منشور";
	}

	?> الموديل الذي تم تحميله الآن في موديل Frontend-User-Access  فقط للتأكد من أنها لا تظهر في أي مكان إلا داخل موديل Frontend-User-Access. </li>
	<li>إخفاء عنوان الموديل المضمن.
	</li>
</ol>


<p>موديل Frontend-User-Acces يمكنة تحميل موديل واحد  فقط.ولذلك عليك تقديم نسخة من Frontend-User-Access  لكل موديل ترغب في وضع صلاحيات وصول إلية.اذا كنت بحاجة الى مزيد من موديل Frontend-User-Access  ، اذهب إلى 'مدير الموديلات'وانسخ اي موديل يخص Frontend-User-Access كيف هنا. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>نسخ موديل Frontend-User-Access</h2>

<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'امتدادات' &gt; 'مدير الموديلات'";
	}else{
		//joomla 1.0.x
		echo "'الموديلات' &gt; 'موديلات الموقع'";
	}

	?></li>
	<li>ابحث عن موديل Frontend-User-Access .ثم انظر في العمود 'نوع'علي 'mod_frontend_user_access'. </li>
	<li>حدد الموديل عن طريق اختيار المربع المقابل لاسم الموديل. </li>
	<li>اضغط في أعلى اليمين على شريط الأدوات 'نسخ'.<br>
	تم  الآن نسخ الموديل. وسيكون عنوان 'نسخة من' يليه اسم الموديل القديم.</li>
	<li>اضغط على اسم الموديل الذي تم نسخة.  </li>
		<li>Set 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'مفعلة:'";
	}else{
		//joomla 1.0.x
		echo "'منشور:'";
	}

	?> to 'Yes'.</li>
	<li>اختار مكان الموديل. إذا كنت جديدا على هذا اختار 'اليسار'. <br>
	</li>	
	<li>تحت 'بارامترات الموديل 'في 'تحميل هوية الموديل' ادخل رقم معرف الهوية الذي تريد تضمينة. </li>	
	<li>اضغط 'حفظ'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>وضع صلاحيات وصول على الموديلات</h2>

<ol>
	<li>ذهب الي 'التطبيقات' &gt; 'Frontend-User-Access'.</li>
	<li>اضغط 'وصول الموديل'. <br>
	</li>
	<li>حدد صلاحيات وصول لكل موديل  ، ولكل مجموعات المستخدمين. </li>
	<li>اضغط 'حفظ'.</li>
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