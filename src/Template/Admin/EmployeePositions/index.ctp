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
            <!-- begin page-header -->
            <h1 class="page-header">Employee Positions</h1>
            <!-- end page-header -->
            <!-- begin Add Event button -->
            <?= $this->Html->link('<i class="fa fa-plus"></i> Add Employee Position', ['action' => 'add'],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
            <!-- end Add Event button -->
                                        <table id="data-table" class="table table-striped table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                                            <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                            #
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%;">
                                            Employee Position
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%;">
                                            Priority
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 20%;">
                                        </th>
                                    </tr>
                                            </thead>
                                        <tbody>
                                    <?php foreach ($employee_positions as $i => $employee_position): ?>
                                    <tr>
                                        <td>
                                            <?= $i + 1?>
                                        </td>
                                        <td>
                                            <b>
                                                <?= $employee_position->employee_position_name ?>
                                            </b>
                                        </td>
                                        <td>
                                            <?= $employee_position->employee_position_priority ?>
                                        </td>
                                        <td>
                                            <div class="pull-right center-block">
                                                    
                                                    <?= $this->Html->link('<i class="fa fa-edit">
                                                    </i>', ['action' => 'edit', $employee_position->employee_position_id],['class' => 'btn btn-yellow btn-sm', 'escape' => false]) ?>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $employee_position->employee_position_id ?> )">
                                                    <i class="fa fa-trash">
                                                    </i>
                                                </button>
                                            </div> 
                                            
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            <!-- end table -->
                            </table>
</div>
</div>

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
            TableManageDefault.init();
            $('#data-table').DataTable();
        });

        function confirmDelete($employee_position_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"EmployeePositions","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"EmployeePositions","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to delete employee position?",
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
                            data: {'employee_position_id' : $employee_position_id},
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