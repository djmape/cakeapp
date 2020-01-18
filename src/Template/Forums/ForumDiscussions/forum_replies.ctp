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
            <!-- echo from db remove comment if done -->
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Category Name',['controller' => 'Forums','action'=>'forumHome']) ?>
            </li>
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Topics',['controller' => 'Forums','action'=>'forumHome']) ?>
            </li>
            <li class="breadcrumb-item active">
                Discussion Titles
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
            <h2><?= $discussion->forum_discussion_title ?></h2>
            <p>by <a href=""><?= $discussion->user->username ?></a>, <?= $discussion->forum_discussion_created ?></p>
            <table id="data-table-select" class="table table-bordered">
            <tbody>
                    <tr class="odd gradeX">
                        <td style="width: 20%; text-align: center; padding: 3%">
                            <?php echo $this->Html->image("../webroot/img/upload/".$discussion->user->user_profile->user_profile_photo,['style' => 'width: 50%']); ?>
                            <br>
                            <b><a href=""> <?= $discussion->user->username ?> </a></b>
                            <br>
                            <?= $discussion->user->user_type->user_type_name ?> 
                            <br>
                                <?php
                                    if ($discussion->user->user_type_id == 1) {
                                        # code...
                                    }
                                    else if ($discussion->user->user_type_id == 2) {

                                    }
                                    else if ($discussion->user->user_type_id == 3) {
                                        echo $discussion->user->user_students[0]->course->course_name;
                                    }
                                    else if ($discussion->user->user_type_id == 4) {
                                        
                                    }
                                ?>
                            <br>
                            <br>
                            <?= $discussion->user->user_forum_activity_count->user_forum_activity_discussions_count ?> forum post/s
                            <br>
                            <?= $discussion->user->user_forum_activity_count->user_forum_activity_replies_count ?>
                            forum replies
                        </td>
                        <td style="width: 80%;position: relative">
                            
                            <div>
                                <?= $discussion->forum_discussion_detail->forum_discussion_content ?>
                            </div>
                            <div class="row" style="clear: both;vertical-align:bottom;position: absolute;bottom: 1%; width: 100%">
                            <div class="" style="text-align: left">
                                <small><?= $discussion->forum_discussion_created ?></small>
                            </div>
                            <div class="" style="text-align: right; margin-right: 0">
                                <!-- 79 likes -->
                            </div>
                            </div>
                        </td>
                    </tr>
                    <?php foreach ($replies as $reply): ?>
                        <tr class="odd gradeX">
                            <td style="width: 20%; text-align: center; padding: 3%">
                                <?php echo $this->Html->image("../webroot/img/upload/".$reply->user->user_profile->user_profile_photo,['style' => 'width: 50%']); ?>
                            <br>
                            <b><a href=""> <?= $reply->user->username ?> </a></b>
                            <br>
                            <?= $reply->user->user_type->user_type_name ?> 
                            <br>
                                <?php
                                    if ($reply->user->user_type_id == 1) {
                                        # code...
                                    }
                                    else if ($reply->user->user_type_id == 2) {
                                        echo $reply->user->user_employees[0]->employee_position_name->employee_position_name;
                                    }
                                    else if ($reply->user->user_type_id == 3) {
                                        echo $reply->user->user_students[0]->course->course_name;
                                    }
                                    else if ($reply->user->user_type_id == 4) {
                                        echo $reply->user->user_alumni[0]->course->course_name;
                                    }
                                ?>
                            <br>
                            <br>
                            <?= $reply->user->user_forum_activity_count->user_forum_activity_discussions_count ?> forum post/s
                            <br>
                            <?= $reply->user->user_forum_activity_count->user_forum_activity_replies_count ?>
                            forum replies
                            </td>
                            <td style="width: 80%;position: relative">

                            <div>
                                <?= $reply->forum_reply_detail->forum_reply_detail_content ?>
                            </div>
                            <div class="row" style="clear: both;vertical-align:bottom;position: absolute;bottom: 1%; width: 100%">
                            <div class="" style="text-align: left">
                                <small><?= $reply->forum_reply_created ?></small>
                            </div>
                            <div class="" style="text-align: right; margin-right: 0">
                                <!-- 79 likes -->
                            </div>
                            </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- begin Add Reply button -->
                <?= $this->Html->link('<i class="fa fa-plus"></i> Add Discussion in ' . $discussion->forum_discussion_title , ['controller' => 'ForumDiscussions', 'action' => 'forumAddReply', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title)],['escape' => false , 'class' => 'btn btn-yellow btn-sm'])?>
            <!-- end Add Reply button -->
            
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
        $('#data-table-select').DataTable();
        $(".dataTables_paginate").addClass("pull-right");
        $("#data-table-select_filter").addClass("pull-right");
    });

    </script>

</html>