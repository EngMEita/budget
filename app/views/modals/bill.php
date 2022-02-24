<div id="addBill" class="modal fade" role="dialog">
    <?=form_open('acc/bill')?>
    <input type="hidden" name="frm_data[user_id]" value="<?=$user->user_id?>" />
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>إضافة فاتورة</strong></h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3">التاريخ: </div>
                    <div class="col-sm-9"><input type="text" name="frm_data[rec_time]" class="form-control"
                            placeholder="التاريخ" value="<?=date('d-m-Y')?>" required /></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">الحساب: </div>
                    <div class="col-sm-9">
                        <select name="frm_data[acc_id]" class="sel2" style="width: 100%" size="1">
                            <?php foreach ($accs as $acc) {?>
                            <?php if ($acc->balance > 0) {?>
                            <option value="<?=$acc->acc_id?>"><?=$acc->acc_title?> (
                                <?=number_format($acc->balance, 2)?> )</option>
                            <?php }?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <table class="table table-striped table-border table-hover">
                    <thead>
                        <tr>
                            <th>م.</th>
                            <th>السعر</th>
                            <th>التصنيف</th>
                            <th>ملاحظة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ( $i = 1; $i <= 10; $i++ ) { ?>
                        <tr>
                            <td><?=$i?></td>
                            <td>
                                <div class="col-sm-9"><input type="text" name="itm[<?=$i-1?>][rec_credit]"
                                        class="form-control itm money" placeholder="0.00" value="0.00" required /></div>
                            </td>
                            <td>
                                <select name="itm[<?=$i-1?>][cat_id]" class="sel2" style="width: 100%" size="1">
                                    <option value="">بدون تصنيف</option>
                                    <?php foreach ($o_cats as $cat) {?>
                                    <option value="<?=$cat['cat_id']?>"><?=$cat['cat_name']?></option>
                                    <?php foreach ($cat['sub'] as $sub) {?>
                                    <option value="<?=$sub['cat_id']?>"> ----- <?=$sub['cat_name']?></option>
                                    <?php }?>
                                    <?php }?>
                                    <option value="new_cat" data-type="0"> -- إنشاء تصنيف جديد -- </option>
                                </select>
                            </td>
                            <td><input type="text" name="itm[<?=$i-1?>][rec_comment]" class="form-control"
                                    placeholder="ملاحظة" value="" /></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left">الإجمالي: </td>
                            <td class="text-center"><span id="billTotal">0.00</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <div class="btn-group pull-left">
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i>
                        أضف</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"
                            aria-hidden="true"></i> إغلاق</button>
                </div>
            </div>
        </div>

    </div>
    <?=form_close()?>
</div>