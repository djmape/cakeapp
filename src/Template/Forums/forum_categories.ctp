<!-- src/Template/Users/index.ctp -->

        
        <?php echo $this->element('UserHeader');?>

        <!-- begin #top-menu -->
        <div id="top-menu" class="navbar-header top-menu">
            <!-- begin top-menu nav -->
            <ul class="nav navbar-nav">
                
        <!-- begin breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Forum</li>
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Home',['controller' => 'Forums','action'=>'forumHome']) ?>
            </li>
            <li class="breadcrumb-item active">
                Categories
            </li>
        </ol>
        <!-- end breadcrumb -->
                
            </ul>
            <!-- end top-menu nav -->
        </div>
        <!-- end #top-menu -->
        <?php echo $this->Html->css("front.css")?>
        <?php echo $this->Html->css("forum.css")?>


        <!-- begin #content -->
        <div id="content" class="content forum-content">
            <!-- begin Categories -->
            <div class="categories-table">
            <?php foreach ($forumCategories as $i => $forumCategory): ?>
            <div class="row category-header">
                <?php echo $this->Html->image("../webroot/img/upload/".$forumCategory->forum_category_icon, array('class' => 'center-block','style' => '')); ?>
                <h3> <?= $forumCategory->forum_category_name ?> </h3>
            </div>
              
            <table id="" class="table table-bordered data-table-select">
                        <tbody>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse" style="width: 70%">
                                    <?= $forumCategory->forum_category_name ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_topics_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_topics_count . ' topics'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_topics_count . ' topic' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_discussions_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_discussions_count . ' discussions'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_discussions_count . ' discussion' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumCategory->forum_category_detail->forum_category_replies_count != 0) {
                                            echo $forumCategory->forum_category_detail->forum_category_replies_count . ' replies'  ;
                                        }
                                        else {
                                            echo $forumCategory->forum_category_detail->forum_category_replies_count . ' reply' ;
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                            
            </table> 
            </div> 
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'Forums', 'action' => 'forumTopics'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
            </div>
            <?php endforeach; ?>
            <!-- end Categories -->

        </div>
        </div>
        <!-- end #content -->
    </div>
    <!-- end #container -->
</body>
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

</html>