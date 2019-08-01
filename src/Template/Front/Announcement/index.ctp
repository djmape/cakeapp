<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> PUPQC | Announcements </title>
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

    <style type="text/css">
        body {
            background-color: white;
        }

        #content {
            background-color: white;
        }
        .container {
            background-color: #fff;
        }
        .btn a {
            color: #fff;
        }
        a {
            color: #7e0e09;
        }

        a:hover {
            color: #7e0e09;
            text-decoration: underline;
        }
    </style>

</head>


<body>
    <?php echo $this->element('NavBar');?>
            
         <!-- begin row -->
<div id="content" class="content">
    
    <h1 class="page-header" style="color: #7e0e09;">
            <span class="fa fa-info"></span>
             Announcements
    </h1>
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-body">
                            <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-table" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                                            <thead>
                                                    <th>
                                                    </th>
                                            </thead>
                                        <tbody>
                                    <?php foreach ($announcements as $announcement): ?>
                                    <tr>
                                        <td>
                                            <div class="panel-title">
                                                <h3>
                                                	<?= $this->Html->link($announcement->announcement_title, ['action' => 'view', $announcement->announcement_id]) ?> 
                                                </h3>
                                                <?= $announcement->announcement_modified->format('l, F d, Y g:i A') ?>
                                            </div>
                                            <div class="panel-body">

                          <?php 
                            if (strlen($announcement->announcement_body) >= 500 )  {
                          ?>
                            <h5>
                              <?= substr($announcement->announcement_body,0,500) ?>
                              <small style="font-size: 12px">
                                <?= $this->Html->link('. . .read more', ['action' => 'view', $announcement->announcement_id]) ?>
                              </small>
                            </h5>
                          <?php
                            }
                            else {
                          ?>
                            <h5><?= $announcement->announcement_body ?></h5>
                          <?php
                            }
                          ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
        </div>
    </div>
    </div>
</div>
</div>
    <?php echo $this->element('footer');?>
</body>
<footer></footer>
    


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
    <?php $this->Html->script("button.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
            $('#data-table').DataTable();
        });
        

    </script>

</html>