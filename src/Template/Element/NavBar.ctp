<style>
    .top-menu .nav>li:focus>a, .top-menu .nav>li:hover>a, .top-menu .nav>li>a:focus, .top-menu .nav>li>a:hover {
        background: #ffffff;
        color: #7e0e09;
    }

    .top-menu .nav > li.active > a, .top-menu .nav > li.active > a:focus, .top-menu .nav > li.active > a:hover {
        background: #7e0e09;
        font-weight: bolder;
        color: yellow;
    }

    .dropdown-menu {
        background: #7e0e09;
        color: white;
    }
    #content {
        margin-top: 1%;
    }

</style>

<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        opacity: 0.9;
    }
    .dropdown-menu>li>a {
        color: #fff;
    }
    li {
        font-size: 14px;
    }
    #top-menu {
        width: 100%;
        position: initial;
    }
    .container-fluid>a {
        font-size: 24px;
    }
    .container-fluid {
        padding-bottom: 15px;
    }

    .navbar-default .navbar-nav>.active.open>a, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover { 
        background: #7e0e09!important;
    }
</style>
</head>

<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
  <!-- begin #header -->
  <div id="header" class="header navbar navbar-default navbar-fixed-top">
     <!-- begin container-fluid -->
     <div class="container-fluid" style="">
        <!-- begin mobile sidebar expand / collapse button -->
       <?php echo $this->Html->link('<div class="navbar-header" style=""><span>' . $this->Html->image('PUPlogo.png',array('style' => 'height: 50px')) . '</span> Polytechnic University of the Philippines<small> Quezon City </small><br></div>',array('prefix' => 'front','controller'=>'home','action'=>'index'),array('escape' => false,'class' => 'navbar-brand', 'style' => 'color:gray; width: 1000px')) ?>
       <!-- end mobile sidebar expand / collapse button -->
    <!-- end container-fluid -->
    </div>
<!-- end #header -->

<!-- begin #top-menu -->
<div id="top-menu" class="navbar-header top-menu">
    <!-- begin top-menu nav -->
    <ul class="nav navbar-nav">

        <li class="<?php if ($active == 'announcements') echo 'active'?>">
            <?php echo $this->Html->link('Announcements',array('prefix' => 'front','controller'=>'Announcement','action'=>'index')) ?>
        </li>

        <li class="<?php if ($active == 'events') echo 'active'?>">
            <?php echo $this->Html->link('Events',array('prefix' => 'front','controller'=>'events','action'=>'index', 'all')) ?>
        </li>

        <li class="dropdown <?php if ($active == 'courses') echo 'active'?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Courses<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <?php foreach ($courses as $course): ?>
                            <li>
                                <?php echo $this->Html->link($course->course_name,array('prefix' => 'front','controller'=>'courses','action'=>'view',$course->course_id)) ?>
                            </li>
                        <?php endforeach; ?>
                </ul>
        </li>

        <li class="dropdown <?php if ($active == 'organizations') echo 'active'?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Organizations<b class="caret"></b></a>
                <ul class="dropdown-menu">
                        <?php foreach ($organizations as $organization): ?>
                            <li>
                                <?php echo $this->Html->link($organization->organization_name,array('prefix' => 'front','controller'=>'organizations','action'=>'view',$organization->organization_id)) ?>
                            </li>
                        <?php endforeach; ?>
                </ul>
        </li>

        <li class="<?php if ($active == 'offices') echo 'active'?>">
            <?php echo $this->Html->link('Offices',array('prefix' => 'front','controller'=>'offices','action'=>'index')) ?>
        </li>

        <li class="<?php if ($active == 'employees') echo 'active'?>">
            <?php echo $this->Html->link('Employees',array('prefix' => 'front','controller'=>'employees','action'=>'index')) ?>
        </li>

        <li class="dropdown <?php if ($active == 'about') echo 'active'?>">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">About<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <?php echo $this->Html->link('About',array('prefix' => 'front','controller'=>'abouts','action'=>'index')) ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('The Student Handbook',array('prefix' => 'front','controller'=>'abouts','action'=>'view')) ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Contacts',array('prefix' => 'front','controller'=>'contacts','action'=>'index')) ?>
                    </li>
                </ul>
        </li>

    </ul>
    <!-- end top-menu nav -->
</div>


</div>
<!-- end #top-menu -->

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