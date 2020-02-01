<!-- src/Template/Admin/Organizations/add_officer.ctp --> 

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
                        <?php echo $this->Html->link('Organizations',['prefix' => "admin", 'controller' => 'Organizations','action'=>'index']) ?>
                    </li>
                    <li class="breadcrumb-item">
                        <?php echo $this->Html->link($organizations->organization_acronym,['prefix' => "admin", 'controller' => 'Organizations','action'=>'officers',$organizations->organization_id]) ?>
                    </li>
                    <li class="breadcrumb-item active">
                    Edit Officer
                    </li>
                </ol>
                <!-- end breadcrumb -->

                <!-- begin page-header -->
                <h1 class="page-header"> <?= $organizations->organization_name ?> | Edit Officer </h1>
                <!-- end page-header -->

                <!-- begin form -->
                <?php 
                    echo $this->Form->create($organization_officer,array('enctype'=>'multipart/form-data'));
                ?>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Organization Name</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('organization_name', array('type' => 'text','class' => 'form-control','label' => false, 'default' => $organizations->organization_name, 'disabled'  => true, 'style' => 'background-color: fff;background : none;'));
                        ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Officer Position</label>
                    <div class="col-md-9">
                        <?php
                            if ($organization_officers_positions_count == 0 ) {
                                $noAvailablePosition = [
                                ];
                                echo $this->Form->select('officers_position_id',$noAvailablePosition, array('id' => 'officers_positions','class' => 'form-control','label' => false ));
                            }
                            else  {
                                echo $this->Form->select('officers_position_id',$organization_officers_positions, array('id' => 'officers_positions','class' => 'form-control','label' => false ));
                            } 
                        ?>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Last Name</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('officer_lastname', array('class' => 'form-control','label' => false,'default' => $organization_officer->officer_lastname ))
                        ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">First Name</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('officer_firstname', array('class' => 'form-control','label' => false,'default' => $organization_officer->officer_firstname ));
                        ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Middle Name</label>
                    <div class="col-md-9">
                        <?php
                            echo $this->Form->control('officer_middlename', array('class' => 'form-control','label' => false,'default' => $organization_officer->officer_middlename ));
                        ?> 
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Officer Photo</label>
                    <div class="col-md-7">
                        <span class="btn btn-yellow fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add image</span>
                            <?php
                                echo $this->Form->control('officer_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false));
                            ?>
                        </span>
                        <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-right: 1%; padding: 0">
                            <?php
                                echo $this->Html->image("../webroot/img/upload/".$organization_officer->officer_photo, array('id' => 'img_preview','style' => 'width:100%; height:auto;','class' => 'center-block'));
                            ?>
                        </div>
                        <label id="img_filename" style="margin-left: 1%">No image uploaded</label>
                    </div>
                </div>

                <div class="form-group row m-b-15 pull-right">
                    <?php
                        echo $this->Form->button(__('<i class="fa fa-edit"></i >Edit Officer'), array('id' => 'submit_button','class' => 'btn btn-sm btn-yellow'));
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

    <!-- File Upload -->
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
            AppendCurrentPosition();
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

        function AppendCurrentPosition() {
            var currentPosition = new Option("<?php echo $organization_officer->officers_position_id ?>", "<?php echo $organization_officer->officers_position_id ?>");
            /// jquerify the DOM object 'o' so we can use the html method
            $(currentPosition).html("<?php echo $organization_officer->organization_officers_position->officers_position_name?>");
            $("#officers_positions").append(currentPosition);
            $('#officers_positions option[value=<?php echo $organization_officer->officers_position_id ?>]').attr('selected','selected');
            $("#officers_positions select").val("<?php echo $organization_officer->officers_position_id ?>");
        }
    </script>

</html>