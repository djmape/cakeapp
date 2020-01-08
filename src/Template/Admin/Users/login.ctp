<!-- File: src/Template/Articles/index.ctp -->

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>PUPQC | Admin Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<!-- Include Base CSS -->
	<?php echo $this->element('css');?>

	<!-- Include Base JS -->
	<?php echo $this->element('js');?> 

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
	<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
	<?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
	

	<?php echo $this->Html->css("custom/admin.css") ?>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->

	

	<!-- begin #content -->
	<style>
		body {
			background: #7e0e09;
			overflow: hidden;
		}
		.panel {
			background: #fff;
		}
		h3, label {
			color: #7e0e09;
		}
		.panel-heading {
			background: #fff;
		}
		p {
			color: #7e0e09;
			text-align: center
		}
	</style>
			<div class="panel" style="margin: auto; width: 350px; height:58%; margin-top: 9%;">
				<div class="panel-body" style="padding: 10%;">
					<div style=" text-align: center; width:100px; height: 100px; margin: auto">
						<?php echo $this->Html->image('PUPlogo.png', array('style' => 'width: 100px; margin: auto')); ?>
					</div>
						<?= $this->Form->create() ?>
                        <div class="row m-b-15"> </div>
                        <div class="row m-b-15"> </div>
						<div class="form-group row m-b-15">
                                <label class="col-md-6 col-form-label">Email</label>
                                <div class="">
                                	<?= $this->Form->control('email',array('type' => 'email', 'class' => 'form-control','label' => false)); ?>
                            </div>
                        </div>
						<div class="form-group row m-b-15">
                                <label class="col-md-6 col-form-label">Password</label>
                                <div class="">
                                	<?= $this->Form->control('password', array('type' => 'password', 'class' => 'form-control', 'label' => false)); ?>
                            </div>
                        </div>
                        <div class="row m-b-15"> </div>
						<div class="form-group row m-b-15">
                               <div class="">
                                	<?= $this->Form->button('Login', array('class' => 'btn btn-sm btn-yellow','style' => 'width: 100%')) ?>
									<?= $this->Form->end() ?>
                            </div>
                        </div>
                </div>
			</div>
	<!-- end #content -->

<!-- Include Base JS -->
    <?php echo $this->element('base_js');?>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
<?php echo $this->Html->script("apps.min.js")?>
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
