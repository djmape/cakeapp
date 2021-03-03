            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content announcement-view-content">
    
                <h1 class="page-header" style="color: #7e0e09;">
                    <span class="fa fa-info"></span>
                        Announcements
                </h1>
                <br>
                <br>
                <!-- begin row -->
                <table id="data-table-select" class="table">
                    <thead>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($announcements as $announcement): ?>
                                <tr>
                                    <td class="" style="padding: 1%">
                            <h3>
                                <?= $this->Html->link($announcement->announcement_title, ['action' => 'view', $announcement->announcement_id]) ?>
                            </h3>   
                            <?= $announcement->announcement_modified->format('l, F d, Y g:i A') ?>
                            <br>
                            <br>
                            <?php 
                                if (strlen($announcement->announcement_body) >= 500 )  {
                            ?>
                                    <p>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $announcement->announcement_id]) ?>
                                        </small>
                                    </p>
                            <?php
                                }
                                else {
                            ?>
                                    <p>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                    </p>
                                    </td>
                                </tr>
                    <?php
                                }
                        endforeach;
                    ?>
                    </tbody>
                </table>
                </div>
        </div>
    <?php echo $this->element('footer');?>
</body>
    



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

<?php echo $this->Html->script("infinite-scroll.pkgd.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            $('#data-table-select').DataTable();
            $(".dataTables_paginate").addClass("pull-right");
            $("#data-table-select_filter").addClass("pull-right");
            $("#data-table-select thead").remove();
        });


        

    </script>

</html>