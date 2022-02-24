<?php $this->load->view ( "modals/income" ) ; ?>
<?php $this->load->view ( "modals/outcome" ) ; ?>
<?php $this->load->view ( "modals/transfer" ) ; ?>
<?php $this->load->view ( "modals/bill" ) ; ?>



<div class="row">

    <div class="col-lg-3">
        <a href="#addIncome" data-toggle="modal" data-target="#addIncome">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h1 class="text-center">
                        <i class="fa fa-arrow-up fa-5x" aria-hidden="true"></i><br />
                        <strong>إضافة دخل</strong>
                    </h1>
                </div>
            </div>
        </a>
    </div>

    <?php if ($balance > 0) {?>

    <div class="col-lg-3">
        <a href="#addOutcome" data-toggle="modal" data-target="#addOutcome">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h1 class="text-center">
                        <i class="fa fa-arrow-down fa-5x" aria-hidden="true"></i><br />
                        <strong>إضافة مصروف</strong>
                    </h1>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3">
        <a href="#addBill" data-toggle="modal" data-target="#addBill">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h1 class="text-center">
                        <i class="fa fa-list fa-5x" aria-hidden="true"></i><br />
                        <strong>إضافة فاتورة</strong>
                    </h1>
                </div>
            </div>
        </a>
    </div>

    <div class="col-lg-3">
        <a href="#addTransfer" data-toggle="modal" data-target="#addTransfer">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h1 class="text-center">
                        <i class="fa fa-refresh fa-5x" aria-hidden="true"></i><br />
                        <strong>تحويل</strong>
                    </h1>
                </div>
            </div>
        </a>
    </div>



    <?php }?>

</div>

<?php foreach ($budgets as $b) {?>

<div class="row">

    <div class="col-md-3">

        <a href="<?=site_url('acc/budgets/view/' . $b['budget_id'])?>"><strong><?=$b['budget_name']?> (
                <?=number_format($b['budget_available'], 2)?> )</strong></a>

    </div>

    <div class="col-md-9">

        <div class="progress">

            <div class="progress-bar progress-bar-striped progress-bar-<?=budgetProgressClass($b['progress'])?> active"
                role="progressbar" aria-valuenow="<?=$b['progress']?>" aria-valuemin="0" aria-valuemax="100"
                style="width:<?=($b['progress'] * 0.9) + 10?>%">

                <?=$b['progress']?>%

            </div>

        </div>

    </div>

</div>

<?php }?>

<?php $this->load->view('ledger')?>