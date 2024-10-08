<!-- src/Template/Admin/Employees/add.ctp --> 

        <!-- begin include -->
        <?php echo $this->element('AdminHeaderSideBar');?>
        <?php echo $this->Html->css("admin.css"); ?> 
        <?php echo $this->Flash->render(); ?>

        <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
            <?php echo $this->Html->css("../plugins/bootstrap-select/bootstrap-select.min.css"); ?> 
            <?php echo $this->Html->css("../plugins/select2/dist/css/select2.min.css"); ?> 
        <!-- end include -->

        <!-- begin #content -->
        <div id="content" class="content">

            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Employees',['prefix' => "admin", 'controller' => 'Employees','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    Add Employee
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">Add Employee</h1>
            <!-- end page-header -->
            
            <!-- begin form -->
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

                echo $this->Form->create($employees,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); 
            ?>

            <form class="form-horizontal">
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Faculty</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('employee_type',$employee_type, array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'disabled' => array(0), 'empty' => '-- Select Faculty --', 'required' => true  )); ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('employee_lastname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true ));?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('employee_firstname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true ));?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Middle Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('employee_middlename', array('class' => 'form-control','label' => false, 'required' => false ));?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Position</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('employee_position_id',$employee_positions, array('class' => 'form-control','label' => false, 'disabled' => array(0), 'empty' => '-- Select Position --','default', 'required' => true  )); ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('employee_email', array('class' => 'form-control','label' => false, 'required' => false )); ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Employee Photo</label>
                    <div class="col-md-9">
                        <span class="btn btn-yellow fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php echo $this->Form->control('employee_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                        </span>
                        <div id="img_contain" class="col-md-6" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 col-form-label">Link User</label>
                    <div class="col-md-9">
                        <?php
                                $noAvailableUser = [
                                ];
                            if ($users_count == 0 ) {
                                $noUser = [
                                ];
                                echo $this->Form->select('user_id',$noUser, ['class' => 'form-control selectpicker', 'data-size' => 'form-control','data-live-search' => true, 'data-style' => 'btn-white' ,'label' => false ]);
                            }
                            else  {
                                echo $this->Form->select('user_id',$assignUsers, ['class' => 'form-control selectpicker', 'data-size' => 'form-control','data-live-search' => true, 'data-style' => 'btn-white' ,'label' => false, 'data-size' => '1']);
                            } 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right" style="margin-right: 1%">
                    <?php 
                        echo $this->Form->button(__('<i class="fa fa-plus"></i> Add Employee'), array('class' => 'btn btn-sm btn-yellow'));
                        echo $this->Form->end();
                    ?>
                </div>

            </form>
            <!-- end form -->
        </div>
        <!-- end #content -->
    </div>
    <!-- end container -->
</body>


<!-- Include Base JS -->
<?php echo $this->element('base_js');?>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Select/js/dataTables.select.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-select.demo.min.js")?>
<?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
<?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
<?php echo $this->Html->script("apps.min.js")?>

<?php $this->Html->script("button.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-audio.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-image.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-process.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-ui.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-validate.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-video.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.iframe-transport.js")?>

    <?php echo $this->Html->script("../plugins/bootstrap-select/bootstrap-select.min.js")?>
    <?php echo $this->Html->script("../plugins/select2/dist/js/select2.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>

    $(document).ready(function() {
        App.init();
            $('.selectpicker').selectpicker();
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