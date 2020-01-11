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
                <?php echo $this->Html->link('Home',['controller' => 'ForumHome','action'=>'index']) ?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link('Categories', ['controller' => 'ForumCategories', 'action' => 'forumCategoriesIndex'],['escape' => false]) ?>
            </li>
            <li class="breadcrumb-item">
                <?= $this->Html->link($forumCategory->forum_category_name , ['controller' => 'ForumCategories', 'action' => 'forumTopicsIndex', strtolower(str_replace(' ', '-', $forumCategory->forum_category_name))],['escape' => false])?>
            </li>
            <li class="breadcrumb-item active">
                All Topics
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
            <div class="category-header">
                
                <h3> <?= $forumCategory->forum_category_name ?> </h3>
                <!-- begin Add Topic button -->
                <div style="margin-bottom: 2%">
                    <a href="#modal-dialog-add-topic" class="btn btn-yellow btn-sm" data-toggle="modal">
                        <i class="fa fa-plus"></i>
                        Add Topic in <?= $forumCategory->forum_category_name ?>
                    </a>
                </div>
                <!-- end Add Topic button -->

            </div>
            <table id="data-table-select" class="table table-bordered ">
                <thead>
                <tr>
                    <th class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 80%;">
                        Photo
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Email
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%;">
                        Name
                    </th>
                </tr>
            </thead>
                        <tbody>
                            <?php foreach ($forumTopics as $i => $forumTopic): ?>
                            <tr class="odd gradeX">
                                <td class="f-s-600 text-inverse" style="width: 70%">
                                    <?= $this->Html->link($forumTopic->forum_topic_name, ['controller' => 'ForumDiscussions', 'action' => 'forumDiscussionsIndex', str_replace(' ', '-', $forumCategory->forum_category_name), str_replace(' ', '-', $forumTopic->forum_topic_name)]) ?>
                                    <br>
                                    by
                                    <?= $forumTopic->user->username ?> 
                                </td>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumTopic->forum_topic_detail->forum_topic_detail_discussions_count != 0) {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count . ' discussions'  ;
                                        }
                                        else {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_discussions_count . ' discussion' ;
                                        }
                                    ?>
                                </td>
                                <td class="f-s-600 text-inverse" style="width: 10%">
                                    <?php 
                                        if ($forumTopic->forum_topic_detail->forum_topic_detail_replies_count != 0) {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_replies_count . ' replies'  ;
                                        }
                                        else {
                                            echo $forumTopic->forum_topic_detail->forum_topic_detail_replies_count . ' reply' ;
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

    <!-- begin #modal-dialog-add-email -->
    <div class="modal fade" id="modal-dialog-add-topic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Topic in <?= $forumCategory->forum_category_name ?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input id="topic" class="form-control" placeholder="Enter topic name" />
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">
                        Close
                    </a>
                    <button type="button" class="btn btn-success btn-sm" onclick="addTopic()">
                        <i class="fa fa-plus"></i>
                        Add Topic
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end #modal-dialog-add-email -->
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

        function addTopic() {
            $forum_topic_name = $('#topic').val();
            $forum_category_id = <?php echo $forumCategory->forum_category_id?>;
            var targeturl = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"addForumTopic"]); ?>';
            var redirectURL = ' http://localhost' + '<?= \Cake\Routing\Router::url(["prefix" => "forums" ,"controller"=>"ForumTopics","action"=>"forumTopicsAll", str_replace(' ', '-', $forumCategory->forum_category_name), 'all']); ?>';
            $.ajax({
                            type:'post',
                            url: targeturl,              
                            data: {
                                'forum_topic_name' : $forum_topic_name,
                                'forum_category_id' : $forum_category_id
                            },
                            success:function(query)  {
                                window.location = redirectURL;
                            },
                            error:function(xhr, ajaxOptions, thrownError) {
                                swal("Error", thrownError, "error");
                            }
                        });
        }

    </script>

</html>