<?=form_open ( 'acc/save_budget/'.$budget->budget_id )?>

<div class="row">

    <div class="col-md-9">

        <fieldset>

            <legend>الميزانية:</legend>

            <div class="form-group row">

                <div class="col-md-3">الميزانية: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_name]" value="<?=$budget->budget_name?>" class="form-control"

                        placeholder="الميزانية" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">القيمة: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_value]" value="<?=round ( $budget->budget_value, 2 )?>" class="form-control money"

                        placeholder="القيمة" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">تاريخ البدء: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_start]" value="<?=date ( 'd-m-Y', $budget->budget_start )?>"

                        class="form-control" placeholder="تاريخ البدء" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">تاريخ الإنتهاء: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_end]" value="<?=date ( 'd-m-Y', $budget->budget_end )?>"

                        class="form-control" placeholder="تاريخ الإنتهاء" /></div>

            </div>

        </fieldset>

    </div>

    <div class="col-md-3">

        <fieldset>

            <legend>التصنيفات:</legend>

            <?php foreach ( $cats as $cat ) { ?>

            <span class="pull-right" style="padding: 5px; margin: 2px;">

                <label><input type="checkbox" name="cats[]" value="<?=$cat['cat_id']?>"<?php if ( in_array ( $cat['cat_id'], $budget_cats ) ) echo ' checked' ; ?> /> <?=$cat['cat_name']?></label>

            </span>

            <?php } ?>

        </fieldset>

        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save fa-fw"></i> حفظ</button>

    </div>

</div>

<?=form_close ()?>