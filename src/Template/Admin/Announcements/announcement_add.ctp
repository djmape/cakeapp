
<?php echo $this->element('AdminHeaderSideBar');?>
    <?php echo $this->Flash->render(); ?>
    <div id="content" class="content">
            
         <!-- begin row -->
            <!-- begin breadcrumb -->
            <ol class="breadcrumb pull-right">
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Home',['prefix' => "admin", 'controller' => 'Dashboard','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item">
                    <?php echo $this->Html->link('Announcements',['prefix' => "admin", 'controller' => 'Announcements','action'=>'index']) ?>
                </li>
                <li class="breadcrumb-item active">
                    <?php echo $this->Html->link('Add Announcement',['prefix' => "admin", 'controller' => 'Announcements','action'=>'announcementAdd']) ?>
                </li>
            </ol>
            <!-- end breadcrumb -->

            <!-- begin page-header -->
            <h1 class="page-header">Add Announcement</h1>
            <!-- end page-header -->
                         <?php
                            echo $this->Form->create($announcement);
                        ?>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-form-label">Announcement Title</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('announcement_title', array('class' => 'form-control', 'label' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-form-label">Content</label>
                                    <div class="col-md-12">
                                        <?php echo $this->Form->control('announcement_body', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'required' => false)); ?>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15 pull-right">
                                    <div class="col-md-12">
                                                   
                        <?php 
                            echo $this->Form->button(__('Add Announcement'), array('class' => 'btn btn-sm btn-yellow'));
                            echo $this->Form->end();
                        ?>
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
    </script>

</html>