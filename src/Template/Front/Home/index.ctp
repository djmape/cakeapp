		<!-- Add Navbar Element -->
    	<?php echo $this->element('NavBar');?>
  
    	<div id="content" class="content">

      		<!-- start carousel -->
      		<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-ride="carousel" style="height: 87%; width: 100%; margin: 0">

        		<!-- Indicators -->
        		<ol class="carousel-indicators">
          		<?php
            		if (count($home_carousel_imgs) == 0) {
          		?>
            		<li data-target="#myCarousel" data-slide-to="0" class="active">
            		</li>
          		<?php 
            		;} else {
          		?>
          		<?php foreach ($home_carousel_imgs as $i => $carousel_img): ?> 
            		<li data-target="#myCarousel" data-slide-to="<?php echo $i?>" class="<?php if ($i == 0 ) echo 'active' ?>"></li>
          		<?php endforeach; ?>
          		<?php
            		}
          		?>
        		</ol>

        		<!-- Wrapper for slides -->
        		<div class="carousel-inner" role="listbox" style="height: 650px">

          			<!-- start if no active carousel image -->
          			<?php
            			if (count($home_carousel_imgs) == 0) {
          			?>

          			<!-- begin .item active -->
          			<div class="item active">
            			<div class="view slidescss" style="background:url('webroot/img/PUPlogo.png')no-repeat fixed center; background-size: cover;">
            			</div>
            			<div class="carousel-caption" style="padding: 1%; background: rgba(0, 0, 0, 0.4);">
              				<h3 style="color: white;">Polytechnic University of the Philippines</h3>
              				<p>Quezon City</p>
            			</div>
          			</div>
          			<!-- end .item active -->
          			<?php 
            			;} else {
          			?>
        			<!-- end if no active carousel image -->
        			<!-- start if active carousel image/s -->

          			<?php foreach ($home_carousel_imgs as $i => $carousel_img): ?> 

          			<!-- begin .item -->
          			<div class="item <?php if ($i == 0 ) echo 'active' ?> ">
            			<div class="view slidescss" style="background:url('webroot/img/upload/<?= $carousel_img->home_carousel_img_name ?>')no-repeat fixed center; background-size: cover;">
            			</div>
            			<?php if ($carousel_img->home_carousel_img_caption != '') { ?>
              			<div class="carousel-caption" style="padding: 1%; background: rgba(0, 0, 0, 0.4);">
                			<h3 style="color: white;">
                  				<?= $carousel_img->home_carousel_img_caption ?>
                			</h3>
                			<p>
                  				<?= $carousel_img->home_carousel_img_description ?>
                			</p>
              			</div>
            			<?php ; } ?>
          			</div>
          			<!-- end .item -->

          			<?php endforeach; ?>
            			<!-- end if active carousel image/s -->
          			<?php
            			}
          			?>
        		</div>
        		<!-- end Wrapper for slides -->

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

  			<!-- begin events and announcements div -->
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
                            		<?= $this->Html->link($announcement->announcement_title, ['controller' => 'announcement','action' => 'view', $announcement->announcement_id]) ?> 
                          		</h3>
                          		<p> <?= $announcement->announcement_modified?> </p>
                          		<?php 
                            		if (strlen($announcement->announcement_body) >= 500 )  {
                          		?>
                            	<h5>
                              		<?= substr($announcement->announcement_body,0,500) ?>
                              		<small style="font-size: 12px">
                                		<?= $this->Html->link('. . .read more', ['controller'=>'announcement','action' => 'view', $announcement->announcement_id]) ?>
                              		</small>
                            	</h5>
                          		<?php
                            		}
                            		else {
                          		?>
                            	<h5>
                            		<?= $announcement->announcement_body ?>
                            	</h5>
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
  			<!-- end events and announcements div -->

  			<!-- begin events side-content -->
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
                  			;} else {
                		?>
                		<?php foreach ($events as $event): ?>
                    	<tr>
                      		<td>
                          		<p>
                            		<div class="col-md-2 center-div" style="text-align: center;max-width: 250px; height: 200px; object-fit: cover; padding: 1%; margin-right: 1%">
                            			<?php echo $this->Html->image("../webroot/img/upload/".$event->event_photo, array('class' => 'media-object','style' => 'max-width: 100%; max-height: 100%;')); ?>
                            		</div>
                            		<?= $this->Html->link($event->event_title, ['controller' => 'events','action' => 'view', $event->event_id]) ?> 
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
  			<!-- end events side-content -->

  		</div>
  		<!-- end #content -->
	</div>
  	<!-- end #container -->
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
    });
  </script>
</body>
</html>
