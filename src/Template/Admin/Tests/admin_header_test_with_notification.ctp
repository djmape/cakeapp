<!DOCTYPE html>
<head>

<!-- Include Base CSS -->
<?php echo $this->element('css');?>

<!-- Include Base JS -->
<?php echo $this->element('js');?>      

<?php echo $this->Html->css("../plugins/gritter/css/jquery.gritter.css"); ?>
<?php echo $this->Html->css("material-icons.css"); ?>

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
				<li class="dropdown">
					<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle icon">
						<i class="material-icons">inbox</i>
						<span class="label">5</span>
					</a>
					<ul class="dropdown-menu media-list dropdown-menu-right">
						<li class="dropdown-header">NOTIFICATIONS (5)</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<i class="fa fa-bug media-object bg-silver-darker"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
									<div class="text-muted f-s-11">3 minutes ago</div>
								</div>
							</a>
						</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<img src="../assets/img/user/user-1.jpg" class="media-object" alt="" />
									<i class="fab fa-facebook-messenger text-primary media-object-icon"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading">John Smith</h6>
									<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
									<div class="text-muted f-s-11">25 minutes ago</div>
								</div>
							</a>
						</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<img src="../assets/img/user/user-2.jpg" class="media-object" alt="" />
									<i class="fab fa-facebook-messenger text-primary media-object-icon"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading">Olivia</h6>
									<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
									<div class="text-muted f-s-11">35 minutes ago</div>
								</div>
							</a>
						</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<i class="fa fa-plus media-object bg-silver-darker"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading"> New User Registered</h6>
									<div class="text-muted f-s-11">1 hour ago</div>
								</div>
							</a>
						</li>
						<li class="media">
							<a href="javascript:;">
								<div class="media-left">
									<i class="fa fa-envelope media-object bg-silver-darker"></i>
									<i class="fab fa-google text-warning media-object-icon f-s-14"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading"> New Email From John</h6>
									<div class="text-muted f-s-11">2 hour ago</div>
								</div>
							</a>
						</li>
						<li class="dropdown-footer text-center">
							<a href="javascript:;">View more</a>
						</li>
					</ul>
				</li>
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<span class="d-none d-md-inline">Hi, John Smith</span>
						<img src="../assets/img/user/user-14.jpg" alt="" /> 
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item">Settings</a>
						<div class="dropdown-divider"></div>
						<a href="javascript:;" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul>
			<!-- end header navigation right -->
			
			<div class="search-form">
				<button class="search-btn" type="submit"><i class="material-icons">search</i></button>
				<input type="text" class="form-control" placeholder="Search Something..." />
				<a href="#" class="close" data-dismiss="navbar-search"><i class="material-icons">close</i></a>
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
              		<li class="">
                		<?php echo $this->Html->link('<i class="fa fa-globe fw"></i><span>View Website</span>',['prefix' => "front", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              			<li class="active">
                			<?php echo $this->Html->link('<i class="fa fa-home fw"></i><span>Dashboard</span>',['prefix' => "admin", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              			</li>
					<li class="has-sub">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="material-icons">home</i>
						    <span>Site Info</span>
					    </a>
						<ul class="sub-menu">
              				<!-- About -->
              				<li>
                				<?php echo $this->Html->link('About',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index'],array('escape' => false)) ?>
              				</li>
              				<!-- Email -->
						    <li>
                    			<?php echo $this->Html->link('Emails',array('prefix' => "admin", 'controller' => 'ContactEmails','action'=>'index')) ?>
                    		</li>
                    		<!-- Contact -->
                  			<li>
                    <?php echo $this->Html->link('Contact Number',array('prefix' => "admin", 'controller' => 'ContactNumbers','action'=>'index')) ?></li>
              <!-- Home -->
              <li>
                <?php echo $this->Html->link('Home',['prefix' => "admin", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              </li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-pencil-alt"></i>
						    <span>Posts</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Announcements -->
              				<li>
                    <?php echo $this->Html->link('Announcements',array('prefix' => "admin", 'controller' => 'Announcements','action'=>'index')) ?></li>
              				<!-- Events -->
						    <li>
                    <?php echo $this->Html->link('Events',array('prefix' => "admin", 'controller' => 'Events','action'=>'index')) ?></li>
                    		<!-- News & Updates -->
                  			<li>
                    <?php echo $this->Html->link('News & Updates',array('prefix' => "admin", 'controller' => 'ContactNumbers','action'=>'index')) ?></li>
						</ul>
					</li>
              		<!-- Employees -->
					<li class="has-sub">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Employees</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Employees -->
              				<li>
                    <?php echo $this->Html->link('Employees',array('prefix' => "admin", 'controller' => 'Employees','action'=>'index')) ?></li>
              				<!-- Offices -->
						    <li>
                    <?php echo $this->Html->link('Offices',array('prefix' => "admin", 'controller' => 'Offices','action'=>'index')) ?>
                    </li>
						</ul>
					</li>
					<!-- end Employee section -->
              		<!-- begin Student section -->
					<li class="has-sub">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-graduation-cap"></i>
						    <span>Students</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Courses -->
              				<li>
                    <?php echo $this->Html->link('Courses',array('prefix' => "admin", 'controller' => 'Courses','action'=>'index')) ?></li>
              				<!-- Organizations -->
						    <li>
                    <?php echo $this->Html->link('Organizations',array('prefix' => "admin", 'controller' => 'Organizations','action'=>'index')) ?></li>
						</ul>
					</li>
					<!-- end Student section -->
              		<!-- begin Student section -->
					<li class="has-sub">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-users"></i>
						    <span>Users</span>
					    </a>
						<ul class="sub-menu">
              				<!-- Employees -->
              				<li>
                    <?php echo $this->Html->link('Employees',array('prefix' => "admin", 'controller' => 'Courses','action'=>'index')) ?></li>
              				<!-- Students -->
						    <li>
                    <?php echo $this->Html->link('Students',array('prefix' => "admin", 'controller' => 'Organizations','action'=>'index')) ?></li>
						</ul>
					</li>
					<!-- end Student section -->
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<!-- end #content -->
		
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="material-icons">keyboard_arrow_up</i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->



	<!-- Include Base JS -->
    <?php echo $this->element('base_js');?>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
	<?php echo $this->Html->script("material.min.js")?>
	<?php echo $this->Html->script("apps.min.js")?>
	<?php echo $this->Html->script("../plugins/gritter/js/jquery.gritter.js")?>
	<?php echo $this->Html->script("../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")?>
	<?php echo $this->Html->script("dashboard.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->  

<script>
		$(document).ready(function() {
			App.init();
		});
</script>


</body>
</html>