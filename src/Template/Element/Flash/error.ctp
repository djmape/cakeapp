<?php echo $this->Html->css("../plugins/sweetalert/dist/sweetalert.css")?>
<?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert.min.js")?>
<?php echo $this->Html->script("../plugins/sweetalert/dist/sweetalert-dev.js")?>

<?php echo $this->Flash->render(); ?>

<script>swal("Hello world!");</script>

<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

s