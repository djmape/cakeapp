<!-- src/Template/Admin/Users/students_all.ctp -->

<?php echo $this->element('AdminHeaderSideBar');?>
<?php echo $this->Flash->render(); ?>
<?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Select/css/select.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css"); ?> 
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
<?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Home',['prefix' => "admin", 'controller' => 'Dashboard','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    <?php echo $this->Html->link('Students',['prefix' => "admin", 'controller' => 'Users','action'=>'studentsAll']) ?>
                </li>
            </ol>
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            <h1 class="page-header">All Students</h1>
            <!-- end page-header -->
            <div style="margin-bottom: 2%">
                <?= $this->Html->link('<i class="fa fa-plus"></i> Add Employee User', ['controller' => 'Users', 'action' => 'studentAdd'],['class' => 'btn btn-yellow btn-sm','escape' => false]) ?>
            </div>
            <!-- begin table -->
            <table id="data-table-select" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            #
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">
                            Photo
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 50%;">
                            Email
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 22%;">
                            Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 18%;">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $i => $student): ?>
                    <tr class="odd gradeX" data-email-id="<?= $user->user_id ?>">
                        <td>
                            <?= $i + 1?>
                        </td>
                        <td>
                            <?php echo $this->Html->image("../webroot/img/upload/".$student->user_student_photo,['style' => 'max-width: 100%']); ?>
                        </td>
                        <td>
                            <?= $student->user->email ?>
                        </td>
                        <td>
                            <?= $student->user_student_lastname . ', ' . $student->user_student_firstname . ' ' . substr($student->user_student_middlename,0 ,1) ?>
                        </td>
                        <td>
                            <div class="center-block">
                                <?= $this->Html->link('<i class="fa fa-edit"></i> Edit', ['controller' => 'Users', 'action' => 'studentEdit', $student->user_student_id],['class' => 'btn btn-yellow btn-sm','escape' => false,'title' => $student->user->email]) ?>
                                <button type="button" onclick="confirmDelete()" class="btn btn-danger btn-sm" data-user-id = "<?php echo $student->user_id?>" id="btnDelete" title = "<?php echo $student->user->email ?>">
                                    <i class="fa fa-trash"></i>
                                    Remove
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
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-audio.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-image.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-process.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-ui.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-validate.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.fileupload-video.js")?>
<?php echo $this->Html->script("../plugins/jquery-file-upload/js/jquery.iframe-transport.js")?>

<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>

    $(document).ready(function() {
        App.init();
        TableManageTableSelect.init();
        $('#data-table-select').DataTable();
    });

    $("#inputGroupFile01").change(function(event) {  
        RecurFadeIn();
        readURL(this); 
    });

    $("#inputGroupFile01").on('click',function(event){
        RecurFadeIn();
    });

    function readURL(input) { 
        if (input.files && input.files[0]) {   
            var reader = new FileReader();
            var filename = $("#inputGroupFile01").val();
            filename = filename.substring(filename.lastIndexOf('\\')+1);
            reader.onload = function(e) {
                $('#img_preview').attr('src', e.target.result);
                $('#img_preview').hide();
                $('#img_preview').fadeIn(500);      
                $('#img_filename').text(filename);             
            }
            reader.readAsDataURL(input.files[0]);    
        } 
        $(".alert").removeClass("loading").hide();
    }

    function RecurFadeIn(){ 
        console.log('ran');
        FadeInAlert("Wait for it...");  
    }

    function FadeInAlert(text){
        $(".alert").show();
        $(".alert").text(text).addClass("loading");  
    }

    function confirmDelete() {
        var $user_id = $('#btnDelete').data("user-id");
        var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Users","action"=>"deleteUser"]); ?>';
        var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Users","action"=>"studentsAll"]); ?>';
        swal({
            title: "Are you sure?",
            text: "You want to remove user?",
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
                        data: {'user_id' : $user_id
                        },
                        success:function(query)  {
                            window.location = redirectURL;
                        },
                        error:function(xhr, ajaxOptions, thrownError) {
                            swal("Error", thrownError + $user_id , "error");
                        }
                    });
                }
            });
        }



</script>

</html>