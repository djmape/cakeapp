<!-- src/Template/Admin/Employees/index.ctp --> 

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
                    Employees
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">All Employees</h1>
            <!-- end page-header -->

            <!-- begin Add Event button -->
            <?= $this->Html->link('<i class="fa fa-add"></i> Add Employee', ['action' => 'add'],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
            <!-- end Add Event button -->

            <!-- begin Add Event button -->
            <?= $this->Html->link('Employee Positions', ['controller' => 'EmployeePositions','action' => 'index'],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
            <!-- end Add Event button -->

            <!-- begin data table -->
            <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                <thead> 
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%;">
                            Faculty
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 40%;">
                            Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 20%;">
                            Position
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($employees as $i =>  $employee):
                    ?>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <?= $employee->employee_type ?>
                                </td>
                                <td>
                                    <b>
                                        <?= $employee->employee_lastname,', ',$employee->employee_firstname,' ',substr($employee->employee_middlename,0,1),'.' ?>
                                    </b>
                                </td>
                                <td>
                                    <?= $employee->employee_position_name->employee_position_name ?>
                                </td>
                                <td>
                                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $employee->employee_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $employee->employee_lastname . ', ' . $employee->employee_firstname . ' ' .substr($employee->employee_middlename,0,1) . '.' ]) ?>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $employee->employee_id ?> )" title="Delete <?php echo$employee->employee_lastname,', ',$employee->employee_firstname,' ',substr($employee->employee_middlename,0,1),'.' ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
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

        function confirmDelete($employee_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Employees","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Employees","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to delete employee information?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'employee_id' : $employee_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
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