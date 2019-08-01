<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Events </title>
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
</head>


<body>
    <?php echo $this->element('AdminSideBar');?>
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>
            <li class="breadcrumb-item active">Form Elements</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Form Elements <small>header small text goes here...</small></h1>
        <!-- end page-header -->
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= $row->office_name ?></h4>
                        </div>
                        <div class="panel-body">
                            <button type="button" class="btn btn-info btn-sm">
                                <?php echo $this->Html->link('All Employees',array('prefix' => "admin", 'controller' => 'OfficeEmployees','action'=> 'add')) ?></li>
                                            </button>
                            <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="data-table_length"><label>Show <select name="data-table_length" aria-controls="data-table" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="data-table_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="data-table"></label></div></div></div><div class="row"><div class="col-sm-12">

                            <table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                            #
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 45%px;">
                                            Office Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 45%px;">
                                            Position
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 20%;">
                                            <button type="button" class="btn btn-info btn-sm">
                                                <i class="fa fa-plus">
                                                </i>
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-o">
                                                </i>
                                                Delete
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- Here is where we iterate through our $articles query object, printing out article info -->
                                <?php foreach ($office_employees as $office_employee): ?>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <?= $this->Html->link($office_employee->employee->employee_name, ['action' => 'edit', $row->office_id]) ?>
                                        </td>
                                        <td>
                                            <?= $this->Html->link('Remove', ['action' => 'delete', $row->office_id]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row"><div class="col-sm-5">
                        <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">
                            Showing 1 to 10 of 57 entries
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                            <ul class="pagination">
                                <li class="paginate_button previous disabled" id="data-table_previous">
                                    <a href="#" aria-controls="data-table" data-dt-idx="0" tabindex="0">Previous</a>
                                </li>
                                <li class="paginate_button active">
                                    <a href="#" aria-controls="data-table" data-dt-idx="1" tabindex="0">1</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="data-table" data-dt-idx="2" tabindex="0">2</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="data-table" data-dt-idx="3" tabindex="0">3</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="data-table" data-dt-idx="4" tabindex="0">4</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="data-table" data-dt-idx="5" tabindex="0">5</a>
                                </li>
                                <li class="paginate_button ">
                                    <a href="#" aria-controls="data-table" data-dt-idx="6" tabindex="0">6</a>
                                </li>
                                <li class="paginate_button next" id="data-table_next">
                                    <a href="#" aria-controls="data-table" data-dt-idx="7" tabindex="0">Next</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
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