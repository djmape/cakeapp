<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Edit Office Position </title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php echo $this->Html->css("../plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>
    <?php echo $this->Html->css("bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/font-awesome/css/font-awesome.min.css"); ?>
    <?php echo $this->Html->css("animate.min.css")?>
    <?php echo $this->Html->css("style.min.css")?>
    <?php echo $this->Html->css("style-responsive.min.css")?>
    <?php echo $this->Html->css("theme/default.css")?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <?php echo $this->Html->css("../plugins/isotope/isotope.css")?> 
    <?php echo $this->Html->css("../plugins/lightbox/css/lightbox.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <!-- ================== END BASE JS ================== -->

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    
</head>


<body>
    <?php echo $this->element('AdminSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item active">Logged in: <?= $users->email ?></li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Polytechnic University of the Philippines - Quezon City <small>Web Portal</small></h1>
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                            <h5>
                                <i class="fa fa-plus"></i>
                                <b> Edit Office Position </b>
                            </h5>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
                    <div class="panel-body">
                        <?php
                            $priority = [
                                        1 => 1,
                                        2 => 2,
                                        3 => 3,
                                        4 => 4,
                                        5 => 5,
                                        6 => 6,
                                        7 => 7,
                                        8 => 8,
                                        9 => 9,
                                        10 => 10
                            ];
                            echo $this->Form->create($office_positions);
                        ?>
                            
                            
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Position Name</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('office_position_name', array('class' => 'form-control','label' => false, 'default' => $row->office_position_name )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Priority</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->select('office_position_priority',$priority, array('class' => 'form-control', 'default' => $row->office_position_priority )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('Add Office Position'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
                                </div>
                    </div>
            <!-- end panel-body -->
        </div>
</div>

</body>


<!-- ================== BEGIN BASE JS ================== -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php $this->Html->script("/apps.min.js")?>
    <?php $this->Html->script("button.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

</html>