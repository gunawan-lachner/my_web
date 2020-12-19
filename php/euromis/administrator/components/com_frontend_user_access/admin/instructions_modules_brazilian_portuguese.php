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
<h1>Instruções para a configuração de restrição de acesso aos módulos</h1>
<ul>
	<li><a href="#add">adicionar módulo ao módulo Frontend-User-Access</a></li>
	<li><a href="#copy">copiar um módulo Frontend-User_Access</a></li>
	<li><a href="#set">estabelecer restrições de acesso para módulos</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>Adicionar módulo ao módulo Frontend-User-Access</h2>
<p>Para restringir o acesso ao módulo, o módulo necessita ser carregado dentro do módulo Frontend-User-Access (infelizmente o Joomla não prove diretamente o manejo de eventos para restringir o acesso a módulos). O módulo Frontend-User-Access irá trabalhar envolto pelo módulo Frontend-User-Access , permitindo que o módulo seja escondido quando o usuário não possui permissão para acessar. Então você deve configurar o módulo Frontend-User-Access para que ele carregue o módulo que você quer restringir. </p>
<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensões' &gt; 'Administrador de Módulos'";
	}else{
		//joomla 1.0.x
		echo "'Módulos' &gt; 'Módulos do Site'";
	}

	?></li>
	<li>Ache o módulo que você quer restringir o acesso na lista. Anote o ID na coluna 'ID'.</li>
	<li>Abrir o módulo Frontend-User-Access.<br>
		Se você acabou de instalar o módulo, o nome do módulo é 'Frontend-User-Access'. Se você modificou o nome ou apenas fez uma cópia do módulo, veja na coluna 'tipo' por 'mod_frontend_user_access'. Clique no título do módulo.</li>
	<li>Edite o título e escreva outra referência. É a melhor maneira de referenciar o módulo que você vai restringir o acesso. </li>
	<li>Configurar 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Habilitado:'";
	}else{
		//joomla 1.0.x
		echo "'Publicado:'";
	}

	?> para 'Sim'.</li>
	<li>Selecione uma posição para o módulo. Se você é iniciante, selecione 'left'.</li>	
	<li>Onde diz 'parâmetros do módulo' em 'carregar id do módulo' entre com o ID que você anotou no passo 2. </li>	
	<li>Clique em 'salvar'.</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "Desabilitar";
	}else{
		//joomla 1.0.x
		echo "Despublicado";
	}

	?> o módulo que agora está carregado no módulo Frontend-User-Access, apenas para ter certeza que não será mostrado em nenhum outro local exceto no módulo Frontend-User-Access. </li>
	<li>Esconder o título do módulo que selecionamos.
	</li>
</ol>


<p>Um módulo Frontend-User-Acces pode carregar apenas um módulo. Então você deve fazer uma cópia do módulo Frontend-User-Access para cada módulo que você quer restringir o acesso. Se você precisar de mais módulos Frontend-User-Access, vá até o 'Gerenciador de Módulos' e copie o módulo Frontend-User-Access. Aqui temos como. </p>

<a name="copy"></a>
<h2><a href="#top">top</a>Copiando um módulo Frontend-User-Access</h2>

<ol>
	<li>Vá para <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Extensões' &gt; 'Gerenciar Módulos'";
	}else{
		//joomla 1.0.x
		echo "'Módulos' &gt; 'Módulos do Site'";
	}

	?></li>
	<li>Ache o módulo Frontend-User-Access. Procure na coluna 'tipo' por 'mod_frontend_user_access'. </li>
	<li>Selecione o módulo marcando o caixa próximo ao nome do módulo. </li>
	<li>Clique no menu superior-direito em 'copiar'.<br>
	O módulo agora possui uma cópia. O título será 'Cópia de' seguido pelo nome antigo do módulo.</li>
	<li>CLique no nome da cópia do módulo.  </li>
		<li>Configurar 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'Habilitado:'";
	}else{
		//joomla 1.0.x
		echo "'Publicado:'";
	}

	?> para 'Sim'.</li>
	<li>Selecione a posição para o módulo. Se você é iniciante selecione 'left'. <br>
	</li>	
	<li>Onde diz 'parâmetros do módulo' em 'carregar id do módulo' digite o id do módulo que você deseja incluir. </li>	
	<li>Clique em 'salvar'.</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>Estabelecer restrições de acesso para módulos</h2>

<ol>
	<li>Vá em 'Componentes' &gt; 'Frontend-User-Access'.</li>
	<li>Clique em 'acesso a módulos'. <br>
	</li>
	<li>Estabeleça permissões ou restrições para cada módulo e para cada grupo de usuários. </li>
	<li>Clique em 'salvar'.</li>
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