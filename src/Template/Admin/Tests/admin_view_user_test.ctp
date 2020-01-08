<?php echo $this->element('AdminHeaderSideBar');?>
<?php echo $this->Flash->render(); ?>

<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
<!-- begin #content -->
<div id="content" class="content">
		<!-- end #content -->
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">
                	<?php echo $this->Html->link('Users',['prefix' => "admin", 'controller' => 'Users','action'=>'all']) ?>
              	</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
            <div id="user-info" style="margin-bottom: 5%">
			<h1 class="page-header">User Name</h1>
            
			<!-- end page-header -->
            <p>
                Email: 
            </p>
            <p>
                Username: 
            </p>
            <div class="pull-right">
            <?= $this->Html->link('<i class="fa fa-edit"></i>Edit User', ['action' => 'adminEditUserTest'],['class' => 'btn btn-yellow btn-sm','escape' => false]) ?>
                
            <a href="#modal-dialog-add-user-administrator" class="btn btn-danger btn-sm" data-toggle="modal">
                <i class="fa fa-trash"></i>
            Delete User</a>
            </div>
        </div>
			<!-- begin panel -->
            <hr style=" margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 1px solid #7e0e09;">
            <h4>Activities</h4>
            <div style="margin-top: 2%">
					<table id="data-table-select" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                                            #
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 17%;">
                                            Date Time
                                </th>
								<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 60%;">
                                            Activity
                                        </th>
								<th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 18%;">
                                            Actions
                                        </th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php foreach ($users as $i => $user): ?>
							<tr class="odd gradeX" data-email-id="<?= $user->user_id ?>">
								<td>
                                            <?= $i + 1?>
                                </td>
                                <td>
                                    <?php echo $this->Html->image("../webroot/img/upload/".$user->user_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                </td>
                                <td>
                                            <b>
                                                <?= $user->email ?>
                                            </b>
                                </td>
                                <td>
                                    <?= $user->user_type->user_type_name ?>
                                </td>
                                <td>
                                            <div class="center-block">
                                            	<button type="button" class="openUpdateEmailModal btn btn-info btn-sm" href="#modal-dialog-update-email"  data-toggle="modal" data-email-id="<?php echo $user->user_id ?>" data-email = "<?php echo $user->email ?>">
                                                    <i class="fa fa-edit">
                                                    </i>
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $user->user_id ?> )">
                                                    <i class="fa fa-trash">
                                                    </i>
                                                    Remove
                                                </button>
                                            </div>
                                        </td>
							</tr>
							
						<?php endforeach; ?>
                    -->
						</tbody>
					</table>
                    </div>
				<!-- end panel-body -->
</div>
			<!-- end panel -->
		</div>
		<!-- Modals -->
		<!-- Add Email -->
		<div class="modal fade" id="modal-dialog-add-user-administrator">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Add User</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
                                            <form data-parsley-validate="true">
                                            <input id="lastname" class="form-control" placeholder="Last Name" data-parsley-required="true" style="margin: 2%" />
                                            <input id="firstname" class="form-control" placeholder="First Name" style="margin: 2%" />
                                            <input id="middlename" class="form-control" placeholder="Middle Name" style="margin: 2%" />
                                            <input type="email" id="email" class="form-control" placeholder="Enter email" style="margin: 2%" />
                                            <input id="username" class="form-control" placeholder="Middle Name" style="margin: 2%" />
                                        </form>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
											<button type="button" class="btn btn-success btn-sm" onclick="">
                                                    <i class="fa fa-plus">
                                                    </i>
                                                    Add Email
                                                </button>
										</div>
									</div>
								</div>
							</div>
							<!-- Edit Email -->
		<div class="modal fade" id="modal-dialog-update-email">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Update Email</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<input type="email" id="email-update" class="form-control" placeholder="Enter email" />

										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
											<button type="button" class="btn btn-success btn-sm" onclick="updateEmail()">
                                                    <i class="fa fa-plus">
                                                    </i>
                                                    Update Email
                                            </button>
										</div>
									</div>
								</div>
							</div>
	</div>
</body>



<!-- Include Base JS -->
    <?php echo $this->element('base_js');?>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>

<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>

<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>


<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
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

        function addEmail() {
        	var $email = $('#email').val();

        	var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Tests","action"=>"addEmail"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Tests","action"=>"adminContentTest"]); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'email' : $email},
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

        var $emailID;

        $('#modal-dialog-update-email').on('show.bs.modal', function(e) {

    		//get data-id attribute of the clicked element
    		$emailID = $(e.relatedTarget).data('email-id');
    		var $email = $(e.relatedTarget).data('email');

    		//populate the textbox
    		$("#email-update").val($email);
		});

        function updateEmail() {
        	$email = $("#email-update").val();

        	var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Tests","action"=>"updateEmail"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Tests","action"=>"adminContentTest"]); ?>';
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