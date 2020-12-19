<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );
$pageview = JRequest::getVar('view', '');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="templates/<?php echo $this->template ?>/css/template.css" type="text/css" />                             
<?php    
	$document =& JFactory::getDocument();
	$document->setTitle($mainframe->getCfg('sitename') . " - " . $document->title);	
?>     
</head>
<body>

<?php $user =& JFactory::getUser();?>
<?php if ($user->id > 1) { ?>


<div id="main">
  <div class="container">

    <div id="menu">
      <div class="inside">
        <jdoc:include type="modules" name="menu" style="rounded" />      
      </div>
    </div>  
        
    <div class="clear"></div>
    
    <div id="header">
      <div class="logo-page"><img src="templates/<?php echo $this->template ?>/images/logo-small.png"></div>
      <div class="inside-w50-l">
        <div class="logo-title"><img src="templates/<?php echo $this->template ?>/images/LOGO-1.png"></div>
      </div>
      <div id="login-page">
        <div class="inside-w50-r-image">
          <jdoc:include type="modules" name="login-page" style="rounded" />             
          <jdoc:include type="modules" name="clock" style="rounded" />                                
        </div>
      </div>       
    </div>                   
    
    <div class="clear"></div>
    
    <div id="mainbody"> 
	    <div class="verticalline">
        
            <div id="top">
      			<div class="inside">
        			<jdoc:include type="modules" name="top" style="rounded" />                    
      			</div>
    		</div>
            
            <div class="clear"></div>

            <?php if ($pageview != 'frontpage') : ?>
            <div id="content">
                <div class="inside">
        			<jdoc:include type="component" />
      			</div>
    		</div>           
            <?php endif; ?>

            <div class="clear"></div>

            <div id="container">

            <div id="content-1">
      			<div class="inside">
       			       <jdoc:include type="modules" name="content-1" style="rounded" />
      			</div>
    		</div>
                        
            <div class="clear"></div>
            
 	 	</div>
	</div>
    
    <div class="clear"></div>
    
    <div id="footer">
      <div class="inside">
        <jdoc:include type="modules" name="footer" style="rounded" />
      </div>
    </div>

  </div>
</div>

 
<?php } else { ?>

<center>
<div id="main">
    <div class="logo-login"></div>
    <div id="login">
      <div class="inside">
        <jdoc:include type="modules" name="login" style="rounded" />
      </div>
    </div>
</div>
</center>

<?php } ?>

<!-- lordsanjay rules ! lord_sanjay@yahoo.com -->

</body>
</html>
