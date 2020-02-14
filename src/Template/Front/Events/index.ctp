            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content event-view-content">
    
                <h1 class="page-header" style="color: #7e0e09;">
                    <span class="fa fa-star"></span>
                    Events
                </h1>

                <div id="event_status_select" class="col-md-4 row m-b-15">
                    <div class="form-inline">
                        <label> Filter </label>
                    </div>
        
                    <select class="form-control" id="event_status" onchange="filterStatus()">
                        <option value="All">All</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Upcoming">Upcoming</option>
                        <option value="Past">Past</option>
                 </select>
                </div>

                <table id="data-table-select" class="table">
                    <thead>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($events as $event):
                        ?>
                                <tr>
                                    <td class="row" style="padding: 1%">
                                        <div class="col-md-3 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%">
                                            <?php
                                                echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;'));
                                            ?>
                                        </div>
                                        <div class="col-md-9" style="margin: 2%">
                                            <!-- begin panel title -->
                                            <div class="panel-title">
                                                <h3>
                                                    <?= $this->Html->link($event->event_title, ['action' => 'view', $event->event_id]) ?>
                                                </h3>

                                                <!-- If event is upcoming -->
                                                <?php 
                                                    if ($event->event_status == 'Upcoming') {
                                                ?>
                                                        <span class="label label-warning">
                                                            <?= $event->event_status ?>
                                                        </span>
                                                <?php 
                                                    }
                                                ?>
                                            
                                                <!-- If event is ongoing -->
                                                
                                                <?php 
                                                    if ($event->event_status == 'Ongoing') {
                                                ?>
                                                        <span class="label label-green">
                                                            <?= $event->event_status ?>
                                                        </span>
                                                <?php
                                                    }
                                                ?>
                                            
                                                <!-- If event is past -->
                                                <?php
                                                    if ($event->event_status == 'Past') {
                                                ?>
                                                        <span class="label label-yellow">
                                                            <?= $event->event_status ?>
                                                        </span>
                                                <?php
                                                    }
                                                ?>
                                                    <br>
                                                    <b> Date: </b>
                                                    <?= h($event->event_start_date) ?>
                                                    <?= $event->event_start_time ?>
                                                    - 
                                                    <?= h($event->event_end_date) ?> 
                                                    <?= $event->event_end_time ?>
                                                    <br>
                                                    <b> Location: </b>
                                                    <?= $event->event_location?>
                                                    <br>
                                                    <b> Participants: </b>
                                                    <?= $event->event_participants?>
                                            </div>
                                        
                                            <!-- begin panel-body -->
                                            <div class="panel-body">
                                                <?php 
                                                    if (strlen($event->event_body) >= 500 )  {
                                                ?>
                                                        <p>
                                                            <?= substr(preg_replace("/\<[^>]+\>/"," ",$event->event_body),0,500 ) ?>
                                                            <small>
                                                                <?= $this->Html->link('. . .read more', ['action' => 'view', $event->event_id]) ?>
                                                            </small>
                                                        </p>
                                                <?php
                                                    }
                                                    else {
                                                ?>
                                                        <p>
                                                            <?= preg_replace("/\<[^>]+\>/"," ",$event->event_body ) ?>
                                                        </p>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <!-- end panel-body -->
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
        <!-- end container -->
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
        
        function filterStatus() {
            var event_status = $('#event_status').val(); 
            var redirecturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front" ,"controller"=>"Events","action"=>"index"]); ?>';
            window.location = redirecturl + "/" + event_status;
        }

    </script>

</html>