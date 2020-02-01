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
                <?= $this->Html->link($discussion->forum_topic->forum_category->forum_category_name , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name))],['escape' => false])?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link($discussion->forum_topic->forum_topic_name , ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name)],['escape' => false])?>
            </li>
            <li class="breadcrumb-item active">
                Add Discussion
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
                
                <h3> Reply to:  </h3>                
                <!-- begin Add Topic button -->

                <table id="data-table-select" class="table table-bordered">
            <tbody>
                    <tr class="odd gradeX">
                        <td style="width: 20%; text-align: center; padding: 3%">
                            <?php echo $this->Html->image("../webroot/img/upload/".$discussion->user->user_profile->user_profile_photo,['style' => 'width: 50%']); ?>
                            <br>
                            <b><a href=""> <?= $discussion->user->username ?> </a></b>
                            <br>
                            <?= $discussion->user->user_type->user_type_name ?> 
                        </td>
                        <td style="width: 80%;position: relative">
                            
                            <div>
                                <?= $discussion->forum_discussion_detail->forum_discussion_content ?>
                            </div>
                            <div class="row" style="clear: both;vertical-align:bottom;position: absolute;bottom: 1%; width: 100%">
                            <div class="" style="text-align: left">
                                <small>datetime here</small>
                            </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
                <div id="discussion-form">

            <!-- begin form --> 
            <?php echo $this->Form->create($forumReplyDetail,array('enctype'=>'multipart/form-data','data-parsley-validate' => true)); ?>
            <form class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group row m-b-15">
                                    <label class="col-md-2 col-form-label">Reply</label>
                                    <div class="col-md-10">
                                        <?php echo $this->Form->control('forum_reply_detail_content', array('style' => 'height: 200px','class' => 'form-control wysiwyg', 'label' => false, 'required' => false )); ?>
                                    </div>
                                </div>
                <div class="form-group row m-b-15 pull-right">
                    <div class="col-md-9">
                        <?php echo $this->Form->button(__('Post Reply'), array('class' => 'btn btn-sm btn-yellow'));
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