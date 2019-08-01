<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | User </title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php echo $this->Html->css("../plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>
    <?php echo $this->Html->css("bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/font-awesome/css/font-awesome.min.css"); ?>
    <?php echo $this->Html->css("animate.min.css")?>
    <?php echo $this->Html->css("style.min.css")?>
    <?php echo $this->Html->css("style-responsive.min.css")?>
    <?php echo $this->Html->css("theme/default.css")?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <?php echo $this->Html->css("../plugins/isotope/isotope.css")?> 
    <?php echo $this->Html->css("../plugins/lightbox/css/lightbox.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    
</head>


<body>
    <?php echo $this->element('AdminProfileSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <!-- end page-header -->
    <?php echo $this->element('AdminHeader');?>
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h5>
                    <i class="fa fa-user"></i>
                    <b> <?=  $users->email ?></b>
                </h5>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <?php echo $this->Flash->render(); ?>
            <div class="panel-body">
                <?php echo $this->Form->create($user,array('enctype'=>'multipart/form-data')); ?>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">Current Password</label>
                    <div class="col-md-12">
                        <?php echo $this->Form->control('current_password', array('type' => 'password','id' => 'current_password','style' => '','class' => 'form-control', 'label' => false )); ?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">New Password</label>
                    <div class="col-md-12">
                        <?php echo $this->Form->control('new_password', array( 'type' => 'password','id' => 'new_password','style' => '','class' => 'form-control', 'label' => false,'onfocusout' => 'checkPasswordIsMatched()' )); ?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">Confirm Password</label>
                    <div class="col-md-12">
                        <?php echo $this->Form->control('confirm_password', array( 'type' => 'password','id' => 'confirm_password','style' => '','class' => 'form-control', 'label' => false,'onfocusout' => 'checkPasswordIsMatched()')); ?>
                    </div>
                </div>
                            <div class="pull-right">
                                <?php echo $this->Form->button(__('Change Password'), array('id' => 'submit_button','class' => 'btn btn-sm btn-primary'));
                                      echo $this->Form->end();
                                ?>
                            </div>
            <!-- end panel-body -->
            </div>
</div>

</body>


<!-- ================== BEGIN BASE JS ================== -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php $this->Html->script("/apps.min.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            $( "#submit_button" ).prop( "disabled", true );
            checkPasswordIsMatched();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify | link unlink | image",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

        function checkPasswordIsMatched() {
            if($("#current_password").val().length > 0 || $("#new_password").val().length > 0 || $("#confirm_password").val().length > 0)
            {
                if ($('#new_password').val() == $('#confirm_password').val()) {
                    $( "#submit_button" ).prop( "disabled", false );
                }
                else {
                    $( "#submit_button" ).prop( "disabled", true );
                }
            }
            else {
                $( "#submit_button" ).prop( "disabled", true );
            }

        }

        
    </script>

</html>