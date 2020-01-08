

    <!-- ================== Sweet Alert ================== -->
    <?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>
    <?php echo $this->Html->css("front.css")?>

	    <!-- begin #content -->
	    <div id="content" class="content">
            <button class="btn btn-primary" onclick="testOnClick()">
                Save
            </button>
            <label id="showText">Label here</label>
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

        function testOnClick() {
            $url = ' http://localhost' + '<?= \Cake\Routing\Router::url(["controller"=>"Tests","action"=>"testSaveNoLoading"]); ?>';
            $.ajax({        
            type:"POST",
            //the function u wanna call
            url: $url,                
            data:{'saved':'input'},               
            success:function(data)
            {
                $('#showText').html('Saved');
            },
            error:function(xhr, ajaxOptions, thrownError) {
                $('#showText').val(thrownError);
                swal("Error", thrownError + $url, "error");
            }
        });
        }
	</script>
</html>
