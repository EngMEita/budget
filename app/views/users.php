<div class="table-responsive">
    <?=form_open ( 'acc/save' )?>
    <input type="hidden" name="table" value="users" />
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>م.</th>
                <th>الاسم</th>
                <th>الايميل</th>
                <th>كلمة المرور</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($res as $i => $r) { ?>
            <?php if ( $r->user_id == $user_id ) { ?>
            <tr>
                <td><?=$i+1?></td>
                <td>
                    <input type="text" value="<?=$r->user_name?>" name="frm_data[user_name]" class="form-control" placeholder="الاسم" required />
                    <input type="hidden" name="id_fld" value="user_id" />
                    <input type="hidden" name="id_vlu" value="<?=$r->user_id?>" />
                    <input type="hidden" name="back_url" value="<?=site_url ( 'acc/users' )?>" />
                </td>
                <td><input type="email" value="<?=$r->user_email?>" name="frm_data[user_email]" class="form-control" placeholder="الايميل" required /></td>
                <td><input type="text" value="" name="frm_data[user_pass]" class="form-control" placeholder="كلمة المرور" /></td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> حفظ</button></td>
                <td><a href="<?=site_url ( 'acc/users' )?>" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i> إلغاء</a></td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td><?=$i+1?></td>
                <td><strong><?=$r->user_name?></strong></td>
                <td><strong><?=$r->user_email?></strong></td>
                <td>***</td>
                <td><a href="<?=site_url ( 'acc/ledger/user_id.'.$r->user_id )?>" class="btn btn-info"><i class="fa fa-list fa-fw"></i> العمليات</a></td>
                <td><a href="<?=site_url ( 'acc/users/'.$r->user_id )?>" class="btn btn-success"><i class="fa fa-edit fa-fw"></i> تحرير</a></td>
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
        <?php if ( ! isset ( $user_id ) ) { ?>
        <tfoot>
            <tr>
                <td><?=$i+2?></td>
                <td><input type="text" value="" name="frm_data[user_name]" class="form-control" placeholder="الاسم" required /></td>
                <td><input type="email" value="" name="frm_data[user_email]" class="form-control" placeholder="الايميل" required /></td>
                <td><input type="text" value="" name="frm_data[user_pass]" class="form-control" placeholder="كلمة المرور" required /></td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> أضف</button></td>
                <td></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>
    <?=form_close ()?>
</div>