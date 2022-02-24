<?php

?>
<div>
    <h3 class="text-center">
        <strong><?=$budget['budget_name']?></strong>
    </h3>
    <p class="text-center"><?=date ( 'Y/m/d', $budget['budget_start'] )?> - <?=date ( 'Y/m/d', $budget['budget_end'] )?></p>
    <p class="text-center">متبقى <strong><?=number_format ( $budget['budget_available'], 2 )?></strong> من <strong><?=number_format ( $budget['budget_value'], 2 )?></strong></p>
    <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-<?=budgetProgressClass ( $budget['progress'] )?> active" role="progressbar" aria-valuenow="<?=$budget['progress']?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$budget['progress']?>%">
            <?=$budget['progress']?>%
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" id="chart2" style="height: 800px;"></div>
    <div class="col-md-2"></div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>م.</th>
                <th>الحساب</th>
                <th>التصنيف</th>
                <th>المستخدم</th>
                <th>التاريخ</th>
                <th>المبلغ</th>
                <th>ملاحظات</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0 ; ?>
            <?php foreach ( $res as $i => $r ) { ?>
            <?php $parent = getCatParent ( $r['cat_id'] ) != "" ? getCatParent ( $r['cat_id'] ) . ' <i class="fa fa-chevron-left" aria-hidden="true"></i> ' : '' ; ?>
            <tr>
                <td><?=$i + 1?></td>
                <td><?=getFldById ( 'accounts', 'acc_id', $r['acc_id'], 'acc_title' )?></td>
                <td><?=$parent?><?=getFldById ( 'categories', 'cat_id', $r['cat_id'], 'cat_name' )?></td>
                <td><?=getFldById ( 'users', 'user_id', $r['user_id'], 'user_name' )?></td>
                <td><?=date ( 'Y/m/d', $r['rec_time'] )?></td>
                <td><strong><?=number_format ( $r['rec_credit'], 2 )?></strong></td>
                <td><?=$r['rec_comment']?></td>
                <td><a href="<?=site_url ( 'acc/delete/ledger/rec_id/'.$r['rec_id'] )?>" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> حذف</a></td>
            </tr>
            <?php $total += $r['rec_credit'] ; ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td>المجموع: </td>
                <td><strong><?=number_format ( $total, 2 )?></strong></td>
                <td colspan="2"><?=$this->numbers->money2str ( $total, 'SAR', 'ar' )?></td>
            </tr>
        </tfoot>
    </table>
</div>