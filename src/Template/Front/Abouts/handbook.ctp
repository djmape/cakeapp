<!-- src/Template/Front/Abouts/handbook.ctp -->

            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
		
    	       	<h1 class="page-header" style="color: #7e0e09;">
                    The Student Handbook
    	       	</h1>

		      	<div class="row">
		      		<a href="https://www.pup.edu.ph/studentservices/files/ThePUPStudentHandbook.pdf">
		      			Download PUP Student Handbook
		      		</a>
			     	<embed src= "https://www.pup.edu.ph/studentservices/files/ThePUPStudentHandbook.pdf" width= "100%" height= "600">
		      	</div>
			</div>
			<!-- end #content -->
		</div>
		<!-- end page container -->

	</body>

    <?php echo $this->element('footer');?>

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
