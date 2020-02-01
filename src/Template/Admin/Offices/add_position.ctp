<!-- src/Template/Admin/Offices/add_position.ctp --> 

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
                        Add Officer
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header">Edit Office</h1>
                <!-- end page-header -->

                <!-- begin form -->
                <?php echo $this->Form->create($office_employees,array('enctype'=>'multipart/form-data')); ?>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Office Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('Office Name', array('class' => 'form-control','default' => $offices->office_name,'readonly' => true,'label' => false)); ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Employee Name</label>
                    <div class="col-md-9">
                        <?php
                            if ($employee_count == 0 ) {
                                $noAvailableEmployee = [
                                    'No Available Employee' => 'No Available Employee'
                                ];
                                echo $this->Form->select('employee_id',$noAvailableEmployee, array('class' => 'form-control','label' => false ));
                            }
                            else  {
                                echo $this->Form->select('employee_id',$employees, array('class' => 'form-control','label' => false ));
                            } 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Office Position</label>
                    <div class="col-md-9">
                        <?php
                            if ($office_officers_positions_count == 0 ) {
                                $noAvailablePosition = [
                                    'No Available Position' => 'No Available Position'
                                ];
                                echo $this->Form->select('office_position_id',$noAvailablePosition, array('class' => 'form-control','label' => false ));
                            }
                            else  {
                                echo $this->Form->select('office_position_id',$positions, array('class' => 'form-control','label' => false ));
                            } 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right" style="margin-right: 1%">
                    <?php 
                        echo $this->Form->button(__('<i class="fa fa-plus"></i> Add Employee'), array('id' => 'submit_button','class' => 'btn btn-sm btn-yellow'));
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
            <?php if ($office_officers_positions_count == 0 || $employee_count == 0) {
            ?>
                $( "#submit_button" ).prop( "disabled", true );
            <?php
                }
            ?>
            FormMultipleUpload.init();
        });
    </script>

</html>