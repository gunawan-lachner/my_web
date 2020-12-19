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
<h1>Arahan untuk mengkonfigurasi kekangan aksess pada modul</h1>
<ul>
	<li><a href="#add">masukkan modul ke Frontend-User-Access</a></li>
	<li><a href="#copy">salin satu modul Frontend-User-Access</a></li>
	<li><a href="#set">konfigurasi kekangan aksess untuk modul</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">kembali ke atas</a>Tambah modul ke Frontend-User-Access</h2>
<p>Untuk mengekang aksess ke sesebuah modul, modul itu perlu dipanggil oleh modul Frontend-User-Access (kerana Joomla tidak memberikan sebarang kemudahan 'event-handlers' untuk mengawal aksess kepada modul). Frontend-User-Access modul akan berjalan sebagai 'wrapper' untuk aksess pengguna, membolehkan modul di sorok apabila pengguna tiada aksess. Jadi, anda perlu mengkonfigurasi sebuah modul Frontend-User-Access supaya ia memanggil modul yang anda ingin kawal hak aksess. </p>
<ol>
	<li>pergi ke <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
	<li>Cari modul yang anda ingin perketatka aksess didalam senarai. Dapatkan id didalam kolum 'ID'.</li>
	<li>Buka satu modul Frontend-User-Access.<br>
  Jika anda baru sahaja memasang modul ini, ia akan dinamakan dengan nama modul 'Frontend-User-Access'. Jika anda menukar nama atau baru sahaja membuat salinan terhadap modul ini, sila lihat dalam kolum 'type' dan cari 'mod_frontend_user_access'. Klik pada tajuk modul.</li>
	<li>Ubah kepada sesuatu yang difahami. Lebih baik untuk memasukkan sekali nama modul yang ingin dikawal ke dalam modul ini agar memudahkan pengurusan.</li>
	<li>Setkan 
  <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> kepada 'Yes'.</li>
	<li>Pilih posisi untuk modul. Jika anda tidak pasti, sila pilih 'left'.</li>	
	<li>Pada 'module parameters' pada 'load module id' masukkan id yang anda jumpai pada langkah 2.</li>	
	<li>Klik 'save'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Disable";
	}else{
		//joomla 1.0.x
		echo "Unpublish";
	}

	?>
     modul yang dipanggil oleh modul Frontend-User-Access, pastikan ia tidak keluar pada lokasi lain kecuali didalam modul Frontend-User-Access. </li>
  <li>Sorokkan tajuk pada modul yang dipanggil.
	</li>
</ol>


<p>Sesebuah modul Frontend-User-Acces hanya boleh memanggil satu modul sahaja. Jadi, jika anda ingin membuat kekangan pada modul lain, sila buat salinan modul Frontend-User-Access terlebih dahulu. Jika anda perlu lebih modul Frontend-User-Access sila pergi ke 'Module Manager' dan salin mana-mana modul Frontend-User-Access. Begini caranya. </p>

<a name="copy"></a>
<h2><a href="#top">kembali ke atas</a>Menyalin modul Frontend-User-Access</h2>

<ol>
	<li>Pergi ke 
    <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensions' &gt; 'Module Manager'";
	}else{
		//joomla 1.0.x
		echo "'Modules' &gt; 'Site Modules'";
	}

	?></li>
  <li>Cari sebuah modul Frontend-User-Access. Lihat dalam kolum 'type' dan cari 'mod_frontend_user_access'. </li>
  <li>Pilih modul dengan menandakan kotak disebelah namanya. </li>
  <li>Klik butang 'copy' yang berada di 'toolbar' atas kanan.<br>
	Modul ini telah disalinkan. Tajuknya akan menjadi 'Copy of' diikuti nama asal.</li>
  <li>Klik pada nama modul yang telah disalin.  </li>
  <li>Setkan 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Enabled:'";
	}else{
		//joomla 1.0.x
		echo "'Published:'";
	}

	?> kepada 'Yes'.</li>
	<li>Pilih posisi untuk modul. Jika anda tidak pasti, sila pilih 'left'. <br>
	</li>	
  <li>Pada 'module parameters' dibawah 'load module id' masukkan id kepada modul yang anda ingin panggil. </li>	
  <li>Click 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">kembali ke atas</a>Cara menentukan syarat aksess untuk modul</h2>

<ol>
	<li>Pergi ke  'Components' &gt; 'Frontend-User-Access'.</li>
	<li>Klik 'module access'. <br>
	</li>
	<li>Setkan kebenaran atau syarat aksess untuk setiap modul untuk setiap kumpulan pengguna. </li>
  <li>Klik  'save'.</li>
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