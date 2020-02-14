<!-- src/Template/Forums/ForumCategories/forum_topics_index.ctp -->

        
            <?php echo $this->element('UserHeader');?>
            <?php echo $this->Html->css("front.css")?>
            <?php echo $this->Html->css("forum.css")?>

            <!-- begin #top-menu -->
            <div id="top-menu" class="navbar-header top-menu">

                <!-- begin top-menu nav -->
                <ul class="nav navbar-nav">

                    <!-- begin breadcrumb -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <?php echo $this->Html->link('Forum',['controller' => 'ForumHome','action'=>'index']) ?>
                        </li>
                        <li class="breadcrumb-item">
                            <?= $this->Html->link('Categories', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex']) ?>
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


            <!-- begin #content -->
            <div id="content" class="content forum-content forum-topics-index-content">
                <h1 class="page-header">
                    <?php echo $this->Html->image("../webroot/img/upload/".$forumCategory->forum_category_icon, array('class' => 'center-block','id' => 'category-header-icon')); ?>
                    <?= $forumCategory->forum_category_name ?>
                    <br>

                    <?php
                        if ($login_status == true ) {
                    ?>
                            <!-- begin Add Topic button -->
                            <div style="margin: 2% 0">
                                <a href="#modal-dialog-add-topic" class="btn btn-yellow btn-sm" data-toggle="modal">
                                    <i class="fa fa-plus"></i>
                                    Add Topic in <?= $forumCategory->forum_category_name ?>
                                </a>
                            </div>
                            <!-- end Add Topic button -->
                    <?php
                        }
                    ?>

                </h1>
            
                <!-- begin Categories -->
                <?php
                    $topic_counter = 1;
                    foreach ($forumTopics as $i => $forumTopic):
                        if ($topic_counter > 5) {
                            break;
                        }
                ?>
                
                        <table id="" class="table table-bordered category-table">
                            <th class="topic-header" colspan="3">
                                <!-- begin topic header and action buttons -->
                                <div class="row">
                                    <div class="col-md-11">
                                        <h4 id="forum-topic-name"> <?= $forumTopic->forum_topic_name ?> </h4>
                                    </div>
                                    <div id="topic-action-buttons" class="pull-right">
                                        <?php
                                            if ($forumTopic->forum_topic_created_by_user_id == $currentUser) {
                                        ?>
                                                <a href="#modal-dialog-edit-topic" class="btn btn-yellow btn-xs" data-toggle="modal" title="Edit" data-topic-name="<?php echo $forumTopic->forum_topic_name ?>" data-topic-id="<?php echo $forumTopic->forum_topic_id ?>">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            <?php
                                                if ($forumTopic->forum_topic_detail->forum_topic_detail_discussions_count > 0 || $forumTopic->forum_topic_detail->forum_topic_detail_replies_count > 0) {
                                            ?>
                                                    <button type="button" class="btn btn-yellow btn-xs" id="btnDelete" title = "Delete disabled. Topic not empty" disabled>
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                            <?php
                                                }
                                                else {
                                            ?>
                                                <button type="button" onclick="confirmDelete('<?php echo $forumTopic->forum_topic_id ?>')" class="btn btn-yellow btn-xs" id="btnDelete" title = "Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            <?php
                                                }
                                            }
                                            else {
                                            }
                                        ?>
                                    </div>
                                </div>
                            </th>
                            <!-- end topic header and action buttons -->
                            <tbody>

                                <!-- check if topic has discussion -->
                                <?php 
                                    if (count($forumTopic->forum_discussions) == 0) {
                                ?>

                                        <td class="f-s-600 text-inverse">
                                            No discussions in this topic yet.
                                        </td>

                                <?php
                                    }
                                    else {
                                ?>

                                    <?php
                                        $discussion_counter = 1;
                                        foreach ($forumTopic->forum_discussions as $forumDiscussion):
                                            if ($discussion_counter > 5) {
                                                break;
                                            }
                                    ?>
                        
                                            <tr class="odd gradeX">
                                                <td class="f-s-600 text-inverse" style="width: 80%">
                                                    <?= $this->Html->link($forumDiscussion->forum_discussion_title, ['controller' => 'ForumDiscussions', 'action' => 'forumReplies',str_replace(' ', '-',$forumTopic->forum_category->forum_category_name), str_replace(' ', '-',$forumTopic->forum_topic_name) , str_replace(' ', '-',$forumDiscussion->forum_discussion_title) ]) ?>
                                                    <br>
                                                    by
                                                    <?= $forumDiscussion->user->username ?>  
                                                </td>
                                                <td class="f-s-600 text-inverse" style="width: 10%">
                                                    <?= $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count ?> discussion/s
                                                </td>
                                                <td class="f-s-600 text-inverse" style="width: 10%">
                                                    <?= $forumTopic->forum_topic_detail->forum_topic_detail_replies_count ?>
                                                    replies
                                                </td>
                                            </tr>

                                <?php
                                            $discussion_counter++;
                                        endforeach;
                                    }
                                ?>
                            </tbody>
                        </table> 

                        <div class="category-more-topic">
                            <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more from '.  $forumTopic->forum_topic_name , ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex' , str_replace(' ', '-', $forumCategory->forum_category_name) ,  str_replace(' ', '-', $forumTopic->forum_topic_name) ],['escape' => false,'class' => 'btn btn-maroon btn-sm']) ?>
                        </div>
                <?php
                        $topic_counter++;
                    endforeach;
                ?>
                <!-- end Categories -->

                <div id="view-all" class="">
                    <?= $this->Html->link('.. View All Topics', ['controller' => 'ForumTopics', 'action' => 'forumTopicsAll', str_replace(' ', '-', $forumCategory->forum_category_name), 'all'],['escape' => false,'class' => 'btn btn-maroon btn-sm']) ?>
                </div>

                <!-- begin #modal-dialog-add-email -->
                <div class="modal fade" id="modal-dialog-add-topic">
                    <div class="modal-dialog">
                         <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    Add Topic in <?= $forumCategory->forum_category_name ?>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input id="topic" class="form-control" placeholder="Enter topic name" />
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                                    Close
                                </a>
                                <button type="button" class="btn btn-maroon btn-sm" onclick="addTopic()">
                                    <i class="fa fa-plus"></i>
                                    Add Topic
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end #modal-dialog-add-email -->

                <!-- begin #modal-dialog-edit-topic -->
                <div class="modal fade" id="modal-dialog-edit-topic">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    ×
                                </button>
                        </div>
                        <div class="modal-body">
                            <input id="topic" class="form-control" placeholder="Enter topic name" />
                        </div>
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                                Close
                            </a>
                            <button type="button" class="btn btn-maroon btn-sm" onclick="editTopic()">
                                <i class="fa fa-plus"></i>
                                Edit Topic
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end #modal-dialog-edit-topic -->

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
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"forumTopicsAll", str_replace(' ', '-', $forumCategory->forum_category_name)]); ?>';
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

        $('#modal-dialog-edit-topic').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            $topic_name = $(e.relatedTarget).data('topic-name');
            $topic_id = $(e.relatedTarget).data('topic-id');
            $(this).data('topic-id', $topic_id);

            //populate the textbox
            $(".modal-title").text('Edit Topic ' + $topic_name);
            $("#topic").val($topic_name);
        });

        function editTopic() {
            $topic = $('#topic').val();
            $topic_id = $('#modal-dialog-edit-topic').data('topic-id');
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"forumEditTopic"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumCategories","action"=>"forumTopicsIndex",str_replace(' ', '-', $forumCategory->forum_category_name)]); ?>';
            $.ajax({
                type:'post',
                url: targeturl, 
                data: {
                    'topic' : $topic,
                    'topic_id' : $topic_id,
                    'forum_category_name' : '<?php echo $forumCategory->forum_category_name ?>'
                },
                success:function(query)  {
                    window.location = redirectURL;
                },
                error:function(xhr, ajaxOptions, thrownError) {
                    swal("Error", thrownError, "error");
                }
            });
        }

        function confirmDelete($forum_topic_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"forumDeleteTopic"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumCategories","action"=>"forumTopicsIndex",str_replace(' ', '-', $forumCategory->forum_category_name)]); ?>';
            $.ajax({
                type:'post',
                url: targeturl, 
                data: {
                    'forum_topic_id' : $forum_topic_id,
                    'forum_category_name' : '<?php echo $forumCategory->forum_category_name ?>'
                },
                success:function(query)  {
                    window.location = redirectURL;
                },
                error:function(xhr, ajaxOptions, thrownError) {
                    swal("Error", thrownError, "error");
                }
            });
        }

    </script>

</html>