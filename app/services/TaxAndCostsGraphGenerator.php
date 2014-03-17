<?php

/**
 * undocumented class
 *
 * @package default
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/
class TaxAndCostsGraphGenerator {

	protected $_calc;

	public function __construct(SummaryOfResultsCalculator $calc) 
	{
		$this->_calc = $calc;
	}

	public function generate()
	{
		$datay = [
			[
				$this->_calc->c23, 
				$this->_calc->e15 + $this->_calc->e23 + $this->_calc->e33 + $this->_calc->e34, 
				$this->_calc->g15 + $this->_calc->g23 + $this->_calc->g34, 
				$this->_calc->i17 + $this->_calc->i23
			],
			[
				$this->_calc->c38, 
				$this->_calc->e38, 
				$this->_calc->g38, 
				$this->_calc->i38 
			]
		];
		 
		// Create the graph. These two calls are always required
		JpGraphMod::load();
		JpGraphMod::module('bar');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');

		$graph = new Graph(750,335,"auto");
		$graph->img->SetMargin(60,10,20,40);
		$graph->SetScale('textlin');


		// Create the bars and the accbar plot
		$bplot1 = new BarPlot($datay[1]);
		$bplot1->SetLegend("Net Personally Receivable");
		$bplot2 = new BarPlot($datay[0]);
		$bplot2->SetLegend("Tax and Costs");
		$accbplot = new AccBarPlot(array($bplot2,$bplot1));
		$accbplot->value->Show();
		$graph->Add($accbplot);

		// Setup labels
		$labels = ['Do Nothing', 'Bonus', 'Dividend', 'Darwin'];
		$graph->xaxis->SetTickLabels($labels);

		$graph->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		// get unique file name
		$caption = sprintf("%s_%s", uniqid(), 'fig');
		$img_file = "images/cache/{$caption}.png";
		
		// draw as image
		$graph->Stroke($img_file);
		
		return $img_file;
	}

}
