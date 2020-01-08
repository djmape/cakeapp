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
            <!-- echo from db remove comment if done -->
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Category Name',['controller' => 'Forums','action'=>'forumHome']) ?>
            </li>
            <li class="breadcrumb-item">
                <?php echo $this->Html->link('Topics',['controller' => 'Forums','action'=>'forumHome']) ?>
            </li>
            <li class="breadcrumb-item active">
                Discussion Titles
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
            <h2>Discussion Title</h2>
            <p>by <a href="">username</a>, datetime here</p>
            <table id="data-table-select" class="table table-bordered">
            <tbody>
                    <tr class="odd gradeX">
                        <td style="width: 20%; text-align: center; padding: 3%">
                            <?php echo $this->Html->image("../webroot/img/upload/_temp_user_forum_img.jpg",['style' => 'width: 50%']); ?>
                            <br>
                            <b><a href=""> username </a></b>
                            <br>
                            Role here
                            <br>
                            Course
                            <br>
                            <br>
                            25 forums posts
                            <br>
                            121 forum replies
                        </td>
                        <td style="width: 80%;position: relative">
                            79 likes
                            <div class="align-text-bottom" style="vertical-align:bottom;position: absolute;bottom: 1%;">
                                <small>datetime here</small>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
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
        $('#data-table-select').DataTable();
        $(".dataTables_paginate").addClass("pull-right");
        $("#data-table-select_filter").addClass("pull-right");
    });

    </script>

</html>