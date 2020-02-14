<!-- src/Template/Front/Offices/index.ctp -->

            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
                
                <table id="data-table-select" class="table-striped table-bordered nowrap" width="100%" style="border: 0; margin-top: 20px">
                    <thead>
                        <h3>
                            <i class="fa fa-building"></i>
                            Offices
                        </h3>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($offices as $office):
                        ?>
                                <tr style="">
                                    <td class="row" style="height: 200px; padding: 20px">
                                        <div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%; margin-right: 1%">
                                            <?php
                                                echo $this->Html->image("../webroot/img/upload/".$office->office_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;'));
                                            ?>
                                        </div>
                                        <div class="col-md-8">
                                            <p>
                                                <h5>
                                                    <b><?= $office->office_name?></b>
                                                </h5>
                                            </p>
                                            <p>
                                                <?= $office->office_description?>
                                            </p>

                                            <button type="button" class="btn btn-yellow btn-sm">
                                                <i class="fa fa-eye"></i>
                                                <?= $this->Html->link('View', ['action' => 'view', $office->office_id]) ?>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>

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
            $('#data-table-select').DataTable();
            $(".dataTables_paginate").addClass("pull-right");
            $("#data-table-select_filter").addClass("pull-right");
            $("#data-table-select thead").remove();
		});

	</script>

</html>
