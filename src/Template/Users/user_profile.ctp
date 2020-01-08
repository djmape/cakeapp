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
                                        if ($userActivity->user_post_activity->user_post_activity_type_id == 2) {
                                            # comment
                                            echo 'You commented in';
                                ?>
                                    <?= $userActivity->post_comment->post_comment_content->post_comment_content ?>
                                <?php
                                        }
                                        else if ($userActivity->user_post_activity->user_post_activity_type_id == 3) {
                                            # reaction
                                            if ($userActivity->user_post_reaction->user_post_reaction_like == 1) {
                                                echo 'You liked';
                                            }
                                            else if ($userActivity->user_post_reaction->user_post_reaction_dislike == 1) {
                                                echo 'You disliked';
                                            }
                                        }
                                    }
                                ?>
                                <hr>
                                <?php
                                    if ($userActivity->user_activity_activity_type_id == 1) {
                                        if ($userActivity->post->post_post_type_id == 1) {
                                            # announcement
                                ?>
                                    <?= $this->Html->link($userActivity->post->announcement->announcement_title, ['prefix' => 'front','controller' => 'Announcement', 'action' => 'view', $userActivity->post->announcement->announcement_id]) ?>
                                    <?= substr($userActivity->post->announcement->announcement_body,0,255)?>
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
                                ?>
                            </li>
                            <hr>
                        </ul>
                        <ul class="profile-single-activity">
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