<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Acc extends CI_Controller {

    public $g ;

    function __construct ()

    {

        parent::__construct() ;

        $this->load->library ( 'arabic', array('library' => 'Numbers'), 'numbers' ) ; 

        $this->load->helper ( 'globals' ) ;

        if ( $this->m->getCount ( array ( "table" => "users" ) ) < 1 )

        {

            $data               = array () ;

            $data['user_name']  = "محمد" ;

            $data['user_email'] = "maa1987@hotmail.com" ;

            $data['user_pass']  = md5 ( md5 ( '19062017' ) ) ;

            $user_id            = $this->m->setRec ( 'users', $data ) ;

            if ( $user_id > 0 )

            {

                $d['id']        = $user_id ;

                $d['time']      = time () ;

                $d['valid']     = time() + 1800 ;

                $this->session->set_userdata ( 'user_data', $d ) ;

            }

        }

        

        if ( $this->m->getCount ( array ( "table" => "accounts" ) ) < 1 )

        {

            $data = array ( 'acc_title' => 'الحساب الإفتراضي' ) ;

            $this->m->setRec ( 'accounts', $data ) ;

        }



        $method = $this->router->fetch_method () ;

        if ( $method != 'login' )

        {

            if ( ! $this->m->is_logged_in () ) redirect ( 'acc/login' ) ; 

            else 

            {

                $user_data      = $this->session->userdata ( 'user_data' ) ;

                $data['user']   = $this->m->getRec ( 'users', 'user_id', $user_data['id'], 'object' ) ;

                $this->g        = $data ;

            }  

        }

    }



    public function index ()

    {

        $data              = $this->g ;

        $data['accs']      = $this->m->getAccountList () ;

        $data['balance']   = 0;

        foreach ( $data['accs'] as $i => $acc )

        {

            $balance = $this->m->getAccountBalance ( $acc->acc_id ) ;

            $data['balance'] += $balance ;

            $acc->balance = $balance ;

            

            $data['accs'][$i] = $acc ;

        }

        $data['i_cats']     = $this->m->getCategories ( 1 ) ;

        $data['o_cats']     = $this->m->getCategories ( 0 ) ;

        $from               = strtotime ( '-7 day' ) ;

        $to                 = strtotime ( 'today' ) ;

        $data['res']        = $this->m->getQuery ( 'SELECT * FROM `ledger` WHERE `perent_id` IS NULL AND `rec_time` >= '.$from.' AND `rec_time` <= '.$to.' ORDER BY `rec_time` DESC, `rec_id` DESC' );

        $budgets            = $this->m->getQuery ( 'SELECT * FROM `budgets` WHERE `budget_start` <= '.$to.' AND `budget_end` >= '.$to ) ;

        $data['budgets']    = array () ;

        foreach ( $budgets as $i => $b )

        {

            $data['budgets'][$i] = $this->m->getBudget ( $b['budget_id'] ) ;

        }

        $data['view_page']  = 'dashboard' ;

        $data['js_page']  = 'dashboard_js' ;

        $data['page_title'] = 'الرئيسية' ;

        $data['page_sub_title']  = 'مجموع الأرصدة الموجودة بالحسابات <strong>'.number_format ( $data['balance'], 2 ).'</strong> فقط ( <strong>'.$this->numbers->money2str ( $data['balance'], 'SAR', 'ar' ).'</strong> )' ;

        //print_r ( $data ) ; 

        $this->load->view ( 'cp', $data ) ;

    }



    public function accounts ( $acc_id = null )

    {

        $data               = $this->g ;

        $data['res']        = $this->m->getAccountList () ;

        foreach ( $data['res'] as $i => $acc )

        {

            $acc->balance = $this->m->getAccountBalance ( $acc->acc_id ) ;

            $data['res'][$i] = $acc ;

        }

        $data['view_page']  = 'accounts' ;

        $data['page_title'] = 'الحسابات' ;

        if ( ! is_null ( $acc_id ) ) $data['acc_id'] = $acc_id ;

        $this->load->view ( 'cp', $data ) ;

    }



    public function categories ( $cat_type, $cat_id = null )

    {

        $data                   = $this->g ;

        $data['res']            = $this->m->getAllCategories ( $cat_type ) ;

        $data['cats']           = $this->m->getMainCategories ( $cat_type ) ;

        $data['view_page']      = 'categories' ;

        $data['page_title']     = 'التصنيفات' ;

        $data['page_sub_title'] = $cat_type > 0 ? 'تصنيفات الدخل' : 'تصنيفات المصروفات' ;

        $data['cat_type']       = $cat_type ;

        if ( ! is_null ( $cat_id ) ) $data['cat_id'] = $cat_id ;

        $this->load->view ( 'cp', $data ) ;

    }



    public function users ( $user_id = null )

    {

        $data                   = $this->g ;

        $data['res']            = $this->m->getRes ( array ( 'table' => 'users' ), 'object' ) ;

        $data['view_page']      = 'users' ;

        $data['page_title']     = 'المستخدمين' ;

        if ( ! is_null ( $user_id ) ) $data['user_id'] = $user_id ;

        $this->load->view ( 'cp', $data ) ;

    }



    public function budgets ( $mod = 'list', $budget_id = null )

    {

        $data = $this->g ;

        switch ( $mod )

        {

            case 'view':

                $data['budget']         = $this->m->getBudget ( $budget_id ) ;

                $data['res']            = $this->m->getBudgetLedger ( $budget_id ) ;

                $data['budegt_id']      = $budget_id ;

                $data['page_title']     = 'الميزانيات' ;

            break;

            case 'add':

                $data['cats']           = $this->m->getMainCategories ( 0 ) ;

                $fdt = strtotime ( 'first day of this month' ) ;

                $ldt = strtotime ( 'last day of this month' ) ;

                $data['first_date']     = date ( "d-m-Y", $fdt ) ;

                $data['last_date']      = date ( "d-m-Y", $ldt ) ;

                $data['page_title']     = 'الميزانيات' ;

                $data['page_sub_title'] = 'إنشاء ميزانية جديدة' ;

            break;

            case 'edit':

                $data['budget']          = $this->m->getRec ( 'budgets', 'budget_id', $budget_id, 'object' ) ;

                $dt                      = array ();

                $dt['table']             = 'budget_categories';

                $dt['cond']              = array  () ;

                $dt['cond']['budget_id'] = $budget_id ;

                $b_cats                  = $this->m->getRes ( $dt ) ;

                $budget_cats             = array ();

                foreach ( $b_cats as $bc )

                {

                    $budget_cats[]      = $bc['cat_id'] ;

                }

                $data['budget_cats']    = $budget_cats ;

                $data['cats']           = $this->m->getMainCategories ( 0 ) ;

                $data['budegt_id']      = $budget_id ;

                $data['page_title']     = 'الميزانيات' ;

                $data['page_sub_title'] = 'تحرير ميزانية #'.$budget_id ;

            break;

            case 'copy':

                $data['budget']          = $this->m->getRec ( 'budgets', 'budget_id', $budget_id, 'object' ) ;

                $dt                      = array ();

                $dt['table']             = 'budget_categories';

                $dt['cond']              = array  () ;

                $dt['cond']['budget_id'] = $budget_id ;

                $b_cats                  = $this->m->getRes ( $dt ) ;

                $budget_cats             = array ();

                foreach ( $b_cats as $bc )

                {

                    $budget_cats[]      = $bc['cat_id'] ;

                }

                $data['budget_cats']    = $budget_cats ;

                $data['cats']           = $this->m->getMainCategories ( 0 ) ;

                $data['budegt_id']      = $budget_id ;

                $data['page_title']     = 'الميزانيات' ;

                $data['page_sub_title'] = 'إنشاء ميزانية جديدة' ;

            break;

            case 'list':

            default:

                $budgets            = $this->m->getQuery ( "SELECT * FROM `budgets` ORDER BY `budget_start` DESC, `budget_id` ASC" ) ;

                $data['res']        = array () ;

                foreach ( $budgets as $i => $b )

                {

                    $data['res'][$i] = $this->m->getBudget ( $b['budget_id'] ) ;

                }

                $data['page_title'] = 'الميزانيات' ;

            break;

        }

        $data['mod']                = $mod;

        $data['view_page']          = 'budgets/'.$mod ;

        $data['js_page']            = 'budgets/js' ;

        //print_r($data);

        $this->load->view ( 'cp', $data ) ;

    }



    public function set_ledger ()

    {

        if ( isset ( $_POST['frm'] ) ) {

            $frm = array () ;

            foreach ( $_POST['frm'] as $k => $v )

            {

                if ( ! empty ( $v ) && $v != "" ) $frm[$k] = $v ;

            }

            

            $str = urlencode ( array2str ( $frm ) ) ;

            redirect( 'acc/ledger/'.$str ) ;

        }

        else redirect( 'acc/ledger' ) ;

    }



    public function ledger ( $str = null )

    {

        $data               = $this->g ;

        $fdt                = strtotime ( 'first day of this month' ) ;

        $ldt                = strtotime ( 'last day of this month' ) ;

        $data['first_date'] = date ( "d-m-Y", $fdt ) ;

        $data['last_date']  = date ( "d-m-Y", $ldt ) ;

        $data['accs']       = $this->m->getAccountList () ;

        $data['cats']       = $this->m->getMainCategories ( 0 ) ;

        $data['users']      = $this->m->getQuery ( 'SELECT * FROM `users` ORDER BY `user_name` ASC' ) ;

        $q = "SELECT * FROM `ledger` WHERE" ;

        if ( ! is_null ( $str ) )

        {

            $arr = str2array ( urldecode ( $str ) ) ;

            $this->session->set_userdata ( 'frm', $arr ) ;

            if ( isset ( $arr['acc_id'] ) )

            {

                $acc_id = $arr['acc_id'] ;

                $accs   = is_array ( $acc_id ) ? implode ( ', ', $acc_id )  : $acc_id ;

                $q     .= " `acc_id` IN ( " . $accs . " ) AND" ;

            }



            if ( isset ( $arr['user_id'] ) )

            {

                $user_id = $arr['user_id'] ;

                $users   = is_array ( $user_id ) ? implode ( ', ', $user_id )  : $user_id ;

                $q      .= " `user_id` IN ( " . $users . " ) AND" ;

            }



            if ( isset ( $arr['cat_id'] ) )

            {

                $cat_id = $arr['cat_id'] ; 

                if ( is_array ( $cat_id ) )

                {

                    $cats = array () ;

                    foreach ( $cat_id as $c )

                    {

                        $cats[] = $c ;

                        $subs = $this->m->getSubCategories ( $c ) ;

                        foreach ( $sub as $s )

                        {

                            $cats[] = $s['cat_id'] ;

                        } 

                    }

                }

                else

                {

                    $cats = array ( $cat_id ) ;

                    $sub = $this->m->getSubCategories ( $cat_id ) ;

                    foreach ( $sub as $s )

                    {

                        $cats[] = $s['cat_id'] ;

                    } 

                }

                $cats   = implode ( ', ', $cats ) ;

                $q     .= " `cat_id` IN ( " . $cats . " ) AND" ;

            }



            if ( isset ( $arr['from'] ) ) $q .= " `rec_time` >= ".strtotime ( $arr['from'] )." AND" ;



            if ( isset ( $arr['to'] ) ) $q   .= " `rec_time` <= ".strtotime ( $arr['to'] )." AND" ;



            if ( isset ( $arr['rec_comment'] ) ) $q   .= " `rec_comment` LIKE '%" . str_replace ( ' ', '%', $arr['rec_comment'] ) . "%' AND" ;

        }

        else $this->session->unset_userdata ( 'frm' ) ;

        



        $q .= " `rec_id` > 0 ORDER BY `rec_time` ASC, `rec_id` ASC" ;

        $data['res']        = $this->m->getQuery ( $q ) ;

        $data['page_title'] = 'العمليات' ;

        $data['view_page']  = 'ledger' ;

        $data['js_page']    = 'ledger_js' ;

        //print_r ( $data ) ;

        $this->load->view ( 'cp', $data ) ;

    }



    public function save_budget ( $id = 0 )

    {

        $times = array ( 'budget_start', 'budget_end' ) ;

        if ( isset ( $_POST['frm'] ) && is_array ( $_POST['frm'] ) && ! empty ( $_POST['frm'] ) )

        {

            $data    = array () ;

            foreach ( $_POST['frm'] as $fld => $vlu )

            {

                if ( in_array ( $fld, $times ) )          $data[$fld] = strtotime ( $vlu ) ;

                else if ( ! empty ( $vlu ) )              $data[$fld] = $vlu ;

            }



            if ( $id > 0 )

            {

                $this->m->setRec ( 'budgets', $data, 'budget_id', $id ) ;

                $this->m->delRec ( 'budget_categories', 'budget_id', $id ) ;

            }

            else $id = $this->m->setRec ( 'budgets', $data ) ;            



            $cats = $_POST['cats'] ;

            $dt = array () ;

            foreach ( $cats as $i => $cat )

            {

                $dt[$i] = array ( 'budget_id' => $id,  'cat_id' => $cat) ;

            }



            if ( $this->m->insertRes ( 'budget_categories', $dt ) ) $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تمت العملية بنجاح' ) ) ;

            else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'نأسف, لقد حدث خطأ ما' ) ) ;

        } 

        else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية' ) ) ;

        redirect( 'acc/budgets/list' ) ;

    }



    public function transfer ()

    {
        

        if ( isset ( $_POST['money'] ) && round ( $_POST['money'], 2 ) > 0 )

        {

            if ( isset ( $_POST['from'] ) && isset ( $_POST['to'] ) && $_POST['from'] != $_POST['to'] )

            {

                $money   = $_POST['money'] ;

                $time    = strtotime ( $_POST['date'] ) ;

                $from    = $_POST['from'] ;

                $to      = $_POST['to'] ;

                $user    = $_POST['user'] ;

                $comment = $_POST ['comment'] ;

                $oc = array ( 'acc_id' => $from, 'user_id' => $user, 'rec_time' => $time, 'rec_debit' => 0, 'rec_credit' => $money, 'rec_comment' => $comment ) ;

                $ic = array ( 'acc_id' => $to, 'user_id' => $user, 'rec_time' => $time, 'rec_debit' => $money, 'rec_credit' => 0, 'rec_comment' => $comment ) ;

                //print_r ( $oc ) ;
                //print_r ( $ic ) ;
                //die () ;

                $this->m->setRec ( 'ledger', $oc ) ;

                $this->m->setRec ( 'ledger', $ic ) ;

                $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تمت العملية بنجاح' ) ) ;

            }

            else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية' ) ) ;

        }

        else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية' ) ) ;

        redirect( $this->input->server( 'HTTP_REFERER' ) ) ;

    }

    public function bill ()

    {
        if ( isset ( $_POST['frm_data'] ) && isset ( $_POST['itm'] ) )

        {
            $user_id  = $_POST['frm_data']['user_id'] ;
            $acc_id   = $_POST['frm_data']['acc_id'] ;
            $rec_time = strtotime ( $_POST['frm_data']['rec_time'] ) ;

            $dt = array () ;
            foreach ( $_POST['itm'] as $i => $itm ) 
            {
                if ( $itm['rec_credit'] > 0 )
                {
                    $dt[$i] = array ( 'acc_id' => $acc_id, 'user_id' => $user_id, 'rec_time' => $rec_time ) ;
                    foreach ( $itm as $f => $v )
                    {
                        $dt[$i][$f] = $v ;
                    }
                }
            }

            if ( $this->m->insertRes ( 'ledger', $dt ) ) $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تمت العملية بنجاح' ) ) ;
            else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'حدث خطأ ما' ) ) ;
        }
        else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية' ) ) ;
        redirect( $this->input->server( 'HTTP_REFERER' ) ) ;
    }

    public function save ()

    {

        $times = array ( 'rec_time', 'budget_start', 'budget_end' ) ;

        $passwords = array ( 'user_pass' ) ;

        if ( isset ( $_POST['table'] ) )

        {

            if ( isset ( $_POST['frm_data'] ) && is_array ( $_POST['frm_data'] ) && ! empty ( $_POST['frm_data'] ) )

            {

                $table   = $_POST['table'] ;

                $data    = array () ;

                foreach ( $_POST['frm_data'] as $fld => $vlu )

                {

                    if ( in_array ( $fld, $times ) )          $data[$fld] = strtotime ( $vlu ) ;

                    else if ( in_array ( $fld, $passwords ) ) $data[$fld] = md5 ( md5 ( $vlu ) ) ;

                    else if ( ! empty ( $vlu ) )              $data[$fld] = $vlu ;

                }

                //print_r( $data ) ;

                //die () ;

                $id_fld  = isset ( $_POST['id_fld'] ) ? $_POST['id_fld'] : null ;

                $id_vlu  = isset ( $_POST['id_vlu'] ) ? $_POST['id_vlu'] : 0 ;

                if ( $this->m->setRec ( $table, $data, $id_fld, $id_vlu ) ) $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تمت العملية بنجاح' ) ) ;

                else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'نأسف, لقد حدث خطأ ما' ) ) ;

            } 

            else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية ( 2 )' ) ) ;

        }

        else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'لا يمكن إتمام العملية ( 1 )' ) ) ;

        if ( isset ( $_POST['back_url'] ) ) redirect( $_POST['back_url'] ) ;

        else redirect( $this->input->server( 'HTTP_REFERER' ) ) ;

    }



    public function delete ( $table, $id_fld, $id_vlu )

    {

        if ( $this->m->delRec ( $table, $id_fld, $id_vlu ) ) $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تمت العملية بنجاح' ) ) ;

        else $this->session->set_flashdata ( 'alert', array ( 'class' => 'danger', 'message' => 'نأسف, لقد حدث خطأ ما' ) ) ;

        redirect( $this->input->server( 'HTTP_REFERER' ) ) ;

    }



    public function new_acc ()

    {

        $dt = array ( 'acc_title' => $_POST['acc_title'] ) ;

        $tn = 'accounts' ;

        if ( ! empty ( $_POST['acc_title'] ) ) $id = $this->m->setRec ( $tn, $dt ) ;

        else $id = 0 ;

        echo '<select name="'.$_POST['fld'].'" class="form-control" size="1" id="new_gen_'.$_POST['fld'].'">' ;

        $accs = $this->m->getAccountList () ;

        foreach ( $accs as $i => $acc )

        {

            $balance = $this->m->getAccountBalance ( $acc->acc_id ) ;

            if ( $acc->acc_id == $id ) echo '<option value="'.$acc->acc_id.'" selected="selected">'.$acc->acc_title.' ( '.number_format ( $balance, 2 ).' )</option>' ;

            else echo '<option value="'.$acc->acc_id.'">'.$acc->acc_title.' ( '.number_format ( $balance, 2 ).' )</option>' ;

        }

        echo '<option value="new_acc"> -- إنشاء حساب جديد -- </option>' ;

        echo '</select>' ;

    }



    public function new_cat ( $parent_id = null )

    {

        $dt = array ( 'cat_name' => $_POST['cat_name'], 'cat_type' => $_POST['cat_type'] ) ;

        if ( ! is_null ( $parent_id ) && intval ( $parent_id ) > 0 ) $dt['parent_id'] = intval ( $parent_id ) ;

        $tn = 'categories' ;

        if ( ! empty ( $_POST['cat_name'] ) ) $id = $this->m->setRec ( $tn, $dt ) ;

        else $id = 0 ;

        

        echo '<select name="'.$_POST['fld'].'" class="form-control" size="1" id="new_gen_'.$_POST['fld'].'">' ;

        echo '<option value="">بدون تصنيف</option>' ;

        $cats = $this->m->getCategories ( $_POST['cat_type'] ) ; 

        foreach ( $cats as $cat ) {

            if ( $cat['cat_id'] == $id )

            {

                echo '<option value="'.$cat['cat_id'].'" selected="selected">'.$cat['cat_name'].'</option>' ;

            }

            else

            {

                echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>' ;

                foreach ( $cat['sub'] as $sub ) {

                    if ( $sub['cat_id'] == $id ) echo '<option value="'.$sub['cat_id'].'" selected="selected"> ----- '.$sub['cat_name'].'</option>' ;

                    else echo '<option value="'.$sub['cat_id'].'"> ----- '.$sub['cat_name'].'</option>' ;

                }

                echo '<option value="new_cat" data-type="'.$_POST['cat_type'].'" data-parent="'.$cat['cat_id'].'"> ----- إنشاء تصنيف فرعي جديد</option>' ;

            }

        }

        echo '<option value="new_cat" data-type="'.$_POST['cat_type'].'"> -- إنشاء تصنيف جديد -- </option>' ;

        echo '</select>' ;

    }



    public function login ()

    {

        if ( isset ( $_POST['email'] ) && isset ( $_POST['password'] ) )

        {

            $email    = $_POST['email'] ;

            $password = md5 ( md5 ( $_POST['password'] ) ) ;

            if ( $this->m->log_in ( $email, $password ) )

            {

                $this->session->set_flashdata ( 'alert', array ( 'class' => 'success', 'message' => 'تم تسجيل الدخول بنجاح' ) ) ;

                redirect ( 'acc/index' ) ; 

            } 

            else

            {

                $data['error'] = 'بيانات الدخول غير صحيحة' ;

                $this->load->view ( 'login', $data ) ;

            }

        }

        else $this->load->view ( 'login' ) ;

    }

    

    public function logout ()

    {

        $this->m->log_out () ; 

        redirect ( 'acc/login' ) ; 

    }

}

/* End of file Acc.php */