<!-- src/Template/Admin/Offices/index.ctp --> 

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
                <li class="breadcrumb-item active">
                    Offices
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">All Offices</h1>
            <!-- end page-header -->

            <!-- begin Add Event button -->
            <?= $this->Html->link('<i class="fa fa-add"></i> Add Office', ['action' => 'add'],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
            <!-- end Add Event button -->

            <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 5%;">
                            Office Photo
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 65%px;">
                            Office Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 5%;">
                            Priority
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 22%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($offices as $i => $office): 
                    ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <?php echo $this->Html->image("../webroot/img/upload/".$office->office_photo, array('class' => 'center-block','style' => 'max-width: 50px; max-height: 50px')); ?>
                                </td>
                                <td>
                                    <b><?= $office->office_name ?></b>
                                </td>
                                <td>
                                    <b><?= $office->priority ?></b>
                                </td>
                                <td class="actions">
                                    <div class="pull-right center-block">
                                        <?= $this->Html->link('<i class="fa fa-user"></i>View Officers', ['action' => 'positions', $office->office_id],['class' => 'btn btn-primary btn-sm','escape' => false, 'style' => 'color: black', 'title' => 'View officers in ' . $office->office_name] ) ?>
                                        <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $office->office_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $office->office_name ]) ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $office->office_id ?> )" title="Delete <?php echo $office->office_name ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div> 
                                </td>
                            </tr>
                    <?php 
                        endforeach; 
                    ?>
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

<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-default.demo.min.js")?>
<?php $this->Html->script("/apps.min.js")?>
<?php $this->Html->script("button.js")?>
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

        function confirmDelete($office_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Offices","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Offices","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to remove office?",
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
                            'office_id' : $office_id
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