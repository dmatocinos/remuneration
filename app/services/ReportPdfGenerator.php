<?php

class ReportPdfGenerator extends TCPDF {
	
	protected $remuneration;
	protected $calc;
	protected $img_file;
	protected $user;
	protected $pdf;
	protected $img_path = 'images/pdf';
	protected $report_pages = [
			'3'	=> ['section' => '1', 'title' => 'Introduction'],
			'4'	=> ['section' => '2', 'title' => 'Summary of Results'],
			'6'	=> ['section' => '3', 'title' => 'Features of Each Option'],
			'10'	=> ['section' => '-', 'title' => 'Disclaimer'],
			'11'	=> ['section' => '-', 'title' => 'Appendix 1 – Summary of results '],
	];
	
		
	public function __construct($remuneration, $calc, $img_file)
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215.9,279.4), true, 'UTF-8', false);

		$this->remuneration = $remuneration;
		$this->calc = $calc;
		$this->img_file = $img_file;
		$this->user = Session::get('practicepro_user');
	}

	public function Header() 
	{
		if ($this->getNumPages() == 1) {
			return;					
		} 

		$pagetext = intval($this->getAliasNumPage());
		$header_title = 'REMUNERATION STRATEGIES – TAX SAVING REPORT';
		if ($this->getNumPages() == 2) {
			
			$pagetext = '';
			$header_title = 'Table of Contents';
		} 
		else {
			$t = intval($this->getAliasNbPages());
			$p = intval($this->getAliasNumPage());
			
			$pagetext = $this->getNumPages() - 2;
		}

		$img = ($this->CurOrientation == 'P' ? 'head-bg-blue.jpg' : 'head-bg-l.jpg');
		$w = ($this->CurOrientation == 'P ' ? 215.9:279.4);
	
		$this->Image($this->img_path . '/' . $img, 0, 0, $w, 16, 'JPEG', NULL, NULL, 2);
		
		//$this->setTextColor(255, 204, 51);			
		//$this->SetFont('rockb', '', 18, '', true);
		//$this->MultiCell(190, 5, $header_title, 0, 'C', 0, 0, '', 8, true);
		//$this->SetFont('rockb', '', 9, '', true);
		//$this->MultiCell(0, 5, $pagetext, 0, 'R', 0, 0, '', 15, true);
	}

	public function Footer() 
	{
		$this->setTextColor(255, 255, 255);
		$this->SetFont('frabk', '', 10, '', true);
		$this->SetY(-24);	

		if ($this->getNumPages() == 1) {
			$text = '@2014 PracticePro';
			$this->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', 265, true);
		} 
		else if ($this->getNumPages() == 2) {
			$img = ($this->CurOrientation == 'P' ? 'head-bg-blue.jpg' : 'head-bg-l.jpg');
			$w = ($this->CurOrientation == 'P ' ? 215.9 : 279.4);

			$this->Image($this->img_path . '/' . $img, 0, 264, $w, 16, 'JPEG', NULL, NULL, 2);
			
			$text = '(' . $this->remuneration->company->name . ') REMUNERATION STRATEGIES – TAX SAVING REPORT';
			$this->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', 265, true);
		} 
		else {
			$img = ($this->CurOrientation == 'P' ? 'head-bg-blue.jpg' : 'head-bg-l.jpg');
			$w = ($this->CurOrientation == 'P ' ? 215.9 : 279.4);

			$this->Image($this->img_path . '/' . $img, 0, 264, $w, 16, 'JPEG', NULL, NULL, 2);

			$text = '(' . $this->remuneration->company->name . ') REMUNERATION STRATEGIES – TAX SAVING REPORT';
			$this->MultiCell(0, 5, $text, 0, 'R', 0, 0, '', 267, true);
			$this->MultiCell(0, 5, 'Page ' . $this->getNumPages(), 0, 'L', 0, 0, '', 267, true);
		}

	}
	
	public function setupPdf($params = [])
	{
		
		// set document information
		$this->SetCreator('');
		$this->SetAuthor('@2004 PracticePro');
		$this->SetTitle('REMUNERATION PLANNING Tax Saving Report');
		$this->SetSubject('PDF Export');

		// set header and footer fonts
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(8);
		$this->SetFooterMargin(1);		

		// set auto page breaks
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->setLanguageArray($l);
		}

		// set font
		$this->setTextColor(0, 0, 0);
		
		$this->buildTableOfContentsPage();
		$this->buildIntroPage();
		$this->buildSummaryOfResults1Page();
		$this->buildSummaryOfResults2Page();
		$this->buildFeatureOption1Page();
		$this->buildFeatureOption2Page();
		$this->buildFeatureOption3Page();
		$this->buildFeatureOption4Page();
		$this->buildDisclaimerPage();
		$this->buildSofTablePage();

		// reset pointer to the last page
		$this->lastPage();

		//Close and output PDF document
		$this->Output("Remuneration_tax_saving_report.pdf", 'D');

	}

	public function buildCoverPage()
	{
		//do not print header and footer in cover page
		$this->setPrintHeader(false);
		$this->setPrintFooter(false);
		
		$this->AddPage();
		
		//pagebreak off to expand images
		$this->SetAutoPageBreak(false,0);
		
		$this->Image($this->img_path . '/cover-bg3.jpg', 0, 0, 215.9,279.4, 'JPEG',null ,null ,2);

		// Set some content to print
		$this->setTextColor(255, 255, 255);

		$this->SetFont('frabk', '', 15, '', true);
		$this->MultiCell(190, 5, 'Strictly Private and Confidential', 0, 'L', 0, 0, '', 6, true);

		$this->SetFont('helveticaB', '', 35, '', true);
		$this->MultiCell(190, 5, $this->remuneration->company->name, 0, 'L', 0, 0, '', 65, true);
		$this->MultiCell(190, 5, 'REMUNERATION PLANNING', 0, 'L', 0, 0, '', 80, true);
		$this->MultiCell(190, 5, 'Tax Saving Report', 0, 'L', 0, 0, '', 93, true);

		$this->SetFont('frabk', '', 16, '', true);
		$this->MultiCell(190, 5, 'How to get your money out of your company tax efficiently', 0, 'L', 0, 0, '', 115, true);

		$this->SetFont('frabk', '', 12, '', true);
		/*$this->MultiCell(190, 5, 'Prepared on ' . date('F jS, Y', time())  . ' by ' . $this->user->mh2_fname . ', ' . $this->user->mh2_lname, 0, 'L', 0, 0, '', 138, true);*/
		$this->MultiCell(190, 5, 'Prepared on ' . date('F jS, Y', time())  . ' by ' . $this->remuneration->accountant->practice_name, 0, 'L', 0, 0, '', 138, true);

		/*$this->MultiCell(190, 5, $this->user->mh2_company_address, 0, 'L', 0, 0, '', 158, true);
		$this->MultiCell(190, 5, $this->user->town_city_country . ' ' . $this->user->postcode, 0, 'L', 0, 0, '', 165, true);
		$this->MultiCell(190, 5, $this->user->phone, 0, 'L', 0, 0, '', 172, true);
		$this->MultiCell(190, 5, $this->user->mh2_email, 0, 'L', 0, 0, '', 180, true);
		$this->MultiCell(190, 5, $this->user->web_url, 0, 'L', 0, 0, '', 188, true);*/
		
		$this->MultiCell(190, 5, $this->remuneration->accountant->address, 0, 'L', 0, 0, '', 158, true);
		$this->MultiCell(190, 5, $this->remuneration->accountant->telephone_number, 0, 'L', 0, 0, '', 172, true);
		$this->MultiCell(190, 5, $this->remuneration->accountant->email, 0, 'L', 0, 0, '', 180, true);
		$this->MultiCell(190, 5, $this->remuneration->accountant->website, 0, 'L', 0, 0, '', 188, true);


		$this->SetFont('frabk', '', 10, '', true);


		$this->MultiCell(0, 5, $this->user->town_city_country . ' ' . $this->user->postcode, 0, 'L', 0, 0, '', 260, true); 

		//reset true to include header and footer for succeeding pages
		$this->setPrintHeader(true);
		$this->setPrintFooter(true);
		
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	}

	public function buildTableOfContentsPage()
	{
		$this->AddPage();
		$this->SetLeftMargin(10);
		$this->SetFont('frabk', '', 18, '', true);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.table_of_contents", 
			array('pages' => $this->report_pages)
		)->render();

	
		$this->SetMargins(15, 10, 15);
		$this->writeHTML($html, true, false, true, false, '');
	}
	
	public function buildIntroPage($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);
		
		$calc = $this->calc;

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.intro",
			array(
				'company_name'         => $this->remuneration->company->name,
				'amount_to_distribute' => NumFormatter::money($this->remuneration->amount_to_distribute, '£'),
				'highest_tax_savings'  => NumFormatter::money(round(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23) - ($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23)), '£')
			)
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}
	
	public function buildSummaryOfResults1Page($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.summary_of_results1",
			array(
				'amount_to_distribute' => NumFormatter::money($this->remuneration->amount_to_distribute, '£'),
				'calc'  => $this->calc
			)
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildSummaryOfResults2Page($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.summary_of_results2",
			array('graph' => $this->img_file)
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}
	
	public function buildFeatureOption1Page($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.feature_option1",
			array(
				'profit_chargeable' => NumFormatter::money($this->remuneration->profit_chargeable, '£'),
				'tax_cost'          => NumFormatter::money($this->calc->c23, '£')
			)
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildFeatureOption2Page($params = [])
	{
		$this->AddPage();

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.feature_option2" 
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildFeatureOption3Page($params = [])
	{
		$this->AddPage();

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.feature_option3" 
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildFeatureOption4Page($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.feature_option4" 
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildDisclaimerPage($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.disclaimer" 
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function buildSofTablePage($params = [])
	{
		$this->AddPage();
		$this->SetLeftMargin(10);

		$html = View::make("pdf.pdf_styles")->render();
		$html .= View::make(
			"pdf.sof_table",
			array('calc' => $this->calc)
		)->render();

	
		$this->SetMargins(15, PDF_MARGIN_TOP, 15.5);
		$this->writeHTML($html, true, false, true, false, '');
	}

	public function generate($params = [])
	{
		$this->buildCoverPage();
		$this->setupPdf($params);
	}
}
