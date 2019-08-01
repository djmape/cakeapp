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

              <!-- Home -->
              <li class="<?php if ($active == 'home') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa-home fw"></i>Home',['prefix' => "admin", 'controller' => 'Home','action'=>'index'],array('escape' => false)) ?>
              </li>

              <!-- About -->
              <li class="<?php if ($active == 'about') echo 'active'?>">
                <?php echo $this->Html->link('<i class="fa fa-info fw"></i>About',['prefix' => "admin", 'controller' => 'Abouts','action'=>'index'],array('escape' => false)) ?>
              </li>

              <!-- start Announcements -->
              <li class="has-sub <?php if ($expand == 'announcements') echo 'active expand'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-bullhorn"></i>
                  <span>Announcements</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'announcements' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Announcements',array('prefix' => "admin", 'controller' => 'Announcements','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'announcements' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Announcement',array('prefix' => "admin", 'controller' => 'Announcements','action'=>'add')) ?></li>
                </ul>
              </li>
              <!-- end Announcements -->

              <!-- start Events -->
              <li class="has-sub <?php if ($expand == 'events') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-star"></i>
                  <span>Events</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'events' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Events',array('prefix' => "admin", 'controller' => 'Events','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'events' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Event',array('prefix' => "admin", 'controller' => 'Events','action'=>'add')) ?></li>
                </ul>
              </li>
              <!-- end Events -->

              <!-- start Courses -->
              <li class="has-sub <?php if ($expand == 'courses') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-graduation-cap fa-xs"></i>
                  <span>Courses</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'courses' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Courses',array('prefix' => "admin", 'controller' => 'Courses','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'courses' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Course',array('prefix' => "admin", 'controller' => 'Courses','action'=>'add')) ?></li>
                </ul>
              </li>
              <!-- end Courses -->

              <!-- start Organizations -->
              <li class="has-sub <?php if ($expand == 'organizations') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-users"></i>
                  <span>Organizations</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'organizations' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Organizations',array('prefix' => "admin", 'controller' => 'Organizations','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'organizations' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Organization',array('prefix' => "admin", 'controller' => 'Organizations','action'=>'add')) ?></li>
                </ul>
              </li>
              <!-- end Organizations -->

              <!-- start Employees -->
              <li class="has-sub <?php if ($expand == 'employees') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-user"></i>
                  <span>Employees</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'employees' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Employees',array('prefix' => "admin", 'controller' => 'Employees','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'employees' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Employee',array('prefix' => "admin", 'controller' => 'Employees','action'=>'add')) ?></li>
                </ul>
              <li>
              <!-- end Employees -->

              <!-- start Offices -->
              <li class="has-sub <?php if ($expand == 'offices') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-building"></i>
                  <span>Offices</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'offices' && $active == 'all') echo 'active'?>">
                    <?php echo $this->Html->link('All Offices',array('prefix' => "admin", 'controller' => 'Offices','action'=>'index')) ?>
                    </li>
                    <li class="<?php if ($expand == 'offices' && $active == 'add') echo 'active'?>">
                    <?php echo $this->Html->link('New Office',array('prefix' => "admin", 'controller' => 'Offices','action'=>'add')) ?></li>
                    <!--
                  <li class="<?php if ($active == 'Office Employees') echo 'active'?>">
                    <?php echo $this->Html->link('Office Employees',array('prefix' => "admin", 'controller' => 'OfficeEmployees','action'=>'index')) ?></li> -->
                </ul>
              <li>
              <!-- end Offices -->

              <!-- start Contacts -->
              <li class="has-sub <?php if ($expand == 'contacts') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-at"></i>
                  <span>Contacts</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'contacts' && $active == 'emails') echo 'active'?>">
                    <?php echo $this->Html->link('Emails',array('prefix' => "admin", 'controller' => 'ContactEmails','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'contacts' && $active == 'numbers') echo 'active'?>">
                    <?php echo $this->Html->link('Contact Number',array('prefix' => "admin", 'controller' => 'ContactNumbers','action'=>'index')) ?></li>
                </ul>
              <li>
              <!-- end Contacts -->

              <!-- start Settings -->
              <li class="has-sub <?php if ($expand == 'settings') echo 'active'?>">
                <a href="javascript:;">
                  <b class="caret pull-right"></b>
                  <i class="fa fa fa-cog"></i>
                  <span>Settings</span>
                </a>
                <ul class="sub-menu">
                  <li class="<?php if ($expand == 'settings' && $active == 'employees') echo 'active'?>">
                    <?php echo $this->Html->link('Employee Positions',array('prefix' => "admin", 'controller' => 'EmployeePositions','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'settings' && $active == 'officers') echo 'active'?>">
                    <?php echo $this->Html->link('Officers Positions',array('prefix' => "admin", 'controller' => 'OrganizationOfficersPositions','action'=>'index')) ?></li>
                  <li class="<?php if ($expand == 'settings' && $active == 'offices') echo 'active'?>">
                    <?php echo $this->Html->link('Office Positions',array('prefix' => "admin", 'controller' => 'Offices','action'=>'officePositions')) ?>
                    </li>
                </ul>
              </li>
              <!-- end Settings -->

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