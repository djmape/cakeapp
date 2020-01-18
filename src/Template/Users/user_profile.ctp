<!-- src/Template/Users/user_profile.ctp -->

<?php echo $this->element('UserHeader');?>
        <?php echo $this->Html->css("front.css")?>

        <!-- begin #content -->
        <div id="content-profile" class="content">
            <div id="cover-photo">
                <div id="profile-photo">
                    <?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, array());?>
                </div>
            </div>
            <!-- end #cover-photo -->

            <!-- begin #profile-content -->
            <div id="profile-content">
                <!-- begin #profile-left -->
                <div id="profile-left">
                    <div id="profile-info">
                        <?php
                            if ($user_type == 'Employee') {
                        ?>
                        <h3> 
                            <?php echo $user->user_employee_lastname . ', ' . $user->user_employee_firstname . ' ' .substr($user->user_employee_middlename,0 ,1) . '.'; ?> 
                        </h3>
                        <h4> (Employee) </h4>
                        <h5> 
                            <?= $user->employee_position_name->employee_position_name ?>
                        </h5>

                        <?php
                            } else if ($user_type = 'Student') {
                                echo $user->user_employee_lastname . ', ' . $user->user_employee_firstname . ' ' .substr($user->user_employee_middlename,0 ,1) . '.';
                        ?>
                        <?php
                            } else if ($user_type == 'Alumni') {
                                echo $user->user_employee_lastname . ', ' . $user->user_employee_firstname . ' ' .substr($user->user_employee_middlename,0 ,1) . '.';
                            ?>
                        <?php 
                            }
                        ?>
                    <hr>
                    <?= $user->user->email ?>
                    <hr>
                    <?= $profile->user_profile_bio ?>
                    <hr>
                    Last Online: active
                    </div>
                </div>
                <!-- end #profile-left -->

                <!-- begin #profile-activities -->
                <div id="profile-activities">
                    <div id="profile-posts-header">
                        <h3>Activities</h3>
                    </div>
                    <div>
                        <?php foreach ($userActivities as $userActivity): ?>
                        <ul class="profile-single-activity">
                            <li>
                                <?php
                                    if ($userActivity->user_activity_activity_type_id == 1) {
                                        if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 2) {
                                            # comment
                                            echo 'You commented in';
                                ?>
                                    <?= $userActivity->post_comments[0]->post_comment_content->post_comment_content ?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 3) {
                                            # reaction
                                            if ($userActivity->user_post_reactions[0]->user_post_reaction_like == 1) {
                                                echo 'You liked';
                                            }
                                            else if ($userActivity->user_post_reactions[0]->user_post_reaction_dislike == 1) {
                                                echo 'You disliked';
                                            }
                                        }
                                    }
                                    else if ($userActivity->user_activity_activity_type_id == 2) {
                                        # category
                                        if ($userActivity->forum_activities[0]->forum_activity_type_id == 1 ) {
                                            echo 'You created category ';
                                        }
                                        # topic
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 2 ) {
                                            echo 'You created topic ';
                                    ?>
                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_topic_name, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_topic_name)]) ?>
                                        in 
                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name , ['prefix' => 'forums','controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name))],['escape' => false]) ?>

                                    <?php
                                        }
                                        # discussion
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 3 ) {
                                            echo 'You started a discussion ';
                                    ?>

                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                         in 
                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name , ['prefix' => 'forums','controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name))],['escape' => false]) ?>
                                        /
                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name)]) ?>

                                    <?php
                                        }
                                        # reply
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 4 ) {
                                            echo 'You added a reply <i>' . $userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content . '</i>';
                                    ?>
                                    <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 1 ) {
                                            echo 'You created reaction ';
                                        }
                                    }
                                ?>
                                <?php
                                    if ($userActivity->user_activity_activity_type_id == 1) {
                                        if ($userActivity->user_post_activities[0]->post->post_post_type_id == 1) {
                                            # announcement
                                ?>
                                <hr>
                                    <?= $this->Html->link($userActivity->user_post_activities[0]->post->announcement->announcement_title, ['prefix' => 'front','controller' => 'Announcement', 'action' => 'view', $userActivity->user_post_activities[0]->post->announcement->announcement_id]) ?>
                                    <?= substr($userActivity->user_post_activities[0]->post->announcement->announcement_body,0,255)?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activity->post_post_type_id == 1) {
                                            # reaction
                                            # for event no code yet
                                            if ($userActivity->user_post_activity->user_post_reactions->user_post_reaction_like == true) {
                                                echo 'You liked';
                                            }
                                            else if ($userActivity->user_post_activity->user_post_reactions->user_post_reaction_dislike == true) {
                                                echo 'You disliked';
                                            }
                                        }
                                    }
                                    else if ($userActivity->user_activity_activity_type_id == 2) {
                                        if ($userActivity->forum_activities[0]->forum_activity_type_id == 1 ) {
                                    ?>

                                    <?php 
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 4 ) {
                                        # reply
                                    ?>
                                        in
                                        <?= $this->Html->link($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title) ]) ?>

                                        <?= $userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_detail->forum_discussion_content ?>

                                    <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 1 ) {
                                            echo 'You created reaction ';
                                        }
                                    }
                                ?>
                            </li>
                        </ul>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- end #profile-activities -->
            </div>
            <!-- end #profile-content -->
        </div>
        <!-- end #content -->
    </div>
    <!-- end #container -->
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
<?php echo $this->Html->script("profile.demo.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>
    $(document).ready(function() {
        App.init();
        profile.init();
    });

    </script>

</html>