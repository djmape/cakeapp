<html>
<head>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <title> Admin Panel | Home Images </title>
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
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload.css")?>
    <?php echo $this->Html->css("../plugins/jquery-file-upload/css/jquery.fileupload-ui.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <?php echo $this->Html->script("../plugins/pace/pace.min.js")?>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== Sweet Alert ================== -->
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>


    <!-- Include custom.css -->
    <?php echo $this->Html->css("custom/admin.css")?>


</head>


<body onload="startTime()">

    <?php echo $this->element('AdminSideBar');?>
    <?php echo $this->Flash->render(); ?>

    <div id="content" class="content">
    <?php echo $this->element('AdminHeader');?>
        <div class="widget widget-stats bg-yellow">
            <!-- begin Server Time Widget -->
                        <div class="stats-icon"><i class="fa fa-calendar" style="color: #7e0e09"></i></div>
                        <div class="stats-info">
                            <h4>SERVER TIME</h4>
                            <div id="calendar-clock" style="font-size: 24px"></div>    
                        </div>
                    </div>

         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h5> 
                                <i class="fa fa-plus"></i>
                                <b> Home Images </b> 
                            </h5>
                        </div>
                        <div class="panel-body">
                            <div class="home_carousel_imgs">
                                <table style="width: 100%">
                                    <tr>
                                <?php $row_counter = 1; 
                                      foreach ($home_carousel_imgs as $i => $carousel_img): ?>
                                        <?php if (($i + 5) % 5 == 0) { ?> 
                                            </tr>
                                            <tr >
                                        <?php } ?> 
                                            <td style="background-color: gray; width: 200px; height: 200px; margin: 0">
                                                <div class="boxa" style="position: relative; width: 100%; height: 100%; ">
                                                <div style="position: absolute; width: 100%; height: 100%;">
                                                    <?php echo $this->Html->image("../webroot/img/upload/".$carousel_img->home_carousel_img_name, array('style' => 'max-height:100%; max-width: 100%; height: 100%; width: 100% ;object-fit: cover')); ?>
                                                </div>
                                                        <?php if ($carousel_img->visibility == 0) { ?>
                                                        <div class="hidden-image" style="position: absolute; width: 100%; height: 100%; text-align: center">
                                                            <div style="background-color: black;position: absolute; width: 100%; height: 100%;opacity: 0.2; text-align: center">
                                                            </div>
                                                            <i class="fa fa-eye-slash" style="font-size: 100px;opacity: 0.5; color: white">
                                                            </i>
                                                        </div>
                                                        <?php } ?>
                                                    <div class="boxb" style=" display: none; text-align: center" >
                                                        <div style="background-color: black;position: absolute; width: 100%; height: 100%;opacity: 0.5">
                                                        </div>
                                                        <!-- begin buttons div -->
                                                        <div id="b" style="position: absolute; padding: auto; left: 50%;top: 50%;transform: translate(-50%, -50%);">
                                                            <button type="button" class="btn btn-images btn-sm" style="margin: 10%">
                                                                <i class="fa fa-edit">
                                                                </i>
                                                                <?= $this->Html->link('Edit', ['action' => 'edit', $carousel_img->home_carousel_img_id]) ?>
                                                            </button>
                                                            <br>
                                                            <?php if ($carousel_img->visibility == 0) { ?>
                                                                <button type="button" class="btn btn-images btn-sm" onclick="confirmUnhide(<?php echo $carousel_img->home_carousel_img_id ?> )" style="margin: 10%">
                                                                    <i class="fa fa-eye">
                                                                    </i>
                                                                    Unhide
                                                                </button>
                                                                <br>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-images btn-sm" onclick="confirmHide(<?php echo $carousel_img->home_carousel_img_id ?> )" style="margin: 10%">
                                                                    <i class="fa fa-eye-slash">
                                                                    </i>
                                                                    Hide
                                                                </button>
                                                                <br>
                                                            <?php } ?>
                                                            <button type="button" class="btn btn-images btn-sm" onclick="confirmDelete(<?php echo $carousel_img->home_carousel_img_id ?> )" style="margin: 10%">
                                                                <i class="fa fa-trash">
                                                                </i>
                                                                Delete
                                                            </button>
                                                            <br>
                                                        </div>
                                                        <!-- end buttons div -->
                                                    </div>
                                                </div>
                                            </td>
                                <?php endforeach; ?>
                                    </tr>
                                    </table>
                            </div>
                                <?php echo $this->Form->create($home_carousel_img,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); ?>
                            <form class="form-horizontal">
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Upload Image</label>
                                    <div class="col-md-7">
                                        <span class="btn btn-yellow fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span>Add image</span>
                                                <?php echo $this->Form->control('home_carousel_img_name', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));?>
                                        </span>
                                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                                            <?php echo $this->Html->image("../webroot/img/img_holder.png", array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block')); ?>
                                        </div>
                                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Caption Title</label>
                                    <div class="col-md-7">
                                        <?php echo $this->Form->control('image_caption', array('class' => 'form-control','label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 control-label">Description<br>(max of 100 characters)</label>
                                    <div class="col-md-7">
                                        <?php echo $this->Form->control('image_description', array('class' => 'form-control','label' => false,'style' => 'height: 50px')); ?>
                                    </div>
                                    <label id="img_filename" class="col-md-7" style="margin-left: 1%"></label>
                                </div>
                                </div>
                                <div class="form-group row m-b-15" style="margin-right: 1%">
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Add Image'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();
                                        ?>
                                    </div>
                                </div>
                            </form>
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
    <?php $this->Html->script("/apps.min.js")?>
    <?php $this->Html->script("button.js")?>
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


        function confirmUnhide($home_carousel_img_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"unhide"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to unhide image?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Unhide",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'home_carousel_img_id' : $home_carousel_img_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", $home_carousel_img_id, "error");
                            }
                        });
                    }
                });
        }


        function confirmHide($home_carousel_img_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"hide"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to hide image?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Hide",
                cancelButtonText: "Cancel"
            },  function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {'home_carousel_img_id' : $home_carousel_img_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", $home_carousel_img_id, "error");
                            }
                        });
                    }
                });
        }


        function confirmDelete($home_carousel_img_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"delete"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "admin" ,"controller"=>"Home","action"=>"index"]); ?>';
            swal({
                title: "Are you sure?",
                text: "You want to remove image?",
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
                            data: {'home_carousel_img_id' : $home_carousel_img_id},
                            success:function(query)  {
                            // $("#divLoading").removeClass('show');
                            // $('#state').append(result);
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", $home_carousel_img_id, "error");
                            }
                        });
                    }
                });
        }


    function startTime() {
        var today = new Date();
        var d = today.toDateString();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('calendar-clock').innerHTML = d + " " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    $(".boxa").hover(function () {
    $(this).find('.boxb').fadeIn(100);
    $(this).find('.hidden-image').fadeOut(100);
},
function () {
    $(this).find('.boxb').fadeOut(100);
    $(this).find('.hidden-image').fadeIn(100);
});


    </script>

</html>