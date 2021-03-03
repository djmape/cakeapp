<!-- src/Template/Admin/Announcements/announcement_add.ctp -->
        <?php echo $this->element('AdminHeaderSideBar');?>
        <?php echo $this->Html->css("admin.css"); ?> 
        <?php echo $this->Flash->render(); ?>

        <!-- begin #content -->
        <div id="content" class="content">
            
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Announcements',['prefix' => "admin", 'controller' => 'Announcements','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    Edit Announcement
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">Edit Announcement</h1>
            <!-- end page-header -->
            
            <!-- begin edit form -->
            <?php
                echo $this->Form->create($announcement,array('enctype'=>'multipart/form-data','class'=>'form-horizontal'));
            ?>

            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Announcement Title</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('announcement_title', array('class' => 'form-control', 'label' => false,'default'=> $row->announcement_title)); ?>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-md-4 col-form-label">Content</label>
                <div class="col-md-12">
                    <?php echo $this->Form->control('announcement_body', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'required' => false,'default'=> $row->announcement_body)); ?>
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-md-2 col-form-label">Upload Photo</label>
                <div class="col-md-10">
                    <label class="btn btn-yellow fileinput-button">
                        <i class="fa fa-plus"></i>
                        <span>Add image</span>
                        <?php echo $this->Form->control('announcement_photo', array('id' => 'inputGroupFile01','type'=>'file','label' => false, 'required' => false, 'hidden' => true));?>
                    </label>
                    <div id="img_contain" class="col-md-2" style=" height: 150px; width: 150px; margin-top:2%; padding: 0; ">
                        <?php echo $this->Html->image("../webroot/img/upload/" . $row->announcement_photo, array('id' => 'img_preview','style' => 'width:100%; height:100%;object-fit: contain; ','class' => 'center-block')); ?>
                    </div>
                    <label id="img_filename" style="margin: 2% 0 0 1%;"> <?= $row->announcement_photo ?> </label>
                </div>
            </div>
            <div class="form-group row m-b-15 pull-right">
                <?php 
                    echo $this->Form->button(__('Update Announcement'), array('class' => 'btn btn-sm btn-yellow'));
                    echo $this->Form->end();
                ?>
            </div> 
            <!-- end edit form -->
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

<?php $this->Html->script("button.js")?>
<?php echo $this->Html->script("tinymce/tinymce.js")?>
<?php echo $this->Html->script("tinymce/tinymce.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
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