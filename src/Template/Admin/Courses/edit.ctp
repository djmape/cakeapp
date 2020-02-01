<!-- src/Template/Admin/Courses/edit.ctp --> 

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
                        <?php echo $this->Html->link('Courses',['prefix' => "admin", 'controller' => 'Courses','action'=>'index']) ?>
                    </li>
                    <li class="breadcrumb-item active">
                    Edit Course
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"> Edit Course </h1>
                <!-- end page-header -->

                <!-- begin form -->
                <?php  
                    $course_type = [
                        'Undergraduate Courses' => 'Undergraduate Courses'
                    ];
                    echo $this->Form->create($course);
                ?>  

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Course Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('course_name', array('class' => 'form-control','label' => false,'default'=> $row->course_name)); ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Acronym</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('course_acronym', array('class' => 'form-control','label' => false,'default'=> $row->course_acronym)); ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Course Type</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->select('course_type',$course_type, array('empty' => '-- Choose Course Type --', 'disabled' => array(0),'class' => 'form-control','label' => false,'default'=> $row->course_type));?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Organization</label>
                    <div class="col-md-9">
                        <?php
                            if ($organizations_count == 0 ) {
                                $noAvailableOrganization = [
                                ];

                            echo $this->Form->select('organization_id',$noAvailableOrganization, array('id' => 'organizations','class' => 'form-control','label' => false ));
                            }
                            else  {
                                echo $this->Form->select('organization_id',$organizations, array('id' => 'organizations','class' => 'form-control','label' => false ));
                            } 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Mission</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('course_mission', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false,'default'=> $row->course_mission)); ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Vision</label>
                    <div class="col-md-9">
                        <?php 
                            echo $this->Form->control('course_vision', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false,'default'=> $row->course_vision));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Goals</label>
                    <div class="col-md-9">
                        <?php 
                            echo $this->Form->control('course_goal', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false,'default'=> $row->course_goal));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Objectives</label>
                    <div class="col-md-9">
                        <?php 
                            echo $this->Form->control('course_objective', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false,'default'=> $row->course_objective)); 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Other</label>
                    <div class="col-md-9">
                        <?php 
                            echo $this->Form->control('other_info', array('type' => 'textarea','class' => 'form-control wysiwyg','label' => false,'default'=> $row->other_info));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right" style="margin-right: 0.5%">
                    <?php 
                        echo $this->Form->button(__('Edit Course'), array('class' => 'btn btn-sm btn-yellow'));
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

    <!-- TinyMCE JS -->
    <?php echo $this->Html->script("tinymce/tinymce.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>

        $(document).ready(function() {
            App.init();
            AppendCurrentPosition();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

        function AppendCurrentPosition() {
            var currentPosition = new Option("<?php echo $row->organization_id ?>", "<?php echo $row->organization_id ?>");
            /// jquerify the DOM object 'o' so we can use the html method
            $(currentPosition).html("<?php echo $row->organization->organization_name?>");
            $("#organizations").append(currentPosition);
            $('#organizations option[value=<?php echo $row->organization_id ?>]').attr('selected','selected');
            $("#organizations select").val("<?php echo $row->organization_id ?>");
        }
    
    </script>

</html>