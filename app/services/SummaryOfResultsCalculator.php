<?php


/**
 * undocumented class
 *
 * @package Services
 * @author Dixie Philamerah J. Atay <dixie.atay@gmail.com>
**/
class SummaryOfResultsCalculator {

	protected $_data_entry = [];

	protected $_report_data = [
		'c6' => NULL,
		'e6' => NULL,
		'g6' => NULL,
		'i6' => NULL,
		'c8' => NULL,
		'e8' => NULL,
		'g8' => NULL,
		'i8' => NULL,
		'c10' => NULL,
		'e10' => NULL,
		'g10' => NULL,
		'i10' => NULL,
		'c12' => NULL,
		'e12' => NULL,
		'g12' => NULL,
		'i12' => NULL,
		'e14' => NULL,
		'e15' => NULL,
		'i17' => NULL,
		'i19' => NULL,
		'c21' => NULL,
		'e21' => NULL,
		'g21' => NULL,
		'i21' => NULL,
		'c23' => NULL,
		'e23' => NULL,
		'g23' => NULL,
		'i23' => NULL,
		'g25' => NULL,
		'c28' => NULL,
		'e28' => NULL,
		'g28' => NULL,
		'i28' => NULL,
		'e33' => NULL,
		'e34' => NULL,
		'g34' => NULL,
		'i33' => NULL,	
		'i34' => NULL,	
		'c38' => NULL,
		'e38' => NULL,
		'g38' => NULL,
		'i38' => NULL,
		'e41' => NULL,
		'g41' => NULL,
		'i41' => NULL,
		'b49' => NULL,
        'b51' => NULL,
        'b53' => NULL,
		'b55' => NULL,
		'b57' => NULL,
		'b66' 		=> 10000,
		'b68'		=> 31865,
		'b70'		=> 100000,
		'b72'		=> 0.2,
		'b74'		=> 0.4,
		'b76'		=> 0.325,
		'b78'		=> 7956,
		'b80'		=> 41865,
		'b82'		=> 0.138,
		'b84'		=> 0.12,
		'b85'		=> 0.02,
		'd66'		=> NULL,
		'd68'		=> NULL,
		'd70'		=> NULL,
		'd78'		=> NULL,
		'd80'		=> NULL,
	];

	public function __construct($params)
	{
		$this->_data_entry = $params;		
	}

	public function __get($name)
	{
		if (array_key_exists($name, $this->_report_data)) {
			if (is_null($this->_report_data[$name])) {
				$method_name = 'get' . studly_case($name) . 'Calc';
				return $this->$method_name();
			}
			return $this->_report_data[$name];
		}
	}

	public function getC6Calc()
	{
		$this->_report_data['c6'] = $this->c12 + $this->c10 + $this->c8;		
		return $this->_report_data['c6'];
	}

	public function getE6Calc()
	{
		$this->_report_data['e6'] = $this->e12 + $this->e10 + $this->e8;		
		return $this->_report_data['e6'];
	}

	public function getG6Calc()
	{
		$this->_report_data['g6'] = $this->g12 + $this->g10 + $this->g8;		
		return $this->_report_data['g6'];
	}

	public function getI6Calc()
	{
		$this->_report_data['i6'] = $this->i12  + $this->i10 + $this->i8;		
		return $this->_report_data['i6'];
	}

	public function getC8Calc()
	{
		$c8 = 0;
		foreach ($this->_data_entry['directors'] as $data) {
			$c8 = $c8 + $data['salary_paid'];
		}
		$this->_report_data['c8'] = $c8;
		return $this->_report_data['c8'];
	}

	public function getE8Calc()
	{
		$e8 = 0;
		foreach ($this->_data_entry['directors'] as $data) {
			$e8 = $e8 + $data['salary_paid'];
		}
		$this->_report_data['e8'] = $e8;
		return $this->_report_data['e8'];
	}

	public function getG8Calc()
	{
		$g8 = 0;
		foreach ($this->_data_entry['directors'] as $data) {
			$g8 = $g8 + $data['salary_paid'];
		}
		$this->_report_data['g8'] = $g8;
		return $this->_report_data['g8'];
	}

	public function getI8Calc()
	{
		$i8 = 0;
		foreach ($this->_data_entry['directors'] as $data) {
			$i8 = $i8 + $data['salary_paid'];
		}
		$this->_report_data['i8'] = $i8;
		return $this->_report_data['i8'];
	}

	public function getC10Calc()
	{
		$this->_report_data['c10'] = $this->c8 > $this->d78 ? ($this->c8 - $this->d78) * $this->b82 : 0;		
		return $this->_report_data['c10'];
	}

	public function getE10Calc()
	{
		$this->_report_data['e10'] = $this->e8 > $this->d78 ? ($this->e8 - $this->d78) * $this->b82 : 0;		
		return $this->_report_data['e10'];
	}

