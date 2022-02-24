<div class="table-responsive">

    <table class="table table-striped table-hover" id="dataTable">

        <thead>

            <tr>

                <th>م.</th>

                <th>الميزانية</th>

                <th>القيمة</th>

                <th>المصروف</th>

                <th>المتبقي</th>

                <th>النسبة</th>

                <th>من</th>

                <th>إلى</th>

                <th><a href="<?=site_url ( 'acc/budgets/add' )?>" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> إضافة</a></th>

                <th></th>

                <th></th>

                <th></th>

            </tr>

        </thead>

        <tbody>

            <?php $tot1 = 0; ?>

            <?php $tot2 = 0; ?>

            <?php $tot3 = 0; ?>

            <?php $per = 0; ?>

            <?php foreach ( $res as $i => $r ) { ?>

            <tr>

                <td><?=$i+1?></td>

                <td><strong><?=$r['budget_name']?></strong></td>

                <td><strong><?=number_format ( $r['budget_value'], 2 )?></strong></td>

                <td><strong><?=number_format ( $r['budget_outcome'], 2 )?></strong></td>

                <td><strong><?=number_format ( $r['budget_available'], 2 )?></strong></td>

                <td><?=round ( $r['progress'], 2 )?>%</td>

                <td><?=date ( 'd-m-Y', $r['budget_start'] )?></td>

                <td><?=date ( 'd-m-Y', $r['budget_end'] )?></td>

                <td><a href="<?=site_url ( 'acc/budgets/view/'.$r['budget_id'] )?>" class="btn btn-info"><i class="fa fa-eye fa-fw"></i> مشاهدة</a></td>

                <td><a href="<?=site_url ( 'acc/budgets/edit/'.$r['budget_id'] )?>" class="btn btn-success"><i class="fa fa-edit fa-fw"></i> تحرير</a></td>

                <td><a href="<?=site_url ( 'acc/budgets/copy/'.$r['budget_id'] )?>" class="btn btn-default"><i class="fa fa-clipboard"></i> نسخ</a></td>

                <td><a href="<?=site_url ( 'acc/delete/budgets/budget_id/'.$r['budget_id'] )?>" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> حذف</a></td>

            </tr>  

            <?php $tot1 += $r['budget_value'] ; ?>

            <?php $tot2 += $r['budget_outcome'] ; ?>

            <?php $tot3 += $r['budget_available'] ; ?>

            <?php $per  += $r['progress'] ; ?>

            <?php } ?>

        </tbody>

    </table>

</div>