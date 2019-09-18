<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Edit Employee Information </title>
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
                                <b> Edit Employee Information </b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                                <?php  
                                    $employee_type = [
                                        'Faculty' => 'Faculty',
                                        'The Officials' => 'The Officials',
                                        'Non-Faculty' => 'Non-Faculty',
                                        'Admin' => 'Admin',
                                        'Teaching' => 'Teaching',
                                        'Non-Teaching' => 'Non-Teaching',
                                        'University Employees' => 'University Employees'
                                    ];
                                    

                                    echo $this->Form->create($employee,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); ?>
                            <form class="form-horizontal">
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Faculty</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('employee_type',$employee_type, array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'disabled' => array(0), 'empty' => '-- Select Faculty --', 'required' => true, 'default' => $row->employee_type )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_lastname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'default' => $row->employee_lastname ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_firstname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'default' => $row->employee_firstname ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Middle Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_middlename', array('class' => 'form-control','label' => false, 'required' => false, 'default' => $row->employee_middlename ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Position</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('employee_position_id',$employee_positions, array('class' => 'form-control','label' => false, 'disabled' => array(0), 'empty' => '-- Select Position --','default', 'required' => true, 'default' => $row->employee_position_id  )); ?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_email', array('class' => 'form-control','label' => false, 'required' => false, 'default' => $row->employee_email )); ?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Employee Photo</label>
                                    <div class="col-md-7">
                                        <span class="btn btn-yellow fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add image</span>
                                                <?php echo $this->Form->control('employee_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false, 'default' => $row->employee_photo));?>
                                        </span>
                                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                                            <?php echo $this->Html->image("../webroot/img/upload/".$row->employee_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                        </div>
                                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i>  Update Employee Details'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
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


        $("#inputGroupFile01").change(function(event) {  
            RecurFadeIn();
            readURL(this); 
        });

        $("#inputGroupFile01").on('click',function(event){
            RecurFadeIn();
        });

        function readURL(input) {    
            if (input.files && input.files[0]) {   
                var reader = new FileReader();
                var filename = $("#inputGroupFile01").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                    $('#img_preview').attr('src', e.target.result);
                    $('#img_preview').hide();
                    $('#img_preview').fadeIn(500);      
                    $('#img_filename').text(filename);             
                }
                reader.readAsDataURL(input.files[0]);    
            } 
            $(".alert").removeClass("loading").hide();
        }

        function RecurFadeIn(){ 
            console.log('ran');
            FadeInAlert("Wait for it...");  
        }

        function FadeInAlert(text){
            $(".alert").show();
            $(".alert").text(text).addClass("loading");  
        }

    </script>

</html>