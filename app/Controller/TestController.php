<?php 
App::uses('AppController', 'Controller'); 
App::uses('Sanitize', 'Utility'); App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'tcpdf'.DS.'tcpdf');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class MYPDF extends TCPDF {
	// Page Header
	public function Header() {
		// Logo
		////$image_file = '../webroot/images/header.jpg';
		///$border_image = '../webroot/images/border.jpg';
		////$bMargin = $this->getBreakMargin();
		////$auto_page_break = $this->AutoPageBreak;
		////$this->SetAutoPageBreak(false, 0);
		//$this->Image($image_file, left, top
		//$this->Image($image_file, 25, 8, 0, '', 'JPG', '', 'T', false, 0, '', false, false, 0, false, false, false);
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		////$this->Image($border_image, 'C', 10,'', '', 'JPG', false, 'T', true, 300, 'C', false, false, 0, true, false, true);
		// $this->Image($border_image, 8, 8, 0, '', 'JPG', '', 'T', false, 0, '', false, false, 0, false, false, false);
		////$this->SetAutoPageBreak($auto_page_break, $bMargin);
	}
}
class TestController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	public $components = array('Auth','RequestHandler');
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->disableCache();			
		$this->Auth->allow('index');
	}
	
	public function index(){

			//if subject category is not yet applied for submission
			/*Generate PDF*/
			$html = '';
				
			$html .='<table width="100%" border="0"  style="font-size:13px;" align="center"><tr><td align="center">Hello Friends</td></tr></table>';
			
			$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//echo $html;exit;
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Website-Name');
			$pdf->SetTitle('Website-Name');
			$pdf->SetSubject('Website-Name');
			$pdf->SetKeywords('Website-Name');
			
			// set default header data
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
			
			// set header and footer fonts
			//  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			//  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			$pdf->SetMargins(10,20,10,20);
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			
			//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			
			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			
			// ---------------------------------------------------------
			
			// set default font subsetting mode
			// $pdf->setFontSubsetting(true);
			
			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$pdf->SetFont('helvetica', '',11, '', true);
			//$this->SetFont('helvetica','R', 20);
			
			// Add a page
			// This method has several options, check the source code documentation for more information.
			$pdf->AddPage();
			
			// set text shadow effect
			//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
			
			// Set some content to print
			// $html = "test html";
			
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			
			// ---------------------------------------------------------
			
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			
			// $pdf->Output('PromotionOrder.pdf', 'I');
			// echo $random_string; exit;
			$random_string = date('mdYs').rand(1,100);
			if($random_string != NULL) {
				// download on server			
				$pdf->Output(WWW_ROOT.'images/'.str_replace(' ','_',APPLICATION_NAME).$random_string.'.pdf', 'F');
			} else {
				$pdf->Output(str_replace(' ','_',APPLICATION_NAME).$random_string.'.pdf', 'I');
			}
			
			
			//============================================================+
			// END OF FILE
			//============================================================+


		
	}	
}
