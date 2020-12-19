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
<h1>رهنمودها جهت تنظیم محدودیت های دسترسی برای ماژول</h1>
<ul>
	<li><a href="#add">افزودن ماژول به ماژول Frontend-User-Access</a></li>
	<li><a href="#copy">کپی نمودن یک ماژول Frontend-User-Access</a></li>
	<li><a href="#set">تنظیم محدودیت های دسترسی برای ماژول ها</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>افزودن ماژول به ماژول Frontend-User-Access</h2>
<p>جهت محدود نمودن دسترسی به یک ماژول ، ماژول باید در یک ماژول  Frontend-User-Access بارگذاری شود  (متاسفانه جوملا هیچ گرداننده ی رویداد برای محدود نمودن مستقیم دسترسی به ماژول ها را ندارد ). ماژول Frontend-User-Access به عنوان یک لفافا دسترسی کاربر عمل می کند ، و اجازه می دهد تا ماژول هنگامی که کاربر دسترسی ندارد مخفی شود . بنابراین شما باید یک ماژول Frontend-User-Access را تنظیم نمایید بنابراین آن ماژولی را که می خواهید دسترسی به آن را محدود نمایید را بارگذاری می نماید . </p>
<ol>
	<li>بروید به <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'گسترش ها' &gt; 'مدیریت ماژول'";
	}else{
		//joomla 1.0.x
		echo "'ماژول ها' &gt; 'ماژول های سایت'";
	}

	?></li>
	<li>ماژولی  که می خواهید دسترسی به آن را محدود نمایید را در لیست پیدا کنید . شنایه را در ستون  'ID' یادداشت نمایید.</li>
	<li>یک ماژول Frontend-User-Access باز کنید .<br>
		اگر شما ماژول را نصب نموده اید ، نام ماژول هست 'Frontend-User-Access'. اگر شما نام آن را تعییر داده اید و یا از ماژول کپی گرفته اید  ، در ستون 'نوع' بگردید برای 'mod_frontend_user_access'. بر روی عنوان ماژول کلیک نمایید .</li>
	<li>عنوان را به یک مورد قابل تشخیص ویرایش نمایید . بهتر آن است که از عنوان ماژولی که می خواهید دسترسی را به آن محدود نمایید استفاده کنید  </li>
	<li>تنظیم نمایید 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'فعال شده:'";
	}else{
		//joomla 1.0.x
		echo "'انتشار یافته:'";
	}

	?> به 'بلی'.</li>
	<li>یک موقعیت برای ماژول انتخاب نمایید . اگر تازه وارد هستید 'left' را انتخاب نمایید.</li>	
	<li>زیر 'پارامتر های ماژول' در 'بارگذاری شناسه ی ماژول' شناسه ای را که در مرحله ی 2 یادداشت نموده اید را وارد نمایید. </li>	
	<li>'ذخیره' را کلیک نمایید.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "غیر فعال";
	}else{
		//joomla 1.0.x
		echo "عدم انتشار";
	}

	?> ماژول که اکنون در ماژول Frontend-User-Access بارگذاری شده است ، تنها جهت مطمئن شدن از اینکه هیچ جا غیر از داخل ماژول Frontend-User-Access نمایش داده نمی شود . </li>
	<li>عنوان ماژول جاسازی شده را مخفی نمایید .
	</li>
</ol>


<p>یک ماژول Frontend-User-Acces تنها می تواند یک ماژول را بارگذاری نماید . بنابریان برای هر ماژولی که می خواهید دسترسی به آن را محدود نمایید باید یک کپی از ماژول Frontend-User-Access تهیه نمایید . اگر به ماژول های Frontend-User-Access بیشتری نیاز دارید ، بروید به 'مدیریت ماژول' و کپی نمایید هر ماژول Frontend-User-Access . اینجا روش وجود دارد . </p>

<a name="copy"></a>
<h2><a href="#top">بالا</a>کپی نمودن یک ماژول Frontend-User-Access</h2>

<ol>
	<li>بروید به <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'گسترش ها' &gt; 'مدیریت ماژول'";
	}else{
		//joomla 1.0.x
		echo "'ماژول ها' &gt; 'ماژول های سایت'";
	}

	?></li>
	<li>یک ماژول Frontend-User-Access پیدا نمایید . در ستون 'نوع' بنگرید برای  'mod_frontend_user_access'. </li>
	<li>ماژول را با انتخاب جعبه ی کنار نام ماژول انتخاب نمایید . </li>
	<li>در نوار ابزار بالا بر روی 'کپی' کلیک نمایید.<br>
	ماژول اکنون کپی شده است . عنوان خواهد بود 'کپی از ' به همراه نام قدیمی ماژول .</li>
	<li>بر روی نام ماژول کپی شده کلیک نمایید .  </li>
		<li>تنظیم نمایید 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'فعال شده:'";
	}else{
		//joomla 1.0.x
		echo "'انتشار یافته:'";
	}

	?> به 'بلی'.</li>
	<li>یک موقعیت برای ماژول انتخاب نمایید . اگر تازه وارد هستید 'left' را انتخاب نمایید. <br>
	</li>	
	<li>زیر 'پارامتر های ماژول' در 'بارگذاری شناسه ی ماژول' شناسه ی ماژولی را که می خواهید شامل شود را وارد نمایید. </li>	
	<li>بر روی 'ذخیره' کلیک نمایید.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">بالا</a>تنظیم محدودیت های دسترسی برای ماژول</h2>

<ol>
	<li>بروید به 'کامپوننت ها' &gt; 'Frontend-User-Access'.</li>
	<li>کلیک کنید بر روی 'دسترسی ماژول'. <br>
	</li>
	<li>حقوق دسترسی یا محدودیت ها را برای هر ماژول و هر گروه کاربر تنظیم نمایید . </li>
	<li>کلیک کنید بر روی 'ذخیره'.</li>
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