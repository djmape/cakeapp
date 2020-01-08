<!-- src/Template/Users/user_settings_profile.ctp -->

<?php echo $this->element('UserHeader');?>
<?php echo $this->element('UserSettingsSidebar');?>
<?php echo $this->Flash->render(); ?>

<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>

<!-- user custom css -->
<?php echo $this->Html->css("user.css")?>

        <!-- begin #content -->
        <div id="content" class="content">
            <h3>Edit Profile</h3>
                <!-- begin form -->
                <?php echo $this->Form->create($profile,array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));  
                ?>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Profile Photo</label>
                    <div class="col-md-9">
                        <span class="btn btn-yellow fileinput-button row m-b-15">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php echo $this->Form->control('user_profile_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                        </span>
                        <div id="img_contain" class="row m-b-15" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                        <?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block'));
                        ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%" class="row m-b-15">No image uploaded</label>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Cover Photo</label>
                    <div class="col-md-9">
                        <span class="btn btn-yellow fileinput-button row m-b-15">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php echo $this->Form->control('user_cover_photo', array('id' => 'cover-photo','type'=>'file','label' => false, 'required' => false));?>
                        </span>
                        <div id="img_contain" class="row m-b-15" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php echo $this->Html->image("../webroot/img/upload/".$profile->user_cover_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block'));
                        ?>
                        </div>
                        <label id="cover-photo-filename" style="margin-left: 1%" class="row m-b-15">No image uploaded</label>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Bio</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('user_profile_bio', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'admin_username','default' => $profile->user_profile_bio ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Confirm Password</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('confirm_password', array('class' => 'form-control','label' => false,'data-parsley-validate' => true,'data-toggle' => 'password', 'data-placement' => 'after', 'type' => 'password', 'placeholder' => '', 'id' => 'txtConfirmPassword' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15 pull-right">
                    <div class="col-md-9">
                        <?php echo $this->Form->button(__('<i class="fa fa-edit"></i> Update Profile'), array('class' => 'btn btn-sm btn-yellow','id'=>'confirm-button'));
                                echo $this->Form->end();?>
                    </div>
                </div>
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
<?php echo $this->Html->script("../plugins/bootstrap-show-password/bootstrap-show-password.js")?>
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


    $("#cover-photo").change(function(event) {  
        RecurFadeIn();
        readURLCoverPhoto(this); 
    });

    $("#cover-photo").on('click',function(event){
        RecurFadeIn();
    });

    function readURLCoverPhoto(input) {    
        if (input.files && input.files[0]) {   
            var reader = new FileReader();
            var filename = $("#cover-photo").val();
            filename = filename.substring(filename.lastIndexOf('\\')+1);
            reader.onload = function(e) {
                $('#cover-photo-preview').attr('src', e.target.result);
                $('#cover-photo-preview').hide();
                $('#cover-photo-preview').fadeIn(500);      
                $('#cover-photo-filename').text(filename);             
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