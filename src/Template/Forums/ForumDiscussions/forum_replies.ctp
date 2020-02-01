<!-- src/Template/Forums/ForumDiscussions/forum_replies.ctp -->

            <?php echo $this->element('UserHeader');?>

            <!-- begin #top-menu -->
            <div id="top-menu" class="navbar-header top-menu">
                
                <!-- begin top-menu nav -->
                <ul class="nav navbar-nav">
                    <!-- begin breadcrumb -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <?php echo $this->Html->link('Forum',['controller' => 'Forums','action'=>'forumHome']) ?>
                        </li>
                        <li class="breadcrumb-item">
                        <?= $this->Html->link('Categories', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex'],['escape' => false]) ?>
                        </li>
                        <li class="breadcrumb-item">
                            <?= $this->Html->link($discussion->forum_topic->forum_category->forum_category_name , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name))])?>
                        </li>
                        <li class="breadcrumb-item">
                            <?= $this->Html->link($discussion->forum_topic->forum_topic_name , ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name)],['escape' => false])?>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= $discussion->forum_discussion_title ?>
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
                <h2 id="test"><?= $discussion->forum_discussion_title ?></h2>
                <p>by 
                    <?php echo $this->Html->link($discussion->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $discussion->user->username )) ?>, <?= $discussion->forum_discussion_created ?>
                </p>

                <!-- begin table -->
                <table id="data-table-select" class="table table-bordered">
                    <tbody>
                        <!-- begin discussion content row -->
                        <tr class="odd gradeX">
                            <!-- discussion poster profile -->
                            <td style="width: 20%; text-align: center; padding: 3%">
                                <?php echo $this->Html->image("../webroot/img/upload/".$discussion->user->user_profile->user_profile_photo,['style' => 'width: 50%']); ?>
                                <br>
                                <b>
                                    <?php echo $this->Html->link($discussion->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $discussion->user->username )) ?>
                                </b>
                                <br>
                                <?= $discussion->user->user_type->user_type_name ?> 
                                <!-- view user type -->
                                <br>
                                    <?php
                                        if ($discussion->user->user_type_id == 1) {
                                            # admin
                                        }
                                        else if ($discussion->user->user_type_id == 2) {
                                            # employee
                                        }
                                        else if ($discussion->user->user_type_id == 3) {
                                            # student
                                            echo $discussion->user->user_students[0]->course->course_name;
                                        }
                                        else if ($discussion->user->user_type_id == 4) {
                                            # alumni
                                        }
                                    ?>
                                <br>
                                <br>
                                <?= $discussion->user->user_forum_activity_count->user_forum_activity_discussions_count ?> forum post/s
                                <br>
                                <?= $discussion->user->user_forum_activity_count->user_forum_activity_replies_count ?>
                                forum replies
                            </td>
                            <!-- begin discussion content -->
                            <td style="width: 80%; position: relative">
                                <!-- begin discussion content header -->
                                <div style="margin-bottom: 5%">
                                    <h4 style="margin-bottom: 0"><?= $discussion->forum_discussion_title ?></h4>
                                    <small><?= $discussion->forum_discussion_created ?></small>
                                
                                    <?php
                                        # if discussion is by current user view edit, delete actions
                                        if ($discussion->user->id == $currentUser) {
                                    ?>
                                            <div style="float: right;">
                                                <?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'ForumDiscussions', 'action' => 'forumEditDiscussion',str_replace(' ', '-',$discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-',$discussion->forum_topic->forum_topic_name) , str_replace(' ', '-',$discussion->forum_discussion_title) ],['class' => 'btn btn-yellow btn-xs', 'title' => 'Edit', 'escape' => false]) ?>
                                                <button type="button" onclick="confirmDeleteDiscussion('<?php echo $discussion->forum_discussion_id ?>')" class="btn btn-yellow btn-xs" id="btnDelete" title = "Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                    <?php     
                                        }      
                                    ?>
                                </div>
                                <!-- end discussion content header -->
                                <!-- begin discussion content -->
                                <div>
                                                <p id="clicked-react"></p>
                                                <p id="sent-react"></p>
                                    <?= $discussion->forum_discussion_detail->forum_discussion_content?>
                                    <!-- begin discussion reactions -->
                                    <div class="" style="vertical-align:bottom;position: absolute; bottom: 10%; width: 100%; margin-right: 1%;">
                                        <div class="" style="right: 1%; position: absolute;">
                                            <div id="discussion-post-reactions">
                                                <a class="m-r-15 post-reaction btnDiscussionReaction"  data-discussion-vote="DiscussionUpvote" id="btnDiscussionUpvote" title="Upvote">
                                                    <i class="fa fa-thumbs-up"></i>
                                                    <span id="txtDiscussionUpvoteCount">
                                                        <?= $discussion->forum_discussion_detail->forum_discussion_detail_upvote_count ?>
                                                    </span>
                                                </a>
                                                <a class="m-r-15 post-reaction btnDiscussionReaction"  data-discussion-vote="DiscussionDownvote" id="btnDiscussionDownvote" title="Downvote">
                                                    <i class="fa fa-thumbs-down"></i>
                                                    <span id="txtDiscussionDownvoteCount">
                                                        <?= $discussion->forum_discussion_detail->forum_discussion_detail_downvote_count ?>
                                                    </span>
                                                </a>
                                                <?= $this->Html->link('<i class="fa fa-comment"></i> '.$discussion->forum_discussion_detail->forum_discussion_detail_replies_count, ['controller' => 'ForumDiscussions', 'action' => 'forumAddReply', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title)],['class' => 'button m-r-15', 'escape' => false])?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end discussion reactions -->
                                </div>
                                <!-- end discussion content -->
                            </td>
                            <!-- end discussion content -->
                    </tr>
                    <!-- end discussion content row-->
                    <!-- begin discussion replies -->
                    <?php 
                        foreach ($replies as $reply):
                    ?>
                            <tr class="odd gradeX">
                                <!-- begin discussion reply user profile -->
                                <td style="width: 20%; text-align: center; padding: 3%">
                                    <?php echo $this->Html->image("../webroot/img/upload/".$reply->user->user_profile->user_profile_photo,['style' => 'width: 50%']); ?>
                                    <br>
                                    <b>
                                        <?php echo $this->Html->link($reply->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $reply->user->username )) ?>
                                    </b>
                                    <br>
                                    <?= $reply->user->user_type->user_type_name ?> 
                                    <br>
                                    <?php
                                        if ($reply->user->user_type_id == 1) {
                                            # admin
                                        }
                                        else if ($reply->user->user_type_id == 2) {
                                            # employee
                                            echo $reply->user->user_employees[0]->employee_position_name->employee_position_name;
                                        }
                                        else if ($reply->user->user_type_id == 3) {
                                            # student
                                            echo $reply->user->user_students[0]->course->course_name;
                                        }
                                        else if ($reply->user->user_type_id == 4) {
                                            # alumni
                                            echo $reply->user->user_alumni[0]->course->course_name;
                                        }
                                    ?>
                                    <br>
                                    <br>
                                    <?= $reply->user->user_forum_activity_count->user_forum_activity_discussions_count ?> forum post/s
                                    <br>
                                    <?= $reply->user->user_forum_activity_count->user_forum_activity_replies_count ?> forum replies
                                </td>
                                <!-- end discussion reply user profile -->

                                <!-- begin discussion reply content -->
                                <td style="width: 80%;position: relative">
                                    <div class="discussion-reply-header" style="margin-bottom: 5%">
                                        <small><?= $reply->forum_reply_created ?></small>
                                        <div style="float: right">
                                            <?php
                                                if ($reply->user->id == $currentUser) {
                                            ?>
                                                    <?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'ForumDiscussions', 'action' => 'forumEditReply', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title), $reply->forum_reply_id],['escape' => false , 'class' => 'btn btn-yellow btn-xs','title' => 'Edit'])?>
                                                    <button type="button" onclick="confirmDelete('<?php echo $reply->forum_reply_id ?>')" class="btn btn-yellow btn-xs" id="btnDelete" title = "Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div>
                                        <?php
                                            if ($reply->forum_parent_reply_id != null) {
                                        ?>
                                                <div id="reply-discussion-content" style="">
                                                    <?php echo $this->Html->link($reply->forum_parent_reply->user->username,array('prefix' => false,'controller' => 'Users','action'=>'userProfile', $reply->forum_parent_reply->user->username )) ?> wrote:
                                                    <br>
                                                    <q> 
                                                        <i>
                                                            <?= $reply->forum_parent_reply->forum_reply_detail->forum_reply_detail_content ?>
                                                        </i>
                                                    </q>
                                                </div>
                                        <?php
                                           ; }
                                        ?>
                                        <?= $reply->forum_reply_detail->forum_reply_detail_content ?>
                                        <!-- begin discussion reactions -->
                                    <div class="" style="vertical-align:bottom;position: absolute; bottom: 10%; width: 100%; margin-right: 1%">
                                        <div class="" style="right: 1%; position: absolute;">
                                            <div id="post-reactions">
                                                <a class="m-r-15 post-reaction btnReplyUpvote
                                                    <?php 
                                                        if ($reply->user_forum_reply_votes != null) {
                                                            if($reply->user_forum_reply_votes[0]->forum_reply_vote_upvote == true)  { 
                                                                echo 'currentReplyReact';
                                                            } 
                                                        }
                                                    ?>"
                                                    data-reply-vote="ReplyUpvote" data-reply-id="<?php echo $reply->forum_reply_id?>" id="" title="Upvote"
                                                    style="
                                                        <?php 
                                                            if ($reply->user_forum_reply_votes != null) {
                                                                if($reply->user_forum_reply_votes[0]->forum_reply_vote_upvote == true)  { 
                                                                    echo 'color : #7e0e09;';
                                                                } 
                                                            }
                                                        ?>">
                                                    <i class="fa fa-thumbs-up"></i>

                                                    <span class="txtReplyUpvoteCount">
                                                        <?= $reply->forum_reply_detail->forum_reply_detail_likes_count ?>
                                                    </span>                                                    
                                                </a>
                                                <a class="m-r-15 post-reaction btnReplyDownvote
                                                <?php 
                                                    if ($reply->user_forum_reply_votes != null) {
                                                        if($reply->user_forum_reply_votes[0]->forum_reply_vote_downvote == true)  { 
                                                            echo 'currentReplyReact';
                                                        } 
                                                    }
                                                ?>"
                                                data-reply-vote="ReplyDownvote" data-reply-id="<?php echo $reply->forum_reply_id ?>" id="" title="Downvote"
                                                style="
                                                    <?php 
                                                        if ($reply->user_forum_reply_votes != null) {
                                                            if($reply->user_forum_reply_votes[0]->forum_reply_vote_downvote == true)  { 
                                                                echo 'color : #7e0e09;';
                                                            } 
                                                        }
                                                    ?>"
                                                >
                                                    <i class="fa fa-thumbs-down"></i>
                                                    <span class="txtReplyDownvoteCount">
                                                        <?= $reply->forum_reply_detail->forum_reply_detail_dislikes_count ?>
                                                    </span>                                                    
                                                </a>
                                                <?= $this->Html->link('<i class="fa fa-reply"></i> Reply', ['controller' => 'ForumDiscussions', 'action' => 'forumReplyToReply', str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title), $reply->forum_reply_id],['class' => 'button m-r-15', 'escape' => false])?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end discussion reactions -->
                                    </div>
                                    <div class="row" style="clear: both;vertical-align:bottom;position: absolute;bottom: 1%; width: 100%">
                                        <div class="" style="text-align: left">
                                        </div>
                                        <div class="" style="text-align: right; margin-right: 0">
                                        </div>
                                    </div>
                                </td>
                                <!-- begin discussion reply content -->
                            </tr>
                    <?php
                        endforeach;
                    ?>
                    <!-- end discussion replies -->
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
        $currentDiscussionVote = '';
        $activeReaction = '';
        currentDiscussionVote();
        $('#clicked-react').html('I clicked ' + $activeReplyVote);
    });

        $currentDiscussionVote = '';
        $activeReaction = '';
        $activeVote = '';
        $currentReplyVote = '';
        $activeReplyVote = '';

        $currentRow = '';

        function currentDiscussionVote() {
            $currentDiscussionVote = '<?php echo $currentDiscussionVote ?>';
            if ($currentDiscussionVote == 'DiscussionUpvote') {
                $('#btnDiscussionUpvote').css("color", "#7e0e09");
                $('#btnDiscussionDownvote').css("color", "gray");
                $activeReaction = 'DiscussionUpvote';
            }
            else if ($currentDiscussionVote == 'DiscussionDownvote') {
                $('#btnDiscussionDownvote').css("color", "#7e0e09");
                $('#btnDiscussionUpvote').css("color", "gray");
                $activeReaction = 'DiscussionDownvote';
            }
            $('#clicked-react').html('Current is ' + $currentDiscussionVote);
        }

        function confirmDelete($forum_reply_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumDiscussions","action"=>"forumDeleteReply",str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title)]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumDiscussions","action"=>"forumReplies",str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title)]); ?>';
            $('#test').text($forum_reply_id);
            swal({
                title: "Are you sure?",
                text: "You want to remove email?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#ff5b57',
                confirmButtonClass: "btn btn-info",
                confirmButtonText: "Remove",
                cancelButtonText: "Cancel"
            },  
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url: targeturl,              
                        data: {'forum_reply_id' : $forum_reply_id},
                        success:function(query)  {
                            window.location = redirectURL;
                        },
                        error:function(xhr, ajaxOptions, thrownError) {
                            swal("Error", thrownError, "error");
                        }
                    });
                }
            });
        }


        function confirmDeleteDiscussion($forum_discussion_id) {
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumDiscussions","action"=>"forumDeleteDiscussion",str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name), str_replace(' ', '-', $discussion->forum_discussion_title)]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumDiscussions","action"=>"forumDiscussionsIndex",str_replace(' ', '-', $discussion->forum_topic->forum_category->forum_category_name), str_replace(' ', '-', $discussion->forum_topic->forum_topic_name)]); ?>';
            swal({
            title: "Are you sure?",
            text: "You want to remove email?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#ff5b57',
            confirmButtonClass: "btn btn-info",
            confirmButtonText: "Remove",
            cancelButtonText: "Cancel"
            },  
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        type:'post',
                        url: targeturl,              
                        data: {'forum_discussion_id' : $forum_discussion_id},
                        success:function(query)  {
                            window.location = redirectURL;
                        },
                        error:function(xhr, ajaxOptions, thrownError) {
                            swal("Error", thrownError, "error");
                        }
                    });
                }
            });
            }


        function reactToDiscussion() {

            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums","controller"=>"ForumDiscussions","action"=>"forumDiscussionVote"]); ?>';

            $.ajax({        
                type:"POST",
                url: $url,                
                data:{
                    'discussion_vote': $activeVote,
                    'discussion_id': <?php echo $discussion->forum_discussion_id ?>
                },               
                success:function(data)
                {
                    if ($activeVote == 'DiscussionUpvote' || $activeVote == 'DiscussionUpvoteCancelDownvote') {
                        $('#btnDiscussionUpvote').css("color", "#7e0e09");
                        $('#btnDiscussionDownvote').css("color", "gray");
                    }
                    else if ($activeVote == 'DiscussionDownvote' || $activeVote == 'DiscussionDownvoteCancelUpvote') {
                        $('#btnDiscussionDownvote').css("color", "#7e0e09");
                        $('#btnDiscussionUpvote').css("color", "gray");
                    }
                    else {
                        $('#btnDiscussionUpvote').css("color", "gray");
                        $('#btnDiscussionDownvote').css("color", "gray");
                    }
                },
                error:function(xhr, ajaxOptions, thrownError) {
                    swal("Error", thrownError, "error");
                }
            });
        };

        function reactToReply($activeReplyVote,$reply_id) {
            $url = 'http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums","controller"=>"ForumDiscussions","action"=>"forumReplyVote"]); ?>';

            $.ajax({        
                type:"POST",
                url: $url,                
                data:{
                    'reply_vote': $activeReplyVote,
                    'reply_id': $reply_id
                },               
                success:function(data)
                {   

                },
                error:function(xhr, ajaxOptions, thrownError) {
                    swal("Error", thrownError, "error");
                }
            });
        };



        $('#btnDiscussionUpvote').click(function(){
            $discussionUpvotes = parseInt($('#txtDiscussionUpvoteCount').text());
            $discussionDownvotes = parseInt($('#txtDiscussionDownvoteCount').text());
            // if upvote is active when upvote is clicked, deactivate upvote and deduct number of upvotes
            // Cancel upvote
            if ($activeReaction == 'DiscussionUpvote') {
                $activeVote = 'DiscussionUpvoteCancel';
                $discussionUpvotes -= 1;
                $('#txtDiscussionUpvoteCount').html($discussionUpvotes);
            }
            // if downvote is active when upvote is clicked, deactivate downvote and deduct number of downvotes, then activate upvote and increase number of upvotes
            // Cancel downvote, upvote discussion
            else if ($activeReaction == 'DiscussionDownvote') {
                $activeVote = 'DiscussionUpvoteCancelDownvote';
                $discussionUpvotes += 1;
                $discussionDownvotes -= 1;
                $('#txtDiscussionUpvoteCount').html($discussionUpvotes);
                $('#txtDiscussionDownvoteCount').html($discussionDownvotes);
            }
            // if neither upvote nor downvote is active, activate upvote then increase number of upvotes
            // first vote
            else {
                $activeVote = 'DiscussionUpvote';
                $discussionUpvotes += 1;
                $('#txtDiscussionUpvoteCount').html($discussionUpvotes);
            }
            reactToDiscussion();
        });

        $('#btnDiscussionDownvote').click(function(){
            $discussionUpvotes = parseInt($('#txtDiscussionUpvoteCount').text());
            $discussionDownvotes = parseInt($('#txtDiscussionDownvoteCount').text());
            // if downvote is active when downvote is clicked, deactivate downvote and deduct number of downvotes
            // Cancel downvote

            if ($activeReaction == 'DiscussionDownvote') {
                $activeVote = 'DiscussionDownvoteCancel';
                $discussionDownvotes -= 1;
                $('#txtDiscussionDownvoteCount').html($discussionDownvotes);
            }
            // if upvote is active when downvote is clicked, deactivate upvote and deduct number of upvotes, then activate downvote and increase number of downvotes
            // Cancel upvote, downvote discussion
            else if ($activeReaction == 'DiscussionUpvote') {
                $activeVote = 'DiscussionDownvoteCancelUpvote';
                $discussionDownvotes += 1;
                $discussionUpvotes -= 1;
                $('#txtDiscussionDownvoteCount').html($discussionDownvotes);
                $('#txtDiscussionUpvoteCount').html($discussionUpvotes);
            }
            // if neither downvote nor upvote is active, activate downvote then increase number of downvotes
            // first vote
            else {
                $activeVote = 'DiscussionDownvote';
                $discussionDownvotes += 1;
                $('#txtDiscussionDownvoteCount').html($discussionDownvotes);
            }
            reactToDiscussion();
        });



        $('.btnReplyUpvote').click(function(){
            $row = jQuery(this).closest("tr");
            $txtReplyUpvoteCount = $row.find(".txtReplyUpvoteCount");
            $txtReplyDownvoteCount = $row.find(".txtReplyDownvoteCount");
            $btnReplyUpvote =  $row.find(".btnReplyUpvote");
            $btnReplyDownvote =  $row.find(".btnReplyDownvote");
            $reply_id = $row.find(".btnReplyUpvote").data("reply-id");
            if ($currentRow != $reply_id) {
                $activeReplyVote = $row.data("activeReplyVote");
            }
            if ($btnReplyUpvote.hasClass("currentReplyReact")) {
                $activeReplyVote = 'ReplyUpvote';
                $btnReplyUpvote.removeClass("currentReplyReact");
            }
            else if ($btnReplyDownvote.hasClass("currentReplyReact")) {
                $activeReplyVote = 'ReplyDownvote';
                $btnReplyDownvote.removeClass("currentReplyReact");
            }
            $currentRow = $row.find(".btnReplyUpvote").data("reply-id");
            $btnReplyUpvote.css("color", "#7e0e09");

            $replyUpvotes = parseInt($row.find('.txtReplyUpvoteCount').text());
            $replyDownvotes = parseInt($row.find('.txtReplyDownvoteCount').text());
            // if upvote is active when upvote is clicked, deactivate upvote and deduct number of upvotes
            // Cancel upvote
            if ($activeReplyVote == 'ReplyUpvote' || $activeReplyVote == 'ReplyUpvoteCancelDownvote') {
                $activeReplyVote = 'ReplyUpvoteCancel';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyUpvotes -= 1;
                $txtReplyUpvoteCount.html($replyUpvotes);
                $btnReplyUpvote.css("color", "gray");
            }
            // if downvote is active when upvote is clicked, deactivate downvote and deduct number of downvotes, then activate upvote and increase number of upvotes
            // Cancel downvote, upvote discussion
            else if ($activeReplyVote == 'ReplyDownvote'|| $activeReplyVote == 'ReplyDownvoteCancelUpvote') {
                $activeReplyVote = 'ReplyUpvoteCancelDownvote';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyUpvotes += 1;
                $replyDownvotes -= 1;
                $txtReplyUpvoteCount.html($replyUpvotes);
                $txtReplyDownvoteCount.html($replyDownvotes);
                $btnReplyUpvote.css("color", "#7e0e09");
                $btnReplyDownvote.css("color", "gray");
            }
            // if neither upvote nor downvote is active, activate upvote then increase number of upvotes
            // first vote
            else {
                $activeReplyVote = 'ReplyUpvote';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyUpvotes += 1;
                $txtReplyUpvoteCount.html($replyUpvotes);
                $btnReplyUpvote.css("color", "#7e0e09");
            }
            reactToReply($activeReplyVote,$reply_id);
        });

        $('.btnReplyDownvote').click(function(){
            $row = jQuery(this).closest("tr");
            $txtReplyUpvoteCount = $row.find(".txtReplyUpvoteCount");
            $txtReplyDownvoteCount = $row.find(".txtReplyDownvoteCount");
            $btnReplyUpvote =  $row.find(".btnReplyUpvote");
            $btnReplyDownvote =  $row.find(".btnReplyDownvote");
            $reply_id = $row.find(".btnReplyUpvote").data("reply-id");
            if ($currentRow != $reply_id) {
                $activeReplyVote = $row.data("activeReplyVote");
            }
            if ($btnReplyDownvote.hasClass("currentReplyReact")) {
                $activeReplyVote = 'ReplyDownvote';
                $btnReplyDownvote.removeClass("currentReplyReact");
            }
            else if ($btnReplyUpvote.hasClass("currentReplyReact")) {
                $activeReplyVote = 'ReplyUpvote';
                $btnReplyUpvote.removeClass("currentReplyReact");
            }
            $currentRow = $row.find(".btnReplyDownvote").data("reply-id");
            $btnReplyDownvote.css("color", "#7e0e09");

            $replyUpvotes = parseInt($row.find('.txtReplyUpvoteCount').text());
            $replyDownvotes = parseInt($row.find('.txtReplyDownvoteCount').text());
            // if upvote is active when upvote is clicked, deactivate upvote and deduct number of upvotes
            // Cancel upvote
            if ($activeReplyVote == 'ReplyDownvote' || $activeReplyVote == 'ReplyDownvoteCancelUpvote') {
                $activeReplyVote = 'ReplyDownvoteCancel';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyDownvotes -= 1;
                $txtReplyDownvoteCount.html($replyDownvotes);
                $btnReplyDownvote.css("color", "gray");
            }
            // if downvote is active when upvote is clicked, deactivate downvote and deduct number of downvotes, then activate upvote and increase number of upvotes
            // Cancel downvote, upvote discussion
            else if ($activeReplyVote == 'ReplyUpvote' || $activeReplyVote == 'ReplyUpvoteCancelDownvote') {
                $activeReplyVote = 'ReplyDownvoteCancelUpvote';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyDownvotes += 1;
                $replyUpvotes -= 1;
                $txtReplyDownvoteCount.html($replyDownvotes);
                $txtReplyUpvoteCount.html($replyUpvotes);
                $btnReplyDownvote.css("color", "#7e0e09");
                $btnReplyUpvote.css("color", "gray");
            }
            // if neither upvote nor downvote is active, activate upvote then increase number of upvotes
            // first vote
            else {
                $activeReplyVote = 'ReplyDownvote';
                $row.data('activeReplyVote',$activeReplyVote);
                $replyDownvotes += 1;
                $txtReplyDownvoteCount.html($replyDownvotes);
                $btnReplyDownvote.css("color", "#7e0e09");
            };
            reactToReply($activeReplyVote,$reply_id);
        });

    </script>

</html>