<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Edit Event </title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php echo $this->Html->css("../plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>
    <?php echo $this->Html->css("bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/font-awesome/css/font-awesome.min.css"); ?>
    <?php echo $this->Html->css("animate.min.css")?>
    <?php echo $this->Html->css("style.min.css")?>
    <?php echo $this->Html->css("style-responsive.min.css")?>
    <?php echo $this->Html->css("theme/default.css")?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <?php echo $this->Html->css("../plugins/isotope/isotope.css")?> 
    <?php echo $this->Html->css("../plugins/lightbox/css/lightbox.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-daterangepicker/daterangepicker.css")?>
    <?php echo $this->Html->css("../plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <!-- ================== END BASE JS ================== -->

    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>
    
</head>


<body>
    <?php echo $this->element('AdminSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Polytechnic University of the Philipiines - Quezon City <small>Web Portal</small></h1>
        <!-- end page-header -->
            
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h5>
                                <i class="fa fa-edit"></i>
                                <b> Edit Event </b>
                            </h5>
                        </div>
                        <div class="panel-body">
                            <?php  
                                echo $this->Form->create($event,array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));  
                        ?>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-form-label">Title</label>
                            <div class="col-md-12">
                                <?php echo $this->Form->control('event_title', array('class' => 'form-control','default' => $row->event_title,'label' => false)); ?>
                            </div>
                        </div>
                        <div class="form-group row m-b-15">
                            <label class="col-md-4 col-form-label">Description</label>
                            <div class="col-md-12">
                                <?php echo $this->Form->control('event_body', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'required' => false,'default' => $row->event_body )); ?>
                            </div>
                        </div>

                            <div class="form-group row m-b-15" style="margin-bottom: 20px;">
                                <label class="col-md-2 control-label">Start Date</label>
                                <div class="col-md-4">
                                    <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                                        <?php 
                                            echo $this->Form->control('event_start_date', array('type'=>'text','id' => 'datepicker-start','class' => 'form-control','label' => false,'default' => $row->event_start_date));
                                        ?>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                    <label class="control-label col-md-2">Start Time</label>
                                    <div class="col-md-4">
                                        <div class="input-group bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <a href="#" data-action="incrementHour">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                            </td>
                                                            <td class="separator">
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <a href="#" data-action="incrementMinute">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                            </td>
                                                            <td class="separator">
                                                                &nbsp;
                                                            </td>
                                                            <td class="meridian-column">
                                                                <a href="#" data-action="toggleMeridian">
                                                                    <i class="fa fa-chevron-up"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2">
                                                            </td> 
                                                            <td class="separator">
                                                                :
                                                            </td>
                                                            <td>
                                                                <input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2">
                                                            </td> 
                                                            <td class="separator">
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href="#" data-action="decrementHour">
                                                                    <i class="fa fa-chevron-down"></i>
                                                                </a>
                                                            </td>
                                                            <td class="separator">
                                                            </td>
                                                            <td>
                                                                <a href="#" data-action="decrementMinute">
                                                                    <i class="fa fa-chevron-down"></i>
                                                                </a>
                                                            </td>
                                                            <td class="separator">
                                                                &nbsp;
                                                            </td>
                                                            <td>
                                                                <a href="#" data-action="toggleMeridian">
                                                                    <i class="fa fa-chevron-down"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php echo $this->Form->control('event_start_time', array('type'=>'text','id' => 'timepicker-start','class' => 'form-control','label' => false,'default' => $row->event_start_time)); ?>
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group row m-b-15" style="margin-bottom: 20px;">
                                <label class="col-md-2 control-label">End Date</label>
                                <div class="col-md-4">
                                    <div class="input-group date" id="datepicker-disabled-past-end" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                                        <?php echo $this->Form->control('event_end_date', array('type'=>'text','id' => 'datepicker-end','class' => 'form-control','label' => false,'default' => $row->event_end_date)); ?>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                                    <label class="control-label col-md-2">End Time</label>
                                    <div class="col-md-4">
                                        <div class="input-group bootstrap-timepicker">
                                            <div class="bootstrap-timepicker-widget dropdown-menu">
                                                <table>
                                                    <tbody><tr><td><a href="#" data-action="incrementHour"><i class="fa fa-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="fa fa-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="fa fa-chevron-up"></i></a></td></tr><tr><td><input type="text" name="hour" class="bootstrap-timepicker-hour form-control" maxlength="2"></td> <td class="separator">:</td><td><input type="text" name="minute" class="bootstrap-timepicker-minute form-control" maxlength="2"></td> <td class="separator">&nbsp;</td><td><input type="text" name="meridian" class="bootstrap-timepicker-meridian form-control" maxlength="2"></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="fa fa-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="fa fa-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="fa fa-chevron-down"></i></a></td></tr></tbody>
                                                </table>
                                            </div>
                                            <?php echo $this->Form->control('event_end_time', array('type'=>'text','id' => 'timepicker-end','class' => 'form-control','label' => false,'default' => $row->event_end_time)); ?>
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        </div>
                                    </div>
                            </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Sponsors</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('event_sponsors', array('class' => 'form-control', 'label' => false,'default' => $row->event_sponsors )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Participants</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('event_participants', array('class' => 'form-control', 'label' => false,'default' => $row->event_participants )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Location</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('event_location', array('class' => 'form-control', 'label' => false,'default' => $row->event_location )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Embed Location</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('event_location_embed', array('class' => 'form-control', 'label' => false,'default' => $row->event_location_embed )); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Event Photo</label>
                                    <div class="col-md-12">
                                        <span class="btn btn-yellow fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add image</span>
                                                <?php echo $this->Form->control('event_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                                        </span>
                                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                                            <?php echo $this->Html->image("../webroot/img/upload/".$row->event_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                        </div>
                                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                                    </div>
                                </div>
                            <div class="pull-right">
                                <?php echo $this->Form->button(__('Add Event'), array('class' => 'btn btn-sm btn-primary'));
                                      echo $this->Form->end();
                                ?>
                            </div>
                        </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
        </div>
    </div>

</body>


<!-- ================== BEGIN BASE JS ================== -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
        $('#timepicker-start').timepicker();
        $('#datepicker-end').datepicker();
        $('#timepicker-end').timepicker();
    });

    tinymce.init({
            selector: '.wysiwyg',
            plugins: "lists link image imagetools paste",
            toolbar: "undo redo | fontsizeselect bold italic subscript superscript | numlist bullist  outdent indent | insertfile | alignleft aligncenter alignright alignjustify | link unlink | image",
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