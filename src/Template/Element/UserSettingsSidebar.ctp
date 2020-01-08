
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" data-disable-slide-animation="true">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar nav -->
				<ul class="nav">
              		<!-- Visit Website -->
              		<li class="<?php if ($active == 'profile') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-globe fw"></i><span>Profile</span>',[ 'controller' => 'Users','action'=>'userSettingsProfile'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              		<li class="<?php if ($active == 'info') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-home fw"></i><span>Account Information</span>',[ 'controller' => 'Users','action'=>'userSettingsInfo'],array('escape' => false)) ?>
              		</li>
              		<!-- Dashboard -->
              		<li class="<?php if ($active == 'password') echo 'active'?>">
                		<?php echo $this->Html->link('<i class="fa fa-home fw"></i><span>Password</span>',['controller' => 'Users','action'=>'userSettingsPassword'],array('escape' => false)) ?>
              		</li>
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<!-- end #sidebar -->
