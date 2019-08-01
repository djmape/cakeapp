<?php echo $this->Html->css("custom.css")?>


<div id="sidebar" class="sidebar" style="position: fixed;">
      <!-- begin sidebar scrollbar -->
      <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%; margin-top: 0;"><div data-scrollbar="true" data-height="100%" style="overflow: hidden; width: auto; height: 100%;" data-init="true">
      <!-- begin sidebar user -->
        <ul class="nav">
          <li class="nav-profile" style="margin-top: 0; border: 1px solid #96120b;">
              <div class="cover with-shadow">
              </div>
              <div class="image">
                <?php echo $this->Html->image('PUPlogosmall.png', ['alt' => 'PUPLogo']); ?>
              </div>
              <div class="info" style="margin-top: 10px;">
                Admin Panel
              </div>
          </li>
          <li>
            <ul class="nav nav-profile">
              <!-- Return -->
              <li class="<?php if ($active == 'profile') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa-reply fw"></i>Admin Configuration',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index'],array('escape' => false)) ?>
              </li>
              <!-- Profile -->
              <li class="<?php if ($active == 'profile') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa-user fw"></i>Profile',['prefix' => "admin", 'controller' => 'Users','action'=>'profile', $users->id],array('escape' => false)) ?>
              </li>
              <!-- Password -->
              <li class="<?php if ($active == 'password') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa-lock fw"></i>Password',['prefix' => "admin", 'controller' => 'Users','action'=>'changePassword', $users->id],array('escape' => false)) ?>
              </li>

              <!-- start Logout -->
              <li class="<?php if ($active == 'Logout') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa fa-sign-out"></i>Logout',array('prefix' => "admin", 'controller' => 'Users','action'=>'logout'),array('escape' => false)) ?>
              </li>
              <!-- end Logout -->
            </ul>
          </li>
        </ul>
        <!-- end sidebar user -->
        <!-- end sidebar nav -->
      </div>

      <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 376.892px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
      <!-- end sidebar scrollbar -->
    </div>

    <!-- ================== BEGIN BASE JS ================== -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <?php $this->Html->script("/apps.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->

<script type="text/javascript">

  $(document).ready(function() {
  });
</script>