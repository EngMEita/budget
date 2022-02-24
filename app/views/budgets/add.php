<?=form_open ( 'acc/save_budget' )?>

<div class="row">

    <div class="col-md-9">

        <fieldset>

            <legend>الميزانية:</legend>

            <div class="form-group row">

                <div class="col-md-3">الميزانية: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_name]" class="form-control"

                        placeholder="الميزانية" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">القيمة: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_value]" value="0.00" class="form-control money"

                        placeholder="القيمة" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">تاريخ البدء: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_start]" value="<?=$first_date?>"

                        class="form-control" placeholder="تاريخ البدء" required /></div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">تاريخ الإنتهاء: </div>

                <div class="col-md-9"><input type="text" name="frm[budget_end]" value="<?=$last_date?>"

                        class="form-control" placeholder="تاريخ الإنتهاء" /></div>

            </div>

        </fieldset>

    </div>

    <div class="col-md-3">

        <fieldset>

            <legend>التصنيفات:</legend>

            <?php foreach ( $cats as $cat ) { ?>

            <span class="pull-right" style="padding: 5px; margin: 2px;">

                <label><input type="checkbox" name="cats[]" value="<?=$cat['cat_id']?>" /> <?=$cat['cat_name']?></label>

            </span>

            <?php } ?>

        </fieldset>

        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus fa-fw"></i> أضف</button>

    </div>

</div>

<?=form_close ()?>