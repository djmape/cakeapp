            <?php echo $this->element('NavBar');?>
            <?php echo $this->Html->css("front.css")?>
            
            <!-- begin #content -->
            <div id="content" class="content">
    
                <h1 class="page-header" style="color: #7e0e09;">
                    <span class="fa fa-info"></span>
                        Announcements
                </h1>

                <!-- begin row -->
                <div id="announcements-list" class="grid_entry row masonry" style="width:80%" > 
                    <?php
                        foreach ($announcements as $announcement): ?>
                        <div class="announcement-item">
                            <h3>
                                <?= $this->Html->link($announcement->announcement_title, ['action' => 'view', $announcement->announcement_id]) ?>
                            </h3>
                            <?= $announcement->announcement_modified->format('l, F d, Y g:i A') ?>

                            <?php 
                                if (strlen($announcement->announcement_body) >= 500 )  {
                            ?>
                                    <p>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                        <small style="font-size: 12px">
                                            <?= $this->Html->link('. . .read more', ['action' => 'view', $announcement->announcement_id]) ?>
                                        </small>
                                    </p>
                            <?php
                                }
                                else {
                            ?>
                                    <p>
                                        <?= preg_replace("/\<[^>]+\>/"," ",substr($announcement->announcement_body,0,500)) ?>
                                    </p>
                            <?php
                                }
                            ?>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
                <!-- status elements -->
                <div class="scroller-status">
                    <div class="infinite-scroll-request loader-ellips">
                    ...
                    </div>
                    <p class="infinite-scroll-last">End of content</p>
                    <p class="infinite-scroll-error">No more pages to load</p>
                </div>
                    <p class="pagination">
                        <a class="pagination__next" href="page2.html">Next page</a>
                    </p>
    </div>
    </div>
    <?php echo $this->element('footer');?>
</body>
    



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

<?php echo $this->Html->script("infinite-scroll.pkgd.min.js")?>
<!-- ================== END PAGE LEVEL JS ================== -->
    
    <script>
        $(document).ready(function() {
            App.init();
            $(function() {
                $('#announcements-list').infiniteScroll({
                // options
                    path: '.pagination__next',
                    navSelector  : '.next',    // selector for the paged navigation 
                    nextSelector : '.next a',  // selector for the NEXT link (to page 2)
                    itemSelector : '.announcement-item',     // selector for all items you'll retrieve
                    debug         : true,
                    dataType      : 'html',
                    loading: {
                        finishedMsg: 'No more posts to load. All Hail Star Wars God!',
                        img: ''
                    },
                    status: '.scroller-status',
                    hideNav: '.pagination'
                });
            });
        });


        

    </script>

</html>