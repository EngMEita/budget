<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$config = array('fix_date' => 1);
		$this->load->library ( 'hijri', $config ) ;
		$this->load->library ( 'arabic', array('library' => 'Numbers'), 'numbers' ) ;
		$this->load->library ( 'arabic', array('library' => 'Date'), 'ar_dates' ) ;
	
		$this->load->helper ( 'barcode' ) ;
		$this->load->helper ( 'phpword' ) ;
		$this->load->helper ( 'countries' ) ;
		
		$list = worldCountries();
		foreach($list as $code => $x)
		{
			$c = getCountry ( $code ) ;
			$f = $c->getFlag();
			$list[$code]['flag'] = $f;
			$data[$code] = $list[$code];
		}
		
		$data['country'] = $c;
		$data['flag'] = $f;
		$data['id'][] = svgBarcode(2341682066);
		//$data['id'][] = pngBarcode(2341682066);
		//$data['id'][] = jpgBarcode(2341682066);
		$data['id'][] = htmlBarcode(2341682066);
		$date = date ( "d/m/Y" ) ;
		$hdate = $this->hijri->GregorianToHijri ( $date, "DD/MM/YYYY");
		$adate = $this->hijri->HijriToGregorian ( $hdate, "DD/MM/YYYY");
		$data['date'] = $date;
		$data['hijri'] = $hdate;
		$data['grego'] = $adate;
		$data['salary']  = $this->numbers->money2str ( 6734, 'SAR', 'ar' ) ;
		
		$this->numbers->setFeminine(2);
		$this->numbers->setFormat(2);
		$this->numbers->setOrder(2);
		for($i = 10; $i <= 150; $i += 10)
		{
			$data['p'][$i] = $this->numbers->int2str($i);
		}
		$data['date_correction'] = $this->ar_dates->dateCorrection ( time () ) ;
		$data['full_hijri_date'] = $this->ar_dates->date ( "l, j F Y", time(), 1 );
		

		echo '<pre>'; 
		print_r($data);
		echo '</pre>';
		//$this->load->view('welcome_message', $data);
	}
}
