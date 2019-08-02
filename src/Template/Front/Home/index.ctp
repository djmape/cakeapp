<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8" />
  <title>PUPQC | Home</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  

    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <?php echo $this->Html->css("../plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>
    <!-- <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("bootstrap.min.css")?>
    <!-- <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("../plugins/font-awesome/css/font-awesome.min.css"); ?>
    <!-- <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("animate.min.css")?>
    <!-- <link href="assets/css/animate.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("style.min.css")?>
    <!--  <link href="assets/css/style.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("style-responsive.min.css")?>
    <!--  <link href="assets/css/style-responsive.min.css" rel="stylesheet" /> -->
    <?php echo $this->Html->css("theme/default.css")?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <?php echo $this->Html->css("../plugins/DataTables/media/css/dataTables.bootstrap.min.css")?>
    <!-- <link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"/> -->
    <?php echo $this->Html->css("../plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css")?>
    <!-- <link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet"/> -->
    <?php echo $this->Html->css("../plugins/bootstrap-wizard/css/bwizard.min.css")?>
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    <!-- <script src="assets/plugins/pace/pace.min.js"></script> -->
    <!-- ================== END BASE JS ================== -->

    <style type="text/css">
      .page-with-top-menu, .page-with-top-menu .sidebar {
       padding: 0; 
      }
      .page-header-fixed {
        padding: 0; 
      }
      .container {
        width: 100%;
        padding-right: 0;
        padding-left: 0;
        margin-right: 0;
        margin-left: 0;
        background-color: #fff;
      }

      #content {
        padding: 0;
        margin: 0;
        width: 100%;
      }

      .carousel-inner>.item>img {
        width: 100%;
        max-width:100%;
        max-height:100%;
        height: auto;
      }

      .carousel-item {
    -webkit-background-attachment: fixed!important;
    -moz-background-attachment: fixed!important;
    background-attachment: fixed!important;
    background-position: center top!important;
      }
      .carousel-fade .active.carousel-item-left, 
      .carousel-fade .active.carousel-item-prev, 
    .carousel-fade .carousel-item-next, 
.carousel-fade .carousel-item-prev,
.carousel-fade .carousel-item.active{
  -webkit-transform: none;
 transform: none;
}
      .parallax {
        background-image: url("webroot/img/PUPlogo.png");
        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 500px
      }
      .slidescss{
        background-size: 100% 100%;
        max-width:100%;
        max-height:100%;
        width:100%;
        height: 650px;
      }

      a {
        color: #7e0e09;
      }

      a:hover {
        color: #7e0e09;
        text-decoration: underline;
      }

    </style>
</head>
<body>
  
  <!-- Add Navbar Element -->
  <?php echo $this->element('NavBar');?>
  
  <div class="container">
  <div id="content" class="content">

    <!-- start carousel -->
  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-ride="carousel" style="height: 87%; width: 100%; margin: 0">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php foreach ($home_carousel_imgs as $i => $carousel_img): ?> 
          <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>"></li>
        <?php endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" style="height: 650px">
  

      <?php foreach ($home_carousel_imgs as $i => $carousel_img): ?> 

      <div class="item <?php if ($i == 0 ) echo 'active' ?> ">
        <div class="view slidescss" style="background:url('webroot/img/upload/<?= $carousel_img->home_carousel_img_name ?>')no-repeat fixed center; background-size: cover;">
        </div>
        <?php if ($carousel_img->home_carousel_img_caption != '') { ?>
          <div class="carousel-caption" style="padding: 1%; background: rgba(0, 0, 0, 0.4);">
            <h3 style="color: white;"><?= $carousel_img->home_carousel_img_caption ?></h3>
            <p><?= $carousel_img->home_carousel_img_description ?></p>
          </div>
        <?php ; } ?>

      </div>

      <?php endforeach; ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- end carousel -->

  <!-- events and announcements div -->
  <div class="col-md-8" style="padding: 20px">
  <table id="data-table" class="table nowrap" width="100%">
    <thead>
    <h3 style="margin-left: 20px">
      <?= $this->Html->link('<span class="fa fa-bullhorn"></span> Announcements', ['controller' => 'announcement','action' => 'index'],['escape' => false]) ?>
    </h3> 
  </thead>
                            <!-- start tbody -->
                            <tbody>
                <!-- Here is where we iterate through our $articles query object, printing out article info -->
                <?php foreach ($announcements as $announcement): ?>
                  <tr>
                    <td>
                          <h3>
                            <?= $this->Html->link($announcement->announcement_title, ['action' => 'view', $announcement->announcement_id]) ?> 
                          </h3>
                          <p> <?= $announcement->announcement_modified?> </p>
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
                      </td>
                  </tr>
                <?php endforeach; ?>
                            </tbody>
                            <!-- end tbody -->
                        </table>
  </div>

  <div class="col-md-4" style="padding: 20px">
    <table id="data-table" class="table nowrap" width="100%">
    <thead>
    <h3 style="margin-left: 20px">
      <?= $this->Html->link('<span class="fa fa-star"></span> Events', ['controller' => 'events','action' => 'index'],['escape' => false]) ?>
    </h3> 
  </thead>
                            <!-- start tbody -->
                            <tbody>
                <!-- Here is where we iterate through our $articles query object, printing out article info -->
                <?php
                  if (count($events) == 0) {
                ?>
                    <tr>
                      <td>
                          <p>
                            No Ongoing Events
                          </p>
                      </td>
                    </tr>

                <?php
                  ;} else {
                ?>
                <?php foreach ($events as $event): ?>
                    <tr>
                      <td>
                          <p>
                            <div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%; margin-right: 1%">
                                                    <?php echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;')); ?>
                                            </div>
                            <?= $this->Html->link($event->event_title, ['controller' => 'Events','action' => 'view', $event->event_id]) ?> 
                          </p>
                      </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                  }
                ?>
                            </tbody>
                            <!-- end tbody -->
                        </table>
  </div>

  </div>
</div>
 <?php echo $this->element('footer');?>


<!-- ================== BEGIN BASE JS ================== -->
<!-- <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery/jquery-1.9.1.min.js")?>
<!-- <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery/jquery-migrate-1.1.0.min.js")?>
<!-- <script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script> -->
<?php echo $this->Html->script("../plugins/jquery-ui/ui/minified/jquery-ui.min.js")?>
<!-- <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> -->
<?php echo $this->Html->script("../plugins/bootstrap/js/bootstrap.min.js")?>
    <!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->
    <!-- <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> -->
    <?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
    <!-- <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script> -->
    <?php echo $this->Html->script("../plugins/jquery-cookie/jquery.cookie.js")?>
    <!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- <script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/jquery.dataTables.js")?>
<!-- <script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/media/js/dataTables.bootstrap.min.js")?>
<!-- <script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script> -->
<?php echo $this->Html->script("../plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js")?>
<!-- <script src="assets/js/table-manage-responsive.demo.min.js"></script> -->
<?php echo $this->Html->script("table-manage-responsive.demo.min.js")?>
<!-- <script src="assets/js/apps.min.js"></script> -->
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- <script src="assets/js/apps.min.js"></script> -->
    <?php $this->Html->script("/apps.min.js")?>
    <!-- ================== END PAGE LEVEL JS ================== -->
  
  <script>
    $(document).ready(function() {
      App.init();
    });
  </script>
</body>
</html>
