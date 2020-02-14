<!-- src/Template/Admin/Organizations/edit.ctp --> 

            <!-- begin include -->
            <?php echo $this->element('OrganizationPanelHeaderSidebar');?>
            <?php echo $this->Html->css("front.css")?>
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
                    Edit Organization
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"> Edit Organization </h1>
                <!-- end page-header -->

                <!-- begin form -->
                <?php  
                    $organization_type = [
                        'Course Affliated Student Organizations' => 'Course Affliated Student Organizations',
                        'University Student Organizations' => 'University Student Organizations'
                    ];
                    echo $this->Form->create($organization,array('enctype'=>'multipart/form-data'));
                ?>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Organization Type</label>
                    <div class="col-md-9">
                        <?php 
                            echo $this->Form->select('organization_type',$organization_type, array('class' => 'form-control','label' => false, 'default' => $row->organization_type ));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Organization Name</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_name', array('class' => 'form-control','label' => false, 'default' => $row->organization_name ));
                        ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Acronym</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_acronym', array('class' => 'form-control','label' => false, 'default' => $row->organization_acronym));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Mission</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_mission', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_mission));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Vision</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_vision', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_vision));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Goals</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_goal', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_goal));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Objectives</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_objective', array('style' => 'height: 200px','class' => 'form-control wysiwyg','label' => false, 'default' => $row->organization_objective));
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 col-form-label">Organization Photo</label>
                    <div class="col-md-9">
                        <span class="btn btn-yellow fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php
                                echo $this->Form->control('organization_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));
                            ?>
                        </span>
                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php
                                echo $this->Html->image("../webroot/img/upload/".$row->organization_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block'));
                            ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%;">No image uploaded</label>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right">
                    <?php 
                        echo $this->Form->button(__('<i class="fa fa-edit"></i>  Update Organization'), array('class' => 'btn btn-sm btn-yellow'));
                        echo $this->Form->end();
                    ?>
                </div>

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
    
    <!-- TinyMCE JS -->
    <?php echo $this->Html->script("tinymce/tinymce.js")?>
    <?php echo $this->Html->script("tinymce/tinymce.min.js")?>

    <!-- File Upload -->
    <?php echo $this->Html->script("../plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js")?>
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
            FormMultipleUpload.init();
        });

        tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify",
                imagetools_cors_hosts: ['localhost/cakeapp'],
            menubar : false,
            statusbar: false
        });

        $("#inputGroupFile01").change(function(event) {  
            RecurFadeIn();
            readURL(this); 
        });

        $("#inputGroupFile01").on('click',function(event){
            RecurFadeIn();
        });

        // begin script for image upload
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
        // end script for image upload

    </script>

</html>