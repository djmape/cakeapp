
        <?php echo $this->element('NavBar');?>
        <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	   <div id="content" class="content" style="background-color: #fff">
            <?php echo $this->Flash->render(); ?>
            <div id="post-container">
                <div class="col-md-10">
                    <h2><?= $row->event_title ?></h2>
					<br>
                    <p style="font-size: 14px"> 
                        <b> Location: </b> 
                        <?= $row->event_location ?>
                    </p>
                    <p style="font-size: 14px">  
                        <b> Event Period: </b>
                        <?= $row->event_start_date ?>
                        <?= $row->event_start_time ?>
                        - 
                        <?= $row->event_end_date ?> 
                        <?= $row->event_end_time ?>
                    </p>
                    <p style="font-size: 14px"> 
                        <b> Participants: </b> 
                        <?= $row->event_participants ?>
                    </p>
					<br>
					<div style="margin-bottom: 5%; margin-top: 5%;">
                        <?php echo $this->Html->image("../webroot/img/upload/".$row->event_photo, array('class' => 'center-block','style' => 'max-width:100%; max-height:500px;')); ?>
                    </div>
                    <br>
                    <p style="font-size: 14px"><?= $row->event_body ?></p>
                    <br>
                    <p style="font-size: 14px">
                        <?php 
                            if ($row->event_sponsors != "") {
                                echo "<b> Sponsor: </b>";
                            }
                        ?>
                        <?= $row->event_sponsor ?>
                    </p>
                    <br>
						<!-- For Embed Location
						<iframe id="locationIframe" src="<?php echo $row->event_location_embed?>" class="center-block" width="80%" height="500" frameborder="0" style="border:0; display: hidden" allowfullscreen></iframe>
						<br>
						-->

					<p>
                        <small>
                            Last Updated: <?= $row->event_modified ?>
                        </small>
                    </p>
                    <div class="">
                            <div id="post-reactions">
                                <a href="javascript:;" class="m-r-15 post-reaction" style="color: gray">
                                    <i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i>
                                    Like
                                </a>
                                <a href="javascript:;" class="m-r-15 post-reaction">
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
                                                <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end timeline single post -->

					<!-- begin Question Panel -->
                    <div class="panel panel-inverse" id="inquiry-panel">
                    	<div class="panel-heading">
                            <h5 style="color: white">
                                <i class="fa fa-plus"></i>
                                <b> Questions about <?= $row->event_title ?> </b>
                            </h5>
                        </div>
                        <div class="panel-body">
							<?php echo $this->Form->create($email, ['url' => ['action' => 'sendMail',$row->event_id]]); ?>
                            <div class="form-group row m-b-15">
                                <div class="col-md-12">
                                    <label class="col-md-4 col-form-label">Event</label>
                                    <?php echo $this->Form->control('subject', array('class' => 'form-control','label' => false,'default' => $row->event_title,'disabled' => true)); ?>
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
		var iframe = document.getElementById('locationIframe');

		$(document).ready(function() {
			App.init();
    		iframe.style.display = 'none';
		});

		$(function(){
    		$('#locationIframe').ready(function(){
        		iframe.style.display = 'inline';
    		});
		});

	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-53034621-1', 'auto');
		ga('send', 'pageview');

	</script>

</html>
