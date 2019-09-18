<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>PUPQC | <?= $row->event_title ?></title>
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

    <!-- ================== Sweet Alert ================== -->
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>

    <style type="text/css">
    	
	.btn.btn-yellow {
	color: #7e0e09;
	background: #fdea08;
	border-color: #fdea08;
	}

	.btn.btn-yellow>a {
	color: #7e0e09;
    text-decoration: none;
	}

	.btn-yellow.active, .btn-yellow:active, .btn-yellow:focus, .btn-yellow:hover, .open .dropdown-toggle.btn-yellow {
    background: #efd101;
    border-color: #efd101;
    text-decoration: none;
	}
    </style>
</head>
<body>
	<!-- begin #page-loader -->

	<!-- end #page-loader -->

	<!-- begin #page-container -->

	
    <?php echo $this->element('NavBar');?>

	<!-- begin #content -->
	<div id="content" class="content" style="background-color: #fff">
    <?php echo $this->Flash->render(); ?>
		
		<div class="row">
			<div class="col-md-12">
						<h2><?= $row->event_title ?></h2>
						<br>
						<p style="font-size: 14px"> <b> Location: </b> <?= $row->event_location ?></p>
						
						<p style="font-size: 14px">  <b> Event Period: </b>
													 <?= $row->event_start_date ?>
													 <?= $row->event_start_time ?>
													 - 
													 <?= $row->event_end_date ?> 
													 <?= $row->event_end_time ?>
						</p>
						<p style="font-size: 14px"> <b> Participants: </b> <?= $row->event_participants ?></p>
						<br>
						<div style="margin-bottom: 5%; margin-top: 5%;">
							<?php echo $this->Html->image("../webroot/img/upload/".$row->event_photo, array('class' => 'center-block','style' => 'max-width:100%; max-height:500px;')); ?>
						</div>
						<br>
						<p style="font-size: 14px"><?= $row->event_body ?></p>
						<br>
						<p style="font-size: 14px">
							<?php 
        						if ($row->event_sponsors != "") {
            						echo "<b> Sponsor: </b>";
        						}
							?>
							 <?= $row->event_sponsor ?>
						</p>
						<br>
						<!-- For Embed Location
						<iframe id="locationIframe" src="<?php echo $row->event_location_embed?>" class="center-block" width="80%" height="500" frameborder="0" style="border:0; display: hidden" allowfullscreen></iframe>
						<br>
						-->

						<p><small>Last Updated: <?= $row->event_modified ?></small></p>

						<!-- begin Question Panel -->
                    	<div class="panel panel-inverse" style="margin-top: 1%">
                    		<div class="panel-heading">
                            <h5 style="color: white">
                                <i class="fa fa-plus"></i>
                                <b> Questions about <?= $row->event_title ?> </b>
                            </h5>
                        	</div>
                        	<div class="panel-body">
								<?php echo $this->Form->create($email, ['url' => ['action' => 'sendMail',$row->event_id]]); ?>
                                <div class="form-group row m-b-15">
                                    <div class="col-md-12">
                                    <label class="col-md-4 col-form-label">Event</label>
                                        <?php echo $this->Form->control('subject', array('class' => 'form-control','label' => false,'default' => $row->event_title,'disabled' => true)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Email</label>
                                    <div class="col-md-12">
                                		<?php echo $this->Form->control('email', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-12">
                                		<?php echo $this->Form->control('name', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Message</label>
                                    <div class="col-md-12">
                               			 <?php echo $this->Form->control('message', array('type' => 'textarea','class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                            <div class="pull-right" style=" margin-bottom: 1%">
                                <?php echo $this->Form->button(__('Send'), array('class' => 'btn btn-sm btn-yellow'));
                                      echo $this->Form->end();
                                ?>
                            </div>
                        	</div>
                    	</div>
						<!-- end Question Panel -->
				
		</div>
	</div>
	<!-- end #content -->
	
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</div>
<!-- end page container -->
</body>
    <?php echo $this->element('footer');?>


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
		var iframe = document.getElementById('locationIframe');

		$(document).ready(function() {
			App.init();
    		iframe.style.display = 'none';
		});

		$(function(){
    		$('#locationIframe').ready(function(){
        		iframe.style.display = 'inline';
    		});
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

</html>
