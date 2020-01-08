
    <?php echo $this->element('NavBar');?>
            
         <!-- begin row -->
<div id="content" class="content">
    
    <h1 class="page-header" style="color: #7e0e09;">
            <span class="fa fa-info"></span>
             Announcements
    </h1>
         <!-- begin row -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-body">
                            <div id="data-table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-table" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                                            <thead>
                                                    <th>
                                                    </th>
                                            </thead>
                                        <tbody>
                                    <?php foreach ($announcements as $announcement): ?>
                                    <tr>
                                        <td>
                                            <div class="panel-title">
                                                <h3>
                                                	<?= $this->Html->link($announcement->announcement_title, ['action' => 'view', $announcement->announcement_id]) ?> 
                                                </h3>
                                                <?= $announcement->announcement_modified->format('l, F d, Y g:i A') ?>
                                            </div>
                                            <div class="panel-body">

                          <?php 
                            if (strlen($announcement->announcement_body) >= 500 )  {
                          ?>
                            <h5>
                              <?= substr($announcement->announcement_body,0,500) ?>
                              <small style="font-size: 12px">
                                <?= $this->Html->link('. . .read more', ['action' => 'view', $announcement->announcement_id]) ?>
                              </small>
                            </h5>
                          <?php
                            }
                            else {
                          ?>
                            <h5><?= $announcement->announcement_body ?></h5>
                          <?php
                            }
                          ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
        </div>
    </div>
    </div>
</div>
</div>
    <?php echo $this->element('footer');?>
</body>
<footer></footer>
    



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
            TableManageDefault.init();
            $('#data-table').DataTable();
        });
        

    </script>

</html>