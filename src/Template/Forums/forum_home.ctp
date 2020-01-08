<!-- src/Template/Users/index.ctp -->

        <?php echo $this->element('UserHeader');?>

        <!-- begin #top-menu -->
        <div id="top-menu" class="navbar-header top-menu">
            <!-- begin top-menu nav -->
            <ul class="nav navbar-nav">
                
        <!-- begin breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Forum</li>
            <li class="breadcrumb-item active">
                Home
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
            <h3> Categories </h3>  
            <table id="data-table-default" class="table table-bordered">
                        <thead>
                            <th style="width: 70%">
                                Category Name
                            </th>
                            <th style="width: 10%">
                                Topics
                            </th>
                            <th style="width: 10%">
                                Discussions
                            </th>
                            <th style="width: 10%">
                                Replies
                            </th>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">175 topics</td>
                                <td class="f-s-600 text-inverse">459 discussion</td>
                                <td class="f-s-600 text-inverse">5,452 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">162 topics</td>
                                <td class="f-s-600 text-inverse">459 discussion</td>
                                <td class="f-s-600 text-inverse">5,452 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">231 topics</td>
                                <td class="f-s-600 text-inverse">459 discussion</td>
                                <td class="f-s-600 text-inverse">5,452 replies</td>
                            </tr>
                        </tbody>
            </table> 
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'Forums', 'action' => 'forumCategories'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
            </div>
            </div> 
            <!-- end Categories -->

            <!-- begin Topics -->
            <div class="categories-table">
            <h3> Topics </h3>   
            <table id="data-table-default" class="table table-bordered">
                        <thead>
                            <th style="width: 80%">
                                Category Name
                            </th>
                            </th>
                            <th style="width: 10%">
                                Discussions
                            </th>
                            <th style="width: 10%">
                                Replies
                            </th>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">217 discussion</td>
                                <td class="f-s-600 text-inverse">5,452 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">469 discussion</td>
                                <td class="f-s-600 text-inverse">8,720 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Category Title</td>
                                <td class="f-s-600 text-inverse">192 discussion</td>
                                <td class="f-s-600 text-inverse">737 replies</td>
                            </tr>
                        </tbody>
            </table> 
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'Forums', 'action' => 'forumTopics'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
            </div>
            </div>
            <!-- end Topics -->

            <!-- begin Discussions -->
            <div class="categories-table">
            <h3> Discussions </h3>   
            <table id="data-table-default" class="table table-bordered">
                        <thead>
                            <th style="width: 70%">
                                Discussion Title
                            </th>
                            <th style="width: 10%">
                                Likes
                            </th>
                            <th style="width: 10%">
                                Dislikes
                            </th>
                            <th style="width: 10%">
                                Replies
                            </th>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Discussion Title</td>
                                <td class="f-s-600 text-inverse">348 likes</td>
                                <td class="f-s-600 text-inverse">14 dislikes</td>
                                <td class="f-s-600 text-inverse">446 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Discussion Title</td>
                                <td class="f-s-600 text-inverse">345 likes</td>
                                <td class="f-s-600 text-inverse">1 dislikes</td>
                                <td class="f-s-600 text-inverse">147 replies</td>
                            </tr>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse">Discussion Title</td>
                                <td class="f-s-600 text-inverse">112 likes</td>
                                <td class="f-s-600 text-inverse">16 dislikes</td>
                                <td class="f-s-600 text-inverse">650 replies</td>
                            </tr>
                        </tbody>
            </table> 
            <div class="pull-right">
                <?= $this->Html->link('<i class="fa fa-arrow-right"></i> more...', ['controller' => 'Forums', 'action' => 'forumDiscussions'],['class' => 'btn btn-maroon btn-sm','escape' => false]) ?>
            </div>
            <!-- end Topics -->
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