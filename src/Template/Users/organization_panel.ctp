<!-- src/Template/Users/user_settings_info.ctp -->

        <?php echo $this->element('OrganizationPanelHeaderSidebar');?>
        <?php echo $this->Html->css("front.css")?>

        <div id="content" class="content">
            <h3><?= $organization_name ?> </h3>
            <h5><?= ' (' . $organization->organization_acronym. ')' ?></h5>
            <br>
            <?php
                            echo $this->Html->image("../webroot/img/upload/".$organization->organization_photo, array('style' => 'width:20%; height:auto; margin: 1%; float: right'));
            ?>
            <p style="font-size: 14px">
                            <b>Organization Type</b>
            </p>
            <p style="font-size: 14px">
                            <?= $organization->organization_type ?>
            </p>
            <!-- begin organization mission -->
                            <?php
                                if ($organization->organization_mission != null) {
                            ?>
                                    <p style="font-size: 14px"><b>Mission</b></p>
                                    <p style="font-size: 14px"><?= $organization->organization_mission ?></p>
                            <?php
                                }
                            ?>
                            <!-- end organization mission -->

                            <!-- begin organization vision -->
                            <?php
                                if ($organization->organization_vision != null) {
                            ?>
                                    <p style="font-size: 14px"><b>Vision</b></p>
                                    <p style="font-size: 14px"><?= $organization->organization_vision ?></p>
                            <?php
                                }
                            ?>
                            <!-- end organization vision -->

                            <!-- begin organization goals -->
                            <?php
                                if ($organization->organization_goal != null) {
                            ?>
                                    <p style="font-size: 14px">
                                        <b>Goals</b>
                                    </p>
                                    <p style="font-size: 14px">
                                        <?= $organization->organization_goal ?>
                                    </p>
                            <?php
                                }
                            ?>
                            <!-- end organization goals -->

                            <!-- begin organization objective -->
                            <?php
                                if ($organization->organization_objective != null) {
                            ?>
                                    <p style="font-size: 14px">
                                        <b>Objectives</b>
                                    </p>
                                    <p style="font-size: 14px">
                                        <?= $organization->organization_objective ?>
                                    </p>
                            <?php
                                }
                            ?>
        </div>
        <!-- end #content -->
    </div>
    <!-- end #container -->
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
<?php echo $this->Html->script("../plugins/bootstrap-show-password/bootstrap-show-password.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>
    $(document).ready(function() {
        App.init();
    });

</script>

</html>