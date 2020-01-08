
    <?php echo $this->element('NavBar');?>
    <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	    <div id="content" class="content">
		
		<div class="post-container">
			<div class="col-md-12">
                <h1 class="page-header" style="color: #7e0e09;">
            		<?= $row->announcement_title ?>
    			</h1>
				<p style="font-size: 14px">
                    <?= $row->announcement_body ?>
                </p>
				<p>
                    <small>
                        Last Updated: <?= $row->announcement_modified->format(DATE_RFC850) ?>
                    </small>
                </p>
                <div class="">
                    <div id="post-reactions">
                        <a href="javascript:;" class="m-r-15 post-reaction btnReaction"  data-reaction="like" id="btnLike">
                            <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                Like
                        </a>
                        <a href="javascript:;" class="m-r-15 post-reaction btnReaction"  data-reaction="dislike" id="btnDislike">
                            <i class="fa fa-thumbs-down fa-fw fa-lg m-r-3"></i> Dislike
                        </a>
                    </div>
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
                        <hr>
                        <div class="comment-box">
                            <div class="user" style="overflow: hidden; float: left">
                                <?php echo $this->Html->image("../webroot/img/upload/unknown-user.png", array()); ?>
                            </div>
                            <div class="comment" style="padding-left: 10%">
                                <p>Qwe rtyu iop. Asdfgh jkl; zxc vbnm.</p>
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
                    </div>
                            </div>
                        </div>
                        <hr>
                        <div class="comment-box">
                            <div class="user" style="overflow: hidden; float: left">
                                <?php echo $this->Html->image("../webroot/img/upload/unknown-user.png", array()); ?>
                            </div>
                            <div class="comment" style="padding-left: 10%">
                                <p>Qwe rtyu iop. Asdfgh jkl; zxc vbnm.</p>
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
		});
	</script>
	
	<script>
        $('.btnReaction').click(function(){
            $reaction = $(this).data("reaction");
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Tests","action"=>"saveReaction"]); ?>';

            $.ajax({        
            type:"POST",
            //the function u wanna call
            url: $url,                
            data:{'reaction':$reaction},               
            success:function(data)
            {
                if ($reaction == 'like') {
                    $('#btnLike').css("color", "#7e0e09");
                    $('#btnDislike').css("color", "gray");
                }
                else if ($reaction == 'dislike') {
                    $('#btnDislike').css("color", "#7e0e09");
                    $('#btnLike').css("color", "gray");
                }
            },
            error:function(xhr, ajaxOptions, thrownError) {
                $('#showText').val($reaction);
                swal("Error", thrownError + $url, "error");
            }
        });
        });

        function testOnClick() {
            
        }

	</script>
</html>
