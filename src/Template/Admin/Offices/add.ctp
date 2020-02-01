<!-- src/Template/Admin/Offices/add.ctp --> 

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
                    Add Office
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header">Add Offices</h1>
                <!-- end page-header -->

                <!-- begin form -->
                <?php echo $this->Form->create($offices,array('enctype'=>'multipart/form-data')); ?>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Office Name</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('office_name', array('class' => 'form-control','label' => false ));?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                        <?php  echo $this->Form->control('office_description', array('type' => 'textarea','class' => 'form-control','label' => false));?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Officer Photo</label>
                    <div class="col-md-7">
                        <span class="btn btn-yellow fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php echo $this->Form->control('office_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                        </span>
                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Priority</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('priority', array('class' => 'form-control','label' => false,'type' => 'number')); ?>
                        <small class="f-s-12 text-grey-darker">Set priority by number. 1 highest</small>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right" style="margin-right: 1%">
                    <?php 
                        echo $this->Form->button(__('<i class="fa fa-plus"></i>Add Office'), array('class' => 'btn btn-sm btn-yellow'));
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

        // begin script for image upload
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
        // end script for image upload
    </script>

</html>