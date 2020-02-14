
        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	    <div id="content" class="content">
    		<div class="post-container">
			    <div class="col-md-12">
                    <h1 class="page-header" style="color: #7e0e09;">
            		  <?= $organization_announcement->organization_announcement_title ?>
                    </h1>
				    <p style="font-size: 14px">
                        <?= $organization_announcement->organization_announcement_body ?>
                    </p>
				    <p>
                        <small>
                            Last Updated: <?= $organization_announcement->organization_announcement_modified->format('l, F d, Y g:i A') ?>
                        </small>
                    </p>
                    <hr>
                    <i class="fa fa-thumbs-up fa-fw fa-sm m-r-3">
                        <?php
                            if ($getReactionsCountAvailable == false) {
                        ?>
                            <p id="likes-count"> 0 </p>
                        <?php
                            }
                            else {
                        ?>
                            <p id="likes-count"><?= ' ' . $reactions->post_likes_count ?></p>
                        <?php
                            }
                        ?>                        
                    </i>
                    <i class="fa fa-thumbs-down fa-fw fa-sm m-r-3">
                        <?php
                            if ($getReactionsCountAvailable == false) {
                        ?>
                                <p id="dislikes-count"> 0 </p>
                        <?php
                            }
                            else {
                        ?>
                                <p id="dislikes-count"><?= ' ' . $reactions->post_dislikes_count ?></p>
                        <?php
                            }
                        ?> 
                    </i>
                    <hr>
                    <div class="">
                        <div id="post-reactions">
                            <a class="m-r-15 post-reaction btnReaction"  data-reaction="Like" id="btnLike">
                                <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                Like
                            </a>
                            <a class="m-r-15 post-reaction btnReaction"  data-reaction="Dislike" id="btnDislike">
                                <i class="fa fa-thumbs-down fa-fw fa-lg m-r-3"></i> Dislike
                            </a>
                        </div>
                        <hr>
                        <div style="">   
                            <?php 
                                    if ($login_status == true ) {
                            ?> 
                            <div class="user" style="overflow: hidden; float: left;">
                                
                                <?= $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, ['style' => 'display: block; margin-left: auto; margin-right: auto; width: 50%;']); ?>
                                    
                            </div>
                            <div class="input" style="margin-left: 7%">
                                <form action="">
                                    <div class="input-group">
                                        <input id="txtComment" type="text" class="form-control rounded-corner" placeholder="Write a comment..." />
                                        <span class="input-group-btn p-l-10">
                                            <button id="submit-comment" class="btn btn-maroon f-s-12 rounded-corner" type="button">
                                                Comment
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <?php
                                }
                                else {
                            ?>
                                    <span class="input-group-btn p-l-10">
                                        <button id="submit-comment" class="btn btn-maroon f-s-12 rounded-corner" type="button">
                                            Login to comment
                                        </button>
                                    </span>
                            <?php 
                                }
                            ?>
                        </div>
                        <hr>
                        <div id="comments-area">
                            <?php foreach ($postCommentContents as $postCommentContent): ?>
                            <div class="comment-box">
                                <div class="user" style="overflow: hidden; float: left">
                                    <?php echo $this->Html->image("../webroot/img/upload/".$postCommentContent->post_comment->user->user_profile->user_profile_photo, array()); ?>
                                </div>
                                <div class="comment" style="padding-left: 10%">
                                    <p><?= $postCommentContent->post_comment_content ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="comment-box">
                                <!--
                                <div id="post-reactions">
                                    <a href="javascript:;" class="m-r-15 post-reaction">
                                        <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                            Like
                                    </a>
                                    <a href="javascript:;" class="m-r-15 post-reaction">
                                        <i class="fa fa-thumbs-down fa-fw fa-lg m-r-3"></i> Dislike
                                    </a>
                                    <hr>
                                
                                <div style="">    
                                    <div class="user" style="overflow: hidden; float: left">
                                    <?php
                                        if ($login_status == true ) {
                                            if ($user_type == 'Employee') {
                                                echo $this->Html->image("../webroot/img/upload/".$user->user_employee_photo, array());
                                            }
                                            else if ($user_type = 'Student') {
                                                echo $this->Html->image("../webroot/img/upload/".$user->user_student_photo, array());
                                            }
                                            else if ($user_type == 'Alumni') {
                                                echo $this->Html->image("../webroot/img/upload/".$user->user_alumni_photo, array());
                                            }
                                        }
                                        else {
                                            echo $this->Html->image("../webroot/img/upload/unknown-user.png", array());
                                        }
                                    ?>
                                    </div>
                                    <div class="input" style="margin-left: 7%">
                                        <form action="">
                                            <div class="input-group">
                                                <input type="text" class="form-control rounded-corner" placeholder="Write a comment..." />
                                                <span class="input-group-btn p-l-10">
                                                    <button class="btn btn-maroon f-s-12 rounded-corner" type="button">
                                                    Comment
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end timeline single post -->
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

<footer style=" bottom: 0;
    width: 100%;">
    <?php echo $this->element('footer');?>
