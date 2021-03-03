<!-- src/Template/Front/Employees/index.ctp -->

            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
    
                <h1 class="page-header" style="color: #7e0e09;">
                    <span class="fa fa-users"></span>
                    Employees
                </h1>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="data-table-select" class="table table-bordered dataTable no-footer dtr-inline" role="grid" aria-describedby="data-table_info">
                            <thead>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($employees as $employee):
                                ?>
                                    <tr>
                                        <td class="row">
                                            <div class="col-md-3 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%">
                                                <?php
                                                    echo $this->Html->image("../webroot/img/upload/".$employee->employee_photo, array('style' => 'width: 150px; height: 150px; object-fit: cover; border-radius: 50% '));
                                                ?>
                                            </div>
                                            <div class="col-md-9">
                                                <p>
                                                    <h5>
                                                        <b>
                                                            <?= $employee->employee_lastname,', ',$employee->employee_firstname,' ',substr($employee->employee_middlename,0,1),'.' ?>
                                                        </b>
                                                    </h5>
                                                </p>
                                                <p>
                                                    <h6>
                                                        <?= $employee->employee_position_name->employee_position_name;?>
                                                    </h6>
                                                    <i>
                                                        <?= $employee->employee_position_name->employee_position_description ?>
                                                    </i>
                                                </p>


                                            <!-- begin employee email -->
                                            <?php
                                                if ($employee->employee_email != null) {
                                            ?>
                                                    <p>
                                                        <h6>
                                                            <b>Email: </b>
                                                            <?= $employee->employee_email;?>
                                                        </h6>
                                                    </p>
                                            <?php
                                                }
                                            ?>
                                            <!-- end employee email -->

                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end .col-md-12 -->
                </div>
                <!-- end .row -->
            </div>
            <!-- end content -->
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
            $('#data-table-select').DataTable({"bSort" : false});
            $data_table = $('#data-table-select').DataTable();
            $(".dataTables_paginate").addClass("pull-right");
            $("#data-table-select_filter").addClass("pull-right");
            $("#data-table-select thead").remove();
		});

	</script>

</html>
