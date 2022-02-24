<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globals_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct() ;
    }

    function getRes ( $data, $output = 'array' )
    {
        $flds  = null;
        $cond  = null;
        $sort  = null;
        $limit = 0;
        $start = 0;
        if ( is_array ( $data ) && ! empty ( $data ) )
        {
            if ( isset ( $data['table'] ) && ! empty ( $data['table'] ) )
            {
                $table = $data['table'];
                if ( isset ( $data['flds'] ) && ! empty ( $data['flds'] ) )                    $flds  = $data['flds'];
                if ( is_array ( $data['cond'] ) && ! empty ( $data['cond'] ) )                 $cond  = $data['cond'];
                if ( is_array ( $data['sort'] ) && ! empty ( $data['cond'] ) )                 $sort  = $data['sort'];
                if ( isset ( $data['limit'] ) && intval ( $data['limit'] ) > 0 )               $limit = intval ( $data['limit'] );
                if ( isset ( $data['start'] ) && intval ( $data['start'] ) > 0 && $limit > 0 ) $start = intval ( $data['start'] );
                
                if ( ! is_null ( $flds ) ) $this->db->select ( $flds ) ;
                if ( ! is_null ( $cond ) ) $this->db->where ( $cond ) ;
                if ( ! is_null ( $sort ) )
                {
                    foreach ( $sort as $fld => $order )
                    {
                        $this->db->order_by ( $fld, $order ) ;
                    }
                }
                if ( $start > 0 )     $q = $this->db->get ( $table, $limit, $start );
                else if ( $limit > 0) $q = $this->db->get ( $table, $limit );
                else                  $q = $this->db->get ( $table );
                
                switch ( $output )
                {
                    case 'count' :
                        return $q->num_rows () ;
                    break;
                    case 'object_json' :
                        $res = $q->num_rows () > 0 ? $q->result () : false ;
                        return $res != false ? json_encode ( $res ) : false ;
                    break;
                    case 'object' :
                        return $q->num_rows () > 0 ? $q->result () : false ;
                    break;
                    case 'array_json' :
                        $res = $q->num_rows () > 0 ? $q->result_array () : false ;
                        return $res != false ? json_encode ( $res ) : false ;
                    break;
                    case 'array' :
                    default:
                        return $q->num_rows () > 0 ? $q->result_array () : false ;
                    break;
                }
            }
            else return false;
        }
        else return false;
    }

    function getCount ( $data )
    {
        if ( is_array ( $data ) && ! empty ( $data ) )
        {
            if ( isset ( $data['table'] ) && ! empty ( $data['table'] ) )
            {
                if ( is_array ( $data['cond'] ) && ! empty ( $data['cond'] ) ) $this->db->where ( $data['cond'] ) ;
                $q = $this->db->get ( $data['table'] ) ;
                return $q->num_rows () ;
            }
            else return 0;
        }
        else return 0;
    }

    function getQuery ( $query, $output = 'array' )
    {
        $q = $this->db->query ( $query );
        switch ( $output )
        {
            case 'count' :
                return $q->num_rows () ;
            break;
            case 'object_json' :
                $res = $q->num_rows () > 0 ? $q->result () : false ;
                return $res != false ? json_encode ( $res ) : false ;
            break;
            case 'object' :
                return $q->num_rows () > 0 ? $q->result () : false ;
            break;
            case 'array_json' :
                $res = $q->num_rows () > 0 ? $q->result_array () : false ;
                return $res != false ? json_encode ( $res ) : false ;
            break;
            case 'array' :
            default:
                return $q->num_rows () > 0 ? $q->result_array () : false ;
            break;
        }
    }

    function runQuery ( $query )
    {
        if ( $this->db->query ( $query ) ) return true ;
        return false ;
    }

    function getRec ( $tbl, $fld, $vlu, $output = 'array' )
    {
        $this->db->like ( $fld, $vlu, 'none' ) ;
        $q = $this->db->get ( $tbl, 1, 0 ) ;
        switch ( $output )
        {
            case 'object_json' :
                $rec = $q->num_rows () > 0 ? $q->row () : false ;
                return $rec != false ? json_encode ( $rec ) : false ;
            break;
            case 'object' :
                return $q->num_rows () > 0 ? $q->row () : false ;
            break;
            case 'array_json' :
                $rec = $q->num_rows () > 0 ? $q->row_array () : false ;
                return $res != false ? json_encode ( $rec ) : false ;
            break;
            case 'array' :
            default:
                return $q->num_rows () > 0 ? $q->row_array () : false ;
            break;
        }
    }

    function setRec ( $table, $data, $id_fld = null, $id_vlu = 0 )
    {
        if ( is_array ( $data ) &&  ! empty ( $data ) )
        {
            if ( $id_vlu > 0 )
            {
                $this->db->where ( $id_fld, $id_vlu ) ;
                $this->db->set ( $data ) ;
                if ( $this->db->update ( $table ) ) return true ;
                return false ;
            }
            else
            {
                $this->db->set ( $data ) ;
                if ( $this->db->insert ( $table ) ) return $this->db->insert_id() ;
                return false ;
            }
        }
        return false ;
    }

    function insertRes( $table, $data )
    {
        if ( is_array( $data ) && ! empty ( $data ) )
        {
            if ( $this->db->insert_batch( $table, $data ) ) return true ;
            return false ;
        }
        return false ;
    }

    function updateRes ( $table, $data, $id_fld )
    {
        if ( is_array( $data ) && ! empty ( $data ) )
        {
            if ( $this->db->update_batch ( $table, $data, $id_fld ) ) return true ;
            return false ;
        }
        return false ;
    }

    function delRec ( $table, $id_fld, $id_vlu )
    {
        if ( $id_vlu > 0 )
        {
            $this->db->where ( $id_fld, $id_vlu ) ;
            if ( $this->db->delete ( $table ) ) return true ;
            return false ;
        }
        return false ;
    }

    function delRes( $table, $id_fld, $id_vlus )
    {
        if ( is_array( $id_vlus ) && ! empty ( $id_vlus ) )
        {
            $this->db->where_in ( $id_fld, $id_vlus ) ;
            if ( $this->db->delete ( $table ) ) return true ;
            return false ;
        }
        return false ;
    }

    /** Specialized methods */
    function getAccountList ()
    {
        $data = array () ;
        $data['table'] = 'accounts' ;
        return $this->getRes ( $data, 'object' ) ;
    }

    function getAccount ( $acc_id, $from_dur = '-1 month', $to_dur = 'now' )
    {
        $acc                  = $this->getRec ( 'accounts', 'acc_id', $acc_id, 'object' ) ;
        $open_balance         = $this->getAccountBalance ( $acc_id, $from_dur ) ;
        $close_balance        = $this->getAccountBalance ( $acc_id, $to_dur ) ;
        $balance              = $this->getAccountBalance ( $acc_id, 'now' ) ;
        $acc->open_balance    = $open_balance ;
        $acc->close_balance   = $close_balance ;
        $acc->current_balance = $balance ;
        return $acc ;
    }

    function getAccountBalance ( $acc_id, $dur = 'now' )
    {
        $time = strtotime ( $dur ) ;
        $q = $this->getQuery ( 'SELECT ( SUM(`rec_debit`) - SUM(`rec_credit`) ) AS `balance` FROM `ledger` WHERE `perent_id` IS NULL AND `acc_id` = '.$acc_id.' AND `rec_time` <= '.$time ) ;
        return round ( $q[0]['balance'], 2 ) ;
    }

    function getCategories ( $type )
    {
        $list = $this->getQuery ( 'SELECT * FROM `categories` WHERE `cat_type` = '.$type.' AND `parent_id` IS NULL' ) ;
        foreach ( $list as $i => $cat )
        {
            $list[$i]['sub'] = $this->getSubCategories ( $cat['cat_id'] ) ;
        }
        return $list ;
    }

    function getSubCategories ( $cat_id )
    {
        return $this->getQuery ( 'SELECT * FROM `categories` WHERE `parent_id` = '.$cat_id ) ;
    }

    function getMainCategories ( $type )
    {
        return $this->getQuery ( 'SELECT * FROM `categories` WHERE `cat_type` = '.$type.' AND `parent_id` IS NULL' ) ;
    }

    function getAllCategories ( $type )
    {
        $list = $this->getQuery ( 'SELECT * FROM `categories` WHERE `cat_type` = '.$type ) ;
        foreach ( $list as $i => $item )
        {
            if ( is_null ( $item['parent_id'] ) ) $parent_name = "بلا" ;
            else
            {
                $parent = $this->getRec ( 'categories', 'cat_id', $item['parent_id'] ) ;
                $parent_name = $parent['cat_name'] ;
            }
            $list[$i]['parent_name'] = $parent_name;
        }
        return $list ;
    }

    function getBudget ( $budget_id )
    {
        $budget     = $this->getRec ( 'budgets', 'budget_id', $budget_id ) ;
        $categories = $this->getBudgetCategories ( $budget_id ) ;
        $budget_vlu = 0 ;
        $budget['cats'] = array ();
        foreach ( $categories as $j => $cat ) 
        {
            $budget['cats'][$j] = array () ;
            $budget['cats'][$j]['name'] = $cat['cat_name'] ;
            $vlu  = $this->getCategoryValue ( $cat['cat_id'], $budget['budget_start'], $budget['budget_end'] ) ;
            $subs = $this->getSubCategories ( $cat['cat_id'] ) ; 
            foreach ( $subs as $i => $sub )
            {
                $sub_vlu             = $this->getCategoryValue ( $sub['cat_id'], $budget['budget_start'], $budget['budget_end'] ) ;
                $subs[$i]['value']   = $sub_vlu ;
                $vlu                += $sub_vlu ;
            }
            $budget['cats'][$j]['value'] = $vlu ;
            $categories[$j]['sub']   = $subs ;
            $categories[$j]['value'] = $vlu ;
            $budget_vlu             += $vlu ;
        }
        $budget['categories']        = $categories ;
        $budget['budget_outcome']    = $budget_vlu ;
        $budget['budget_available']  = $budget['budget_value'] - $budget['budget_outcome'] ;
        $budget['progress']          = round ( $budget['budget_outcome'] / $budget['budget_value'], 4 ) * 100 ;
        return  $budget ;
    }

    function getBudgetCategories ( $budget_id )
    {
        return $this->getQuery ( 'SELECT a.`id`, b.* FROM `budget_categories` a, `categories` b WHERE b.`cat_id` = a.`cat_id` AND a.`budget_id` = '.$budget_id ) ;
    }

    function getCategoryValue ( $cat_id, $start, $end = null )
    {
        if ( is_null ( $end ) ) $end = time () ;
        $category = $this->getRec ( 'categories', 'cat_id', $cat_id, 'object' ) ; 
        $fld      = $category->cat_type > 0 ? 'rec_debit' : 'rec_credit' ;
        $res      = $this->getQuery ( 'SELECT SUM(`'.$fld.'`) AS "vlu" FROM `ledger` WHERE `cat_id` = '.$cat_id.' AND `rec_time` >= '.$start.' AND `rec_time` <= '.$end ) ;
        return $res[0]['vlu'] ;
    }

    function getBudgetLedger ( $budget_id )
    {
        $budget     = $this->getBudget ( $budget_id ) ;
        $cats       = $this->getBudgetCategories ( $budget_id ) ;
        $cats_array = array () ;
        foreach ($cats as $cat)
        {
            $cats_array[] = $cat['cat_id'] ;
            $subs = $this->getSubCategories ( $cat['cat_id'] ) ;
            foreach ( $subs as $sub )
            {
                $cats_array[] = $sub['cat_id'] ;
            }
            $cats_str = implode ( ', ', $cats_array ) ;
        }
        $res = $this->getQuery ( 'SELECT * FROM `ledger` WHERE `cat_id` IN ( '.$cats_str.' ) AND `rec_time` >= '.$budget['budget_start'].' AND `rec_time` <= '.$budget['budget_end'].' ORDER BY `rec_time` ASC, `rec_id` ASC' ) ;
        return $res;
    }

    /**Log in-out functions */

    function log_in ( $email, $password )
    {
        $q = $this->db->query ( 'SELECT * FROM `users` WHERE `user_email` = "'.$email.'" AND `user_pass` = "' . $password . '" LIMIT 1' );
        if ( $q->num_rows() > 0 )
        {
            $u = $q->row () ;
            $d = array();
            $d['id']    = $u->user_id ;
            $d['time']  = time () ;
            $d['valid'] = time() + 1800 ;
            $this->session->set_userdata ( 'user_data', $d ) ;
            return true;
        }else return false;
    }

    function log_out ()
    {
        $this->session->unset_userdata ( 'user_data' ) ;
        $this->session->sess_destroy () ;
    }

    function is_logged_in ()
    {
        if ( $this->session->userdata( 'user_data' ) )
        {
            $user_data = $this->session->userdata( 'user_data' ) ;
            if ( $user_data['valid'] > time () )
            {
                $user_data['valid'] = time () + 1800 ;
                $this->session->set_userdata( 'user_data', $user_data );
                return true ;
            } 
            else
            {
                $this->log_out () ; 
                return false ;
            }
        }
        return false ;
    }
}

/* End of file Globals_model.php */
