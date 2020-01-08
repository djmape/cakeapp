
    <?php echo $this->element('NavBar');?>
            
         <!-- begin row -->
<div id="content" class="content">
    
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
                                <!-- Here is where we iterate through our $articles query object, printing out article info -->
                                    <?php foreach ($events as $event): ?>
                                    <tr>
                                        <td>
                                            <div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%">
                                                    <?php echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;')); ?>
                                            </div>
                                            <div class="col-md-8">
                                            <div class="panel-title">
                                                <h3><?= $this->Html->link($event->event_title, ['action' => 'view', $event->event_id]) ?> </h3>
                                                <!-- If event is upcoming -->
                                                <style type="text/css">
                                                    .badge.badge-yellow, .label.label-yellow {
                                                        background: #FFEB3B;
                                                        color: #000;
                                                    }
                                                    .badge.badge-green, .label.label-green {
                                                        background: #4CAF50;
                                                    }
                                                </style>
                                                <?php if($event->event_status == 'Upcoming') { ?>
                                                    <span class="label label-warning"><?= $event->event_status ?></span>
                                                <?php } ?>
                                                <!-- If event is ongoing -->
                                                <?php if($event->event_status == 'Ongoing') { ?>
                                                    <span class="label label-green"><?= $event->event_status ?></span>
                                                <?php } ?>
                                                <!-- If event is past -->
                                                <?php if($event->event_status == 'Past') { ?>
                                                    <span class="label label-yellow"><?= $event->event_status ?></span>
                                                <?php } ?>
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
                           <!--                         
                                            <div class="panel-body">
                          <?php 
                            if (strlen($event->event_body) >= 250 )  {
                          ?>
                            <h5>
                              <?= substr($event->event_body,0,250) ?>
                              <small style="font-size: 12px">
                                <?= $this->Html->link('. . .read more', ['action' => 'view', $event->event_id]) ?>
                              </small>
                            </h5>
                          <?php
                            }
                            else {
                          ?>
                            <h5><?= $event->event_body ?></h5>
                          <?php
                            }
                          ?>
                                            </div>
                      -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                </div></div>
                <!-- end col-12 -->
            </div>
        </div>
    </div>
    </div>
</div>
</div>
</body>
<footer>
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
            $("#event_status").val("<?php echo $event_status ?>");
            $('#data-table').dataTable( {
    "bSort": false
  } );
        });
        
        function filterStatus() {
            var event_status = $('#event_status').val(); 
            var redirecturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "front" ,"controller"=>"Events","action"=>"index"]); ?>';
            window.location = redirecturl + "/" + event_status;
        }

    </script>

</html>