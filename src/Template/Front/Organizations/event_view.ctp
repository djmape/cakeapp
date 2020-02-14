
        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	   <div id="content" class="content" style="background-color: #fff">
            <?php echo $this->Flash->render(); ?>
            <div id="post-container">
                <div class="col-md-10">
                    <h2><?= $organization_event->organization_event_title ?></h2>
					<br>
                    <p style="font-size: 14px"> 
                        <b> Location: </b> 
                        <?= $organization_event->organization_event_location ?>
                    </p>
                    <p style="font-size: 14px">  
                        <b> Event Period: </b>
                        <?= $organization_event->organization_event_start_date ?>
                        <?= $organization_event->organization_event_start_time ?>
                        - 
                        <?= $organization_event->organization_event_end_date ?> 
                        <?= $organization_event->organization_event_end_time ?>
                    </p>
                    <p style="font-size: 14px"> 
                        <b> Participants: </b> 
                        <?= $organization_event->organization_event_participants ?>
                    </p>
					<br>
					<div style="margin-bottom: 5%; margin-top: 5%;">
                        <?php echo $this->Html->image("../webroot/img/upload/".$organization_event->organization_event_photo, array('class' => 'center-block','style' => 'max-width:100%; max-height:500px;')); ?>
                    </div>
                    <br>
                    <p style="font-size: 14px"><?= $organization_event->organization_event_body ?></p>
                    <br>
                    <p style="font-size: 14px">
                        <?php 
                            if ($organization_event->organization_event_sponsors != "") {
                                echo "<b> Sponsor: </b>";
                            }
                        ?>
                        <?= $organization_event->organization_event_sponsor ?>
                    </p>
                    <br>
					<p>
                        <small>
                            Last Updated: <?= $organization_event->organization_event_modified ?>
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
                    <p class="clicked-react"></p>
                    <div class="">
                        <div id="post-reactions">
                            <a href="javascript:;" class="m-r-15 post-reaction btnReaction" data-reaction="Like" id="btnLike">
                                <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                Like
                            </a>
                            <a href="javascript:;" class="m-r-15  btnReaction"  data-reaction="Dislike" id="btnDislike">
                                <i class="fa fa-thumbs-down fa-fw fa-lg m-r-3"></i> Dislike
                            </a>
                        </div>
                        <hr>
                        <div class = "row"> 
                            <?php
                                if ($login_status == true ) {
                            ?>   
                                        <div class="user col-md-3" style="overflow: hidden; float: left">
                                
                                                <?= $this->Html->image("../webroot/img/upload/".$profile->user_profile_photo, ['style' => 'display: block; margin-left: auto; margin-right: auto; width: 20%; height: auto']); ?>
                                    
                                        </div>
                                        <div class="input col-md-9" style="margin-left: 7%">
                                            <form action="">
                                                <div class="input-group">
                                                    <input id="txtComment" type="text" class="form-control rounded-corner" placeholder="Write a comment..." />
                                                    <span class="input-group-btn p-l-10">
                                                        <button id="submit-comment" class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
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
                    </div>
                    <!-- end timeline single post -->
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
                            <div class="user" style="overflow: hidden; float: left">
                                <?php echo $this->Html->image("../webroot/img/upload/unknown-user.png", array()); ?>
                            </div>
                            <div class="comment" style="padding-left: 10%">
                                <p>Qwe rtyu iop. Asdfgh jkl; zxc vbnm.</p>
                            </div>
                        </div>

					<!-- begin Question Panel -->
                    <div class="panel panel-inverse" id="inquiry-panel">
                    	<div class="panel-heading">
                            <h5 style="color: white">
                                <i class="fa fa-plus"></i>
                                <b> Questions about <?= $organization_event->event_title ?> </b>
                            </h5>
                        </div>
                        <div class="panel-body">
							<?php echo $this->Form->create($email, ['url' => ['action' => 'sendMail',$organization_event->organization_event_id]]); ?>
                            <div class="form-group row m-b-15">
                                <div class="col-md-12">
                                    <label class="col-md-4 col-form-label">Event</label>
                                    <?php echo $this->Form->control('subject', array('class' => 'form-control','label' => false,'default' => $organization_event->event_title,'disabled' => true)); ?>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-form-label">Email</label>
                                <div class="col-md-12">
                                	<?php echo $this->Form->control('email', array('class' => 'form-control','label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-form-label">Name</label>
                                <div class="col-md-12">
                                	<?php echo $this->Form->control('name', array('class' => 'form-control','label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group row m-b-15">
                                <label class="col-md-4 col-form-label">Message</label>
                                <div class="col-md-12">
                               		<?php echo $this->Form->control('message', array('type' => 'textarea','class' => 'form-control','label' => false)); ?>
                                </div>
                            </div>
                            <div class="pull-right" style=" margin-bottom: 1%">
                                <?php echo $this->Form->button(__('Send'), array('class' => 'btn btn-sm btn-yellow'));
                                      echo $this->Form->end();
                                ?>
                            </div>
                        </div>
                    </div>
					<!-- end Question Panel -->
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
           	$('.clicked-react').html('I clicked ' + $activeReaction);
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front","controller"=>"Organizations","action"=>"saveEventPostReactions"]); ?>';

            <?php
                if ($login_status == true) {
            ?>

                    $.ajax({        
                    type:"POST",
                    url: $url,                
                    data:{
                        'reaction': $activeReaction,
                        'organization_event_id': <?php echo $organization_event->organization_event_id ?>
                    },               
                    success:function(data)
                    {
                        $reaction = $(this).data("reaction");

                        if ($currentReaction == $reaction) {
                            $reaction = 'Cancel';
                        }
                        if ($activeReaction == 'Like'  || $activeReaction == 'LikeCancelDislike') {
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
        }; 

        $('#btnLike').click(function(){
            <?php
                if ($login_status == true) {
            ?>

            $likes = parseInt($('#likes-count').text());
            $dislikes = parseInt($('#dislikes-count').text());

            // if like is active then like is clicked.
            // cancel like
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

        $('#submit-comment').click( function() {
            $comment = $('#txtComment').val();
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front","controller"=>"Organizations","action"=>"saveEventPostComment"]); ?>';

            $.ajax({        
                type:"POST",
                url: $url,                
                data:{
                    'comment':$comment,
                    'organization_event_id': <?php echo $organization_event->organization_event_id ?>
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
