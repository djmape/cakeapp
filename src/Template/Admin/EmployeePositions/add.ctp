<!-- src/Template/Admin/Employees/index.ctp --> 

        <!-- begin include -->
        <?php echo $this->element('AdminHeaderSideBar');?>
        <?php echo $this->Html->css("admin.css"); ?> 
        <?php echo $this->Flash->render(); ?>

        <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
        <!-- end include -->

        <!-- begin #content -->
    <div id="content" class="content">
            <!-- begin page-header -->
            <h1 class="page-header">Add Employee Position</h1>
            <!-- end page-header -->
                    <div class="panel-body">
                        <?php echo $this->Form->create($employee_positions);?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Position Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_position_name', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Position Description</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_position_description', array('class' => 'form-control','label' => false,'type' => 'textarea')); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Priority</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('employee_position_priority', array('class' => 'form-control','label' => false,'type' => 'number')); ?>
                                        <small class="f-s-12 text-grey-darker">Set priority by number. 1 highest</small>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15 pull-right" style="margin-right: 1%">
                                    <?php echo $this->Form->button(__('<i class="fa fa-plus"></i>  Add Employee Position'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                </div>
                    </div>
            <!-- end panel-body -->
        </div>
</div>

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

<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-default.demo.min.js")?>
<?php $this->Html->script("/apps.min.js")?>
<?php $this->Html->script("button.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

</html>