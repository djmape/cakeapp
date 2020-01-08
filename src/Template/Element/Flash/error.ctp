
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
    <?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>

<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
    $messages = $params['saves'];
?>

	<script>
		swal('Error!','<?php echo $messages ?>','error');
	</script>
