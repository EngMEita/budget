<?php if ( isset ( $accs ) && isset ( $cats ) ) { ?>

<?php if ( $this->session->userdata ( 'frm' ) ) { ?>

<?php $frm_data = $this->session->userdata ( 'frm' ) ; ?>

<?php } ?>

<?=form_open ( 'acc/set_ledger' )?>

<div class="row" style="margin-bottom: 10px;">

    <div class="col-md-1"><strong>إختر الحسابات</strong>: </div>

    <div class="col-md-3">

        <select name="frm[acc_id][]" class="sel2" multiple="multiple" style="width: 100%" id="frm_acc_id" data-placeholder="إختر الحسابات">

            <?php foreach ($accs as $acc) { ?>

            <option value="<?=$acc->acc_id?>"<?php if ( isset ( $frm_data['acc_id'] ) && ( in_array ( $acc->acc_id, $frm_data['acc_id'] ) || $acc->acc_id == $frm_data['acc_id'] ) ) { echo " selected='selected'" ; } ?>><?=$acc->acc_title?></option>

            <?php } ?>

        </select>

    </div>

    <div class="col-md-1"><strong>إختر التصنيفات</strong>: </div>

    <div class="col-md-3">

        <select name="frm[cat_id][]" class="sel2" multiple="multiple" style="width: 100%" id="frm_cat_id" data-placeholder="إختر التصنيفات">

            <?php foreach ($cats as $cat) { ?>

            <option value="<?=$cat['cat_id']?>"<?php if ( isset ( $frm_data['cat_id'] ) && ( in_array ( $cat['cat_id'], $frm_data['cat_id'] ) || $cat['cat_id'] == $frm_data['cat_id'] ) ) { echo " selected='selected'" ; } ?>><?=$cat['cat_name']?></option>

            <?php } ?>

        </select>

    </div>

    <div class="col-md-1"><strong>إختر المدخل</strong>: </div>

    <div class="col-md-3">

        <select name="frm[user_id]" class="sel2" style="width: 100%" id="frm_user_id" data-placeholder="إختر المدخل" size="1">

            <option value="">الجميع</option>

            <?php foreach ($users as $user) { ?>

            <option value="<?=$user['user_id']?>"<?php if ( isset ( $frm_data['user_id'] ) && $user['user_id'] == $frm_data['user_id'] ) { echo " selected='selected'" ; } ?>><?=$user['user_name']?></option>

            <?php } ?>

        </select>

    </div>

</div>



<div class="row" style="margin-bottom: 10px;">

    <div class="col-md-1"><strong>من</strong>: </div>

    <div class="col-md-3">

        <input type="text" name="frm[from]" value="<?=isset ( $frm_data['from'] ) ? $frm_data['from'] : ''?>" id="frm_from_date" class="form-control" placeholder="<?=$first_date?>" />

    </div>

    <div class="col-md-1"><strong>إلى</strong>: </div>

    <div class="col-md-3">

        <input type="text" name="frm[to]" value="<?=isset ( $frm_data['to'] ) ? $frm_data['to'] : ''?>" id="frm_to_date" class="form-control" placeholder="<?=$last_date?>" />

    </div>

    <div class="col-md-3">

        <input type="text" name="frm[rec_comment]" value="<?=isset ( $frm_data['rec_comment'] ) ? $frm_data['rec_comment'] : ''?>" id="frm_comment" class="form-control" placeholder="كلمة البحث" />

    </div>

    <div class="col-md-1"><button type="submit" class="btn btn-info btn-block" id="frm_search"><i class="fa fa-search" aria-hidden="true"></i> بحث</button></div>

</div>

<?=form_close ()?>

<?php } ?>

<div class="dt-responsive">

    <table class="table table-striped table-hover" id="dataTable">

        <thead>

            <tr>

                <th>م.</th>

                <th>الحساب</th>

                <th>التصنيف</th>

                <th>المدخل</th>

                <th>التاريخ</th>

                <th data-orderable="false">سحب</th>

                <th data-orderable="false">إيداع</th>

                <th data-orderable="false">ملاحظات</th>

                <th data-orderable="false"></th>

            </tr>

        </thead>

        <tbody>

            <?php $tot_c = 0 ; ?>

            <?php $tot_d = 0 ; ?>

            <?php foreach ( $res as $i => $r ) { ?>

            <?php $parent = getCatParent ( $r['cat_id'] ) != "" ? getCatParent ( $r['cat_id'] ) . ' <i class="fa fa-chevron-left" aria-hidden="true"></i> ' : '' ; ?>

            <tr>

                <td><?=$i + 1?></td>

                <td><?=getFldById ( 'accounts', 'acc_id', $r['acc_id'], 'acc_title' )?></td>

                <td><?=$parent?><?=getFldById ( 'categories', 'cat_id', $r['cat_id'], 'cat_name' )?></td>

                <td><?=getFldById ( 'users', 'user_id', $r['user_id'], 'user_name' )?></td>

                <td><?=date ( 'Y/m/d', $r['rec_time'] )?></td>

                <td><strong><?=number_format ( $r['rec_credit'], 2 )?></strong></td>

                <td><strong><?=number_format ( $r['rec_debit'], 2 )?></strong></td>

                <td><?=$r['rec_comment']?></td>

                <td><a href="<?=site_url ( 'acc/delete/ledger/rec_id/'.$r['rec_id'] )?>" class="btn btn-danger"><i

                            class="fa fa-trash fa-fw"></i> حذف</a></td>

            </tr>

            <?php $tot_c += $r['rec_credit'] ; ?>

            <?php $tot_d += $r['rec_debit'] ; ?>

            <?php } ?>

        </tbody>

        <tfoot>

            <tr>

                <td colspan="4"></td>

                <td>المجموع: </td>

                <td><strong><?=number_format ( $tot_c, 2 )?></strong></td>

                <td><strong><?=number_format ( $tot_d, 2 )?></strong></td>

                <td colspan="2"><strong><?=number_format ( $tot_d - $tot_c, 2 )?> (

                        <?=$this->numbers->money2str ( $tot_d - $tot_c, 'SAR', 'ar' )?> )</strong></td>

            </tr>

        </tfoot>

    </table>

</div>