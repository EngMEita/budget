<div id="addIncome" class="modal fade" role="dialog">
    <?=form_open('acc/save')?>
    <input type="hidden" name="table" value="ledger" />
    <input type="hidden" name="frm_data[user_id]" value="<?=$user->user_id?>" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>إضافة دخل</strong></h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3">المبلغ: </div>
                    <div class="col-sm-9"><input type="text" name="frm_data[rec_debit]" class="form-control money"
                            placeholder="المبلغ" value="0.00" required /></div>
                </div>
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
                            <option value="<?=$acc->acc_id?>"><?=$acc->acc_title?> (
                                <?=number_format($acc->balance, 2)?> )</option>
                            <?php }?>
                            <option value="new_acc"> -- إنشاء حساب جديد -- </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">التصنيف: </div>
                    <div class="col-sm-9">
                        <select name="frm_data[cat_id]" class="sel2" style="width: 100%" size="1">
                            <option value="">بدون تصنيف</option>
                            <?php foreach ($i_cats as $cat) {?>
                            <option value="<?=$cat['cat_id']?>"><?=$cat['cat_name']?></option>
                            <?php foreach ($cat['sub'] as $sub) {?>
                            <option value="<?=$sub['cat_id']?>"> ----- <?=$sub['cat_name']?></option>
                            <?php }?>
                            <?php }?>
                            <option value="new_cat" data-type="1"> -- إنشاء تصنيف جديد -- </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">ملاحظة: </div>
                    <div class="col-sm-9"><input type="text" name="frm_data[rec_comment]" class="form-control"
                            placeholder="ملاحظة" value="" /></div>
                </div>
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