<!-- src/Template/Admin/Events/index.ctp -->
        <?php echo $this->element('AdminHeaderSideBar');?>
        <?php echo $this->Html->css("admin.css"); ?> 
        <?php echo $this->Flash->render(); ?>

        <!-- begin #content -->
        <div id="content" class="content">
            
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item active">
                    Events
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">All Events</h1>
            <!-- end page-header -->

            <!-- begin Add Event button -->
            <?= $this->Html->link('<i class="fa fa-add"></i> Add Event', ['action' => 'add'],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
            <!-- end Add Event button -->

            <!-- begin table -->
            <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #   
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            Status
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 5%;">
                            Poster
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 35%;">
                            Event Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 15%px;">
                            Start
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 15%;">
                            End
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 12%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Here is where we iterate through our $articles query object, printing out article info -->
                    <?php foreach ($event as $i => $event): ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <?= $event->event_status ?>
                            </td>
                            <td>
                                <?php echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'center-block','style' => 'max-width: 50px; max-height: 50px')); ?>
                            </td>
                            <td>
                                <b>
                                    <?= $event->event_title ?>
                                </b>
                            </td>
                            <td>
                                <?= $event->event_start_date->format('l, F d, Y') ?>
                                <?= $event->event_start_time->format('g:i A') ?>
                            </td>
                            <td>
                                <?= $event->event_end_date->format('l, F d, Y') ?>
                                <?= $event->event_end_time->format('g:i A') ?>
                            </td>
                            <td>
                                <div class="pull-right center-block">
                                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $event->event_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $event->event_title ]) ?>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $event->event_id ?> )" title="Delete <?php echo $event->event_title ?>">
                                        <i class="fa fa-trash">
                                        </i>
                                    </button>
                                </div>  
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- end table -->
        </div>
        <!-- end #content -->
    </div>
    <!-- end container -->
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
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            TableManageTableSelect.init();
            $data_table = $('#data-table-select').DataTable();
 
            $data_table.on( 'order.dt search.dt', function () {
            $data_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
                } );
             } ).draw();
            $(".dataTables_paginate").addClass("pull-right");
            $("#data-table-select_filter").addClass("pull-right");
        });

        function confirmDelete($event_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Events","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Events","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to delete event?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url: targeturl,
                        data: {
                            'event_id' : $event_id
                        },
                        success:function(query)  {
                            window.location = redirectURL;
                        },
                        error:function(xhr, ajaxOptions, thrownError) {
                            swal("Error", thrownError, "error");
                        }
                    });
                }
            });
        }

    </script>

</html>