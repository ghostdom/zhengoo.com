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
<style type="text/css">
    div.selector{
        margin-right:5px;
        width:120px;
        float: right;
    }
    div.selector span{
        width:120px;
    }

    #uniform-app_order{
        width:60px;
    }

    #uniform-app_order span{
        width:60px;
    }
</style>
<body>
    <!-- Left side content -->
    <?php $this->load->view('admin/main_left'); ?>
<!-- Right side -->
<div id="rightSide">
    <!-- Top fixed navigation -->
    <?php $this->load->view('admin/main_top'); ?>
    <!-- Title area -->
    <?php $this->load->view('admin/app/app_title'); ?>
    <!-- Main content wrapper -->
    
    <div class="wrapper">
        <div class="widget" style="padding: 5px;margin-top:10px; ">
            <form name="app_seach" action="/admin/app/seach" class="form">
                <input type="text" name="keyword"  placeholder="<?php if($this->input->get('keyword')){ echo $this->input->get('keyword'); }else{ echo '关键字'; }?>" style="width:150px;float:left; margin-right:5px"/>                <input type="submit" value="查询" class="basic"/>
                <select style="width:130px">
                    <option value="opt1">选择类型</option>
                    <option value="opt2">Option 2</option>
                    <option value="opt3">Option 3</option>
                    <option value="opt4">Option 4</option>
                    <option value="opt5">Option 5</option>
                    <option value="opt6">Option 6</option>
                    <option value="opt7">Option 7</option>
                    <option value="opt8">Option 8</option>
                </select>

                <select id="app_order" style="width:60px">
                    <option value="opt1">排序</option>
                    <option value="opt2">Option 2</option>
                    <option value="opt3">Option 3</option>
                    <option value="opt4">Option 4</option>
                    <option value="opt5">Option 5</option>
                    <option value="opt6">Option 6</option>
                    <option value="opt7">Option 7</option>
                    <option value="opt8">Option 8</option>
                </select>
            </form>   
        </div>
        <div class="widget" style="margin-top:10px">
            <div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>应用列表</h6>
               
                <div class="num">
                    <a class="greenNum" href="javascript:;" id="add_app">+新增</a>
                    <a class="redNum" href="#">删除</a>
                </div>
            </div>

            <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                <thead>
                    <tr>
                        <td><img src="<?=lib_url()?>images/icons/tableArrows.png" alt="" /></td>
                        <td>图标</td>
                        <td class="sortCol" ><div>名称 / 介绍<span></span></div></td>
                        <td width="100">详情</td>
                        <td width="100">操作</td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <?php
                                if(isset($apps_count))
                                $this->load->view('admin/common/common_paging', array('count' => $apps_count));
                            ?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        if($apps){
                            foreach ($apps as $app) {
                                if(isset($app['app_id'])){
                                    $app_id = $app['app_id'];
                                }else{
                                    $app_id = -1;
                                }
                    ?>
                    <tr>
                        <td ><input type="checkbox" name="app_id" value="<?=$app_id?>" /></td>
                        <td  align="center">
                            <a href="http://www.pintutu.com/?iframe=true&width=100%&height=100%" rel="lightbox" title="<?=$app['app_title']?>">
                                <img class="app_icon" src="<?=$app['app_icon']?>" width="55" height="55"/>
                            </a>
                        </td>
                        
                        <td class="pInfo" style="text-align:left;">
                            <a href="#"><?=$app['app_title']?></a>
                            <a href="<?=$app['app_store_url']?>" class="tipS" title="AppStore" target="_blank"><img src="<?=lib_url()?>/images/icons/apple.png"/></a>
                            <?php
                                if($app['app_official_web']){
                            ?>
                            <a href="<?=$app['app_official_web']?>" class="tipS" title="官方网站" target="_blank"><img src="<?=lib_url()?>/images/icons/external-link.png"/></a>
                            <?php
                                }
                            ?>
                            <i><?=mb_substr($app['app_desc'], 0 ,100, 'UTF-8')?></i>
                        </td>
                        <td class="fileInfo">
                            <span><strong>类别:</strong> <h7 class="green"><?=$app['app_category_name']?></h7></span>
                             <?php
                                if($app['app_status'] != APP_STATUS_UNDONE){
                             ?>
                            <span><strong>价格:</strong> <h7 class="orange"><?=$app['app_price']?></h7></span>
                            <span><strong>版本:</strong> <h7 class="blue"><?=$app['app_version']?></h7></span>
                            <span><strong>支持设备:</strong> <h7><?=$app['app_devices']?></h7></span>
                            <?php
                                }
                            ?>
                        </td>
                        <td class="actBtns">
                            <?php
                            if($app_id != -1){
                                if($app['app_status'] == APP_STATUS_UNDONE){
                            ?>
                            <a href="javascript:;" title="未完成" class="tipS"><img src="<?=lib_url()?>images/icons/taskDone.png"/></a>
                            <a href="javascript:;" title="下载数据" id="<?=$app_id?>" name="<?=$app['app_store_id']?>" class="tipS get_app_info"><img src="<?=lib_url()?>images/icons/arrow-small-down_1.png"/></a>
                            <?php
                                }else if($app['app_status'] == APP_STATUS_SHOW){
                            ?>
                            <a href="javascript:;" title="正常" class="tipS"><img src="<?=lib_url()?>images/icons/taskProgress.png"/></a>
                            <a href="javascript:;" title="刷新" id="<?=$app_id?>" name="<?=$app['app_store_id']?>" class="tipS get_app_info"><img src="<?=lib_url()?>images/icons/min_refresh.png"/></a>
                            <?php
                                }else if($app['app_status'] == APP_STATUS_HIDE){
                            ?>
                            <a href="javascript:;" title="下架" class="tipS"><img src="<?=lib_url()?>images/icons/taskPending.png"/></a>
                            <a href="javascript:;" title="刷新" id="<?=$app_id?>" name="<?=$app['app_store_id']?>" class="tipS get_app_info"><img src="<?=lib_url()?>images/icons/min_refresh.png"/></a>
                            <?php
                                }
                                if($app['app_hot']){
                            ?>
                            <a href="javascript:;" title="热门应用" class="tipS hot_app" alt="<?=APP_HOT_NO?>" name="<?=$app['app_id']?>"><img src="<?=lib_url()?>images/icons/min_star_show.png"/></a>
                            <?php
                                }else{
                            ?>
                            <a href="javascript:;" title="热门应用" class="tipS hot_app" alt="<?=APP_HOT_YES?>" name="<?=$app['app_id']?>"><img src="<?=lib_url()?>images/icons/min_star_hide.gif"/></a>
                            <?php 
                                }
                            ?>
                            <a href="#" title="编辑" class="tipS"><img src="<?=lib_url()?>images/icons/edit.png" alt="" /></a>
                            <a href="#" title="删除" class="tipS"><img src="<?=lib_url()?>images/icons/remove.png" alt="" /></a>
                        </td>
                    </tr>
                    <?php 
                        }else{
                     ?>
                     <a href="javascript:;" title="下载数据" name="<?=$app['app_store_id']?>" class="tipS get_app_info"><img src="<?=lib_url()?>images/icons/arrow-small-down_1.png"/></a>
                     <?php       
                            }
                        }
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
    <div id="add_app_dialog" title="+新增应用">
        <p>
            <img src="<?=lib_url()?>images/icons/color/information.png"/>
            <span>键入应用<strong class="red">完整URL</strong>或<strong class="red">编号</strong>, 点击OK系统将自动获取应用详细信息.</span>
        </p>
        <div class="uiForm">
            <input type="text"  id="app_url_or_id" name="app_url_or_id" value=""/>
            <p id="add_app_loading" style="text-align:center; display:none">
                <img src="<?=lib_url()?>/images/loaders/loader8.gif"/>
            </p> 
        </div>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#add_app_dialog").dialog({
            autoOpen: false,
            modal: false,
            buttons: {
            OK: function() {
                    add_dialog  = $(this);
                    var url_or_id = $("#app_url_or_id").val();
                    if(url_or_id != "" && url_or_id != null){
                        $("#add_app_loading").show();
                        $.getJSON('/admin/app/add/',
                        {
                            id_or_url: url_or_id
                        },
                        function (data){
                            app_return(data);
                            add_dialog.dialog('close');

                        });
                    }else{
                        $("#add_app_dialog").prepend('<div class="nNote nFailure hideit" style="margin-top:0; margin-bottom:5px; background: no-repeat scroll 15px center #FCCAC1;"><p style="margin-left:10px"><strong>提醒: </strong>请输入正确的应用URL或应用编号.</p></div>');
                    }
                }
            },
            close: function () {
                 $("#add_app_loading").hide();
            }
        });

        $(".hot_app").click(function (){
            var _this = $(this);
            var app_hot = _this.attr('alt');
            
            $.getJSON('/admin/app/hot', 
            {
                app_id: _this.attr('name'),
                app_hot: app_hot
            },
            function (data){
                if(data.result > 0){
                    if(app_hot == ''){
                        _this.attr('alt', '<?=APP_HOT_YES?>');
                        _this.children('img').attr('src', '<?=lib_url()?>images/icons/min_star_hide.gif');
                    }else{
                        _this.attr('alt', '<?=APP_HOT_NO?>');
                        _this.children('img').attr('src', '<?=lib_url()?>images/icons/min_star_show.png');
                    }
                    growl_icon = '<?=lib_url()?>/images/icons/notifications/accept_32.png';
                    $.jGrowl(
                    '<img style="vertical-align:top; position:relative; top:6px;float:left; margin-right:15px" src="' 
                    + growl_icon 
                    + '"/> <div style="overflow:hidden; zoom:1">成功</div>'
                    );
                }else{
                    growl_icon = '<?=lib_url()?>/images/icons/notifications/exclamation_32.png';
                    $.jGrowl(
                    '<img style="vertical-align:top; position:relative; top:6px;float:left; margin-right:15px" src="' 
                    + growl_icon 
                    + '"/> <div style="overflow:hidden; zoom:1">失败</div>'
                    );
                }
            });
        });

        $("#add_app").click(function () {
            $("#add_app_dialog").dialog("open");
            $("#app_url_or_id").val('');
        });

        $(".get_app_info").click(function () {
            obj = $(this);
            obj.children('img').attr('src','<?=lib_url()?>/images/loaders/loader2.gif');
            $('.tipsy').hide();
            $.getJSON('/admin/app/add/',
            {
                id_or_url:  $(this).attr('name'),
                app_id:     $(this).attr('id')
            },
            function (data) {
                var app = data.app;
                obj.parent().parent().find('.app_icon').attr('src', app.app_icon);
                obj.children('img').attr('src','<?=lib_url()?>/images/icons/min_refresh.png');
                app_return(data);
            });
        });

        function app_return(data) {
            var result = data.result ;
            var app = data.app;
            if(result == 1){
                growl_icon = '<?=lib_url()?>/images/icons/notifications/accept_32.png';
                $.jGrowl(
                    '<img style="vertical-align:top; position:relative; top:6px;float:left; margin-right:15px" src="' 
                    + growl_icon 
                    + '"/> <div style="overflow:hidden; zoom:1"><span><strong class="orange">标题:  </strong>' 
                    + app.app_title 
                    + '</span><br/>'
                    + '<span><strong class="orange">版本:  </strong>'
                    + app.app_version
                    + '</span><br/></div>'
                    
                );
            }else{
                growl_icon = '<?=lib_url()?>/images/icons/notifications/exclamation_32.png';
                $.jGrowl(
                    '<img style="vertical-align:top; position:relative; top:6px;float:left; margin-right:15px" src="' 
                    + growl_icon 
                    + '"/> <span ><strong class="orange">错误</strong>' 
                    // ,
                    // { 
                    //     sticky: true
                    // }
                );
            }
            
        }

    });
</script>
</body>
</html>