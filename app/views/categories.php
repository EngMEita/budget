<div class="table-responsive">
    <?=form_open ( 'acc/save' )?>
    <input type="hidden" name="table" value="categories" />
    <input type="hidden" name="frm_data[cat_type]" value="<?=$cat_type?>" />
    <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>م.</th>
                <th>التصنيف الرئيسي</th>
                <th>التصنيف الفرعي</th> <!-- stoped here  -->
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($res as $i => $r) { ?>
        <?php if ($r['cat_id'] == $cat_id) { ?>
            <tr>
                <td><?=$i+1?></td>
                <td>
                <select name='frm_data[parent_id]' size='1' class='form-control'>
                        <option value="">بلا</option>
                        <?php foreach ($cats as $cat) { ?>
                        <option value='<?=$cat['cat_id']?>'<?php if ( $cat['cat_id'] == $r['parent_id'] ) echo ' selected="selected"'; ?>><?=$cat['cat_name']?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <input type='text' name='frm_data[cat_name]' class='form-control' value='<?=$r['cat_name']?>' placeholder="التصنيف" required />
                    <input type="hidden" name="id_fld" value="cat_id" />
                    <input type="hidden" name="id_vlu" value="<?=$r['cat_id']?>" />
                    <input type="hidden" name="back_url" value="<?=site_url ( 'acc/categories/'.$cat_type )?>" />
                </td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> حفظ</button></td>
                <td><a href="<?=site_url ( 'acc/categories/'.$cat_type )?>" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i> إلغاء</a></td>
            </tr>
        <?php }else{ ?>
            <tr>
                <td><?=$i+1?></td>
                <td><strong><?=$r['parent_name']?></strong></td>
                <td><strong><?=$r['cat_name']?></strong></td>
                <td><a href="<?=site_url ( 'acc/ledger/cat_id.'.$r['cat_id'] )?>" class="btn btn-info"><i class="fa fa-list fa-fw"></i> العمليات</a></td>
                <td><a href="<?=site_url ( 'acc/categories/'.$cat_type.'/'.$r['cat_id'] )?>" class="btn btn-success"><i class="fa fa-edit fa-fw"></i> تحرير</a></td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
        <?php if ( ! isset ( $cat_id ) ) { ?>
        <tfoot>
            <tr>
                <td><?=$i+2?></td>
                <td>
                    <select name='frm_data[parent_id]' size='1' class='form-control'>
                        <option value="">بلا</option>
                        <?php foreach ($cats as $r) { ?>
                        <option value='<?=$r['cat_id']?>'><?=$r['cat_name']?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type='text' name='frm_data[cat_name]' class='form-control' placeholder="التصنيف" required /></td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> أضف</button></td>
                <td></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>
    <?=form_close ()?>
</div>