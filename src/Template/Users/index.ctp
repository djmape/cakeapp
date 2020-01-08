<!-- src/Template/Users/index.ctp -->

        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

        <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin #timeline-contents -->
            <div id="timeline-content">
                    <div id="timeline-posts-header">
                        <h3>Posts</h3>
                    </div>
                    <!-- begin timeline -->
                    <div id="timeline">
                        <!-- begin timeline single post -->
                        <?php foreach ($posts as $post): ?>
                        <ul class="timeline-single-post">
                            <li class="post-header row">
                                <?php echo $this->Html->image("../webroot/img/upload/".$post->user->user_profile->user_profile_photo, array('class' => '')); ?>
                                <h4> <?= $post->user->username ?> </h4>
                            </li>
                            <hr>
                            <li>
                                <h4>
                                    <?php 
                                        if ($post->post_post_type_id == 1) {
                                    ?>
                                    <?= $this->Html->link($post->announcement->announcement_title, ['prefix' => 'front','controller' => 'Announcement', 'action' => 'view', $post->announcement->announcement_id]) ?>
                                    <?php 
                                        }
                                    ?>
                                </h4>
                                <?php 
                                    if ($post->post_post_type_id == 1) {
                                        echo $post->announcement->announcement_body;
                                    }
                                ?>
                            </li>
                            <hr>
                            <!-- 
                            <li class="post-reactions">
                                <a href="javascript:;" class="m-r-15 text-inverse-lighter">
                                    <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                    Like
                                </a>
                                <a href="javascript:;" class="m-r-15 text-inverse-lighter">
                                    <i class="fa fa-thumbs-down fa-fw fa-lg m-r-3"></i> Dislike
                                </a>
                            </li>
                            <hr>
                            <li style="">    
                                <div class="user" style="overflow: hidden; float: left">
                                    <?php
                                        if ($user_type == 'Employee') {
                                            echo $this->Html->image("../webroot/img/upload/".$user->user_employee_photo, array());
                                        }
                                        else if ($user_type = 'Student') {
                                            echo $this->Html->image("../webroot/img/upload/".$user->user_student_photo, array());
                                        }
                                        else if ($user_type == 'Alumni') {
                                            echo $this->Html->image("../webroot/img/upload/".$user->user_alumni_photo, array());
                                        }
                                    ?>
                                </div>
                                <div class="input" style="margin-left: 7%">
                                    <form action="">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded-corner" placeholder="Write a comment..." />
                                            <span class="input-group-btn p-l-10">
                                                <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            -->
                        </ul>
                        <?php endforeach; ?>
                        <!-- end timeline single post -->
                    </div>
                    <!-- end timeline -->
            </div>
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
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>

    $(document).ready(function() {
        App.init();
    });

    </script>

</html>