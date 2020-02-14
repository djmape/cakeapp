
        <?php echo $this->element('UserHeader');?>

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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Courses
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($courses as $course): ?>
                            <li>
                                <?php echo $this->Html->link($course->course_name,array('prefix' => 'front','controller'=>'courses','action'=>'view',$course->course_id)) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="dropdown <?php if ($active == 'organizations') echo 'active'?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Organizations
                    </a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        About
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php echo $this->Html->link('About',array('prefix' => 'front','controller'=>'abouts','action'=>'index')) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('The Student Handbook',array('prefix' => 'front','controller'=>'abouts','action'=>'handbook')) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link('Contacts',array('prefix' => 'front','controller'=>'contacts','action'=>'index')) ?>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($active == 'forum') echo 'active'?>">
                    <?php echo $this->Html->link('Forum',['prefix' => 'forums','controller' => 'ForumHome','action'=>'index']) ?>
                </li>
            </ul>
            <!-- end top-menu nav -->
        </div>
        <!-- end #top-menu -->


