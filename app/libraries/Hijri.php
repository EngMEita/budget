<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hijri
{
    protected $ci;
    var $fix_date;
    var $Day;
    var $Month;
    var $Year;

    public function __construct($config)
    {
        $this->ci =& get_instance();
        $this->fix_date = $config['fix_date'];
    }

    function intPart ( $floatNum )
    {
        if ( $floatNum < -0.0000001 )
        {
            return ceil ( $floatNum - 0.0000001 );
        }
        return floor ( $floatNum + 0.0000001 );
    }

    function ConstractDayMonthYear ( $date, $format ) // extract day, month, year out of the date based on the format.
    {
        $this->Day   = "" ;
        $this->Month = "" ;
        $this->Year  = "" ;

        $format     = strtoupper ( $format ) ;
        $format_Ar  = str_split ( $format ) ;
        $srcDate_Ar = str_split ( $date ) ;

        for ( $i = 0 ; $i < count ( $format_Ar ) ; $i++ )
        {

            switch ( $format_Ar[$i] )
            {
                case "D":
                    $this->Day   .= $srcDate_Ar[$i] ;
                break;
                case "M":
                    $this->Month .= $srcDate_Ar[$i] ;
                break;
                case "Y":
                    $this->Year  .= $srcDate_Ar[$i];
                break;
            }
        }

    }

    function HijriToGregorian ( $date, $format ) // $date like 10121400, $format like DDMMYYYY, take date & check if its hijri then convert to gregorian date in format (DD-MM-YYYY), if it gregorian the return empty;
    {
        //$fix_date = $this->$fix_date;
        $this->ConstractDayMonthYear ( $date, $format );
        $d = intval ( $this->Day ) ;
        $m = intval ( $this->Month ) ;
        $y = intval ( $this->Year ) ;

        if ($y<1700)
        {

            $jd=$this->intPart((11*$y+3)/30)+354*$y+30*$m-$this->intPart(($m-1)/2)+$d+1948440-385;

            if ($jd> 2299160 )
            {
                $l=$jd+68569;
                $n=$this->intPart((4*$l)/146097);
                $l=$l-$this->intPart((146097*$n+3)/4);
                $i=$this->intPart((4000*($l+1))/1461001);
                $l=$l-$this->intPart((1461*$i)/4)+31;
                $j=$this->intPart((80*$l)/2447);
                $d=$l-$this->intPart((2447*$j)/80);
                $l=$this->intPart($j/11);
                $m=$j+2-12*$l;
                $y=100*($n-49)+$i+$l;
            }
            else
            {
                $j=$jd+1402;
                $k=$this->intPart(($j-1)/1461);
                $l=$j-1461*$k;
                $n=$this->intPart(($l-1)/365)-$this->intPart($l/1461);
                $i=$l-365*$n+30;
                $j=$this->intPart((80*$i)/2447);
                $d=$i-$this->intPart((2447*$j)/80);
                $i=$this->intPart($j/11);
                $m=$j+2-12*$i;
                $y=4*$k+$n+$i-4716;
            }

            $mxc = $this->monthDays ( $m, $y ) ;

            /* next month data */
            $mn  = $m + 1 > 12 ? 1 : $m + 1;
            $yn  = $mn > 1 ? $y : $y + 1;
            $mxn = $this->monthDays ( $mn, $yn ) ;

            /* prev month data */
            $mp  = $m - 1 < 1 ? 12 : $m - 1;
            $yp  = $mn < 12 ? $y : $y - 1;
            $mxp = $this->monthDays ( $mp, $yp ) ;

            $d -= $this->fix_date;
            if($d > $mxc ){
                $m += 1;
                $d -= $mxc;
                if($m > 12){
                    $y += 1;
                    $m = 1;
                }
            }elseif($d < 1){
                $m -= 1;
                $d += $mxc;
                if($m < 1){
                    $y -= 1;
                    $m = 12;
                }
            }

            if ( $d < 10 ) $dd = "0" . $d ;
            else $dd = $d;

            if ( $m < 10)  $mm = "0" . $m;
            else $mm = $m;

            $yy   = substr ($y, 2, 2);
            $yyyy = $y;

            $out = strtoupper ( $format );

            $out = str_replace ( "YYYY", $yyyy, $out ) ;
            $out = str_replace ( "YY", $yy, $out ) ;
            $out = str_replace ( "Y", $y, $out ) ;

            $out = str_replace ( "MM", $mm, $out ) ;
            $out = str_replace ( "M", $m, $out ) ;

            $out = str_replace ( "DD", $dd, $out ) ;
            $out = str_replace ( "D", $d, $out ) ;

            return $out;
        }
        else return "";
    }

    function GregorianToHijri( $date, $format ) // $date like 10122011, $format like DDMMYYYY, take date & check if its gregorian then convert to hijri date in format (DD-MM-YYYY), if it hijri the return empty;
    {
        //$fix_date = $this->$fix_date;
        $this->ConstractDayMonthYear($date,$format);
        $d=intval($this->Day);
        $m=intval($this->Month);
        $y=intval($this->Year);

        if ($y>1700)
        {
            if (($y>1582)||(($y==1582)&&($m>10))||(($y==1582)&&($m==10)&&($d>14)))
            {
                $jd=$this->intPart((1461*($y+4800+$this->intPart(($m-14)/12)))/4)+$this->intPart((367*($m-2-12*($this->intPart(($m-14)/12))))/12)-$this->intPart((3*($this->intPart(($y+4900+$this->intPart(($m-14)/12))/100)))/4)+$d-32075;
            }
            else
            {
                $jd = 367*$y-$this->intPart((7*($y+5001+$this->intPart(($m-9)/7)))/4)+$this->intPart((275*$m)/9)+$d+1729777;
            }

            $l=$jd-1948440+10632;
            $n=$this->intPart(($l-1)/10631);
            $l=$l-10631*$n+354;
            $j=($this->intPart((10985-$l)/5316))*($this->intPart((50*$l)/17719))+($this->intPart($l/5670))*($this->intPart((43*$l)/15238));
            $l=$l-($this->intPart((30-$j)/15))*($this->intPart((17719*$j)/50))-($this->intPart($j/16))*($this->intPart((15238*$j)/43))+29;
            $m=$this->intPart((24*$l)/709);
            $d=$l-$this->intPart((709*$m)/24);
            $y=30*$n+$j-30;

            $d += $this->fix_date;
            if($d > 30 ){
                $m += 1;
                $d -= 30;
                if($m > 12){
                    $y += 1;
                    $m = 1;
                }
            }elseif($d < 1){
                $m -= 1;
                $d += 30;
                if($m < 1){
                    $y -= 1;
                    $m = 12;
                }
            }

            if ( $d < 10 ) $dd = "0" . $d ;
            else $dd = $d;

            if ( $m < 10)  $mm = "0" . $m;
            else $mm = $m;

            $yy   = substr ($y, 2, 2);
            $yyyy = $y;

            $out = strtoupper ( $format );

            $out = str_replace ( "YYYY", $yyyy, $out ) ;
            $out = str_replace ( "YY", $yy, $out ) ;
            $out = str_replace ( "Y", $y, $out ) ;

            $out = str_replace ( "MM", $mm, $out ) ;
            $out = str_replace ( "M", $m, $out ) ;

            $out = str_replace ( "DD", $dd, $out ) ;
            $out = str_replace ( "D", $d, $out ) ;

            return $out;
        }
        else return "";


    }

    function monthDays($m, $y)
    {
        $d31s = array(1, 3, 5, 7, 8, 10, 12);
        $d30s = array(4, 6, 9, 11) ;
        if ( in_array ( $m, $d31s ) ) return 31 ;
        else if ( in_array ( $m, $d30s ) ) return 30 ;
        else return ( $y % 4 == 0 ) ? 29 : 28;
    }
}

/* End of file Hijri.php */
