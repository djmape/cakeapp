<div style="margin-bottom: 3%; display: inline">
        <!-- begin page-header -->
        <h3 class ="page-header">Polytechnic University of the Philippines - Quezon City
        <!-- <small>Web Portal</small> -->
            <div class="col-md-3 pull-right" style="padding-right: 0">
		            <?php echo $this->Html->image("../webroot/img/upload/".$users->user_photo, array('class' => '','style' => 'width: 12%; height: 12%; border-radius: 36px;')); ?>
            		<?= $this->Html->link('Logged in:' . $users->email, ['controller' => 'users','action' => 'profile', $users->id], array('style' => 'color: #7e0e09; font-size: 14px')) ?>
            </div></h3>
</div>