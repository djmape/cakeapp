<!DOCTYPE html>
<head>
    <!-- -->
    <title> <?php echo $title ?> </title>

	<!-- Include Base CSS -->
	<?php echo $this->element('css');?>

	<!-- Include Base JS -->
	<?php echo $this->element('js');?>      

	<?php echo $this->Html->css("../plugins/gritter/css/jquery.gritter.css"); ?>
	<?php echo $this->Html->css("material-icons.css"); ?>


    <!-- ================== Sweet Alert ================== -->
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>

</head>

<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<div class="material-loader">
			<svg class="circular" viewBox="25 25 50 50">
				<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
			</svg>
			<div class="message">Loading...</div>
		</div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade <?php if($user_settings == true) { echo 'page-sidebar-fixed page-header-fixed page-with-wide-sidebar'; } ?>">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header" style=" display: inline">				
              	<div class="image navbar-brand">                	
                	<?php echo $this->Html->link('<div class="navbar-header" style=""><span>' . $this->Html->image('PUPlogo.png',array('style' => 'height: 50px')) . '</span> Polytechnic University of the Philippines <small> Quezon City </small><br></div>',array('controller'=>'Users','action'=>'index'),array('escape' => false,'class' => 'navbar-brand', 'style' => 'color:gray; width: 1000px')) ?>
              	</div>
			</div>
			<!-- end navbar-header -->
			
			<?php 
				if ($login_status == true ) {
			?>
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="d-none d-md-inline">
							Hi, 
							<?php
								if ($user_type == 'Employee') {
        							echo $user->user_employee_lastname . ' ' . $user->user_employee_firstname . ' ' .substr($user->user_employee_middlename,0 ,1) . '.';
        						}
        						else if ($user_type = 'Student') {
        							echo $user->user_student_lastname . ', ' . $user->user_student_firstname . ' ' . substr($user->user_student_middlename,0 ,1 . '.');
        						}
        						else if ($user_type == 'Alumni') {
        							echo $user->user_alumni_lastname . ', ' . $user->user_alumni_firstname . ' ' . substr($user->user_alumni_middlename,0 ,1 . '.');
        						}
        					?>

						</span>

						<?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, array());
                        ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<?php echo $this->Html->link('View Profile',array('controller' => 'Users','action'=>'userProfile'),array('class'=>'dropdown-item')) ?>
						<?php echo $this->Html->link('Settings',array('controller' => 'Users','action'=>'userSettingsProfile'),array('class'=>'dropdown-item')) ?>
						<div class="dropdown-divider"></div>
						<?php echo $this->Html->link('Log Out',array('controller' => 'Users','action'=>'logout'),array('escape' => false,'class'=>'dropdown-item')) ?>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
			<?php } else { ?>
				<div class="" style="margin: 1%">
					
					<?= $this->Html->link('Login', ['prefix' => false,'controller' => 'Users', 'action' => 'login'],['class' => 'btn btn-maroon pull-right','escape' => false]) ?>
				</div>
			<?php } ?>
			
		</div>
		<!-- end #header -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
			<i class="material-icons">keyboard_arrow_up</i>
		</a>
		<!-- end scroll to top btn -->

