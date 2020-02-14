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
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header" style=" display: inline">
				<button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
              	<div class="image navbar-brand">
                	<?php echo $this->Html->image('PUPlogosmall.png', ['alt' => 'PUPLogo']); ?>
                	Organization Panel
              	</div>
			</div>
			<!-- end navbar-header -->
			
			<!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="d-none d-md-inline">Hi, <?= $user->user->username?></span>
						<?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo);
        					?>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item">Settings</a>
						<div class="dropdown-divider"></div>
						<?php echo $this->Html->link('Log Out',array('prefix' => "admin", 'controller' => 'Users','action'=>'logout'),array('escape' => false,'class'=>'dropdown-item')) ?>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
			
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" data-disable-slide-animation="true">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar nav -->
				<ul class="nav">
              		<!-- Visit Website -->
              		<li class="<?php if ($active == 'organizationPanel') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-users fw"></i><span>Dashboard</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationPanel',str_replace(' ', '-', $organization->organization_name)],array('escape' => false)) ?>
              		</li>
              		<li class="<?php if ($active == 'organizationInformation') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-info fw"></i><span>Information</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationInformationEdit',str_replace(' ', '-', $organization->organization_name)],array('escape' => false)) ?>
              		</li>
              		<li class="<?php if ($active == 'organizationAnnouncements') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-bullhorn fw"></i><span>Announcements</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationAnnouncementsAll',str_replace(' ', '-', $organization->organization_name)],array('escape' => false)) ?>
              		</li>
              		<li class="<?php if ($active == 'organizationEvents') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-star fw"></i><span>Events</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationEventsAll',str_replace(' ', '-', $organization->organization_name)],array('escape' => false)) ?>
              		</li>
              		<li class="<?php if ($active == 'organizationMembers') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-users fw"></i><span>Members</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationMembersAll',str_replace(' ', '-', $organization->organization_name)],array('escape' => false)) ?>
              		</li>
					
			        <!-- begin sidebar minify button -->
					<li>
						<a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">	<i class="fa fa-angle-double-left"></i>
						</a>
					</li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg">
			
		</div>
		<!-- end #sidebar -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
			<i class="material-icons">keyboard_arrow_up</i>
		</a>
		<!-- end scroll to top btn -->

