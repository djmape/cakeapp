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
                        <?= $this->Html->link($forumTopic->forum_category->forum_category_name, ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumTopic->forum_category->forum_category_name))],['escape' => false]) ?>
                    </li>
                    <li class="breadcrumb-item active">
                        <?= $forumTopic->forum_topic_name ?>
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
            <h1 class="page-header">
                        <?= $forumTopic->forum_topic_name ?>
                        <br>

            </h1>
            <!-- begin Categories -->
            
            <?php
                $topic_counter = 1;
                foreach ($forumDiscussions as $i => $forumDiscussion):
                if ($topic_counter > 5) {
                                    break;
                                }
            ?>
                <div class="row category-header">
                    <h3> <?= $forumDiscussion->forum_topic_name ?> </h3>
                </div>
              
                <table id="" class="table table-bordered category-table">
                    <tbody>
                            
                        <tr class="odd gradeX">
                            <!--
                            <td class="f-s-600 text-inverse" style="width: 80%">
                                <?= $forumDiscussion->forum_topic_name ?>
                                <br>
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumDiscussion->forum_topic_detail->forum_topic_detail_discussions_count ?> discussion/s
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumDiscussion->forum_topic_detail->forum_topic_detail_replies_count ?>
                                replies
                            </td>
                        </tr> -->
                    </tbody>
                </table> 
                <!--
                <div class="category-more-topic">
                    <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more from '.  $forumDiscussion->forum_topic_name , ['controller' => 'ForumTopics', 'action' => 'forumDiscussionsIndex' , 'category_name' => strtolower(str_replace(' ', '-', $forumCategory->forum_category_name)) , 'topic_name' => strtolower(str_replace(' ', '-', $forumTopic->forum_topic_name)) ],['escape' => false]) ?>
                </div>
                <?php $topic_counter++; endforeach; ?>
            -->
            <!-- end Categories -->
            
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

        function addTopic() {
        }

    </script>

</html>