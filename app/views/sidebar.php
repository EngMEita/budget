<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li><a href="<?=site_url ( 'acc/index' )?>"><i class="fa fa-dashboard fa-fw"></i> الرئيسية</a></li>
            <li><a href="<?=site_url ( 'acc/ledger' )?>"><i class="fa fa-list fa-fw"></i> العمليات</a></li>
            <li><a href="<?=site_url ( 'acc/budgets/list' )?>"><i class="fa fa-calculator fa-fw"></i> الميزانيات</a></li>
            <li><a href="<?=site_url ( 'acc/accounts' )?>"><i class="fa fa-money fa-fw"></i> الحسابات</a></li>
            <li>
                <a href="#"><i class="fa fa-cogs fa-fw"></i> التصنيفات<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?=site_url ( 'acc/categories/1' )?>">تصنيفات الدخل</a>
                    </li>
                    <li>
                        <a href="<?=site_url ( 'acc/categories/0' )?>">تصنيفات المصروفات</a>
                    </li>
                </ul>
            </li>
            <li><a href="<?=site_url ( 'acc/users' )?>"><i class="fa fa-users fa-fw"></i> المستخدمين</a></li>
        </ul>
    </div>
</div>