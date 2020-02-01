<!-- src/Template/Users/index.ctp -->

        
        <?php echo $this->element('UserHeader');?>

        <!-- begin #top-menu -->
        <div id="top-menu" class="navbar-header top-menu">
            <!-- begin top-menu nav -->
            <ul class="nav navbar-nav">
                
        <!-- begin breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Forum</li>
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Home',['controller' => 'ForumHome','action'=>'index']) ?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link('Categories', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex'],['escape' => false]) ?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link($forumTopic->forum_category->forum_category_name , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumTopic->forum_category->forum_category_name))],['escape' => false])?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link('Topics' , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumTopic->forum_category->forum_category_name))],['escape' => false])?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link($forumTopic->forum_topic_name , ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumTopic->forum_category->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)],['escape' => false])?>
            </li>
            <li class="breadcrumb-item active">
                Edit Discussion
            </li>
        </ol>
        <!-- end breadcrumb -->
                
            </ul>
            <!-- end top-menu nav -->
        </div>
        <!-- end #top-menu -->
        <?php echo $this->Html->css("front.css")?>
        <?php echo $this->Html->css("forum.css")?>


        <!-- begin #content -->
        <div id="content" class="content forum-content">
            <!-- begin Categories -->
                
                <h3> <?= 'Add Discussion in ' . $forumTopic->forum_category->forum_category_name . '/' . $forumTopic->forum_topic_name   ?> </h3>
                <!-- begin Add Topic button -->
                <div id="discussion-form">

            <!-- begin form --> 
            <?php echo $this->Form->create($forumDiscussion,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); ?>
            <form class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group row m-b-15">
                    <label class="col-md-3 control-label">Title</label>
                    <div class="col-md-9">
                        <?php echo $this->Form->control('forum_discussion_title', array('class' => 'form-control','label' => false,'data-parsley-validate' => true, 'id' => 'admin_username' ));?>
                    </div>
                </div>

                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Content</label>
                                    <div class="col-md-9">
                                        <?php echo $this->Form->control('forum_discussion_content', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'default' => $forumDiscussion->forum_discussion_detail->forum_discussion_content )); ?>
                                    </div>
                                </div>
                <div class="form-group row m-b-15 pull-right">
                    <div class="col-md-9">
                        <?php echo $this->Form->button(__('<i class="fa fa-plus"></i> Add User'), array('class' => 'btn btn-sm btn-yellow'));
                                              echo $this->Form->end();?>
                    </div>
                </div>
            </form>
            <!-- end form -->
                </div>
                <!-- end Add Topic button -->            
            <!-- end Categories -->

        </div>
        </div>
        <!-- end #content -->
    </div>
    <!-- end #container -->
</body>
    <?php echo $this->element('footer');?>      



<!-- Include Base JS -->
<?php echo $this->element('base_js');?>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Select/js/dataTables.select.min.js")?>
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
        $('#data-table-select').DataTable();
        $(".dataTables_paginate").addClass("pull-right");
        $("#data-table-select_filter").addClass("pull-right");
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