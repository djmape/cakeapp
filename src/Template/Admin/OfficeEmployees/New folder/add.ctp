<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Add Organization </title>
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
</head>


<body>

    <?php echo $this->element('AdminSideBar');?>
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>
            <li class="breadcrumb-item active">Form Elements</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form Elements <small>header small text goes here...</small></h1>
        <!-- end page-header -->
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal">
                                <?php  
                                    $organization_type = [
                                        'Affiliated' => 'Course Affliated Student Organizations',
                                        'University' => 'University Student Organizations'
                                    ];
                                    echo $this->Form->create($organization); ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Organization Type</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('organization_type',$organization_type, array('class' => 'form-control','label' => false )); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Organization Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_name', array('class' => 'form-control','label' => false ));?> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Acronym</label>
                                    <div class="col-md-9">
                                        <?php  echo $this->Form->control('organization_acronym', array('class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mission</label>
                                    <div class="col-md-9">
                                        <?php  echo $this->Form->control('organization_mission', array('type' => 'textarea','class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Vision</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_vision', array('type' => 'textarea','class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Goals</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_goal', array('type' => 'textarea','class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Objectives</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_objective', array('type' => 'textarea','class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                </div>
                                <!--
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Organization Logo</label>
                                    <div class="col-md-7">
                                        <span class="btn btn-success fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add image</span>
                                                <?php echo $this->Form->control('organization_photo', array('type'=>'file','label' => false));?>
                                        </span>
                                            <label id="filename">No file selected</label>
                                    </div>
                                </div>
                            -->
                                <div class="pull-right">
                                    <?php echo $this->Form->button(__('Add Organization'), array('class' => 'btn btn-sm btn-primary'));
                                      echo $this->Form->end();
                                    ?>
                                </div>
                            </form>
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
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

</html>