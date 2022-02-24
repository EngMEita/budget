<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/third_party/I18N/Arabic.php"; 
class Arabic extends I18N_Arabic
{
    public function __construct($config)
    {
        $this->load($config['library']);
    }
    /** Numbers
     * => setFeminine ( 1 male, 2 female) تجنيس الصيغة
     * => setFormat ( 1 مرفوع, 2 منصوب ) 
     * => int2str ( int number ) تفقيط الأرقام
     * => money2st ( money, currency, lang ) تفقيط المال
     * => int2indic ( number ) الأرقام الهندية
     * => setOrder ( 2 )  with int2str ( number ) ترتيب
     */

     /** Date
      * => dateCorrection ( time ) set correction of hijri date 
      * => date ( format, time, correction ) hijri date in arabic
      * => date ( format, time ) date in arabic
      * => setMode( 8 ) dates in english
      * => setMode( 2 or 3 or 4 or 5 or 6 or 7 ) dates in arbic countries
      */

      /** Mktime
      * => dateCorrection ( time ) set correction of hijri date 
      * => date ( format, time, correction ) hijri date in arabic
      * => date ( format, time ) date in arabic
      * => setMode( 8 ) dates in english
      * => setMode( 2 or 3 or 4 or 5 or 6 or 7 ) dates in arbic countries
      */

      /** Transliteration
       * => en2ar ( word ) translate from en into ar
       * => arNum ( number ) number in arabic
       * => ar2en ( word ) translate from ar into en
       * => enNum ( number ) numbers in english
       */

       /** Salat
        * => setLocation ( long, lat ) location for calc
        * => setDate(date('j'), date('n'), date('Y')) date for calc
        * => getPrayTime() get prayer times
        * => getQibla() get qibla directions from north
        */
}
/* End of file Arabic.php */