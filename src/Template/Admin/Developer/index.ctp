<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | About </title>
    
</head>


<body>
    <?php echo $this->element('AdminHeaderSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content"> 
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">
                    <?php echo $this->Html->link('Emails',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index']) ?>
                </li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">About</h1>
            <!-- end page-header -->           
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h5>
                    <i class="fa fa-info"></i>
                    <b> About</b>
                </h5>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <?php echo $this->Flash->render(); ?>
                    <div class="panel-body">
                        <?php echo $this->Form->create($about,array('class'=>'form-horizontal')); ?>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">About</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_description', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_description )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Mission</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_mission', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_mission )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Vision</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_vision', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_vision )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Goals</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_goals', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_goals )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Objective</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_objective', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_objective )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Additional Info</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_additional_info', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_additional_info )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Hymn</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('about_hymn', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default'=> $row->about_hymn )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <div class="pull-right" style="margin-right: 1%">
                                        <?php echo $this->Form->button(__('Update About Information'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
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
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
    <?php $this->Html->script("/apps.min.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify | link unlink | image",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

        
    </script>

</html>