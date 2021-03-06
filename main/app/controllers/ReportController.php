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
		Asset::container('header')->add('report-index-css', 'assets/css/report/index.css');

		$data_entry = $this->remuneration->getAttributes();
		$data_entry['corporate_tax_rate'] = $data_entry['corporate_tax_rate'] / 100;
		$data_entry['directors'] = $this->remuneration->directors->toArray();
		$data_entry['number_of_director_shareholders'] = count($data_entry['directors']);

		$calc = new SummaryOfResultsCalculator($data_entry);
		$graph = new TaxAndCostsGraphGenerator($calc);
		$img_file = $graph->generate();
		
		$form_data = array('calc' => $calc, 'data_entry' => $data_entry, 'graph' => $img_file);		
		View::share('edit_remuneration', $this->remuneration->name);

		$this->layout->content = View::make("pages.report", $form_data);
	}

	public function download()
	{
		$data_entry = $this->remuneration->getAttributes();
		$data_entry['corporate_tax_rate'] = $data_entry['corporate_tax_rate'] / 100;
		$data_entry['directors'] = $this->remuneration->directors->toArray();
		$data_entry['number_of_director_shareholders'] = count($data_entry['directors']);

		$calc = new SummaryOfResultsCalculator($data_entry);
		$graph = new TaxAndCostsGraphGenerator($calc);
		$img_file = $graph->generate();

		$form_data = array('calc' => $calc, 'data_entry' => $data_entry, 'graph' => $img_file);		
		
		$generator = new ReportPdfGenerator($this->remuneration, $calc, $img_file);
		$generator->generate();
	}

	public function restrictDownloads($remuneration_id)
	{
		return Redirect::to('report/' . $remuneration_id)
			->with('message', "Sorry, valuation report is not downloadable for Free Trial membership. You may want to upgrade to other packages to fully use this application.");
	}
	

}

