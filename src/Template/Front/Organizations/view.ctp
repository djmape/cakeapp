            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
				
				<!-- begin .row -->
		     	<div class="row">
					<div class="col-md-12">
    					<h1 class="page-header" style="color: #7e0e09;">
            				<?= $organization->organization_name. ' (' . $organization->organization_acronym. ')' ?>
    					</h1>
						<?php
							echo $this->Html->image("../webroot/img/upload/".$organization->organization_photo, array('style' => 'width:20%; height:auto; margin: 1%; float: right'));
						?>
                        <p style="font-size: 14px">
                        	<b>Organization Type</b>
                        </p>
						<p style="font-size: 14px">
							<?= $organization->organization_type ?>
						</p>
						<!--<p style="font-size: 14px"><b>Organization</b></p>
						<p style="font-size: 14px"><?php echo $course['organizations']['organization_name'] ?></p> -->

                        	<!-- begin organization mission -->
                        	<?php
                            	if ($organization->organization_mission != null) {
                        	?>
									<p style="font-size: 14px"><b>Mission</b></p>
									<p style="font-size: 14px"><?= $organization->organization_mission ?></p>
                        	<?php
                            	}
                        	?>
                        	<!-- end organization mission -->

                       		<!-- begin organization vision -->
                        	<?php
                            	if ($organization->organization_vision != null) {
                        	?>
									<p style="font-size: 14px"><b>Vision</b></p>
									<p style="font-size: 14px"><?= $organization->organization_vision ?></p>
                        	<?php
                            	}
                        	?>
                        	<!-- end organization vision -->

                        	<!-- begin organization goals -->
                        	<?php
                            	if ($organization->organization_goal != null) {
                        	?>
									<p style="font-size: 14px">
										<b>Goals</b>
									</p>
									<p style="font-size: 14px">
										<?= $organization->organization_goal ?>
									</p>
                        	<?php
                            	}
                        	?>
                        	<!-- end organization goals -->

                        	<!-- begin organization objective -->
                        	<?php
                            	if ($organization->organization_objective != null) {
                        	?>
									<p style="font-size: 14px">
										<b>Objectives</b>
									</p>
									<p style="font-size: 14px">
										<?= $organization->organization_objective ?>
									</p>
                        	<?php
                            	}
                        	?>
                        	<!-- end organization objective -->

                        	<!-- begin #organization-chart -->
                        	<?php
                            	if (count($organization_officers) != 0) {
                        	?>
                        			<div id="organization-chart" style="margin-top: 10%">
                        				<table id="data-table" class="table nowrap" width="100%" style="border: 0;">
                            				<thead>
                            					<h3>Organizational Chart</h3>
                            				</thead>
                            				<tbody>
                                    			<?php
                                    				foreach ($organization_officers as $organization_officer):
                                    			?>
                                    					<tr>
															<td style="height: 200px; width: 100%">
																<div class="row">
																	<div class="col-md-2 center-block" style=" width: 150px; height: 150px; padding-left: 2%; padding-right: 2%; margin-right: 10%">
																		<?php
																			echo $this->Html->image("../webroot/img/upload/".$organization_officer->officer_photo, array('class' => 'center-block','style' => ' height:  150px; width:  150px; border-radius: 50%; object-fit: cover;'));
																		?>
																	</div>
																	<div class="col-md-8">
																		<p>
																			<h5>
																			<b>
																				<?=$organization_officer->officer_lastname,', ',$organization_officer->officer_firstname,' ',substr($organization_officer->officer_middlename,0,1),'.'
																				?>
																			</b>
																			</h5>
																		</p>
																		<p>
																			<h6>
                                                        					<b> Position: </b>
																			<?= $organization_officer->organization_officers_position->officers_position_name;?>
																			</h6>
																		</p>
																</div>
																</div>
									    					</td>
														</tr>
                                				<?php
                                					endforeach;
                                				?>
                            				</tbody>
                        				</table>
                    				</div>
                    		<?php
                        		}
                    		?>
                    		<!-- end #organization-chart -->
                    </div>
                   	<!-- end .col-md-12 -->
				</div>
				<!-- end .row -->
			</div>
			<!-- end #content -->
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
		});

	</script>

</html>
