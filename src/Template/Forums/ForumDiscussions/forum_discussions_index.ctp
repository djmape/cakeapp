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
            <li class="breadcrumb-item active">
                <?= $forumTopic->forum_topic_name?>
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

            <div class="categories-table">
            <div class="category-header">
                
                <h3> <?= $forumTopic->forum_category->forum_category_name . '/' . $forumTopic->forum_topic_name ?> </h3>
                <!-- begin Add Topic button -->
                <div style="margin-bottom: 2%">
                        <?= $this->Html->link('<i class="fa fa-plus"></i> Add Discussion in ' . $forumTopic->forum_topic_name , ['controller' => 'ForumDiscussions', 'action' => 'forumAddDiscussion', str_replace(' ', '-', $forumTopic->forum_category->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)],['escape' => false , 'class' => 'btn btn-yellow btn-sm'])?>
                </div>
                    <table id="data-table-select" class="table table-bordered ">
                <thead>
                <tr>
                    <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 80%;">

                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        
                    </th>
                </tr>
            </thead>
                        <tbody>
                            <?php foreach ($forumDiscussions as $i => $forumDiscussion): ?>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse" style="width: 70%">
                                    <?= $this->Html->link($forumDiscussion->forum_discussion_title, ['controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$forumDiscussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$forumDiscussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$forumDiscussion->forum_discussion_title) ]) ?>
                                    <br>
                                    by
                                    <?= $forumDiscussion->user->username ?> 
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumDiscussion->forum_discussion_detail->forum_discussion_detail_replies_count != 0) {
                                            echo $forumDiscussion->forum_discussion_detail->forum_discussion_detail_replies_count . ' replies'  ;
                                        }
                                        else {
                                            echo $forumDiscussion->forum_discussion_detail->forum_discussion_detail_replies_count . ' reply' ;
                                        }
                                    ?> -->
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">

                                reactions
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                            
            </table> 
                </div>
                <!-- end Add Topic button -->

            </div>
            </div> 
            
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
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>

    $(document).ready(function() {
        App.init();
        $('#data-table-select').DataTable();
        $(".dataTables_paginate").addClass("pull-right");
        $("#data-table-select_filter").addClass("pull-right");
    });

    </script>

</html>