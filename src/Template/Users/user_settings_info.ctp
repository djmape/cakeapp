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
            <h3>Edit Information</h3>
            <br>
            <?php echo $this->Form->create($user_info,array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));  
                ?>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('email', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'admin_username','type' => 'email','default' => $user->user->email ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Confirm Password</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('confirm_password', array('class' => 'form-control','label' => false,'data-parsley-validate' => true,'data-toggle' => 'password', 'data-placement' => 'after', 'type' => 'password', 'placeholder' => '' ));?>
                    </div>
                </div>
                <div class="form-group row m-b-15 pull-right">
                    <div class="col-md-9">
                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Update Information'), array('class' => 'btn btn-sm btn-yellow'));
                              echo $this->Form->end();?>
                    </div>
                </div>
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

</script>

</html>