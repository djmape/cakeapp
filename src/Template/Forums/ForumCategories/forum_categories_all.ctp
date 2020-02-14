<!-- src/Template/Users/index.ctp -->

        
            <?php echo $this->element('UserHeader');?>
            <?php echo $this->Html->css("front.css")?>
            <?php echo $this->Html->css("forum.css")?>

            <!-- begin #top-menu -->
            <div id="top-menu" class="navbar-header top-menu">
                
                <!-- begin top-menu nav -->
                <ul class="nav navbar-nav">
                
                    <!-- begin breadcrumb -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <?php echo $this->Html->link('Forum',['controller' => 'ForumHome','action'=>'index']) ?>
                        </li>
                        <li class="breadcrumb-item active">
                            All Categories
                        </li>
                    </ol>
                    <!-- end breadcrumb -->
                
            </ul>
            <!-- end top-menu nav -->
        </div>
        <!-- end #top-menu -->


        <!-- begin #content -->
        <div id="content" class="content forum-content">
            <!-- begin Categories -->
            <div class="categories-table">
            <div class="row category-header">
                
                <h3> All Categories </h3>
            </div>
            <table id="data-table-select" class="table table-bordered ">
                <thead>
                <tr>
                    <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 10%;">
                        #
                    </th>
                    <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 60%;">
                        Photo
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Email
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Name
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">
                        Actions
                    </th>
                </tr>
            </thead>
                        <tbody>
                            <?php foreach ($forumCategories as $i => $forumCategory): ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $this->Html->image("../webroot/img/upload/".$forumCategory->forum_category_icon, array('class' => 'center-block','style' => 'width: 50px')); ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 70%">
                                    <?= $this->Html->link($forumCategory->forum_category_name, ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumCategory->forum_category_name))],['escape' => false]) ?>
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
                            <?php endforeach; ?>
                        </tbody>
                            
            </table> 
            </div> 
            
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
<?php echo $this->Html->script("../plugins/DataTables/extensions/Select/js/dataTables.select.min.js")?>
<?php echo $this->Html->script("table-manage-select.demo.min.js")?>
<?php echo $this->Html->script("../plugins/slimscroll/jquery.slimscroll.min.js")?>
<?php echo $this->Html->script("../plugins/js-cookie/js.cookie.js")?>
<?php echo $this->Html->script("apps.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
<script>

    $(document).ready(function() {
        App.init();
        $('#data-table-select').DataTable();
        $(".dataTables_paginate").addClass("pull-right");
        $("#data-table-select_filter").addClass("pull-right");
    });

    </script>

</html>