        <!-- src/Template/Admin/Announcements/index.ctp --> 

        <!-- begin include -->
        <?php echo $this->element('OrganizationPanelHeaderSidebar');?>
        <?php echo $this->Html->css("admin.css"); ?> 

        <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
        <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 

        <!-- ================== Sweet Alert ================== -->
        <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
        <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
        <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>
        <!-- end include -->

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

            <!-- begin Add Announcement button -->
            <?= $this->Html->link('<i class="fa fa-bullhorn fw"></i><span> Add Announcement</span>',['prefix' => false, 'controller' => 'Users','action'=>'organizationAnnouncementAdd', str_replace(' ', '-', $organization->organization_name)],array('escape' => false, 'class' => 'btn btn-yellow btn-sm add-button')) ?>
            <!-- end Add Announcement button -->
            
            <!-- begin table -->
            <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 30%;">
                            Title
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 30%;">
                            Content
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 10%;">
                            Availability
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 15%;">
                            Modified
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($organization_announcements as $organization_announcement): ?>
                        <tr style="font-size: 12px">
                            <td>
                            </td>
                            <td>
                                <?= $organization_announcement->organization_announcement_title ?>
                            </td>
                            <td>
                                <?php 
                                    if (strlen($organization_announcement->organization_announcement_body) >= 255 )  {
                                ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($organization_announcement->organization_announcement_body,0,100)) ?>
                                        . . .
                                <?php
                                    }
                                    else {
                                ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",$organization_announcement->organization_announcement_body) ?>
                                <?php
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                    if ($organization_announcement->organization_announcement_visibility_members_only == 1) {
                                        echo 'Members only';
                                    }
                                    else {
                                        echo 'Everyone';
                                    }
                                ?>
                            </td>
                            <td>
                                <?= $organization_announcement->organization_announcement_modified->format('l, F d, Y g:i A') ?>
                            </td>
                            <td>
                                <div class="pull-right center-block">
                                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'organizationAnnouncementEdit', str_replace('-', ' ', $organization->organization_name), $organization_announcement->organization_announcement_id],['escape' => false, 'class' => 'btn btn-yellow btn-sm', 'title' => 'Edit ' . $organization_announcement->organization_announcement_title ]) ?>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $organization_announcement->organization_announcement_id ?> )" title="Delete <?php echo $organization_announcement->organization_announcement_title?>">
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

        function confirmDelete($organization_announcement_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationAnnouncementDelete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Users","action"=>"organizationAnnouncementsAll", str_replace('-', ' ', $organization->organization_name)]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to delete announcement?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'organization_announcement_id' : $organization_announcement_id,
                                'organization_name' : '<?php echo $organization->organization_name ?>'
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