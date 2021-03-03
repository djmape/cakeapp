<!-- src/Template/Admin/Events/add.ctp -->
        <?php echo $this->element('AdminHeaderSideBar');?>
        <?php echo $this->Html->css("admin.css"); ?> 
        <?php echo $this->Html->css("../plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"); ?> 
        <?php echo $this->Flash->render(); ?>

        <!-- begin #content -->
        <div id="content" class="content">
            
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Events',['prefix' => "admin", 'controller' => 'Events','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    Add Event
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">Add Event</h1>
            <!-- end page-header -->

            <!-- begin form -->
            <?php  
                echo $this->Form->create($event,array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));
            ?>

            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Title</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_title', array('class' => 'form-control','label' => false)); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Description</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_body', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'required' => false )); ?>
                </div>
            </div>
            <!-- begin start date -->
            <div class="form-group row m-b-15" style="margin-bottom: 20px;">
                <label class="col-md-2 control-label">Start Date</label>
                <div class="col-md-4">
                    <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                        <?php 
                            echo $this->Form->control('event_start_date', array('type'=>'text','id' => 'datepicker-start','class' => 'form-control','label' => false));
                        ?>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <label class="control-label col-md-2">Start Time</label>
                <!-- begin bootstrap-timepicker -->
                <div class="col-md-4">      
                    <div class="input-group bootstrap-timepicker">
                        <?php echo $this->Form->control('event_start_time', array('type'=>'text','id' => 'timepicker-start','class' => 'form-control','label' => false)); ?>
                        <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                    </div>
                </div>
                <!-- end bootstrap-timepicker -->
            </div>
            <!-- end start date -->

            <!-- begin end date -->
            <div class="form-group row m-b-15" style="margin-bottom: 20px;">
                <label class="col-md-2 control-label">End Date</label>
                <div class="col-md-4">
                    <div class="input-group date" id="datepicker-disabled-past-end" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                        <?php echo $this->Form->control('event_end_date', array('type'=>'text','id' => 'datepicker-end','class' => 'form-control','label' => false)); ?>
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <label class="control-label col-md-2">End Time</label>
                <div class="col-md-4">
                    <div class="input-group bootstrap-timepicker">
                        <?php echo $this->Form->control('event_end_time', array('type'=>'text','id' => 'timepicker-end','class' => 'form-control','label' => false)); ?>
                        <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                    </div>
                </div>
            </div>
            <!-- end end date -->

            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Sponsors</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_sponsors', array('class' => 'form-control', 'label' => false )); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Participants</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_participants', array('class' => 'form-control', 'label' => false )); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Location</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_location', array('class' => 'form-control', 'label' => false )); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Embed Location</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('event_location_embed', array('class' => 'form-control', 'label' => false )); ?>
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-md-2 col-form-label">Upload Photo</label>
                <div class="col-md-10">
                    <label class="btn btn-yellow fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span>Add image</span>
                        <?php echo $this->Form->control('event_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false, 'hidden' => true));?>
                    </label>
                    <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-top:2%; padding: 0; ">
                        <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:100%;object-fit: contain; ','class' => 'center-block')); ?>
                    </div>
                    <label id="img_filename" style="margin: 2% 0 0 1%;"></label>
                </div>
            </div>
            <div class="pull-right" style=" margin-bottom: 1%">
                <?php 
                    echo $this->Form->button(__('Add Event'), array('class' => 'btn btn-sm btn-yellow'));
                    echo $this->Form->end();
                ?>
            </div>
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

<?php echo $this->Html->script("tinymce/tinymce.js")?>
<?php echo $this->Html->script("tinymce/tinymce.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")?>
<?php echo $this->Html->script("../plugins/bootstrap-daterangepicker/daterangepicker.js")?>
<?php echo $this->Html->script("../plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap-daterangepicker/moment.js")?>
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
        $('#datepicker-start').datepicker();
        $('#datepicker-end').datepicker();
        $('#timepicker-start').timepicker();
        $('#timepicker-start').val('');
        $('#timepicker-end').timepicker();
        $('#timepicker-end').val('');
    });

    tinymce.init({
        selector: '.wysiwyg',
        plugins: "lists link image imagetools paste table",
        toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify | link unlink | image | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                imagetools_cors_hosts: ['localhost/cakeapp'],
        menubar : "table",
        statusbar: false
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

</script>

</html>