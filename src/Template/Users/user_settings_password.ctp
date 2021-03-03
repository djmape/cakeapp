<!-- src/Template/Users/user_settings_profile.ctp -->

<?php echo $this->element('UserSettingsSidebar');?>
<?php echo $this->Html->css("front.css")?>

<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>

<!-- user custom css -->

        <!-- begin #content -->
        <div id="content" class="content">
            <h3>Edit Password</h3>
            <br>
            <!-- begin form -->
            <?php echo $this->Form->create($user_password,array('enctype'=>'multipart/form-data')); ?>
            <div class="form-group row m-b-15">
                <label class="col-md-3 col-form-label">Current Password</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('current_password', array('type' => 'password','id' => 'current_password','style' => '','class' => 'form-control', 'label' => false,'data-toggle' => 'password', 'data-placement' => 'after', 'type' => 'password', 'placeholder' => '', 'onfocusout' => 'checkPasswordIsMatched()' )); ?>
                    </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-3 col-form-label">New Password</label>
                <div class="col-md-9">
                    <?php echo $this->Form->control('new_password', array( 'type' => 'password','id' => 'new_password','style' => '','class' => 'form-control', 'label' => false,'onfocusout' => 'checkPasswordIsMatched()','data-toggle' => 'password', 'data-placement' => 'after', 'type' => 'password', 'placeholder' => '', 'onfocusout' => 'checkPasswordIsMatched()' )); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-3 col-form-label">Confirm Password</label>
                <div class="col-md-9">
                    <?php echo $this->Form->control('confirm_password', array( 'type' => 'password','id' => 'confirm_password','style' => '','class' => 'form-control', 'label' => false,'onfocusout' => 'checkPasswordIsMatched()','data-toggle' => 'password', 'data-placement' => 'after', 'type' => 'password', 'placeholder' => '', 'onfocusout' => 'checkPasswordIsMatched()')); ?>
                </div>
            </div>
            <div class="form-group row m-b-15 pull-right" style="margin-right: 0.5%">
                <small>
                    <label class="password-not-matched" style="color: red;margin-right: 0.5%"></label>
                </small>
                    <?php echo $this->Form->button(__('<i class="fa fa-key"></i> Change Password'), array('class' => 'btn btn-sm btn-yellow','id' =>"submit_button"));
                        echo $this->Form->end();
                    ?>
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
            $( "#submit_button" ).prop( "disabled", true );
            checkPasswordIsMatched();
    });


        function checkPasswordIsMatched() {
            
            if($("#current_password").val().length > 0 && $("#new_password").val().length > 0 && $("#confirm_password").val().length > 0)
            {
                if ($('#new_password').val() == $('#confirm_password').val()) {
                    $( "#submit_button" ).prop( "disabled", false );
                    $(".password-not-matched").html('');
                }
                else {
                    $( "#submit_button" ).prop( "disabled", true );
                    $(".password-not-matched").text('Password does not match');
                }
            }
            else {
                $( "#submit_button" ).prop( "disabled", true );
            }

        }

    </script>

</html>