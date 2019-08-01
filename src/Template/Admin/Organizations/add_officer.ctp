<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Add Officer </title>
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
                                <i class="fa fa-user"></i>
                                <b> Add Officer </b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                                <?php echo $this->Form->create($organization_officer,array('enctype'=>'multipart/form-data')); ?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Organization Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('organization_id', array('type' => 'text','class' => 'form-control','label' => false, 'default' => $organization->organization_name, 'disabled'  => true, 'style' => 'background-color: fff;background : none; color: #000')); ?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Officer Position</label>
                                    <div class="col-md-9">
                                        <?php
                                            if ($organization_officers_positions_count == 0 ) {
                                                $noAvailablePosition = [
                                                    'No Available Position' => 'No Available Position'
                                                ];
                                                echo $this->Form->select('officers_position_id',$noAvailablePosition, array('class' => 'form-control','label' => false ));
                                            }
                                            else  {
                                                echo $this->Form->select('officers_position_id',$organization_officers_positions, array('class' => 'form-control','label' => false ));
                                            } 
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('officer_lastname', array('class' => 'form-control','label' => false ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('officer_firstname', array('class' => 'form-control','label' => false ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Middle Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('officer_middlename', array('class' => 'form-control','label' => false ));?> 
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Officer Photo</label>
                                    <div class="col-md-7">
                                        <span class="btn btn-yellow fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add image</span>
                                                <?php echo $this->Form->control('officer_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                                        </span>
                                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                                            <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                        </div>
                                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Add Officer'), array('id' => 'submit_button','class' => 'btn btn-sm btn-yellow'));
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
            <?php if ($organization_officers_positions_count == 0 ) {
            ?>
                $( "#submit_button" ).prop( "disabled", true );
            <?php
                }
            ?>
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