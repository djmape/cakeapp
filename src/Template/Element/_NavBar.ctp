<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">
  <!-- begin #header -->
  <div id="header" class="header navbar navbar-default navbar-fixed-top">
     <!-- begin container-fluid -->
     <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
           <a class="navbar-brand">
                <span>
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
            <?php echo $this->Html->link('Announcement',array('controller'=>'Announcements','Announcement')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Event',array('controller'=>'pages','action'=>'display','Event')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Course',array('controller'=>'pages','action'=>'display','Course')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Students',array('controller'=>'pages','action'=>'display','Students')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('Employee',array('controller'=>'pages','action'=>'display','Employee')) ?>
        </li>
        <li>
            <?php echo $this->Html->link('About',array('controller'=>'pages','action'=>'display','About')) ?>
        </li>
        <li class="pull-right">
            <?php echo $this->Html->link('Login',array('controller'=>'Users','action'=>'login')) ?>
        </li>
    </ul>
    <!-- end top-menu nav -->
</div>
<!-- end #top-menu -->

<!-- #modal-login -->
<div class="modal fade" id="modal-login">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Login</h4>
                        </div>
                        <div class="panel-body">
                            <form action=" " method="POST">
                                <div>
                                    <fieldset>
                                        <legend class="pull-left width-full">Login</legend>
                                        <!-- begin row -->
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <div class="controls">
                                                        <input type="text" name="username" placeholder="username"
                                                               class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <div class="controls">
                                                        <input type="text" name="password" placeholder="password"
                                                               class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="modal-footer">
                                            <button class="btn btn-sm btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-success">Log in</button>
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <!-- end wizard step-3 -->

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

