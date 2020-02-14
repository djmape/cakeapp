<!-- src/Template/Front/Abouts/index.ctp -->

            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
		
			    <h3 style="color: #7e0e09;">
			    	About Polytechnic University of the Philippines - Quezon City
			    </h3>
			    <br>
			    <p style="font-size: 14px">
			    	<?= $abouts->about_description ?>
			    </p>
			    <br>
			    <p style="font-size: 16px">
			    	<b>Mission</b>
			    </p>
			    <p style="font-size: 14px">
			    	<?= $abouts->about_mission ?>
			    </p>
			    <br>
			    <p style="font-size: 16px">
			    	<b>Vision</b>
			    </p>
			    <p style="font-size: 14px">
			    	<?= $abouts->about_vision ?>
			    </p>
			    <br>
			    <p style="font-size: 16px">
			    	<b>Goals</b>
			    </p>
			    <p style="font-size: 14px">
			    	<?= $abouts->about_goals ?>
			    </p>
			    <br>
			    <p style="font-size: 16px">
			    	<b>Objectives</b>
			    </p>
			    <p style="font-size: 14px">
			    	<?= $abouts->about_objective ?>
			    </p>
			    <br>
			    <p style="font-size: 23px">
			    	<?= $abouts->about_additional_info ?>
			    </p>
			    <br>
			    <p style="font-size: 16px">
			    	<b>Hymn</b>
			    </p>
			    <p style="font-size: 23px">
			    	<?= $abouts->about_hymn ?>
			    </p>
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
