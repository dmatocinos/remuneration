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
		$generator = new ReportPdfGenerator();
		$generator->generate();
	}

}

