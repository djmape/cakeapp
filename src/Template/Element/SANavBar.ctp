<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
  <!-- begin #header -->
  <div id="header" class="header navbar navbar-default navbar-fixed-top">
     <!-- begin container-fluid -->
     <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
           <a class="navbar-brand">
                <span>
                    <!-- <img src="extra/PUPlogosmall.png" alt="" style="margin-top: -5px"/> -->
                    <?php echo $this->Html->image('PUPlogosmall.png', ['alt' => 'PUPLogo']); ?>
                </span>
                PUPQC
            </a>
       </div>
       <!-- end mobile sidebar expand / collapse button -->
   </div>
   <!-- end container-fluid -->
</div>
<!-- end #header -->

<!-- begin #top-menu -->
<div id="top-menu" class="top-menu">
    <!-- begin top-menu nav -->
    <ul class="nav">

        <li>
            <?php echo $this->Html->link('Announcement',array('controller'=>'Articles','action'=>'index')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Event',array('controller'=>'AdminEvents','action'=>'index')) ?>
        </li>
    </ul>
    <!-- end top-menu nav -->
</div>
<!-- end #top-menu -->

