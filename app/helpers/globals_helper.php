<?php
function getFldById ( $tbl, $idf, $id, $fld )
{
    $CI =& get_instance();
    $q = $CI->db->query ( 'SELECT `'.$fld.'` AS "fld" FROM `'.$tbl.'` WHERE `'.$idf.'` LIKE "'.$id.'" ORDER BY `'.$idf.'` ASC LIMIT 1' ) ;
    if ( $q->num_rows () > 0 )
    {
        $rec = $q->row_array () ;
        return $rec['fld'] ;
    }
    return "" ;
}

function getCatParent ( $cat_id )
{
    $parent_id = getFldById ( 'categories', 'cat_id', $cat_id, 'parent_id' ) ;
    if ( ! is_null ( $parent_id ) ) return getFldById ( 'categories', 'cat_id', $parent_id, 'cat_name' ) ;
    return "" ;
}

function array2str ( $array )
{
    $str = array () ;
    foreach ( $array as $k => $v )
    {
        if ( is_array ( $v ) ) $str[] = $k.'.'.implode ( ',', $v ) ;
        else $str[] = $k.'.'.$v ;
    }
    return implode ( ':', $str ) ;
}

function str2array ( $str )
{
    $array = array () ;
    $strs = explode ( ':', $str ) ;
    foreach ( $strs as $str )
    {
        $x = explode ( '.', $str ) ;
        $prts = explode ( ',', $x[1] ) ;
        if ( isset ( $prts[1] ) ) $array[$x[0]] = $prts ;
        else  $array[$x[0]] = $prts[0] ;
    }
    return $array ;
}

function getPercentage ( $a, $b, $d = 2 )
{
    $f = $d + 2;
    $c = round ( $a / $b, $f ) * 100 ;
    return $c;
}

function getRandElement ( $array )
{
    $l = count ( $array ) ;
    $i = rand ( 0, $l - 1 ) ;
    return $array[$i] ;
}

function budgetProgressClass ( $progress )
{
    if ( $progress >= 90 )      $class = 'danger';
    else if ( $progress >= 75 ) $class = 'warning';
    else if ( $progress >= 50 ) $class = 'info';
    else                        $class = 'success';
    return $class ;
}
?>