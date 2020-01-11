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
                        <?php echo $this->Html->link('Home',['controller' => 'Forums','action'=>'forumHome']) ?>
                    </li>
                    <li class="breadcrumb-item active">
                        Categories
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

            <<!-- begin Categories -->
            
            <?php foreach ($forumCategories as $i => $forumCategory): ?>
                <div class="row category-header">
                    <?php echo $this->Html->image("../webroot/img/upload/".$forumCategory->forum_category_icon, array('class' => 'center-block','style' => '')); ?>
                    <h3> <?= $forumCategory->forum_category_name ?> </h3>
                    <br>
                    <?= $forumCategory->forum_category_detail->forum_category_topics_count . ' topics, ' . $forumCategory->forum_category_detail->forum_category_discussions_count . ' discussions, ' . $forumCategory->forum_category_detail->forum_category_replies_count . ' replies' ?> 
                </div>
              
                <table id="" class="table table-bordered category-table">
                    <tbody>
                        <?php 
                            if (count($forumCategory->forum_topics) == 0) {
                        ?>
                                <td class="f-s-600 text-inverse" style="width: 80%">
                                    No topic in <?= $forumCategory->forum_category_name ?> yet
                                </td>
                        <?php
                             } else {
                        ?>
                        <?php
                            $topic_counter = 1;
                            foreach ($forumCategory->forum_topics as $forumTopic): 
                                if ($topic_counter > 5) {
                                    break;
                                }
                        ?>
                        <tr class="odd gradeX">
                            <td class="f-s-600 text-inverse" style="width: 80%">
                                <?= $this->Html->link($forumTopic->forum_topic_name, ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumCategory->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)]) ?>
                                <br>
                                <?= 'by ' . $forumTopic->user->username ?>
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count ?> discussion/s
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumTopic->forum_topic_detail->forum_topic_detail_replies_count ?>
                                replies
                            </td>
                        </tr>
                            <?php $topic_counter++; endforeach; } ?>
                    </tbody>
                </table> 
                <div class="category-more-topic">
                    <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more from '.  $forumCategory->forum_category_name , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumCategory->forum_category_name))],['escape' => false]) ?>
                </div>
            <?php endforeach; ?>
            <!-- end Categories -->
                    <div id="view-all" class="">
                        <?= $this->Html->link('.. View All Categories', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesAll'],['escape' => false]) ?>
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