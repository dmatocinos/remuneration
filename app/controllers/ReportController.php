<?php

/**
 * undocumented class
 *
 * @packaged default
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
 **/
class ReportController extends AuthorizedController {

	public function index() 
	{
		$data_entry = [
			'profit_chargeable'			=> 200000,
			'corporate_tax_rate'			=> 0.2,
			'amount_to_distribute'			=> 150000,
			'directors_salary'			=> 10000,
			'number_of_associated_companies'	=> 0,
			'claim_ct_deduction'			=> NULL,
			'number_of_director_shareholders'	=> 2,
			'directors'	=> [
				[
					'percentage_of_shares'			=> 0,
					'salary_paid'				=> 10000,
					'other_taxable_income'			=> 0,
					'balance_on_directors_loan_account'	=> 0,
				],					
				[
					'percentage_of_shares'			=> 0,
					'salary_paid'				=> 10000,
					'other_taxable_income'			=> 0,
					'balance_on_directors_loan_account'	=> 0,
				],					
				[
					'percentage_of_shares'			=> 0,
					'salary_paid'				=> 0,
					'other_taxable_income'			=> 0,
					'balance_on_directors_loan_account'	=> 0,
				],					
				[
					'percentage_of_shares'			=> 0,
					'salary_paid'				=> 0,
					'other_taxable_income'			=> 0,
					'balance_on_directors_loan_account'	=> 0,
				]					
			]
		];

		$calc = new SummaryOfResultsCalculator($data_entry);

		$data1y=array(12,8,19,3,10,5);
		$data2y=array(8,2,11,7,14,4);
		 
		// Create the graph. These two calls are always required
		JpGraphMod::load();
		JpGraphMod::module('bar');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		$graph = new Graph(600,300,"auto");
		// Create the graph. These two calls are always required
		$graph = new Graph(310,200);    
		$graph->SetScale("textlin");
		 
		$graph->SetShadow();
		$graph->img->SetMargin(40,30,20,40);
		 
		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b1plot->SetFillColor("orange");
		$b2plot = new BarPlot($data2y);
		$b2plot->SetFillColor("blue");
		 
		// Create the grouped bar plot
		$gbplot = new AccBarPlot(array($b1plot,$b2plot));
		 
		// ...and add it to the graPH
		$graph->Add($gbplot);
		 
		$graph->title->Set("Accumulated bar plots");
		$graph->xaxis->title->Set("X-title");
		$graph->yaxis->title->Set("Y-title");
		 
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
		// get unique file name
		$caption = sprintf("%s_%s", uniqid(), 'fig');
		
		$asset_path = "/images/cache/{$caption}.png";
		$file = public_path() . $asset_path;
		$graph->Stroke($file);

		$form_data = array('calc' => $calc, 'data_entry' => $data_entry, 'graph' => $file);		
		$this->layout->content = View::make("pages.report", $form_data);
	}

	public function download()
	{
		$generator = new ReportPdfGenerator();
		$generator->generate();
	}

}

