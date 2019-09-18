<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Edit Office Employee </title>
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
                                <i class="fa fa-edit"></i>
                                <b> Edit Office Employee</b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                                <?php echo $this->Form->create($office_employees,array('enctype'=>'multipart/form-data')); ?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Office Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('Office Name', array('class' => 'form-control','default' => $offices->office_name,'readonly' => true,'label' => false )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Employee Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_name', array('class' => 'form-control','label' => false,'default' => [$employee->employee_lastname,', ',$employee->employee_firstname,' ',substr($employee->employee_middlename,0,1),'.'],'readonly' => true )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Office Position</label>
                                    <div class="col-md-9">
                                        <?php
                                            if ($office_officers_positions_count == 0 ) {
                                                $noAvailablePosition = [
                                                ];
                                                echo $this->Form->select('office_position_id',$noAvailablePosition, array('id' => 'office_positions','class' => 'form-control','label' => false ));
                                            }
                                            else  {
                                                echo $this->Form->select('office_position_id',$positions, array('id' => 'office_positions','class' => 'form-control','label' => false ));
                                            } 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>  Edit Office Employee'), array('class' => 'btn btn-sm btn-yellow'));
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
    
    <script>
        $(document).ready(function() {
            App.init();
            AppendCurrentPosition();
            FormMultipleUpload.init();
        });

        function AppendCurrentPosition() {
            var currentPosition = new Option("<?php echo $office_employees->office_position_id ?>", "<?php echo $office_employees->office_position_id ?>");
            /// jquerify the DOM object 'o' so we can use the html method
            $(currentPosition).html("<?php echo $office_employees->office_position->office_position_name?>");
            $("#office_positions").append(currentPosition);
            $('#office_positions option[value=<?php echo $office_employees->office_position_id ?>]').attr('selected','selected');
            $("#office_positions select").val("<?php echo $office_employees->office_position_id ?>");
        }
    </script>

</html>