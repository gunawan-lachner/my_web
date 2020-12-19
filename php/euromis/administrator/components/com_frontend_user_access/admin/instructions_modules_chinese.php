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
<h1>设置模块使用限制说明</h1>
<ul>
	<li><a href="#add">增加模块到前端用户使用模块</a></li>
	<li><a href="#copy">拷贝一个前端用户使用模块</a></li>
	<li><a href="#set">设置模块使用限制</a></li>
</ul>
	
<a name="add"></a>
<h2><a href="#top">top</a>增加模块到前端用户使用模块</h2>
<p>为了限制进入一个模块, 该模块需要装入一个前端用户使用模块（不幸的是Joomla 没有提供任何直接的模块权限限制的处理器） 。该前端用户使用模块将作为用户使用包装，当用户没有使用权而允许模块被隐藏时。所以你需要配置前端用户使用模块，以便它载入你要要限制的模块。</p>
<ol>
	<li>Go to <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'延伸' &gt; '模块管理'";
	}else{
		//joomla 1.0.x
		echo "'模块' &gt; '网站模块'";
	}

	?></li>
	<li>在名单寻找你要限制的模块。注意'ID'栏中id。</li>
	<li>开一个前端用户使用模块.<br>如果您刚刚安装模块，其模块的名字是'前端用户使用'。如果您更改名称或刚刚拷贝模块，看'类型'栏中的' mod_frontend_user_access ' 。点击模块的标题。</li>
	<li>修改让你易记的标题。最好使用你要限制使用的模块标题。</li>
	<li>设置 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'启用:'";
	}else{
		//joomla 1.0.x
		echo "'发布:'";
	}

	?> 到'是'。</li>
	<li>选择一个模块的位置。如果您是新手请选择'左'。</li>	
	<li>在'模块参数'下的'加载模块id'输入您在步骤2看到的id。</li>	
	<li>点击'保存'。</li>
	<li><?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "禁用";
	}else{
		//joomla 1.0.x
		echo "取消发布";
	}

	?> 正在载入前端用户使用模块的模块，以确保它不显示在其它地方，除了在前端用户使用模块。</li>
	<li>隐藏嵌入式模块的标题。
	</li>
</ol>


<p>一个前端用户使用模块只能加载一个模块。所以，你必须拷贝一份前端用户使用模块到每个你要限制使用的模块。如果您需要更多前端用户使用模块，到'模块管理 '拷贝任何前端用户使用模块。以下是示范。</p>

<a name="copy"></a>
<h2><a href="#top">top</a>拷贝一份前端用户使用模块</h2>

<ol>
	<li>到 <?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'延伸' &gt; '模块管理'";
	}else{
		//joomla 1.0.x
		echo "'模块' &gt; '网站模块'";
	}

	?></li>
	<li>寻找一个前端用户使用模块. 看'类型'栏中的'mod_frontend_user_access'。</li>
	<li>选择模块名称旁边的框以选择模块。</li>
	<li>单击右上角的工具栏的'复制' 。<br>
	现在模块已被拷贝。旧的模块标题将被拷贝。</li>
	<li>单击已被拷贝模块的名字。</li>
		<li>设置 
	<?php
	if(defined('_JEXEC')){
		//joomla 1.5
		echo "'启用:'";
	}else{
		//joomla 1.0.x
		echo "'发布:'";
	}

	?> 到 '是'。</li>
	<li>选择一个模块的位置。如果您是新手请选择'左'。<br>
	</li>	
	<li>在'模块参数'下的'加载模块id'输入您要加载模块的id。</li>	
	<li>点击'保存'。</li>
</ol>

<a name="set"></a>
<h2><a href="#top">top</a>设置模块的使用限制</h2>

<ol>
	<li>到'组件' &gt; '前端用户使用'。</li>
	<li>点击‘模块使用’。<br>
	</li>
	<li>设置使用权限或限制给每个模块和每个用户组。 </li>
	<li>点击'保存'。</li>
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