<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <?php if ( $this->session->flashdata ( 'alert' ) ) { ?>
            <?php $alert = $this->session->flashdata ( 'alert' ) ; ?>
            <div class="alert alert-<?=$alert['class']?> alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?=$alert['message']?>
            </div>
            <?php } ?>
            <?php if ( isset ( $page_title ) ) { ?>
            <h1 class="page-header"><?=$page_title?></h1>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <?php if ( isset ( $page_sub_title ) ) { ?>
                <div class="panel-heading"><?=$page_sub_title?></div>
                <?php } ?>
                <div class="panel-body">
                    <?php 
                    if ( isset ( $view_page ) ) $this->load->view ( $view_page ) ;
                    else $this->load->view ( 'test_table' ) ; 
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>