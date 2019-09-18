<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Add Course </title>
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
    <!-- ================== END BASE JS ================== -->

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    
</head>


<body>

    <?php echo $this->element('AdminSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <?php echo $this->element('AdminHeader');?>
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h5> 
                                <i class="fa fa-plus"></i>
                                <b> Add Course</b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                            <?php  
                                $course_type = [
                                'Undergraduate Courses' => 'Undergraduate Courses'
                                ];
                                echo $this->Form->create($course);
                            ?>  
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Course Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_name', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Acronym</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_acronym', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Course Type</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('course_type',$course_type, array('empty' => '-- Choose Course Type --', 'disabled' => array(0),'class' => 'form-control','label' => false));?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Organization</label>
                                    <div class="col-md-9">
                                        
                                        <?php
                                            if ($organizations_count == 0 ) {
                                                $noAvailableOrganization = [
                                                    '1' => 'No Available Organizations'
                                                ];
                                                echo $this->Form->select('organization_id',$noAvailableOrganization, array('id' => 'organizations','class' => 'form-control','label' => false ));
                                            }
                                            else  {
                                                echo $this->Form->select('organization_id',$organizations, array('id' => 'organizations','class' => 'form-control','label' => false ));
                                            } 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Mission</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_mission', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Vision</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_vision', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false)); ?>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Goals</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_goal', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false)); ?>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Objectives</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('course_objective', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false)); ?>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Other</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('other_info', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false)); ?>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="form-group  row m-b-15">
                                    <div class="pull-right" style="margin-right: 1%">

                                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Add Course'), array('class' => 'btn btn-sm btn-yellow','escape' => false));
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
    <?php $this->Html->script("dropdown.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->

<!-- TinyMCE JS -->
<?php echo $this->Html->script("tinymce/tinymce.js")?>
<?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    
    <script>
        $(document).ready(function() {
            App.init();
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