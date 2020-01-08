<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Admin Home </title>    
</head>


<body>
    <?php echo $this->element('AdminHeaderSideBar');?>
    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item active">Logged in: <?= $users->email ?></li>
        </ol>
        <!-- begin page-header -->
        <h1 class="page-header">Polytechnic University of the Philippines - Quezon City <small>Web Portal</small></h1>
        <!-- end page-header -->
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                    <i class="fa fa-star"></i>
                    <b> Current Events</b>
            </div>
                    <table>
                        <tbody>
                <?php
                  if (count($events) == 0) {
                ?>
                    <tr>
                      <td>
                          <p style="width: 100%;margin: 15% ">
                            No Ongoing Events
                          </p>
                      </td>
                    </tr>

                <?php
                  ;} else {
                ?>
                                    <?php foreach ($events as $event): ?>
                                    <tr>
                                        <td>
                                            <div class="panel-title">
                                                <p style="width: 100%;margin: 5%;color: #7e0e09 ">
                                                    <?= $event->event_title ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                <?php
                  }
                ?>
                                </tbody>
                            </table>
            </div>
            <!-- end panel-heading -->

            <!-- begin Upcoming Events -->
            <!-- begin panel-body -->

        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true" style="margin-top: 2%">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                    <i class="fa fa-star"></i>
                    <b> Upcoming Events</b>
            </div>
                    <table>
                        <tbody>
                <?php
                  if (count($upcomingEvents) == 0) {
                ?>
                    <tr>
                      <td>
                          <p style="width: 100%;margin: 15% ">
                            No Upcoming Events
                          </p>
                      </td>
                    </tr>

                <?php
                  ;} else {
                ?>
                                    <?php foreach ($upcomingEvents as $upcomingEvent): ?>
                                    <tr>
                                        <td>
                                            <div class="panel-title">
                                                <p style="width: 100%;margin: 15%;color: #7e0e09">
                                                    <?= $upcomingEvent->event_title ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                <?php
                  }
                ?>
                                </tbody>
                            </table>
            </div>
            <!-- end Upcoming Events -->
            <?php echo $this->Flash->render(); ?>
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