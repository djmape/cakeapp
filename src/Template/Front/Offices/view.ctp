<!-- src/Template/Front/Offices/view.ctp -->

            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
				
				<!-- begin .row -->
		        <div class="row">
		        	<!-- begin .col-md-12 -->
					<div class="col-md-12">
    					<h1 class="page-header" style="color: #7e0e09;">
            				<?= $office->office_name ?>
    					</h1>
                		<?php
                			echo $this->Html->image("../webroot/img/upload/".$office->office_photo, array('style' => 'max-height: 20%; width:20%; height:auto; margin: 1%;'));
                		?>
						<p style="font-size: 14px"><?= $office->office_description ?></p>

                        <!-- begin #organization-chart -->
                        <?php
                            if (count($office_employees) != 0) {
                        ?>
                        		<table id="data-table" class="table-striped table-bordered nowrap" width="100%" style="border: 0">
                            		<thead>
                            			<h3>Organizational Chart</h3>
                            		</thead>
                            		<tbody>
                                    	<?php
                                    		foreach ($office_employees as $office_employee):
                                    	?>
                                    			<tr>
                                    				<td class="row" style="height: 200px;">
                                    					<div class="col-md-4" style="padding-left: 5%">
                                    						<?php
                                    							echo $this->Html->image("../webroot/img/upload/".$office_employee->employee->employee_photo, array('style' => 'width:auto; max-width:45%; height: auto;width: 100%;border-radius: 50%'));
                                    						?>
														</div>
														<div class="col-md-8">
															<p>
																<h6>
																	<b>
																		<?= $office_employee->employee->employee_lastname,', ',$office_employee->employee->employee_firstname,' ',substr($office_employee->employee->employee_middlename,0,1),'.' ?>
																	</b>
																</h6>
															</p>
															<p>
																<?= $office_employee->office_position->office_position_name ?>
															</p>
														</div>
									    			</td>
												</tr>
                                		<?php
                                			endforeach;
                                		?>
                            		</tbody>
                        		</table>
                    	<?php
                        	}
                    	?>
                    	<!-- end #organization-chart -->
					</div>
					<!-- end col-md-12 -->
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
