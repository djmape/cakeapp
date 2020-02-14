        <!-- src/Template/Admin/Announcements/index.ctp --> 

        <!-- begin include -->
        <?php echo $this->element('OrganizationPanelHeaderSidebar');?>
        <?php echo $this->Html->css("admin.css")?> 
        <?php echo $this->Flash->render(); ?>

        <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 

        <!-- ================== Sweet Alert ================== -->
        <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
        <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
        <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>
        <!-- end include -->

        <?php echo $this->Html->css("../plugins/bootstrap-select/bootstrap-select.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/select2/dist/css/select2.min.css"); ?> 

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item active">
                    Announcements
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">All Announcements</h1>
            <!-- end page-header -->

            <!-- begin Add Email button -->
            <div style="margin-bottom: 2%">
                <a href="#modal-dialog-add-organization-member" class="btn btn-yellow btn-sm" data-toggle="modal">
                    <i class="fa fa-plus"></i>
                    Add Member
                </a>
            </div>
            <!-- end Add Email button -->
            
            <!-- begin table -->
            <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 50%;">
                            Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 40%;">
                            Username
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($organization_members as $organization_member): ?>
                        <tr style="font-size: 12px">
                            <td>
                            </td>
                            <td>
                                <?= $organization_member->user->user_lastname . ', ' . $organization_member->user->user_firstname . ' ' . $organization_member->user->user_middlename ?>
                            </td>
                            <td>
                                <?= $organization_member->user->username ?>
                            </td>
                            <td>
                                <div class="pull-right center-block">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $organization_member->organization_member_id ?> )" title="Remove <?php echo $organization_member->user->user_lastname . ', ' . $organization_member->user->user_firstname . ' ' . $organization_member->user->user_middlename?>">
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
                    <!-- begin #modal-dialog-add-email -->
        <div class="modal fade" id="modal-dialog-add-organization-member">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Email</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <?php
                                $noAvailableUser = [
                                ];
                            if ($users_count == 0 ) {
                                $noUser = [
                                ];
                                echo $this->Form->select('',$noUser, ['class' => 'form-control selectpicker', 'data-size' => 'form-control','data-live-search' => true, 'data-style' => 'btn-white' ,'label' => false ]);
                            }
                            else  {
                                echo $this->Form->select('',$assignUsers, ['class' => 'form-control selectpicker', 'data-size' => 'form-control','data-live-search' => true, 'data-style' => 'btn-white' ,'label' => false, 'data-size' => '1']);
                            } 
                        ?>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                            Close
                        </a>
                        <button type="button" class="btn btn-yellow btn-sm" onclick="addMember()">
                            Add Member
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end #modal-dialog-add-email -->
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

    <?php echo $this->Html->script("../plugins/bootstrap-select/bootstrap-select.min.js")?>
    <?php echo $this->Html->script("../plugins/select2/dist/js/select2.min.js")?>
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
            $('.selectpicker').selectpicker();
        });

        function confirmDelete($organization_member_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationMemberDelete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationMembersAll", str_replace(' ', '-', $organization->organization_name)]); ?>';
            swal({
                title: "Are you sure?",
                text: redirectURL,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-danger",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'organization_member_id' : $organization_member_id },
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



        function addMember() {
            var $user_id = $('.selectpicker').val();
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationMemberAdd"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationMembersAll", str_replace(' ', '-', $organization->organization_name)]); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'user_id' : $user_id ,
                                'organization_id' : <?php echo $organization->organization_id ?>},
                            success:function(query)  {
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError, "error");
                            }
                        });
        }

             
    </script>

</html>