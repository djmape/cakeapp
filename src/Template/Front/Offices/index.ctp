<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>PUPQC | Announcements</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	

    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php echo $this->Html->css("../plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>
    <!-- <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("bootstrap.min.css")?>
    <!-- <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("../plugins/font-awesome/css/font-awesome.min.css"); ?>
    <!-- <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("animate.min.css")?>
    <!-- <link href="assets/css/animate.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("style.min.css")?>
    <!--  <link href="assets/css/style.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("style-responsive.min.css")?>
    <!--  <link href="assets/css/style-responsive.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("theme/default.css")?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
    <!-- <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"/> -->
    <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
    <!-- <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet"/> -->
    <?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <!-- <script src="assets/plugins/pace/pace.min.js"></script> -->
    <!-- ================== END BASE JS ================== -->

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>

    <style type="text/css">
        body {
            background-color: white;
        }

        #content {
            background-color: white;
        }
        .container {
            background-color: #fff;
        }
        .btn a {
            color: #fff;
        }
        a {
            color: #7e0e09;
        }

        a:hover {
            color: #7e0e09;
            text-decoration: underline;
        }

        h3 {
            color: #7e0e09;
        }
    </style>
</head>
<body>
	<!-- begin #page-container -->
    <?php echo $this->element('NavBar');?>

	<!-- begin #content -->
	<div id="content" class="content">
                        <table id="data-table" class="table-striped table-bordered nowrap" width="100%" style="border: 0; margin-top: 20px">
                            <thead>
                            	<h3>
                            		<i class="fa fa-building"></i>
                            		Offices
                            	</h3>
                            </thead>
                            <tbody>
                                    <?php foreach ($offices as $office): ?>
								 	<tr style="">
										<td style="height: 200px; padding: 20px">
                                            <div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%; margin-right: 1%">
                                                    <?php echo $this->Html->image("../webroot/img/upload/".$office->office_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;')); ?>
                                            </div>
											<p><h5><b><?= $office->office_name;?></b></h5></p>
											<p><?= $office->office_description;?></p>
                                            <button type="button" class="btn btn-yellow btn-sm">
                                                <i class="fa fa-eye">
                                                </i>
                                                <?= $this->Html->link('View', ['action' => 'view', $office->office_id]) ?>
                                            </button>
									    </td>
									</tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
	</div>
	<!-- end #content -->
	
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</div>
<?php echo $this->element('footer');?>
<!-- end page container -->


<!-- ================== BEGIN BASE JS ================== -->
<!-- <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<!-- <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<!-- <script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<!-- <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> -->
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <!-- <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> -->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <!-- <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script> -->
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<!-- <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<!-- <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<!-- <script src="assets/js/table-manage-responsive.demo.min.js"></script> -->
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- <script src="assets/js/apps.min.js"></script> -->
    <?php $this->Html->script("/apps.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-53034621-1', 'auto');
		ga('send', 'pageview');

	</script>
</body>
</html>
