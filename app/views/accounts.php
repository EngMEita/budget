<div class="table-responsive">
    <?=form_open ( 'acc/save' )?>
    <input type="hidden" name="table" value="accounts" />
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>م.</th>
                <th>الحساب</th>
                <th>الرصيد</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($res as $i => $r) { ?>
            <?php if ( $r->acc_id == $acc_id ) { ?>
            <tr>
                <td><?=$i+1?></td>
                <td>
                    <input type="text" value="<?=$r->acc_title?>" name="frm_data[acc_title]" class="form-control"
                        placeholder="الحساب" required />
                    <input type="hidden" name="id_fld" value="acc_id" />
                    <input type="hidden" name="id_vlu" value="<?=$r->acc_id?>" />
                    <input type="hidden" name="back_url" value="<?=site_url ( 'acc/accounts' )?>" />
                </td>
                <td><strong><?=number_format ( $r->balance, 2 )?></strong></td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> حفظ</button></td>
                <td><a href="<?=site_url ( 'acc/accounts' )?>" class="btn btn-danger"><i
                            class="fa fa-refresh fa-fw"></i> إلغاء</a></td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td><?=$i+1?></td>
                <td><strong><?=$r->acc_title?></strong></td>
                <td><strong><?=number_format ( $r->balance, 2 )?></strong></td>
                <td><a href="<?=site_url ( 'acc/ledger/acc_id.'.$r->acc_id )?>" class="btn btn-info"><i
                            class="fa fa-list fa-fw"></i> العمليات</a></td>
                <td><a href="<?=site_url ( 'acc/accounts/'.$r->acc_id )?>" class="btn btn-success"><i
                            class="fa fa-edit fa-fw"></i> تحرير</a></td>
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
        <?php if ( ! isset ( $acc_id ) ) { ?>
        <tfoot>
            <tr>
                <td><?=$i+2?></td>
                <td><input type="text" value="" name="frm_data[acc_title]" class="form-control" placeholder="الحساب"
                        required /></td>
                <td><strong>0.00</strong></td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> أضف</button></td>
                <td></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>
    <?=form_close ()?>
</div>