<!-- src/Template/Users/user_profile.ctp -->

<?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

        <!-- begin #content -->
        <div id="content-profile" class="content">
            <div id="cover-photo">
                <div id="profile-photo">
                    <?php 
                    if ($profile != '') {
                        echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, array());
                    }
                    ?>
                </div>
            </div>
            <!-- end #cover-photo -->

            <!-- begin #profile-content -->
            <div id="profile-content">
                <!-- begin #profile-left -->
                <div id="profile-left">
                    <div id="profile-info">
                        <?php
                        ?>
                        <h3> 
                            <?= $userProfile->user_lastname . ', ' . $userProfile->user_firstname . ' ' .substr($userProfile->user_middlename,0 ,1) . '.'; ?> 
                        </h3>
                        <h4> <?= $user_type ?> </h4>
                    <hr>
                    <?= $userProfile->email ?>
                    <?php
                        if ($profile->user_profile_bio != '') {
                    ?>
                        <hr>
                        <?= $profile->user_profile_bio ?>
                    <?php 
                        }
                    ?>
                    <?php 
                        if ($user_forum_activity_statistics !=  '') {
                    ?>
                    <hr>
                    <?php
                        if ($user_forum_activity_statistics->user_forum_activity_topics_count != '') {
                    ?>
                            <?= $user_forum_activity_statistics->user_forum_activity_topics_count . ' forum topic/s' ?>
                    <br>
                    <?php 
                        }
                    ?>
                    <?php
                        if ($user_forum_activity_statistics->user_forum_activity_discussions_count != '') {
                    ?>
                            <?= $user_forum_activity_statistics->user_forum_activity_discussions_count . ' forum discussion/s' ?>
                    <br>
                    <?php 
                        }
                    ?>
                    <?php
                        if ($user_forum_activity_statistics->user_forum_activity_replies_count != '') {
                    
                            if ($user_forum_activity_statistics->user_forum_activity_replies_count == 0) {
                                echo '0 forum reply';
                            }
                            else {
                                echo $user_forum_activity_statistics->user_forum_activity_replies_count . ' forum replies';
                            }
                        }
                    }
                    ?>
                    <hr>
                    </div>
                </div>
                <!-- end #profile-left -->

                <!-- begin #profile-activities -->
                <div id="profile-activities">
                    <div id="profile-posts-header">
                        <h3>Activities</h3>
                    </div>
                    <div>
                        <?php 
                            if ($userActivities->count() != 0) {
                            foreach ($userActivities as $userActivity): 
                        ?>

                        <ul class="profile-single-activity">
                                <?php
                                    # if activity is Post
                                    if ($userActivity->user_activity_activity_type_id == 1) {
                                        # Create Post
                                        if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 1) {
                                ?>  
                                            <li>
                                                <?= $pronoun . ' created post '  ?>

                                            <?php
                                                if ($userActivity->user_post_activities[0]->post->announcements != null) {
                                                    echo $userActivity->user_post_activities[0]->post->announcements[0]->announcement_title;
                                                }
                                                if ($userActivity->user_post_activities[0]->post->events != null) {
                                                    echo $userActivity->user_post_activities[0]->post->events[0]->event_title;
                                                }
                                            ?>
                                            </li>
                                <?php
                                        }
                                        # Post Comment
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 2) {
                                ?>
                                        <li>
                                            <?= $pronoun . ' commented ' ?>
                                            <?= '"' . $userActivity->post_comments[0]->post_comment_content->post_comment_content . '"'?>
                                            in
                                            <br>
                                            <br>
                                            <?php
                                                # if post comment is on announcement
                                                if ($userActivity->user_post_activities[0]->post->post_post_type_id == 1) {
                                            ?>  
                                                    <?= $this->Html->link($userActivity->user_post_activities[0]->post->announcements[0]->announcement_title, ['prefix' => 'front','controller' => 'Announcement', 'action' => 'view', $userActivity->user_post_activities[0]->post->announcements[0]->announcement_id]) ?>
                                                    <?= substr($userActivity->user_post_activities[0]->post->announcements[0]->announcement_body,0,255)?>
                                            <?php
                                                }
                                                else if ($userActivity->user_post_activities[0]->post->post_post_type_id == 2) {
                                            ?>
                                                    <?= $this->Html->link($userActivity->user_post_activities[0]->post->events[0]->event_title, ['prefix' => 'front', 'controller' => 'Events', 'action' => 'view', $userActivity->user_post_activities[0]->post->events[0]->event_id]) ?>
                                                    <?= substr($userActivity->user_post_activities[0]->post->events[0]->event_body,0,255) . '...'?>
                                            <?php
                                                }
                                            ?>
                                        </li>
                                <?php
                                        }
                                        # Post Reaction
                                        
                                        # like reaction
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 3) {
                                ?>          
                                            <li>
                                                <?=  $pronoun . ' liked' ?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 4) {
                                ?>          
                                            <li>
                                                <?= $pronoun . '  disliked ' ?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 5) {
                                ?>                
                                            <li>
                                                <?= $pronoun . '  cancelled your like in ' ?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activities[0]->user_post_activity_type_id == 6) {
                                ?>
                                            <li>
                                                <?= $pronoun . '  cancelled your dislike in ' ?>
                                <?php
                                        }

                                        # reaction is for announcement
                                        if ($userActivity->user_post_activities[0]->post->post_post_type_id == 1) {
                                ?>              
                                            <?= $this->Html->link($userActivity->user_post_activities[0]->post->announcements[0]->announcement_title, ['prefix' => 'front', 'controller' => 'Announcement', 'action' => 'view', $userActivity->user_post_activities[0]->post->announcements[0]->announcement_id]) ?>
                                <?php
                                        }
                                        # reaction is for event
                                        else if ($userActivity->user_post_activities[0]->post->post_post_type_id == 2) {
                                ?>
                                            <?= $this->Html->link($userActivity->user_post_activities[0]->post->events[0]->event_title, ['prefix' => 'front', 'controller' => 'Events', 'action' => 'view', $userActivity->user_post_activities[0]->post->events[0]->event_id]) ?>


                                <?php
                                        }
                                    }
                                    # end if activity is Post

                                    # if activity is Forum
                                    else if ($userActivity->user_activity_activity_type_id == 2) {

                                        # create category
                                        if ($userActivity->forum_activities[0]->forum_activity_type_id == 1 ) {
                                ?>
                                            <li>
                                                <?=  $pronoun . '  created a forum category ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_category_activities[0]->forum_category->forum_category_name , ['prefix' => 'forums','controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', str_replace(' ', '-', $userActivity->forum_activities[0]->forum_category_activities[0]->forum_category->forum_category_name)]) ?>
                                            </li>
                                <?php
                                        }
                                        # if create topic
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 2 ) {
                                ?>
                                            <li>
                                                <?= $pronoun . '  created topic ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_topic_name, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_topic_name)]) ?>
                                                in 
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name , ['prefix' => 'forums','controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $userActivity->forum_activities[0]->forum_topic_activities[0]->forum_topic->forum_category->forum_category_name))],['escape' => false]) ?>
                                            </li>
                                        
                                    <?php
                                        }
                                        # end if create topic

                                        # if create discussion
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 3 ) {
                                    ?>
                                            <li>
                                                <?= $pronoun . '  started a discussion ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                                    in 
                                                    <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name , ['prefix' => 'forums','controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name))],['escape' => false]) ?>
                                                    /           
                                                    <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name)]) ?>
                                            </li>

                                    <?php
                                        }
                                        # if create reply
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 4 ) {
                                    ?>
                                            <?= $pronoun . '  added a reply <i>' . $userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content . '</i>' ?>

                                    <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 5 ) {
                                            # for Edit Category
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 6 ) {
                                            # for Edit Topic
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 7 ) {
                                            # for Edit Discussion
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 8 ) {
                                            # for Edit Reply
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 9 ) {
                                            # for Delete Category
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 10 ) {
                                            # for Delete Topic
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 11 ) {
                                            # for Delete Discussion
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 12 ) {
                                            # for Delete Reply
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 13 ) {
                                            # for Discussion Upvote
                                    ?>
                                            <li>
                                                <?= $pronoun . ' upvoted discussion ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                            </li>
                                    <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 14 ) {
                                            # for Discussion Downvote
                                    ?>
                                            <li>
                                                <?= $pronoun . ' downvoted discussion ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                            </li>
                                <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 15 ) {
                                            # for Discussion Cancel Upvote
                                ?>          
                                            <li>
                                                <?= $pronoun . ' cancel upvote on discussion ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                            </li>

                                <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 16 ) {
                                            # for Discussion Cancel Downvote
                                ?>

                                            <li>
                                                <?= $pronoun . ' cancel downvote on discussion ' ?>
                                                <?= $this->Html->link($userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_discussion_activities[0]->forum_discussion->forum_discussion_title) ]) ?>
                                            </li>

                                <?php 
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 17 ) { 
                                ?>
                                            <li>
                                                <?= $pronoun . ' upvoted ' . substr($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content,0,100)  . '... reply on discussion ' . $this->Html->link($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title) ])
                                                ?>
                                            </li>
                                <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 18 ) { 
                                ?>
                                            <li>
                                                <?= $pronoun . ' downvoted ' . substr($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content,0,100)  . '... reply on discussion ' . $this->Html->link($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title) ])
                                                ?>
                                            </li>
                                <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 19 ) { 
                                ?>
                                            <li>
                                                <?= $pronoun . ' cancel upvote ' . substr($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content,0,100)  . '... reply on discussion ' . $this->Html->link($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title) ])
                                                ?>
                                            </li>
                                <?php
                                        }
                                        else if ($userActivity->forum_activities[0]->forum_activity_type_id == 20 ) { 
                                ?>
                                            <li>
                                                <?= $pronoun . ' cancel downvote ' . substr($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_reply_detail->forum_reply_detail_content,0,100)  . '... reply on discussion ' . $this->Html->link($userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$userActivity->forum_activities[0]->forum_reply_activities[0]->forum_reply->forum_discussion->forum_discussion_title) ])
                                                ?>
                                            </li>
                                <?php
                                        }
                                    }
                                    # end if activity is Forum
                                ?>
                                
                                <small class="user-activity-t">
                                    <?= $userActivity->user_activity_timestamp ?>
                                </small>
                            </li>
                        </ul>
                        <?php
                            endforeach;
                        }
                        else {
                        ?>
                            <ul class="profile-single-activity">
                                <li>
                                    <?= $pronoun . " has no activity yet" ?>
                                </li>
                            </ul>
                        <?php
                        }
                        ?>
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