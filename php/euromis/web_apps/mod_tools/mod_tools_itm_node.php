<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );

# Load the global function
require_once("web_apps/global/process-helper.php");

# Create object
$euromis  = new webapps();
$document =& JFactory::getDocument();

# Set variable
$script_folder      = "mod_tools";
$script_name        = "mod_tools_itm_node.php";
$script_helper_name = "mod_tools_itm_node_helper.php";

# Check if jQuery is loaded, to avoid conflict
if ( !$euromis->is_jQuery() )
{
    $document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.js"></script>');
}


# Load javascript
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/redmond/jquery-ui-1.7.2.custom.css');                            
$document->addStyleSheet(JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/css/ui.jqgrid.css');

$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/i18n/grid.locale-en.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jqgrid/jquery.jqGrid.min.js"></script>');      

$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.core.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.widget.js"></script>');
$document->addCustomTag('<script type="text/javascript" src="'.JURI::root(true)."/".ROOT_FOLDER.'/includes/js/jquery.ui.progressbar.js"></script>');
                                                                                                                                               
# Get username
$user =& JFactory::getUser();
$username = $user->name; 
                                   
# Create random number for unique ID
$random = mt_rand();
                                   
?>

<div id="page_title"><?php echo PAGE_TITLE_18; ?></div>

<script language="javascript" type="text/javascript">  
var running = false;                          

function doRewrite() {
    if (running) {                                       
        $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, random: '<?php echo $random; ?>'}, function(count){

            var progress   = count.split(',');
            var percentage = parseInt( parseInt(progress[0]) / parseInt(progress[1]) * 100 );

            if( parseInt(progress[0]) == 99999 ) 
            { 
                running = false; 
                $('#progress').html('<strong>Create File Progress : DONE</strong>'); 
                $('#progress_bar').progressbar({value: 100});
                $.post('<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>' ,{t: 2, random: '<?php echo $random; ?>'});
            }
            else if( parseInt(progress[0]) != 0 ) 
            {
                $('#progress').html('<strong>Create File Progress : ' + percentage + '%</strong>');
                $('#progress_bar').progressbar({value: percentage});                                                                      
            }            

        });
        setTimeout("doRewrite()", 1000);        
    }
}

$(document).ready(function(){
    
    $('#progress_bar').progressbar({value: 0});
    $('#progress_bar').hide();    
    
      $("#list").jqGrid({
          url:'<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>',    
          datatype: "xml",
          colNames:['Date','Time','Node','Description','Status'],
          colModel:[                                                                                                                           
              {name: 'G_DATE',        index: 'G_DATE',        width: 100, align: 'center', editable: true, edittype: 'text',     editoptions: {size: 50, readonly: true}},              
              {name: 'G_TIME',        index: 'G_TIME',        width: 100, align: 'center', editable: true, edittype: 'text',     editoptions: {size: 50, readonly: true}},              
              {name: 'G_NODE',        index: 'G_NODE',        width: 75,  align: 'center', editable: true, edittype: 'text',     editoptions: {size: 50, readonly: true}},
              {name: 'G_DESCRIPTION', index: 'G_DESCRIPTION', width: 250, align: 'left',   editable: true, edittype: 'text',     editoptions: {size: 50, readonly: true}},
              {name: 'G_STATUS',      index: 'G_STATUS',      width: 100, align: 'center', editable: true, edittype: 'text',     editoptions: {size: 50, readonly: true}} ],
          rowNum: 30,
          rowList: [10,20,30,50,100],
          pager: '#pager',
          sortname: 'G_DATE DESC, G_TIME',
          viewrecords: true,
          rownumbers: true, 
          rownumWidth: 30,               
          sortorder: "desc",
          caption: 'AS400 ITM Node History Log',
          mtype: 'POST',       
          loadComplete: function(){ 
              $('#progress').html('');    
              $('#progress_bar').progressbar({value: 0});
              $('#progress_bar').hide();    
          },
          postData: {
              t: 0, 
              username: '<?php echo $username; ?>'
          },                            
          ondblClickRow: function(rowId, iRow, iCol, e) {
              if (rowId)
              {
                  $("#list").jqGrid('editGridRow', rowId, {width:400, height:200, closeOnEscape:true, closeAfterEdit:true, reloadAfterSubmit:true});    
              }
          },                                 
          height: 300               
      });

    $("#list").jqGrid('navGrid', '#pager',
        {add:false, del:false}, //options
        {
            width:400,
            height:350,
            closeOnEscape: true,
            closeAfterEdit: true,
            reloadAfterSubmit: true
        }, // edit options
        {}, // add options                         
        {}, // del options
        {         
            sopt: ['eq','lt','le','gt','ge','cn'],
            recreateFilter: true,
            closeAfterReset: true,
            closeAfterSearch: true,
            closeOnEscape: true,
            multipleSearch: true
        } // search options
    );              

    $("#list").jqGrid('navButtonAdd','#pager',{
           caption:"", 
           title:"Export To Excel", 
           onClickButton : function () {                
               var SQL = $("#list").getUserDataItem('SQL');
               var input = $("<input>").attr("type", "hidden").attr("name", "SQL").val(SQL);
               $('#excel_form').append($(input));
               var input = $("<input>").attr("type", "hidden").attr("name", "random").val('<?php echo $random; ?>');
               $('#excel_form').append($(input));
               var input = $("<input>").attr("type", "hidden").attr("name", "t").val('1');
               $('#excel_form').append($(input));

               $("#excel_form").submit();
               $('#progress').html('<strong>Initializing Creating File...</strong>');
               $('#progress_bar').progressbar({value: 0});
               $('#progress_bar').show();
               running = true;
               doRewrite();               
           } 
    });
        
});        
    
</script>

<center>

<table id="list"></table>
<div id="pager"></div>    

<form id="excel_form" action="<?php echo ROOT_FOLDER."/".$script_folder."/".$script_helper_name; ?>" method="post">
</form>

<br>
<div id="page0">
<div id="progress"></div>
<br>
<div id="progress_bar"></div>
</div>

</center>


