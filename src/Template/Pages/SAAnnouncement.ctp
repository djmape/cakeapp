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
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->

	
	<?php echo $this->element('SANavBar');?>

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="active">Announcements</li>
		</ol>
		<!-- end breadcrumb -->
		<!-- begin page-header -->
		<h1 class="page-header">Announcements</h1>
		<!-- end page-header -->
		
		<div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Announcements</h4>
                    </div>
                    <div class="panel-body">
                        <a href="#modal-addannment" class="btn btn-sm btn-primary" data-toggle="modal">Add Announcements</a>
                    </div>
                    <div class="panel-body">
                        <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                            <tr>
                                <th>Announcement title</th>
                                <th>Date</th>
								<th>Description</th>
								<th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

								<!-- Here is where we iterate through our $articles query object, printing out article info -->
								<?php foreach ($articles as $article): ?>
									<tr>
										<td>
									    	<?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
									    </td>
									    <td>
									        <?= $article->created->format(DATE_RFC850) ?>
									    </td>
									    <td>
									        <?= $article->body?>
									    </td>
        								<td>
            								<?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?>
            								<?= $this->Form->postLink(
                								'Delete',
                								['action' => 'delete', $article->slug],
                								['confirm' => 'Are you sure?'])
            								?>
        								</td>
									</tr>
								<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
            </div>
        </div>
	</div>
	<!-- end #content -->

	<!-- #modal-addannment -->
    <div class="modal fade" id="modal-addannment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Add Announcement</h4>
                        </div>
                        <div class="panel-body">
                            <form action=" " method="POST">
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">Announcement</legend>
                                        <!-- begin row -->
                                        <div class="row">

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <div class="controls">
                                                        <input type="text" name="anntitle" placeholder="Title"
                                                               class="form-control" required/>
                                                    </div>
                                                </div>
											</div>
											
											<div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Date*</label>
                                                    <input type="text" class="form-control date" name="anndate" required/>
                                                </div>
                                            </div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
															<textarea class="form-control" name="anndesc" placeholder="Description" rows="5"></textarea>
												</div>
											</div>
                                        </div>

                                        <br>

                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-success">Add</button>
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <!-- end wizard step-3 -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
</div>
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
