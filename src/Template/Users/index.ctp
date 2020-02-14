<!-- src/Template/Users/index.ctp -->

        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

        <!-- begin #content -->
        <div id="content" class="content user-home-content">
            <!-- begin #timeline-contents -->
            <div id="timeline-content">
                    <!-- begin timeline -->
                    <div id="timeline">
                        <!-- begin timeline single post -->
                        <?php foreach ($posts as $post): ?>
                        <ul class="timeline-single-post">
                            <li class="post-title">
                                    <?php 
                                        # if post is Announcement
                                        if ($post->post_post_type_id == 1) {
                                    ?>      
                                            Announcement
                                            <hr>
                                            <?= $this->Html->link($post->announcements[0]->announcement_title, ['prefix' => 'front','controller' => 'Announcement', 'action' => 'view', $post->announcements[0]->announcement_id]) ?>
                                    <?php 
                                        } # if post is Event
                                        else if ($post->post_post_type_id == 2) {
                                    ?>  
                                            Event
                                            <hr>
                                            <?= $this->Html->link($post->events[0]->event_title, ['prefix' => 'front','controller' => 'Event', 'action' => 'view', $post->events[0]->event_id]) ?>
                                    <?php 
                                        } # if post is Organization Announcement
                                        else if ($post->post_post_type_id == 4) {
                                    ?>      
                                            Announcement from 
                                            <?= $this->Html->link($post->organization_announcement->organization->organization_name, ['prefix' => 'front','controller' => 'Organizations', 'action' => 'announcement_view', $post->organization_announcement->organization->organization_name]) ?>
                                            <hr>
                                            <?= $this->Html->link($post->organization_announcement->organization_announcement_title, ['prefix' => 'front','controller' => 'Organizations', 'action' => 'announcementView', $post->organization_announcement->organization_announcement_id]) ?>
                                    <?php 
                                        } # if post is Organization Event
                                        else if ($post->post_post_type_id == 5) {
                                    ?>      
                                            Event by 
                                            <?= $this->Html->link($post->organization_event->organization->organization_name, ['prefix' => 'front','controller' => 'Organizations', 'action' => 'view', $post->organization_event->organization->organization_id]) ?>
                                            <hr>
                                            <?= $this->Html->link($post->organization_event->organization_event_title, ['prefix' => 'front','controller' => 'Organizations', 'action' => 'eventView', $post->organization_event->organization_event_id]) ?>
                                    <?php 
                                        }
                                    ?>
                            </li>
                            <li class="post-header row">
                                <?php echo $this->Html->image("../webroot/img/upload/".$post->user->user_profile->user_profile_photo, array('class' => '')); ?>
                                <h6> <?= $post->user->username ?> </h6>
                            </li>
                            <!-- begin Post Content Preview -->
                            <li class="post-content-preview">
                            <?php 
                                # begin if post is Announcement
                                if ($post->post_post_type_id == 1) {
                                    if (strlen($post->announcements[0]->announcement_body) > 1000 )  {
                            ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($post->announcements[0]->announcement_body,0,999)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $post->announcements[0]->announcement_id]) ?>
                                        </small>
                            <?php
                                    }
                                    else {
                            ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",$post->announcements[0]->announcement_body) ?>
                            <?php
                                    }
                                }
                                # end if post is Announcement
                                # begin if post is Event
                                else if ($post->post_post_type_id == 2) {
                                    if (strlen($post->events[0]->event_body) > 1000 )  {
                            ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($post->events[0]->event_body,0,999)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $post->events[0]->event_id]) ?>
                                        </small>
                            <?php
                                    }
                                    else {
                            ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",$post->events[0]->event_body) ?>
                            <?php
                                    }
                                }
                                # end if post is Organization Announcement
                                # begin if post is Event
                                else if ($post->post_post_type_id == 4) {
                                    if (strlen($post->organization_announcement->organization_announcement_body) > 1000 )  {
                            ?>          
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($post->organization_announcement->organization_announcement_body,0,999)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $post->organization_announcement->organization_announcement_id]) ?>
                                        </small>
                            <?php
                                    }
                                    else {
                            ?>          
                                        <?= preg_replace("/\<[^>]+\>/"," ", $post->organization_announcement->organization_announcement_body) ?>
                            <?php
                                    }
                                }
                                # end if post is Organization Announcement
                                # begin if post is Organization Event
                                else if ($post->post_post_type_id == 5) {
                                    if (strlen($post->organization_event->organization_event_body) > 1000 ) {
                            ?>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($post->organization_event->organization_event_body,0,999)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $post->organization_event->organization_event_id]) ?>
                                        </small>
                            <?php
                                    }
                                    else {
                            ?>   
                                        <?= preg_replace("/\<[^>]+\>/"," ", $post->organization_event->organization_event_body) ?>
                            <?php
                                    }
                                }
                                # end if post is Organization Event
                            ?>
                            </li>
                            <!-- end Post Content Preview -->
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