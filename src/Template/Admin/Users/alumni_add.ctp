<!-- src/Template/Admin/Users/admin_add.ctp -->

<?php echo $this->element('AdminHeaderSideBar');?>
<?php echo $this->Flash->render(); ?>

<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>

        <!-- begin #content -->
        <div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Home',['prefix' => "admin", 'controller' => 'Dashboard','action'=>'index']) ?>
                </li>
				<li class="breadcrumb-item">
                	<?php echo $this->Html->link('Alumni',['prefix' => "admin", 'controller' => 'Users','action'=>'alumniAll']) ?>
              	</li>
                <li class="breadcrumb-item active">
                    <?php echo $this->Html->link('Add User',['prefix' => "admin", 'controller' => 'Users','action'=>'alumniAdd']) ?>
                </li>
			</ol>
			<!-- end breadcrumb -->

			<!-- begin page-header -->
			<h1 class="page-header">Add User: Alumni</h1>
			<!-- end page-header -->
			
            <!-- begin form -->	
            <?php echo $this->Form->create($alumni,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); ?>
            <form class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_alumni_lastname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'alumni_lastname' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_alumni_firstname', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'alumni_firstname' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Middle Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_alumni_middlename', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'alumni_middlename' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('email', array('class' => 'form-control','label' => false,'data-parsley-validate' => true ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Username</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('username', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'alumni_username' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Course</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('course_id',$courses, array('class' => 'form-control','label' => false, 'disabled' => array(0), 'empty' => '-- Select Course --','default', 'required' => true  )); ?> 
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Student Number</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_alumni_student_number', array('class' => 'form-control','label' => false,'data-parsley-validate' => true ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Year Graduated</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_alumni_year_graduated', array('class' => 'form-control','label' => false,'data-parsley-validate' => true ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">User Photo</label>
                    <div class="col-md-9">
                        <span class="btn btn-yellow fileinput-button row m-b-15">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php echo $this->Form->control('user_alumni_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                        </span>
                        <div id="img_contain" class="row m-b-15" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%" class="row m-b-15">    No image uploaded
                        </label>
                    </div>
                </div>
                <div class="form-group row m-b-15 pull-right">
                    <div class="col-md-9">
                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Add User'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();?>
                    </div>
                </div>
            </form>
            <!-- end form -->
        </div>
        <!-- end #content -->
	</div>
    <!-- end #container -->
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
		TableManageTableSelect.init();
        $('#data-table-select').DataTable();
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

    $('#alumni_username').on('click', function() {
        $('#alumni_username').val(($('#alumni_lastname').val() + $('#alumni_firstname').val() + $('#alumni_middlename').val()).toLowerCase());
    });

    </script>

</html>