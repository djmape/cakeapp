<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Organization Officers </title>
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
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== Sweet Alert ================== -->
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>

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
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h5> 
                                <i class="fa fa-users"></i>
                                <b> <?= $organization->organization_name ?> </b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                            <button type="button" class="row m-b-15 btn btn-yellow btn-sm" style="margin-left: 0.5%">
                                <i class="fa fa-plus">
                                </i>
                                <?= $this->Html->link('Add Officer', ['action' => 'addOfficer', $organization->organization_id]) ?>
                            </button>
                            <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                                        #
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 40%px;">
                                                        Officer Name
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 40%px;">
                                                        Position
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 17%;">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                <?php foreach ($organization_officers as $i => $organization_officer): ?>
                                    <tr>
                                        <td>
                                            <?= $i + 1?>
                                        </td>
                                        <td>
                                            <b>
                                                <?= $organization_officer->officer_lastname,', ',$organization_officer->officer_firstname,' ',substr($organization_officer->officer_middlename,0,1),'.' ?>
                                            </b>
                                        </td>
                                        <td>
                                            <?= $organization_officer->organization_officers_position->officers_position_name ?>
                                        </td>
                                        <td>
                                            <div class="pull-right center-block">
                                                <button type="button" class="btn btn-info btn-sm">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                    <?= $this->Html->link('Edit', ['action' => 'editOfficer', $organization_officer->organization_officer_id, $organization->organization_id]) ?>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $organization_officer->organization_officer_id ?> )">
                                                    <i class="fa fa-trash">
                                                    </i>
                                                    Remove
                                                </button>
                                            </div>                                            
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            <!-- end table -->
                            </table>
                        <!-- end col-sm-12 -->
                        </div>
                    <!-- end row -->
                    </div>
                <!-- end data-table_wrapper -->
                </div>
                <!-- panel-body -->
                </div>
        <!-- end panel -->
        </div>
    <!-- end col-md-12 ui-sortable -->
    </div>
    <!-- end row -->
</div>
</div>
</div>

</body>



<!-- ================== BEGIN BASE JS ================== -->
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
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

        <!-- datatable scripts -->
            <?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
            <?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
            <?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
            <?php echo $this->Html->script("table-manage-default.demo.min.js")?>
        <!-- -->
    <?php $this->Html->script("/apps.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
            $('#data-table').DataTable();
        });

       
       function confirmDelete($organization_officer_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Organizations","action"=>"removeOfficer"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Organizations","action"=>"officers"]); ?>' + '\\' + <?= $organization->organization_id ?> ;
            swal({
                title: "Are you sure?",
                text: "You want to remove officer?",
                type: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                cancelButtonColor: 'orange',
                confirmButtonClass: "btn btn-danger btn-sm",
                cancelButtonClass: "btn-info",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'organization_officer_id' : $organization_officer_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError , "error");
                            }
                        });
                    }
                });
        }

    </script>

</html>