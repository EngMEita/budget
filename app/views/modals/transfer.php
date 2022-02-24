<div id="addTransfer" class="modal fade" role="dialog">
<?=form_open('acc/transfer')?>
    <input type="hidden" name="user" value="<?=$user->user_id?>" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><strong>تحويل</strong></h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3">المبلغ: </div>
                    <div class="col-sm-9"><input type="text" name="money" class="form-control money" placeholder="المبلغ"
                            value="0.00" required /></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">التاريخ: </div>
                    <div class="col-sm-9"><input type="text" name="date" class="form-control" placeholder="التاريخ"
                            value="<?=date('d-m-Y')?>" required /></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">من حساب: </div>
                    <div class="col-sm-9">
                        <select name="from" class="sel2" style="width: 100%" size="1">
                            <?php foreach ($accs as $acc) {?>
                            <?php if ($acc->balance > 0) {?>
                            <option value="<?=$acc->acc_id?>"><?=$acc->acc_title?> (
                                <?=number_format($acc->balance, 2)?> )</option>
                            <?php }?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">إلى حساب: </div>
                    <div class="col-sm-9">
                        <select name="to" class="sel2" style="width: 100%" size="1">
                            <?php foreach ($accs as $acc) {?>
                            <option value="<?=$acc->acc_id?>"><?=$acc->acc_title?> (
                                <?=number_format($acc->balance, 2)?> )</option>
                            <?php }?>
                            <option value="new_acc"> -- إنشاء حساب جديد -- </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">ملاحظة: </div>
                    <div class="col-sm-9"><input type="text" name="comment" class="form-control" placeholder="ملاحظة"
                            value="" /></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group pull-left">
                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i>
                        أضف</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"
                            aria-hidden="true"></i> إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <?=form_close()?>
</div>