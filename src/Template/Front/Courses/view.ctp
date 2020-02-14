            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
				<!-- begin .row -->
		        <div class="row">
                    <!-- end .col-md-12 -->
					<div class="col-md-12">

    					<h1 class="page-header" style="color: #7e0e09;">
                    		<?= $course->course_name. ' (' . $course->course_acronym. ')' ?>
    					</h1>

                        <p style="font-size: 14px">
                        	<b>Course Type</b>
                        </p>
						<p style="font-size: 14px">
							<?= $course->course_type ?>
						</p>
						<p style="font-size: 14px">
							<b>Organization</b>
						</p>
						<p style="font-size: 14px">
							<?= $organization->organization->organization_name ?>
						</p>

                        <!-- begin course mission -->
                        <?php
                            if ($course->course_mission != null) {
                        ?>
								<p style="font-size: 14px"><b>Mission</b></p>
								<p style="font-size: 14px"><?= $course->course_mission ?></p>
                        <?php
                            }
                        ?>
                        <!-- end course mission -->

                        <!-- begin course vision -->
                        <?php
                            if ($course->course_vision != null) {
                        ?>
							<p style="font-size: 14px"><b>Vision</b></p>
							<p style="font-size: 14px"><?= $course->course_vision ?></p>
                        <?php
                            }
                        ?>
                        <!-- end course vision -->

                        <!-- begin course goal -->
                        <?php
                            if ($course->course_goal != null) {
                        ?>
								<p style="font-size: 14px"><b>Goals</b></p>
								<p style="font-size: 14px"><?= $course->course_goal ?></p>
                        <?php
                            }
                        ?>
                        <!-- end course vision -->

                        <!-- begin course objective -->
                        <?php
                            if ($course->course_objective != null) {
                        ?>
								<p style="font-size: 14px"><b>Objectives</b></p>
								<p style="font-size: 14px"><?= $course->course_objective ?></p>
                        <?php
                            }
                        ?>
                        <!-- end course vision -->

                        <!-- begin other info -->
                        <?php
                            if ($course->other_info != null) {
                        ?>
                        		<p style="font-size: 14px"><?= $course->other_info ?></p>
                        <?php
                            }
                        ?>
                        <!-- end other info -->
                    </div>
                    <!-- end .col-md-12 -->
				</div>
				<!-- end .row -->
			</div>
			<!-- end #content -->
		</div>
		<!-- end container -->
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

	</script>
	
</html>
