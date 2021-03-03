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
                	<?php echo $this->Html->link('<div class="navbar-header" style=""><span>' . $this->Html->image('PUPlogo.png',array('style' => 'height: 50px')) . '</span> Polytechnic University of the Philippines <small> Quezon City </small><br></div>',array('prefix' => 'front', 'controller'=>'Home','action'=>'index'),array('escape' => false,'class' => 'navbar-brand', 'style' => 'color:gray; width: 1000px')) ?>
              	</div>
			</div>
			<!-- end navbar-header -->
			<?php 
				if ($login_status == true ) {
			?>
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li>
					<?php
						if ($user_notification_count > 0) {
							# code...
					?>
					<?php
							echo $this->Html->link('<i class="fa fa-bell fa-2x"></i> '.$user_notification_count,['prefix' => false,'controller' => 'Users','action'=>'userNotifications', $user->user->username],array('escape' => false, 'title' => 'You have ' . $user_notification_count . ' unread notifications', 'style' => 'color: #7e0e09'));
					?>
					<?php
						}
						else {
							echo $this->Html->link('<i class="fa fa-bell fa-2x"></i> ',['prefix' => false,'controller' => 'Users','action'=>'userNotifications', $user->user->username],array('escape' => false, 'title' => 'You have no unread notifications'));
						}
					?>
				</li>
				
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="d-none d-md-inline">
							
							Hi, 

							<?= $user->user->user_firstname . ' ' .substr($user->user->user_lastname,0 ,1) . '.';
        					?>

						</span>
                        <?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo);
        					?>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<?php echo $this->Html->link('View Profile',array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $user->user->username ),array('class'=>'dropdown-item')) ?>
						<?php echo $this->Html->link('Settings',array('prefix' => false,'controller' => 'Users','action'=>'userSettingsProfile'),array('class'=>'dropdown-item')) ?>
						<?php
							if ($organization_officer_count != 0) {
								foreach ($organization_officer as $organization_officer):
						?>
							<div class="dropdown-divider"></div>
							<?php echo $this->Html->link($organization_officer->organization->organization_acronym,array('prefix' => false,'controller' => 'Users','action'=>'organizationPanel',str_replace(' ', '-', $organization_officer->organization->organization_name)),array('class'=>'dropdown-item')) ?>
							<div class="dropdown-divider"></div>
						<?php
								endforeach;
							}
						?>
						<a href="javascript:;" onclick="confirmLogout()" class="dropdown-item">Log Out</a>
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
		<a href="javascript:;" class="btn btn-icon btn-circle btn-maroon btn-scroll-to-top fade" data-click="scroll-top">
			<i class="material-icons">keyboard_arrow_up</i>
		</a>
		<!-- end scroll to top btn -->

		<script type="text/javascript">

			function confirmLogout() {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => false ,"controller"=>"Users","action"=>"logout"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => false ,"controller"=>"Users","action"=>"login"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to logout?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-maroon",
                confirmButtonText: "Logout",
                cancelButtonText: "Cancel",
    			confirmButtonColor: "#7e0e09"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            success:function(query)  {
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError, "error");
                            }
                        });
                    }
                });
        }

		</script>