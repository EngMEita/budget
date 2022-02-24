<?php $this->load->view ( 'header_html' ) ; ?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url ()?>"><i class="fa fa-calculator" aria-hidden="true"></i> سمارت بدجت</a>
        </div>
        <!-- /.navbar-header -->


        <?php $this->load->view ( 'navbar' ) ?>
        <?php $this->load->view ( 'sidebar' ) ?>
    </nav>