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
    <?php $this->load->view('admin/dcenter/dcenter_title'); ?>
    <!-- Main content wrapper -->
    <div class="wrapper">
        <div class="toggle acc">
            <?php
                foreach ($app_datas as $app_data) {
                    $category = $app_data['category'];
                    $dcenters = $app_data['dcenters'];
            ?>
            <div class="title"><img src="<?=lib_url()?>images/icons/dark/link2.png" class="titleIcon"/>
                <h6><?=$category['category_name']?></h6>
                <div class="clear"></div>
            </div>
            <div class="menu_body">
                <?php
                    if(!empty($dcenters)){
                ?>
                <div class="widget" style="margin-top:0;¢">       
                    <ul class="tabs">
                        <?php
                            $letters = '' ;
                            foreach ($dcenters as $i => $dcenter) {
                                $letters .= $dcenter['dcenter_letter'];
                               
                               if( $i + 1 == count($dcenters) || $i % 2 == 1){
                        ?>
                                    <li><a href="#tab_<?=$dcenter['dcenter_id']?>"><?=$letters?></a></li>
                        <?php
                                    $letters = '';
                                }
                            }
                        ?>
                        <div class="num">
                            <a href="javascript:;" alt="<?=$category['category_alias']?>" name="" class="redNum get_apps">获取<?=$category['category_name']?>热门应用</a>
                        </div>
                    </ul>

                    <div class="tab_container">
                        <?php
                            $tr = ''; 
                            foreach ($dcenters as $i => $dcenter) {
                                if($dcenter['dcenter_status'] == DCENTER_STATUS_READY){
                                    $status_class = 'taskPr';
                                }else{
                                    $status_class = 'taskD';
                                }
                                $tr .= '<tr>
                                            <td class="' . $status_class . '">首字母 [<font color="red">' . $dcenter['dcenter_letter'] . '</font>] 已获取到第 <font color="red">' . $dcenter['dcenter_page'] . '</font> 页</td>
                                            <td><a href="#" title="" class="webStatsLink">' . $dcenter['dcenter_count'] . '</a></td>
                                            <td class="actBtns">
                                                <a alt="" title="继续抓取" name="' . $dcenter['dcenter_id'] . '" href="javascript:;" class="tipS get_apps"><img src="'.lib_url().'images/icons/edit.png"/></a>
                                            </td>
                                        </tr>';
                            if($i + 1 == count($dcenters) || $i % 2 == 1){
                        ?>
                        <div id="tab_<?=$dcenter['dcenter_id']?>" class="tab_content">
                             <div class="widget" style="margin-top:0;">
                                <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                                    <thead>
                                        <tr>
                                            <td>详情</td>
                                            <td width="100">总数</td>
                                            <td width="60">操作</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?=$tr?>
                                    </tbody>
                                </table>            
                            </div> 
                        </div>
                        <?php
                            $tr = '';
                            }
                        }
                        ?>
                    </div>      
                </div>
                <?php
                    }else {
                ?>
                    <a href="/admin/dcenter/init/<?=$category['category_alias']?>/<?=$category['category_id']?>?category_name=<?=$category['category_name']?>" class="wContentButton bluewB">初始化</a>
                <?php
                    }
                ?>
            </div>
        <div class="clear"></div>
        <?php
            } // first foreach
        ?>
    </div>             
</div>
 <!-- Footer line -->
<?php  $this->load->view('admin/main_footer'); ?>


<div class="uDialog">
    <div id="ajax_loading" title="正在从AppStore获取数据.">
        <p>
            <img src="<?=lib_url()?>images/loaders/loader2.gif">
            <span>正在从AppStore获取数据, 可能需要一段时间.请耐心等待...</span>
        </p>
        
        <div class="uiForm">
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function (){
        $( "#ajax_loading" ).dialog({
            autoOpen: false,
            closeOnEscape: false,
            modal: true
        });

        $(".get_apps").click(function () {
            $("#ajax_loading").dialog("open");
            getApps($(this).attr('name'), $(this).attr('alt'));
            return false;
        });

    });

    function getApps (dcenter_id, category_alias) {
        $('#ajax_loading > p > img').attr('src', '<?=lib_url()?>images/loaders/loader2.gif');
        $('#ajax_loading > p > span').text('正在从AppStore获取数据, 可能需要一段时间.请耐心等待...');
        $.getJSON('/admin/dcenter/getAppList/',
        {
            dcenter_id: dcenter_id,
            category_alias: category_alias
        },
        function(json){
            if(json.result == 1){
                var info = json.info;
                if(info.next_page == 0){
                    $('#ajax_loading > p > img').attr('src', '<?=lib_url()?>images/icons/color/tick.png');
                    $('#ajax_loading > p > span').html('已成功从AppStore获取到<strong class="red">' + info.app_count + '</strong>个应用, 点击下一页继续获取.');
                    $("#ajax_loading").dialog("option", "buttons", [
                        {
                            text: "下一页",
                            click: function(){
                                getApps(info.dcenter_id);
                            }
                        }
                    ]); 
                }else{
                    $('#ajax_loading > p > img').attr('src', '<?=lib_url()?>images/icons/color/information.png');
                    $('#ajax_loading > p > span').html('数据获取完毕! 获取了<strong class="red">' + info.app_count + '</strong>个应用');
                    $("#ajax_loading").dialog("option", "buttons", [
                        {
                            text: "完成",
                            click: function(){
                                $(this).dialog( "close" );
                            }
                        }
                    ]); 
                }
            }else{
                alert('插入失败');
            }    
        });
    }
</script>
</body>
</html>