</footer>



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
            currentReaction();
		});

        $currentReaction = '';
        $activeReaction = '';

        function currentReaction() {
            $currentReaction = '<?php echo $currentReaction ?>';
            if ($currentReaction == 'Like') {
                $('#btnLike').css("color", "#7e0e09");
                $('#btnDislike').css("color", "gray");
                $activeReaction = 'Like';
            }
            else if ($currentReaction == 'Dislike') {
                $('#btnDislike').css("color", "#7e0e09");
                $('#btnLike').css("color", "gray");
                $activeReaction = 'Dislike';
            }
            else {
                $('#btnDislike').css("color", "gray");
                $('#btnLike').css("color", "gray");
                $activeReaction = '';
            }
            $('#current-react').html('Current is ' + $currentReaction);
        }
		
        function btnReaction() {
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front","controller"=>"Organizations","action"=>"saveAnnouncementPostReactions"]); ?>';

            <?php
                if ($login_status == true) {
            ?>

            $.ajax({        
            type:"POST",
            //the function u wanna call
            url: $url,                
            data:{'reaction': $activeReaction,
                  'organization_announcement_id': <?php echo $organization_announcement_id ?>},               
            success:function(data)
            {
                if ($activeReaction == 'Like' || $activeReaction == 'LikeCancelDislike') {
                    $('#btnLike').css("color", "#7e0e09");
                    $('#btnDislike').css("color", "gray");
                    $currentReaction = 'Like';
                }
                else if ($activeReaction == 'Dislike' || $activeReaction == 'DislikeCancelLike') {
                    $('#btnDislike').css("color", "#7e0e09");
                    $('#btnLike').css("color", "gray");
                    $currentReaction = 'Dislike';
                }
                else {
                    $('#btnLike').css("color", "gray");
                    $('#btnDislike').css("color", "gray");
                    $currentReaction = '';
                }
            },
            error:function(xhr, ajaxOptions, thrownError) {
                swal("Error", thrownError, "error");
            }
        });
            <?php
               }
               else {
            ?>
                swal('Error','Login to react to the post','error');
            <?php
                }
            ?>
        } 

        $('#btnLike').click(function(){
            <?php
                if ($login_status == true) {
            ?>
            $likes = parseInt($('#likes-count').text());
            $dislikes = parseInt($('#dislikes-count').text());
            if ($activeReaction == 'Like' || $activeReaction == 'LikeCancelDislike') {
                $activeReaction = 'LikeCancel';
                $likes -= 1;
                $('#likes-count').html($likes);
            }
            else if ($activeReaction == 'Dislike' || $activeReaction == 'DislikeCancelLike') {
                $activeReaction = 'LikeCancelDislike';
                $likes += 1;
                $dislikes -= 1;
                $('#likes-count').html($likes);
                $('#dislikes-count').html($dislikes);
            }
            else {
                $activeReaction = 'Like';
                $likes += 1;
                $('#likes-count').html($likes);
            }
            btnReaction();
            <?php
               }
               else {
            ?>
                swal('Error','Login to react to the post','error');
            <?php
                }
            ?>
        });

        $('#btnDislike').click(function(){
            <?php
                if ($login_status == true) {
            ?>
            $likes = parseInt($('#likes-count').text());
            $dislikes = parseInt($('#dislikes-count').text());

            if ($activeReaction == 'Dislike' || $activeReaction == 'DislikeCancelLike') {
                $activeReaction = 'DislikeCancel';
                $dislikes -= 1;
                $('#dislikes-count').html($dislikes);
            }
            else if ($activeReaction == 'Like' || $activeReaction == 'LikeCancelDislike') {
                $activeReaction = 'DislikeCancelLike';
                $dislikes += 1;
                $likes -= 1;
                $('#dislikes-count').html($dislikes);
                $('#likes-count').html($likes);
            }
            else {
                $activeReaction = 'Dislike';
                $dislikes += 1;
                $('#dislikes-count').html($dislikes);
            }
            btnReaction();
            <?php
               }
               else {
            ?>
                swal('Error','Login to react to the post','error');
            <?php
                }
            ?>
        });
        
        $('#submit-comment').click(function(){
            $comment = $('#txtComment').val();
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front","controller"=>"Organizations","action"=>"saveAnnouncementPostComments"]); ?>';

            $.ajax({        
            type:"POST",
            url: $url,                
            data:{'comment':$comment,
                  'organization_announcement_id': <?php echo $organization_announcement_id ?>
            },               
            success:function(data)
            {
                <?php 
                    if ($login_status == true ) {
                ?>
                        $('<div class="comment-box"><div class="user" style="overflow: hidden; float: left"><?php echo $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, array()); ?></div><div class="comment" style="padding-left: 10%"><p>' + $comment + '</p></div></div>').prependTo('#comments-area');
                <?php 
                    }
                ?>
            },
            error:function(xhr, ajaxOptions, thrownError) {
                swal("Error", thrownError + $reaction, "error");
            }
        });
        }); 

	</script>
</html>
