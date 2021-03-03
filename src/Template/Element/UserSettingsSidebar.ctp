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
              		<!-- Go Home -->
              		<li>
                		<?php echo $this->Html->link('<i class="fa fa-home fw"></i><span>Go Home</span>',['prefix' => false, 'controller' => 'Users','action'=>'index'],array('escape' => false)) ?>
              		</li>
              		<?php 
              			if ($user_type == 'Administrator') {
              		?>
              		<li>
                		<?php echo $this->Html->link('<i class="fa fa-cog fw"></i><span>Admin Panel</span>',[ 'prefix' => 'admin','controller' => 'abouts','action'=>'index'],array('escape' => false)) ?>
              		</li>
              		<?php
              			}
              		?>
              		<!-- Visit Website -->
              		<li class="<?php if ($active == 'profile') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-user fw"></i><span>Profile</span>',[ 'controller' => 'Users','action'=>'userSettingsProfile'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              		<li class="<?php if ($active == 'info') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-info fw"></i><span>Account Information</span>',[ 'controller' => 'Users','action'=>'userSettingsInfo'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              		<li class="<?php if ($active == 'password') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-key fw"></i><span>Password</span>',['controller' => 'Users','action'=>'userSettingsPassword'],array('escape' => false)) ?>
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
		<!-- end #sidebar -->
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