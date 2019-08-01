<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Edit Organization </title>
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
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"); ?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css"); ?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css"); ?>
    <!-- ================== END BASE JS ================== -->

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    
</head>


<body>

    <?php echo $this->element('AdminSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item active">Logged in: <?= $users->email ?></li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Polytechnic University of the Philippines - Quezon City <small>Web Portal</small></h1>
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h5> 
                                <i class="fa fa-edit"></i>
                                <b> Edit Organization</b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                                <?php  
                                    $organization_type = [
                                        'Affiliated' => 'Course Affliated Student Organizations',
                                        'University' => 'University Student Organizations'
                                    ];
                                    echo $this->Form->create($organization,array('enctype'=>'multipart/form-data')); ?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Organization Type</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('organization_type',$organization_type, array('class' => 'form-control','label' => false, 'default' => $row->organization_type )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Organization Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_name', array('class' => 'form-control','label' => false, 'default' => $row->organization_name ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Acronym</label>
                                    <div class="col-md-9">
                                        <?php  echo $this->Form->control('organization_acronym', array('class' => 'form-control','label' => false, 'default' => $row->organization_acronym));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Mission</label>
                                    <div class="col-md-9">
                                        <?php  echo $this->Form->control('organization_mission', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_mission));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Vision</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_vision', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_vision));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Goals</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_goal', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_goal));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Objectives</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_objective', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_objective));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15" style="padding-left: 1%">
                                    <label class="col-md-3 control-label">Employee Photo</label>
                                    <div class="col-md-9">
                                        <span class="btn btn-sm btn-primary fileinput-button" style="position: relative; bottom: 0;left: 0;">
                                            <i class="fa fa-plus"></i>
                                            <span style="position: relative; bottom: 0;left: 0;">Add image</span>
                                                <?php echo $this->Form->control('organization_photo', array('type'=>'file','label' => false,'required' => false));?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9" style=" border: 1px solid #7e0e09; width: 150px; height: 150px; object-fit: fill; padding: 10px">
                                        <?php echo $this->Html->image("../webroot/img/upload/".$row->organization_photo, array('style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%;">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>  Add Organization'), array('class' => 'btn btn-sm btn-primary'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
                                </div>
                        </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
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
    <?php $this->Html->script("button.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-audio.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-image.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-process.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-ui.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-validate.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-video.js")?>
    <?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.iframe-transport.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->

<!-- TinyMCE JS -->
<?php echo $this->Html->script("tinymce/tinymce.js")?>
<?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    
    <script>

        $(document).ready(function() {
            App.init();
            FormMultipleUpload.init();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

    </script>

</html>