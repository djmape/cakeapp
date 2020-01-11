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
                    <li class="breadcrumb-item active">
                        <?= $forumCategory->forum_category_name ?>
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
                <?php echo $this->Html->image("../webroot/img/upload/".$forumCategory->forum_category_icon, array('class' => 'center-block','id' => 'category-header-icon')); ?>
                        <?= $forumCategory->forum_category_name ?>
                        <br>

            </h1>
            <!-- begin Categories -->
            
            <?php
                $topic_counter = 1;
                foreach ($forumTopics as $i => $forumTopic):
                if ($topic_counter > 5) {
                                    break;
                                }
            ?>
                <div class="row category-header">
                    <h3> <?= $forumTopic->forum_topic_name ?> </h3>
                </div>
              
                <table id="" class="table table-bordered category-table">
                    <tbody>
                            
                        <tr class="odd gradeX">
                            <td class="f-s-600 text-inverse" style="width: 80%">
                                <?= $this->Html->link($forumTopic->forum_topic_name, ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumCategory->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)]) ?>
                                    <br>
                                    by
                                    <?= $forumTopic->user->username ?> 
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count ?> discussion/s
                            </td>
                            <td class="f-s-600 text-inverse" style="width: 10%">
                                <?= $forumTopic->forum_topic_detail->forum_topic_detail_replies_count ?>
                                replies
                            </td>
                        </tr>
                    </tbody>
                </table> 
                <div class="category-more-topic">
                    <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more from '.  $forumTopic->forum_topic_name , ['controller' => 'ForumTopics', 'action' => 'forumDiscussionsIndex' , 'category_name' => strtolower(str_replace(' ', '-', $forumCategory->forum_category_name)) , 'topic_name' => strtolower(str_replace(' ', '-', $forumTopic->forum_topic_name)) ],['escape' => false]) ?>
                </div>
            <?php $topic_counter++; endforeach; ?>
            <!-- end Categories -->
                    <div id="view-all" class="">
                        <?= $this->Html->link('.. View All Topics', ['controller' => 'ForumTopics', 'action' => 'forumTopicsAll', str_replace(' ', '-', $forumCategory->forum_category_name), 'all'],['escape' => false]) ?>
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

        function addTopic() {
            $forum_topic_name = $('#topic').val();
            $forum_category_id = <?php echo $forumCategory->forum_category_id?>;
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"addForumTopic"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumCategories","action"=>"forumTopicsIndex", 'category_name' => strtolower(str_replace(' ', '_',$forumCategory->forum_category_name)), $forumCategory->forum_category_id]); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {
                                'forum_topic_name' : $forum_topic_name,
                                'forum_category_id' : $forum_category_id
                            },
                            success:function(query)  {
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError, "error");
                            }
                        });
        }

        var $emailID; // global variable for selected email

        $('#modal-dialog-update-email').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            $emailID = $(e.relatedTarget).data('email-id');
            var $email = $(e.relatedTarget).data('email');

            //populate the textbox
            $("#email-update").val($email);
        });

    </script>

</html>