<!-- src/Template/Admin/ContactEmails/index.ctp --> 

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
                    Emails
                </li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">Emails</h1>
            <!-- end page-header -->

            <!-- begin Add Email button -->
            <div style="margin-bottom: 2%">
                <a href="#modal-dialog-add-email" class="btn btn-yellow btn-sm" data-toggle="modal">
                    <i class="fa fa-plus"></i>
                    Add Email
                </a>
            </div>
            <!-- end Add Email button -->

            <!-- begin table -->
            <table id="data-table-select" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 80%;">
                            Email
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emails as $i => $email): ?>
                        <tr class="odd gradeX" data-email-id="<?= $email->contact_email_id ?>">
                            <td>
                            </td>
                            <td>
                                <b> <?= $email->contact_email ?> </b>
                            </td>
                            <td>
                                <div class="row email-actions">
                                    <button type="button" class="openUpdateEmailModal btn btn-yellow btn-sm" href="#modal-dialog-update-email"  data-toggle="modal" data-email-id="<?php echo $email->contact_email_id ?>" data-email = "<?php echo $email->contact_email ?>" title="Edit <?php echo $email->contact_email ?>">
                                   <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $email->contact_email_id ?> )"  title="Delete <?php echo $email->contact_email ?>">
                                        <i class="fa fa-trash"></i>
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

        <!-- begin modals -->
 
        <!-- begin #modal-dialog-add-email -->
        <div class="modal fade" id="modal-dialog-add-email">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Email</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="email" id="email" class="form-control" placeholder="Enter email" />
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                            Close
                        </a>
                        <button type="button" class="btn btn-maroon btn-sm" onclick="addEmail()">
                            <i class="fa fa-plus"></i>
                            Add Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end #modal-dialog-add-email -->

        <!-- begin modal-dialog-update-email -->
        <div class="modal fade" id="modal-dialog-update-email">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Email</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <input type="email" id="email-update" class="form-control" placeholder="    Enter email" />
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                            Close
                        </a>
                        <button type="button" class="btn btn-maroon btn-sm" onclick="updateEmail()">
                            <i class="fa fa-plus"></i>
                            Update Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal-dialog-update-email -->

        <!-- end modals -->
    </div>
    <!-- end #container -->
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
            $data_table.on( 'order.dt search.dt', 
                function () {
                    $data_table.column(0, {search:'applied', order:'applied'}).nodes().each( 
                        function (cell, i) {
                            cell.innerHTML = i+1;
                        }
                        );
                }
            ).draw();
        });

        function confirmDelete($contact_email_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to remove email?",
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
                            data: {'contact_email_id' : $contact_email_id},
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

        function addEmail() {
            var $email = $('#email').val();
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"add"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"index"]); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'email' : $email},
                            success:function(query)  {
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError, "error");
                            }
                        });
        }

        var $emailID; // global variable for selected email

        $('#modal-dialog-update-email').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            $emailID = $(e.relatedTarget).data('email-id');
            var $email = $(e.relatedTarget).data('email');

            //populate the textbox
            $("#email-update").val($email);
        });

        function updateEmail() {
            $email = $("#email-update").val();

            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"edit"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactEmails","action"=>"index"]); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'contact_email_id' : $emailID,
                                    'email' : $email },
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

    </script>
</html>