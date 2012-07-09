<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>Crown - premium responsive admin template for backend systems</title>
<link href="<?=lib_url()?>css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?=lib_url()?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/charts/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/wizard/jquery.form.wizard.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/uploader/jquery.plupload.queue.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/tables/resizable.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/plugins/elfinder.min.js"></script>
<script type="text/javascript" src="<?=lib_url()?>js/custom.js"></script>

</head>

<body>
    <!-- Left side content -->
    <?php $this->load->view('admin/main_left'); ?>
<!-- Right side -->
<div id="rightSide">
    <!-- Top fixed navigation -->
    <?php $this->load->view('admin/main_top'); ?>
    <!-- Title area -->
    <?php $this->load->view('admin/category/category_title'); ?>
    <!-- Main content wrapper -->
    <div class="wrapper">
         <!-- Dynamic table -->
        <div class="widget">
            <div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Media table</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" >
                <thead>
                    <tr>
                        <td><img src="<?=lib_url()?>images/icons/tableArrows.png" alt="" /></td>
                        <td>名称</td>
                        <td width="100">状态</td>
                        <td width="60">操作</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="itemActions">
                                <label>Apply action:</label>
                                <select>
                                    <option value="">Select action...</option>
                                    <option value="Edit">Edit</option>
                                    <option value="Delete">Delete</option>
                                    <option value="Move">Move somewhere</option>
                                </select>
                            </div>
                            <div class="tPagination">
                                <ul>
                                    <li class="prev"><a href="#" title=""></a></li>
                                    <li><a href="#" title="">1</a></li>
                                    <li><a href="#" title="">2</a></li>
                                    <li><a href="#" title="">3</a></li>
                                    <li><a href="#" title="">4</a></li>
                                    <li><a href="#" title="">5</a></li>
                                    <li><a href="#" title="">6</a></li>
                                    <li>...</li>
                                    <li><a href="#" title="">20</a></li>
                                    <li class="next"><a href="#" title=""></a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        foreach ($category as $category) {
                    ?>
                    <tr>
                        <td><input type="checkbox" id="titleCheck2" name="checkRow" /></td>
                        <td ><a href="#" title=""><?=$category['category_name'] ?></a></td>
                        <td>1231</td>
                        <td class="actBtns">
                            <a href="#" title="编辑" class="tipS"><img src="<?=lib_url()?>images/icons/edit.png" alt="" /></a>
                            <a href="#" title="删除" class="tipS"><img src="<?=lib_url()?>images/icons/remove.png" alt="" /></a>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer line -->
    <?php  $this->load->view('admin/main_footer'); ?>
                  
</div>
<div class="clear"></div>

<div class="uDialog">
    <div id="dialog-message" title="Dialog title">
        <p>输入抓取地址</p>
        
        <div class="uiForm">
            <form action="" class="dialog">
                <input type="text" value="http://" name="app_categroy_url"/>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function (){
        $( "#dialog-message" ).dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $("#add_source").click(function () {
            $("#dialog-message").dialog("open");
            return false;
        })
    });
</script>
</body>
</html>