	public function getG10Calc()
	{
		$this->_report_data['g10'] = $this->g8 > $this->d78 ? ($this->g8 - $this->d78) * $this->b82 : 0;		
		return $this->_report_data['g10'];
	}

	public function getI10Calc()
	{
		$this->_report_data['i10'] = $this->i8 > $this->d78 ? ($this->i8 - $this->d78) * $this->b82 : 0;		
		return $this->_report_data['i10'];
	}

	public function getC12Calc()
	{
		$this->_report_data['c12'] = $this->_data_entry['profit_chargeable'];
		return $this->_report_data['c12'];
	}

	public function getE12Calc()
	{
		$this->_report_data['e12'] = $this->_data_entry['profit_chargeable'];
		return $this->_report_data['e12'];
	}

	public function getG12Calc()
	{
		$this->_report_data['g12'] = $this->_data_entry['profit_chargeable'];
		return $this->_report_data['g12'];
	}

	public function getI12Calc()
	{
		$this->_report_data['i12'] = $this->_data_entry['profit_chargeable'];
		return $this->_report_data['i12'];
	}


	public function getE14Calc()
	{
		$this->_report_data['e14'] = $this->_data_entry['amount_to_distribute'] - $this->e15;
		return $this->_report_data['e14'];
	}

	public function getE15Calc()
	{
		$this->_report_data['e15'] = ($this->_data_entry['amount_to_distribute'] / 1.138) * 0.138;
		return $this->_report_data['e15'];
	}

	public function getI17Calc()
	{
		$this->_report_data['i17'] = $this->_data_entry['amount_to_distribute'] * 0.12;
		return $this->_report_data['i17'];
	}

	public function getI19Calc()
	{
		$this->_report_data['i19'] = $this->_data_entry['amount_to_distribute'] - $this->i17;
		return $this->_report_data['i19'];
	}

	public function getC21Calc()
	{
		$this->_report_data['c21'] = $this->c12 - $this->c14 - $this->c15 - $this->c17 - $this->c19;		
		return $this->_report_data['c21'];
	}

	public function getE21Calc()
	{
		$this->_report_data['e21'] = $this->e12 - $this->e14 - $this->e15 - $this->e17 - $this->e19;		
		return $this->_report_data['e21'];
	}

	public function getG21Calc()
	{
		$this->_report_data['g21'] = $this->g12;		
		return $this->_report_data['g21'];
	}

	public function getI21Calc()
	{
		$this->_report_data['i21'] = $this->i12 - $this->i14 - $this->i15 - $this->i17 - $this->i19;		
		return $this->_report_data['i21'];
	}

	public function getC23Calc()
	{
		$this->_report_data['c23'] = $this->c21 * $this->_data_entry['corporate_tax_rate'];
		return $this->_report_data['c23'];
	}

	public function getE23Calc()
	{
		$this->_report_data['e23'] = $this->e21 * $this->_data_entry['corporate_tax_rate'];
		return $this->_report_data['e23'];
	}

	public function getG23Calc()
	{
		$this->_report_data['g23'] = $this->g21 * $this->_data_entry['corporate_tax_rate'];
		return $this->_report_data['g23'];
	}

	public function getI23Calc()
	{
		$this->_report_data['i23'] = $this->i21 * $this->_data_entry['corporate_tax_rate'];
		return $this->_report_data['i23'];
	}

	public function getG25Calc()
	{
		$this->_report_data['g25'] = $this->g21 - $this->g23 - $this->g28;
		return $this->_report_data['g25'];
	}

	public function getC28Calc()
	{
		$this->_report_data['c28'] = $this->c21 - $this->c23 - $this->c25;
		return $this->_report_data['c28'];
	}

	public function getE28Calc()
	{
		$this->_report_data['e28'] = $this->e21 - $this->e23 - $this->e25;
		return $this->_report_data['e28'];
	}

	public function getG28Calc()
	{
		$this->_report_data['g28'] = $this->e28; 
		return $this->_report_data['g28'];
	}

	public function getI28Calc()
	{
		$this->_report_data['i28'] = $this->i21 - $this->i23 - $this->i25;
		return $this->_report_data['i28'];
	}

	public function getE33Calc()
	{
		$this->_report_data['e33'] = $this->e14 > $this->d80 
			? ($this->e14 + $this->e8 - $this->d80) * $this->b85 + ($this->d80 - $this->d78) * $this->b84
			: ($this->e14 + $this->e8 - $this->d78) * $this->b84;
		return $this->_report_data['e33'];
	}

	public function getI33Calc()
	{
		$this->_report_data['i33'] = ($this->i19 * 0.05) * $this->b82;
		return $this->_report_data['i33'];
	}

