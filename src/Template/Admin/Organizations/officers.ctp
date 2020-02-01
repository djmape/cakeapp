<!-- src/Template/Admin/Organizations/officers.ctp --> 

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
                        <?php echo $this->Html->link('Organizations',['prefix' => "admin", 'controller' => 'Organizations','action'=>'index']) ?>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= $organization->organization_acronym ?>
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"><?= $organization->organization_name ?></h1>
                <!-- end page-header -->

                <!-- begin Add Organizations button -->
                <?= $this->Html->link('<i class="fa fa-add"></i> Add Officer', ['action' => 'addOfficer', $organization->organization_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm add-button' ]) ?>
                <!-- end Add Organizations button -->

                <!-- begin table -->
                <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                #
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 40%;">
                                Officer Name
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 40%;">
                                Position
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($organization_officers as $i => $organization_officer): 
                        ?>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <?= $organization_officer->officer_lastname,', ',$organization_officer->officer_firstname,' ',substr($organization_officer->officer_middlename,0,1),'.' ?>
                                    </td>
                                    <td>
                                        <?= $organization_officer->organization_officers_position->officers_position_name ?>
                                    </td>
                                    <td>
                                        <div class="pull-right center-block">
                                            <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'editOfficer', $organization_officer->organization_officer_id, $organization->organization_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $organization_officer->officer_lastname . ', ' . $organization_officer->officer_firstname . ' ' . substr($organization_officer->officer_middlename,0,1) . '.' ]) ?>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $organization_officer->organization_officer_id ?> )" title="Delete <?php echo $organization_officer->officer_lastname . ', ' . $organization_officer->officer_firstname . ' ' . substr($organization_officer->officer_middlename,0,1) . '.' ?>">
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
    <!-- end body -->



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