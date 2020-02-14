<!-- src/Template/Users/index.ctp -->

            <?php echo $this->element('UserHeader');?>
            <?php echo $this->Html->css("forum.css")?>
            <?php echo $this->Html->css("front.css")?>

            <!-- begin #top-menu -->
            <div id="top-menu" class="navbar-header top-menu">
            
                <!-- begin top-menu nav -->
                <ul class="nav navbar-nav">
                
                    <!-- begin breadcrumb -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Forum</li>
                    </ol>
                <!-- end breadcrumb -->
                </ul>
                <!-- end top-menu nav -->
            </div>
            <!-- end #top-menu -->


            <!-- begin #content -->
            <div id="content" class="content forum-content forum-home-content">

                <!-- begin Categories -->
                <div class="categories-table">
                    <h3> Categories </h3>  
                    <table id="data-table-default" class="table table-bordered table-forum-home">
                        <tbody>
                            <?php foreach ($forumCategories as $i => $forumCategory): ?>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse" style="width: 70%">
                                    <?= $this->Html->link($forumCategory->forum_category_name, ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumCategory->forum_category_name))],['escape' => false]) ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_topics_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_topics_count . ' topics'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_topics_count . ' topic' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_discussions_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_discussions_count . ' discussions'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_discussions_count . ' discussion' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_replies_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_replies_count . ' replies'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_replies_count . ' reply' ;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table> 

                    <div class="pull-right">
                        <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
                    </div>
                </div> 
                <!-- end Categories -->

                <!-- begin Topics -->
                <div class="categories-table">
                <h3> Topics </h3>   
                    <table id="data-table-default" class="table table-bordered table-forum-home">
                        <tbody>
                            <?php
                                $forum_topic_count = 1;
                                foreach ($forumTopics as $i => $forumTopic): 
                                    if ($forum_topic_count > 5) {
                                        break;
                                    }
                            ?>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse" style="width: 80%">
                                    <?= $this->Html->link($forumTopic->forum_topic_name, ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumTopic->forum_category->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)]) ?>
                                    in 
                                    <?= $this->Html->link($forumTopic->forum_category->forum_category_name, ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumTopic->forum_category->forum_category_name))],['escape' => false]) ?>
                                    <br>
                                    by
                                    <?php echo $this->Html->link($forumTopic->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $forumTopic->user->username )) ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumTopic->forum_topic_detail->forum_topic_detail_discussions_count != 0) {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count . ' discussions'  ;
                                        }
                                        else {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count . ' discussion' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumTopic->forum_topic_detail->forum_topic_detail_replies_count != 0) {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_replies_count . ' replies'  ;
                                        }
                                        else {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_replies_count . ' reply' ;
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php $forum_topic_count++; endforeach; ?>
                        </tbody>
                    </table> 
                    <div class="pull-right">
                        <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
                    </div>
                </div>
                <!-- end Topics -->

                <!-- begin Discussions -->
                <div class="categories-table">
                <h3> Discussions </h3>   
                <table id="data-table-default" class="table table-bordered table-forum-home">
                    <tbody>
                        <?php 
                            foreach ($forumDiscussions as $i => $forumDiscussion): ?>
                                <tr class="odd gradeX">
                                    <td class="f-s-600 text-inverse" style="width: 70%">
                                        <?= $this->Html->link($forumDiscussion->forum_discussion_title, ['controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$forumDiscussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$forumDiscussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$forumDiscussion->forum_discussion_title) ]) ?>
                                        in
                                        <?= $this->Html->link($forumDiscussion->forum_topic->forum_topic_name, ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumDiscussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $forumDiscussion->forum_topic->forum_topic_name)]) ?>
                                        <br>
                                        by
                                        <?php echo $this->Html->link($forumDiscussion->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $forumDiscussion->user->username )) ?>
                                    </td>
                                    <td class="f-s-600 text-inverse" style="width: 10%">
                                        <?= $forumDiscussion->forum_discussion_detail->forum_discussion_detail_upvote_count . ' upvote/s' ?>
                                    </td>
                                    <td class="f-s-600 text-inverse" style="width: 10%">
                                        <?= $forumDiscussion->forum_discussion_detail->forum_discussion_detail_downvote_count . ' downvote/s' ?>
                                    </td>
                                    <td class="f-s-600 text-inverse" style="width: 10%">
                                        <?= $forumDiscussion->forum_discussion_detail->forum_discussion_detail_replies_count . ' replies' ?>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table> 
                <div class="pull-right">
                    <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'Forums', 'action' => 'forumDiscussions'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
                </div>
                <!-- end Discussions -->
            </div>
            <!-- end #content -->
        </div>
        <!-- end page container -->
    </body>
    <?php echo $this->element('footer');?>      



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
    <!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>

        $(document).ready(function() {
            App.init();
        });

    </script>

</html>