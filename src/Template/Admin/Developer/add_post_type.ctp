<!DOCTYPE html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Dev Panel | Add post type </title>
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
                        <span class="d-none d-md-inline">Hi, <?= $user->email ?></span>
                        <?php echo $this->Html->image("../webroot/img/upload/".$user->user_photo, array()); ?>
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
                    <!-- Add user type -->
                    <li>
                        <?php echo $this->Html->link('Add user type',['prefix' => "admin", 'controller' => 'Developer','action'=>'addUserType'],array('escape' => false)) ?>
                    </li>
                    <!-- Add activity type -->
                    <li>
                        <?php echo $this->Html->link('Add activity type',['prefix' => "admin", 'controller' => 'Developer','action'=>'addActivityType'],array('escape' => false)) ?>
                    </li>
                    <!-- Add post type -->
                    <li>
                        <?php echo $this->Html->link('Add post type',['prefix' => "admin", 'controller' => 'Developer','action'=>'addPostType'],array('escape' => false)) ?>
                    </li>
                    <!-- Add post_reaction type -->
                    <li>
                        <?php echo $this->Html->link('Add post reaction type',['prefix' => "admin", 'controller' => 'Developer','action'=>'addPostReactionType'],array('escape' => false)) ?>
                    </li>
                    
                    <!-- begin sidebar minify button -->
                    <li>
                        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">  <i class="fa fa-angle-double-left"></i>
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
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content"> 
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">
                    <?php echo $this->Html->link('Emails',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index']) ?>
                </li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Add activity type</h1>
            <!-- end page-header -->           
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h5>
                    <i class="fa fa-info"></i>
                    <b> Add activity type</b>
                </h5>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <?php echo $this->Flash->render(); ?>
                    <div class="panel-body">
                        <?php echo $this->Form->create($post_type,array('class'=>'form-horizontal')); ?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Post Type Name</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('post_type_name', array('class' => 'form-control', 'label' => false )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <div class="pull-right" style="margin-right: 1%">
                                        <?php echo $this->Form->button(__('Add Post Type'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
                                </div>
                                                    
                    </div>
            <!-- end panel-body -->
        </div>
</div>

</body>


<!-- Include Base JS -->
    <?php echo $this->element('base_js');?>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
    <?php $this->Html->script("/apps.min.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify | link unlink | image",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

        
    </script>

</html>