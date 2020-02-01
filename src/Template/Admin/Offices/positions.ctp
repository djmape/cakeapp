<!-- src/Template/Admin/Offices/positions.ctp --> 

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
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Offices',['prefix' => "admin", 'controller' => 'Offices','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    <?= $offices->office_name ?>
                </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"><?= $offices->office_name ?></h1>
                <!-- end page-header -->

                <!-- begin Add Officer button -->
                <?= $this->Html->link('<i class="fa fa-add"></i> Add Officer', ['action' => 'addPosition', $offices->office_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
                <!-- end Add Officer button -->
            
                <!-- begin data-table -->

                <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                #
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 45%px;">
                                Employee Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 45%px;">
                                Position
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($office_employees as $i => $office_employee):
                        ?>
                                <tr>
                                    <td>
                                    </td>
                                <td>
                                    <b>
                                        <?= $office_employee->employee->employee_lastname,', ',$office_employee->employee->employee_firstname,' ',substr($office_employee->employee->employee_middlename,0,1),'.' ?>
                                    </b>
                                </td>
                                <td>
                                    <?= $office_employee->office_position->office_position_name ?>
                                </td>
                                <td>
                                    <div class="pull-right center-block">                              
                                        <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'editOfficePosition', $office_employee->office_employees_id, $offices->office_id, $office_employee->employee->employee_id],[ 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $office_employee->employee->employee_lastname . ', ' . $office_employee->employee->employee_firstname . ' ' . substr($office_employee->employee->employee_middlename,0,1) . '.', 'escape' => false  ]) ?>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $office_employee->office_employees_id ?> )">
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

        function confirmDelete($office_employees_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Offices","action"=>"removeEmployee"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Offices","action"=>"positions"]); ?>' + '\\' + <?= $offices->office_id ?> ;
            swal({
                title: "Are you sure?",
                text: "You want to remove employee?",
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
                            data: {'office_employees_id' : $office_employees_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError + $office_employees_id, "error");
                            }
                        });
                    }
                });
        }

    </script>

</html>