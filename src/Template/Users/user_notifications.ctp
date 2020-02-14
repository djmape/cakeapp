
        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	    <div id="content" class="content">
    		<div class="post-container">
                    <h1 class="page-header" style="color: #7e0e09;">
                        <i class="fa fa-bell"></i>
                        Notifications
                    </h1>
                    
                        <?php
                            $currentDate = '';
                            foreach ($user_notifications as $i => $user_notification):
                            if ( $i = 0 ) {
                        ?>  
                            <table id="data-table-default" class="table table-bordered table-notification">
                                <thead> <?= $user_notification->user_notification_created->format('F d, Y, l') ?> </thead>
                        <?php
                            }
                            if ($currentDate != $user_notification->user_notification_created->format('F d, Y, l')) {
                        ?>
                            </table>
                            <table id="data-table-default" class="table table-bordered table-notification">
                                <thead> <?= $user_notification->user_notification_created->format('F d, Y, l') ?> </thead>
                        <?php
                            }
                        ?>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td class="f-s-600 text-inverse">
                                                <?= $user_notification->user_notification_created->format('g:i A') ?>
                                            </td>
                                            <td class="f-s-600 text-inverse">
                                                <?php
                                                    # if forum notification is Discussion Reply
                                                    if ($user_notification->forum_notifications[0]->forum_notification_type_id == 1 ) {
                                                        # code...
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' added a reply on your discussion ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>
                                                <?php
                                                    }
                                                    # if forum notification is Discussion Reaction
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 2 ) {
                                                ?>  
                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 3 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' upvoted ' . ' your discussion ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>
                                                <?php      
                                                    }
                                                    # if forum notification is Reply Reply
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 4 ) {
                                                        # code...
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' downvoted ' . ' your discussion ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>
                                                <?php
                                                    }
                                                    # if forum notification is Reply Reaction
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 5 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' cancelled the upvote on ' . ' your discussion ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>

                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 6 ) {
                                                ?>  
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' cancelled the downvote on ' . ' your discussion ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>

                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 7 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' upvoted your reply in ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>
                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 8 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' downvoted your reply in ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>
                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 9 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' cancelled the upvote on your reply in ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>  
                                                <?php
                                                    }
                                                    else if ($user_notification->forum_notifications[0]->forum_notification_type_id == 10 ) {
                                                ?>
                                                        <?= $this->Html->link($user_notification->forum_notifications[0]->user->username, ['controller' => 'Users', 'action' => 'userProfile', $user_notification->forum_notifications[0]->user->username])  . ' cancelled the downvote on your reply in ' . $this->Html->link($user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title, ['prefix' => 'forums','controller' => 'ForumDiscussions', 'action' => 'forumReplies', str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_topic->forum_topic_name), str_replace(' ', '-',$user_notification->forum_notifications[0]->forum_discussion->forum_discussion_title)]) ?>  
                                            </td>
                                        </tr>
                                    </tbody>

                        <?php 
                                                    }
                            $currentDate = $user_notification->user_notification_created->format('F d, Y, l');
                        ?>
                        <?php
                            endforeach; 
                        ?>
                                </table>
			</div>
		</div>
	</div>
	<!-- end #content -->
	
	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
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
