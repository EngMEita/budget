<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>سمارت بدجت</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url ()?>assists/cp/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url ()?>assists/cp/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=base_url ()?>assists/cp/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url ()?>assists/cp/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url ()?>assists/cp/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url ()?>assists/cp/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">تسجيل الدخول</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ( isset ( $error ) ) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?=$error?>
                        </div>
                        <?php } ?>
                        <?=form_open('')?>
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="البريد الإلكتروني" name="email" type="email"
                                    autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="كلمة المرور" name="password" type="password"
                                    value="" required>
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-sign-in"></i>
                                تسجيل الدخول</button>
                        </fieldset>
                        <?=form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?=base_url ()?>assists/cp/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url ()?>assists/cp/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url ()?>assists/cp/js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url ()?>assists/cp/js/sb-admin-2.js"></script>

</body>

</html>