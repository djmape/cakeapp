src/Template/Admin/ContactNumbers/index.ctp

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
                    Contact Numbers
                </li>
            </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Contact Numbers</h1>
        <!-- end page-header -->  
            <!-- begin Add Email button -->
            <div style="margin-bottom: 2%">
                <a href="#modal-dialog-add-number" class="btn btn-yellow btn-sm" data-toggle="modal">
                    <i class="fa fa-plus"></i>
                    Add Contact Number
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
                    <?php foreach ($numbers as $i => $number): ?>
                        <tr class="odd gradeX" data-number-id="<?= $number->contact_number_id ?>">
                            <td>
                                <?= $i + 1?>
                            </td>
                            <td>
                                <?= $number->contact_number ?>
                            </td>
                            <td>
                                <div class="row email-actions">

                                    <button type="button" class="btn btn-yellow btn-sm" href="#modal-dialog-update-number"  data-toggle="modal" data-number-id="<?php echo $number->contact_number_id ?>" data-number = "<?php echo $number->contact_number ?>" title="Edit <?php echo $number->contact_number ?>">
                                   <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $number->contact_number_id ?> )"  title="Delete <?php echo $number->contact_number ?>">
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
        <!-- begin #modal-dialog-add-number -->
        <div class="modal fade" id="modal-dialog-add-number">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Contact Number</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="number-add" id="number-add" class="form-control" placeholder="Enter contact number" />
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                            Close
                        </a>
                        <button type="button" class="btn btn-yellow btn-sm" onclick="addNumber()">
                            <i class="fa fa-plus"></i>
                            Add Contact Number
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end #modal-dialog-add-number -->

        <!-- begin modal-dialog-update-number -->
        <div class="modal fade" id="modal-dialog-update-number">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Contact Number</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <input id="number-update" class="form-control" placeholder="    Enter email" />
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                            Close
                        </a>
                        <button type="button" class="btn btn-yellow btn-sm" onclick="updateNumber()">
                            <i class="fa fa-plus"></i>
                            Update Contact Number
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal-dialog-update-number -->
        <!-- end modals -->

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
        $('#data-table-select').DataTable();
    });

    function confirmDelete($contact_number_id) {
        var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"delete"]); ?>';
        var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"index"]); ?>';
        swal({
            title: "Are you sure?",
            text: "You want to remove contact number?",
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
                        'contact_number_id' : $contact_number_id
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

    function addNumber() {
        var $contact_number = $('#number-add').val();
        var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"add"]); ?>';
        var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"index"]); ?>';
        $.ajax({
            type:'post',
            url: targeturl, 
            data: {
                'contact_number' : $contact_number
            },
            success:function(query)  {
                window.location = redirectURL;
            },
            error:function(xhr, ajaxOptions, thrownError) {
                swal("Error", thrownError, "error");
            }
        });
    }

    var $numberID; // global variable for selected number

    $('#modal-dialog-update-number').on('show.bs.modal', function(e) {
        //get data-id attribute of the clicked element
        $numberID = $(e.relatedTarget).data('number-id');
        var $number = $(e.relatedTarget).data('number');

        //populate the textbox
        $("#number-update").val($number);
    });


    function updateNumber() {
        $contact_number = $("#number-update").val();
        var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"edit"]); ?>';
        var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"ContactNumbers","action"=>"index"]); ?>';
        $.ajax({
            type:'post',
            url: targeturl, 
            data: {
                'contact_number_id' : $numberID,
                'contact_number' : $contact_number 
            },
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