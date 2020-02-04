
            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>

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
                .carousel-fade .carousel-item.active {
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
  
            <div id="content" class="content">


                <!-- start carousel -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 50%; width: 100%; margin: 0">
                    <ol class="carousel-indicators">
                        <?php
                            if (count($home_carousel_imgs) == 0) {
                        ?>
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <?php
                            } else {
                        ?>
                                <?php 
                                    foreach ($home_carousel_imgs as $i => $carousel_img): 
                                ?> 
                                        <li data-target="#myCarousel" data-slide-to="<?php echo $i?>" class="<?php if ($i == 0 ) echo 'active'; ?>"></li>
                                <?php 
                                    endforeach;
                                ?>
                        <?php
                            }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <!-- start if no active carousel image -->
                        <?php
                            if (count($home_carousel_imgs) == 0) {
                        ?>
                                <div class="item active">
                                    <div class="view slidescss" style="background:url('webroot/img/PUPlogo.png')no-repeat fixed center; background-size: cover;">
                                    </div>
                                    <div class="carousel-caption" style="padding: 1%; background: rgba(0, 0, 0, 0.4);">
                                        <h3 style="color: white;">Polytechnic University of the Philippines</h3>
                                        <p>Quezon City</p>
                                    </div>
                                </div>
                        <?php 
                            }
                            else {  
                                foreach ($home_carousel_imgs as $i => $carousel_img): 
                        ?> 
                                    <div class="carousel-item <?php if ($i == 0 ) echo 'active'; ?> ">
                                        <div class="view slidescss d-block w-100" style="background:url('webroot/img/upload/<?= $carousel_img->home_carousel_img_name ?>')no-repeat fixed center; background-size: cover;">
                                        </div>
                                        <?php 
                                            if ($carousel_img->home_carousel_img_caption != '') {
                                        ?>
                                                <div class="carousel-caption" style="padding: 1%; background: rgba(0, 0, 0, 0.4);">
                                                    <h3 style="color: white;">
                                                        <?= $carousel_img->home_carousel_img_caption ?>
                                                    </h3>
                                                    <p>
                                                        <?= $carousel_img->home_carousel_img_description ?>
                                                    </p>
                                                </div>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                <?php 
                                    endforeach;
                                ?>
                            <?php
                                }
                            ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- end carousel -->

                <div class="row home-announcements-events">
                    <!-- begin announcements div -->
                    <div class="col-md-8" style="padding: 20px">
                        <table id="data-table " class="table nowrap table-home-announcements" width="100%">
                            <thead>
                                <h3 style="margin-left: 20px">
                                    <?= $this->Html->link('<span class="fa fa-bullhorn"></span> Announcements', ['controller' => 'announcement','action' => 'index'],['escape' => false]) ?>
                                </h3> 
                            </thead>
                            <!-- start tbody -->
                            <tbody>

                                <!-- Here is where we iterate through our $articles query object, printing out article info -->
                                <?php
                                    foreach ($announcements as $announcement):
                                ?>
                                        <tr>
                                            <td class="table-home-announcement-cell">
                                                <h3>
                                                    <?= $this->Html->link($announcement->announcement_title, ['controller' => 'announcement','action' => 'view', $announcement->announcement_id]) ?> 
                                                </h3>
                                                <p>
                                                    <?= $announcement->announcement_modified?>
                                                </p>

                                                <?php 
                                                    if (strlen($announcement->announcement_body) >= 500 )  {
                                                ?>
                                                        <p>
                                                            <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                                            <small style="font-size: 12px">
                                                                <?= $this->Html->link('. . .read more', ['controller'=>'announcement','action' => 'view', $announcement->announcement_id]) ?>
                                                            </small>
                                                        </p>
                                                <?php
                                                    }
                                                    else {
                                                ?>
                                                        <p>
                                                            <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                                        </p>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                ?>
                            </tbody>
                            <!-- end tbody -->
                        </table>
                        <div class="pull-right">
                            <h5>
                                <?= $this->Html->link('. . .more announcements', ['controller' => 'announcement','action' => 'index']) ?>
                            </h5>
                        </div>
                    </div>
                    <!-- end announcements div -->

                    <!-- begin events div -->
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
                                                <p> No Ongoing Events </p>
                                            </td>
                                        </tr>

                                <?php
                                    }
                                    else {
                                        foreach ($events as $event):
                                ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%; margin-right: 1%">
                                                            <?php
                                                                echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;'));
                                                            ?>
                                                        </div>
                                                <?= $this->Html->link($event->event_title, ['controller' => 'events','action' => 'view', $event->event_id]) ?> 
                                                    </p>
                                                </td>
                                            </tr>

                                    <?php
                                        endforeach;
                                    ?>
                                <?php
                                    }
                                ?>
                            </tbody>
                            <!-- end tbody -->
                        </table>
                    </div>
                    <!-- end events div -->
                </div>
            </div>
            <!-- end #content -->
        </div>
        <!-- end container -->
    </div>
    <!-- end  body -->

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
      $('.carousel').carousel()
    });
  </script>