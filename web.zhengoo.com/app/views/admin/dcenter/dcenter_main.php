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
    </div>
    <!-- Footer line -->
    <?php  $this->load->view('admin/main_footer'); ?>
                  
</div>
<div class="clear"></div>

</body>
</html>