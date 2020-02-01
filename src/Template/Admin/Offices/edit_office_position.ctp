<!-- src/Template/Admin/Offices/edit_office_position.ctp --> 

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

                <!-- begin breadcrumb -->
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item">
                        <?php echo $this->Html->link('Offices',['prefix' => "admin", 'controller' => 'Offices','action'=>'index']) ?>
                    </li>
                    <li class="breadcrumb-item">
                        <?= $this->Html->link($offices->office_name, ['action' => 'positions', $offices->office_id] ) ?>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Officer
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header">Edit Officer</h1>
                <!-- end page-header -->

                <!-- begin form -->
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

                <div class="form-group row m-b-15 pull-right">
                    <?php 
                        echo $this->Form->button(__('<i class="fa fa-edit"></i>  Edit Office Employee'), array('class' => 'btn btn-sm btn-yellow'));
                        echo $this->Form->end();
                    ?>
                </div>

            </div>
            <!-- end #content -->
        </div>
        <!-- end container -->
    </body>
    <!-- end body -->


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