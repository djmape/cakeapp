<!-- src/Template/Forums/ForumCategories/forum_topics_index.ctp -->

        
            <?php echo $this->element('UserHeader');?>
            <?php echo $this->Html->css("front.css")?>
            <?php echo $this->Html->css("forum.css")?>



            <!-- begin #content -->
            <div id="content" class="content forum-content forum-topics-index-content">
                
        <!-- begin error -->
        <div class="error">
            <div class="error-code m-b-10">403</div>
            <div class="error-content" style="background-color: #ffffff">
                <div class="error-message" style="color: #000000">Forbidden</div>
                <div class="error-desc m-b-30" style="color: #000000">
                    You don't have permission to access the page. <br />
                </div>
                <?php echo $this->Html->link('Go Home',['prefix' => 'front','controller' => 'Home','action'=>'index'],['class' => 'btn btn-yellow p-l-20 p-r-20']) ?>
            </div>
        </div>
        <!-- end error -->
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