	public function getE34Calc()
	{
		$this->_report_data['e34'] = ($this->e8 + $this->e14) > $this->d70 
			? ($this->e8 + $this->e14 - $this->d68) * $this->b74 + ($this->d68 * $this->b72)
			: (($this->e8 + $this->e14 - $this->d66 - $this->d68) * $this->b74) + $this->d68 * $this->b72;
		return $this->_report_data['e34'];
	}

	public function getG34Calc()
	{
		$this->_report_data['g34'] = $this->g8 + ($this->g25 * 1.1111) > $this->d70 
			? ($this->g8 + ($this->g25 * 1.1111) - $this->d68) * $this->b76
			: ($this->g8 + ($this->g25 * 1.1111) - $this->d66 - $this->d68) * $this->b76;
		return $this->_report_data['g34'];
	}

	public function getI34Calc()
	{
		$this->_report_data['i34'] = ($this->i19 * 0.05) * $this->b72;
		return $this->_report_data['i34'];
	}

	public function getC38Calc()
	{
        $this->_report_data['c38'] = $this->c8 - (($this->b55 + $this->b57) * $this->_data_entry['number_of_director_shareholders']);
		return $this->_report_data['c38'];
	}

	public function getE38Calc()
	{
		$this->_report_data['e38'] = $this->e8 - (($this->b55 + $this->b57) * $this->_data_entry['number_of_director_shareholders']) + $this->e14 - $this->e33 - $this->e34;
		return $this->_report_data['e38'];
	}

	public function getG38Calc()
	{
		$this->_report_data['g38'] = $this->g8 + $this->g25 - $this->g34 - (($this->b55 + $this->b57) * $this->_data_entry['number_of_director_shareholders']);
		return $this->_report_data['g38'];
	}

	public function getI38Calc()
	{
		$this->_report_data['i38'] = $this->i8 - (($this->b55 + $this->b57) * $this->_data_entry['number_of_director_shareholders']) + $this->i19 - $this->i33 - $this->i34;
		return $this->_report_data['i38'];
	}

	public function getE41Calc()
	{
		$this->_report_data['e41'] = ($this->e34 + $this->e33 + $this->e15 - $this->c23 + $this->e23) / $this->e14;
		return $this->_report_data['e41'];
	}

	public function getG41Calc()
	{
		$this->_report_data['g41'] = $this->g34 / ($this->g25 * 1.1111);
		return $this->_report_data['g41'];
	}

	public function getI41Calc()
	{
		$this->_report_data['i41'] = ($this->i34 + $this->i33 + $this->i17 - $this->g23 + $this->i23) / $this->i19;
		return $this->_report_data['i41'];
	}

	public function getB49Calc()
	{
		$this->_report_data['b49'] = $this->_data_entry['directors_salary'];
		return $this->_report_data['b49'];
	}

	public function getB51Calc()
	{
		$this->_report_data['b51'] = $this->b49 > $this->b70 ? 0 : $this->b66;
		return $this->_report_data['b51'];
	}

	public function getB53Calc()
	{
        $this->_report_data['b53'] = $this->b49 - $this->b51; 
		return $this->_report_data['b53'];
	}

	public function getB55Calc()
	{
        $this->_report_data['b55'] = $this->b53 < $this->b68 
			? ($this->b53 * $this->b72)
			: ($this->b53 - $this->b68) * $this->b74 + ($this->b68 * $this->b72); 
		return $this->_report_data['b55'];
	}

	public function getB57Calc()
	{
		$this->_report_data['b57'] = $this->b49 > $this->b80 
			? ($this->b49 - $this->b80) * $this->b85 + ($this->b80 - $this->b78) * $this->b84
			: ($this->b49 - $this->b78) * $this->b84;
		return $this->_report_data['b57'];
	}

	public function getB60Calc()
	{
		$this->_report_data['b60'] = $this->b49 - $this->b55 - $this->b57; 
		return $this->_report_data['b60'];
	}

	public function getD66Calc()
	{
		$this->_report_data['d66'] = $this->b66 * $this->_data_entry['number_of_director_shareholders']; 
		return $this->_report_data['d66'];
	}

	public function getD68Calc()
	{
		$this->_report_data['d68'] = $this->b68 * $this->_data_entry['number_of_director_shareholders']; 
		return $this->_report_data['d68'];
	}

	public function getD70Calc()
	{
		$this->_report_data['d70'] = $this->b70 * $this->_data_entry['number_of_director_shareholders']; 
		return $this->_report_data['d70'];
	}

	public function getD78Calc()
	{
		$this->_report_data['d78'] = $this->b78 * $this->_data_entry['number_of_director_shareholders']; 
		return $this->_report_data['d78'];
	}

	public function getD80Calc()
	{
		$this->_report_data['d80'] = $this->b80 * $this->_data_entry['number_of_director_shareholders']; 
		return $this->_report_data['d80'];
	}

}
