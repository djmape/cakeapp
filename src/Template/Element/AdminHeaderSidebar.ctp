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
                	Admin Panel
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
			
			<div class="search-form">
				<button class="search-btn" type="submit">
					<i class="material-icons">search</i>
				</button>
				<input type="text" class="form-control" placeholder="Search Something..." />
				<a href="#" class="close" data-dismiss="navbar-search">
					<i class="material-icons">close</i>
				</a>
			</div>
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" data-disable-slide-animation="true">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar nav -->
				<ul class="nav">
              		<!-- Visit Website -->
              		<li>
                		<?php echo $this->Html->link('<i class="fa fa-globe fw"></i><span>View Website</span>',['prefix' => "front", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              		<li class="<?php if ($active == 'dashboard') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-home fw"></i><span>Dashboard</span>',['prefix' => "admin", 'controller' => 'Dashboard','action'=>'index'],array('escape' => false)) ?>
              		</li>
					<li class="has-sub <?php if ($expand == 'site-info') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="material-icons">home</i>
						    <span>Site Info</span>
					    </a>
						<ul class="sub-menu">
              				<!-- About -->
              				<li class="<?php if ($active == 'about') echo 'active'?>">
                				<?php echo $this->Html->link('About',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index'],array('escape' => false)) ?>
              				</li>
              				<!-- Email -->
						    <li class="<?php if ($active == 'email') echo 'active'?>">
                    			<?php echo $this->Html->link('Emails',array('prefix' => "admin", 'controller' => 'ContactEmails','action'=>'index')) ?>
                    		</li>
                    		<!-- Contact -->
                  			<li class="<?php if ($active == 'contact_number') echo 'active'?>">
                    			<?php echo $this->Html->link('Contact Number',array('prefix' => "admin", 'controller' => 'ContactNumbers','action'=>'index')) ?>
                    		</li>
              				<!-- Home -->
              				<li class="<?php if ($active == 'home') echo 'active'?>">
                				<?php echo $this->Html->link('Home',['prefix' => "admin", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              				</li>
						</ul>
					</li>
					<li class="has-sub <?php if ($expand == 'posts') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-pencil-alt"></i>
						    <span>Posts</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Announcements -->
              				<li class="<?php if ($active == 'announcements') echo 'active'?>">
                    			<?php echo $this->Html->link('Announcements',array('prefix' => "admin", 'controller' => 'Announcements','action'=>'index')) ?>
                    		</li>
              				<!-- Events -->
						    <li class="<?php if ($active == 'events') echo 'active'?>">
                    			<?php echo $this->Html->link('Events',array('prefix' => "admin", 'controller' => 'Events','action'=>'index')) ?>
                    		</li>
						</ul>
					</li>
              		<!-- Employees -->
					<li class="has-sub <?php if ($expand == 'employees') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Employees</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Employees -->
              				<li class="<?php if ($active == 'employees') echo 'active'?>">
                    			<?php echo $this->Html->link('Employees',array('prefix' => "admin", 'controller' => 'Employees','action'=>'index')) ?>
                    		</li>
              				<!-- Offices -->
						    <li class="<?php if ($active == 'offices') echo 'active'?>">
                    			<?php echo $this->Html->link('Offices',array('prefix' => "admin", 'controller' => 'Offices','action'=>'index')) ?>
                    		</li>
						</ul>
					</li>
					<!-- end Employee section -->

              		<!-- begin Student section -->
					<li class="has-sub <?php if ($expand == 'students') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-graduation-cap"></i>
						    <span>Students</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Courses -->
              				<li class="<?php if ($active == 'courses') echo 'active'?>">
                    			<?php echo $this->Html->link('Courses',array('prefix' => "admin", 'controller' => 'Courses','action'=>'index')) ?>
                    		</li>
              				<!-- Organizations -->
						    <li class="<?php if ($active == 'organizations') echo 'active'?>">
						    	<?php echo $this->Html->link('Organizations',array('prefix' => "admin", 'controller' => 'Organizations','action'=>'index')) ?>
						    </li>
						</ul>
					</li>
					<!-- end Student section -->

              		<!-- begin Users section -->
					<li class="has-sub <?php if ($expand == 'users') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-users"></i>
						    <span>Users</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Administrator -->
              				<li class="<?php if ($active == 'users-admin') echo 'active'?>">
                    			<?php echo $this->Html->link('Administrator',array('prefix' => "admin", 'controller' => 'Users','action'=>'adminAll')) ?>
                    		</li>
              				<!-- Employees -->
              				<li class="<?php if ($active == 'user-employees') echo 'active'?>">
                    			<?php echo $this->Html->link('Employees',array('prefix' => "admin", 'controller' => 'Users','action'=>'employeesAll')) ?>
                    		</li>
              				<!-- Students -->
						    <li class="<?php if ($active == 'user-students') echo 'active'?>">
						    	<?php echo $this->Html->link('Students',array('prefix' => "admin", 'controller' => 'Users','action'=>'studentsAll')) ?>
						    </li>
              				<!-- Alumni -->
              				<li class="<?php if ($active == 'user-alumni') echo 'active'?>">
                    			<?php echo $this->Html->link('Alumni',array('prefix' => "admin", 'controller' => 'Users','action'=>'alumniAll')) ?>
                    		</li>
						</ul>
					</li>
					<!-- end Users section -->

              		<!-- begin Forum section -->
					<li class="has-sub <?php if ($expand == 'forums') echo 'active expand'?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-users"></i>
						    <span>Forum</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Categories -->
              				<li class="<?php if ($active == 'forumCategories') echo 'active'?>">
                    			<?php echo $this->Html->link('Categories',array('prefix' => "admin", 'controller' => 'Forums','action'=>'forumCategories')) ?>
                    		</li>
						</ul>
					</li>
					<!-- end Student section -->
					
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

