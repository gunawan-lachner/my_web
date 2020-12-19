<?php
/**
* @package Acceso de Usuarios del Frontend (com_frontend_user_access)
* @version 1.0.3
* @copyright Copyright (C) 2008 Carsten Engel. All rights reserved.
* @license commercial license 
* @author http://www.pages-and-art&iacute;culos.com
* @joomla Joomla is Free Software
*/

//acceso indirecto
if(!defined('_VALID_MOS') && !defined('_JEXEC')){
	die('Acceso Restringido');
}

?>
<style type="text/css">
h2 a{
	margin-right: 20px;
	font-size: 0.8em;
}
</style>
<a name="top"></a>
<h1>Instrucciones para la configuraci&oacute;n de restricciones de acceso en los m&oacute;dulos</h1>
<ul>
	<li><a href="#add">a&ntilde;adir m&oacute;dulo al m&oacute;dulo Frontend-User-Access</a></li>
	<li><a href="#copy">copiar el m&oacute;dulo Frontend-User-Access</a></li>
	<li><a href="#set">establecer restricciones de acceso para m&oacute;dulos</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>A&ntilde;adir m&oacute;dulo al m&oacute;dulo Frontend-User-Access</h2>
<p>Para restringir el acceso al m&oacute;dulo, &eacute;ste necesita ser cargado dentro del m&oacute;dulo Frontend-User-Access (desafortunadamente Joomla no provee directamente de eventos manejadores para restringir el acceso a m&oacute;dulos). El m&oacute;dulo Frontend-User-Access trabajar&aacute; como una envoltura del acceso de usuario, permitiendo al m&oacute;dulo permanecer oculto cuando el usuario no tenga acceso. Pero tu debes configurar el m&oacute;dulo Frontend-User-Access si se quiere restringir el acceso al m&oacute;dulo cargado.</p>
<ol>
	<li>Ir a
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensiones' &gt; 'Administrador de M&oacute;dulos'";
	}else{
		//joomla 1.0.x
		echo "'M&oacute;dulos' &gt; 'M&oacute;dulos del Site'";
	}

	?>
     </li>
	<li>Encontrar el m&oacute;dulo en la lista, al cual se quiere restringir el acceso. Tomar nota del id en la columna 'ID'.</li>
<li>Abrir el m&oacute;dulo Frontend-User-Access.<br>
		Si acabas de instalar el m&oacute;dulo, &eacute;ste se llama  'Frontend-User-Access'. Si has cambiado el nombre o has realizado un copia del m&oacute;dulo, mira en la columna 'tipo' para buscar 'mod_frontend_user_access'. Haz click en el t&iacute;tulo del m&oacute;dulo .</li>
	<li>Edite el t&iacute;tulo y escriba otra referencia. Es la mejor manera de referenciar el m&oacute;dulo al cual le va a restringir el acceso.</li>
  <li>Ponga 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Habilitado:'";
	}else{
		//joomla 1.0.x
		echo "'Publicado:'";
	}

	?> en 'Si'.</li>
	<li>Seleccione la posici&oacute;n para el m&oacute;dulo. Si es uno nuevo seleccione la opci&oacute;n 'izquierda'.</li>	
  <li>Bajo la opci&oacute;n  'par&aacute;metros de m&oacute;dulo' en 'cargar m&oacute;dulo id' introduzca el id que anot&oacute; en el paso 2. </li>	
  <li>Haga click en 'salvar'.</li>
  <li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Deshabilitar";
	}else{
		//joomla 1.0.x
		echo "No publicar";
	}

	?>
   el m&oacute;dulo que ahora va a ser cargado en el m&oacute;dulo Frontend-User-Access, cercior&aacute;ndose de que no va a ser mostrado en ning&uacute;n otro sitio que no sea dentro del m&oacute;dulo Frontend-User-Access.</li>
  <li>Oculte el t&iacute;tulo en el m&oacute;dulo que hemos seleccionado.	</li>
</ol>


<p>El m&oacute;dulo Frontend-User-Access&nbsp; s&oacute;lo puede cargar un s&oacute;lo m&oacute;dulo. Para poder restringir el acceso a diferentes m&oacute;dulos deber&aacute; hacer una copia del m&oacute;dulo Frontend-User-Access, para cada uno de ellos. Si necesita m&aacute;s m&oacute;dulos Frontend-User-Access, deber&aacute; ir al 'Administrador de Módulos' y copiar el m&oacute;dulo Frontend-User-Access. As&iacute; es como se hace.</p>

<a name="copy"></a>
<h2><a href="#top">top</a>Copiar el m&oacute;dulo Frontend-User-Access</h2>

<ol>
	<li>Ir a
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensiones' &gt; 'Administrador de M&oacute;dulos'";
	}else{
		//joomla 1.0.x
		echo "'M&oacute;dulos' &gt; 'M&oacute;dulos del Site'";
	}

	?></li>
	<li>Encuentre el módulo Frontend-User-Access. Mire en la columna 'tipo' y busque 'mod_frontend_user_access'. </li>
	<li>Seleccione el m&oacute;dulo, seleccionando la caja situado al lado del nombre del m&oacute;dulo. </li>
 <li>Haga click en 'copiar', en la barra superior derecha.<br>
	El m&oacute;dulo ha sido copiado. El t&iacute;tulo ser&aacute;  'Copia de ' seguido del nombre antiguo del m&oacute;dulo.</li>
	<li>Haga click en nombre del m&oacute;dulo copiado.  </li>
  <li>Ponga  
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Habilitado:'";
	}else{
		//joomla 1.0.x
		echo "'Publicado:'";
	}

	?> en 'Si'.</li>
	<li>Seleccione la posici&oacute;n para el m&oacute;dulo. Si es uno nuevo seleccione la opci&oacute;n  'izquierda'. <br>
	</li>	
	<li>Bajo la opci&oacute;n 'par&aacute;metros del m&oacute;dulo' en 'cargar m&oacute;dulo id' introduzca el id del m&oacute;dulo que quiere incluir.</li>	
	<li>Haga click en 'save'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Establecer restricciones de acceso para m&oacute;dulos</h2>

<ol>
	<li>Ir a 'Componentes' &gt; 'Frontend-User-Access'.</li>
	<li>Hacer click en 'acceso a m&oacute;dulos'. <br>
	</li>
	<li>Establecer permisos o restricciones para cada m&oacute;dulo y para cada grupo de usuarios.</li>
  <li>Hacer click en 'salvar'.</li>
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