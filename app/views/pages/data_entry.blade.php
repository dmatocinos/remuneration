@section('title')
Data Entry
@stop

@section('page_title')
Data Entry
@stop

@section('content')
<nav id="data-entry-nav" class="navbar navbar-default " role="navigation">
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="data-entry-collapse-bar">
	<ul class="nav navbar-nav">
	  <li class="active"><a href="#">Data Entry</a></li>
	  @if (isset($edit_remuneration))
		<li><a href="{{ url('/report/' . $data['remuneration_id'] ) }}">Report Summary</a></li>
		@endif
	</ul>
  </div><!-- /.navbar-collapse -->
</nav>
<div style="padding: 20px 50px;">
	@if ($errors->any())
	<div class="row">
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Error</h4>
			{{ Session::get('message') }}
		</div>
	</div>
	@endif
	
	<?php
		$number_of_directors = range(1, 4);
		$remuneration = isset($data['remuneration']) ? $data['remuneration'] : NULL;
		$company      = isset($data['company']) ? $data['company'] : NULL;
		$directors    = isset($data['directors']) ? $data['directors'] : NULL;
		$accountant   = isset($data['accountant']) ? $data['accountant'] : NULL;
	?>
				
	<div ng-app="BvApp" id="bv-content" class="">
		{{ Form::open(array('url' => $save_route, 'method' => 'PUT','class' => 'form-horizontal')) }}
			{{ 	Form::hidden('remuneration_id', isset($data['remuneration_id']) ? $data['remuneration_id'] : 'new') }}
			{{ 	Form::hidden('company_id', $company ? $company['id'] : 'new') }}
			{{ 	Form::hidden('accountant_id', $accountant ? $accountant['id'] : 'new') }}
			
			<div class="well">	
			<legend>Remuneration</legend>
			
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						{{ Form::label('remuneration[name]', 'Remuneration Name', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('remuneration[name]', isset($remuneration['name']) ? $remuneration['name'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('remuneration[name]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
				</div>
			</div>
			</div>
			
			<div class="well">	
			<legend>Company Details</legend>
			
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						{{ Form::label('company[name]', 'Company Name', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[name]', $company ? $company['name'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('company[name]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[address]', 'Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[address]', $company ? $company['address'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('company[address]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[telephone_number]', 'Telephone Number', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[telephone_number]', $company ? $company['telephone_number'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('company[telephone_number]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[email]', 'Email Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[email]', $company ? $company['email'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('company[email]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[website]', 'Website Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[website]', $company ? $company['website'] : '', array(
									'class' => 'form-control'
								)) 
							}}
							{{ $errors->first('company[website]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[contact_name]', 'Contact Name', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[contact_name]', $company ? $company['contact_name'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('company[contact_name]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('company[contact_telephone_number]', 'Contact Telephone Number (if not same as above)', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('company[contact_telephone_number]', $company ? $company['contact_telephone_number'] : '', array(
									'class' => 'form-control'
								)) 
							}}
							{{ $errors->first('company[contact_telephone_number]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
				</div> {{-- .col-lg-9 --}}
			</div>{{-- .row --}}
			</div>
			
			<div class="well">
			<legend>Company Tax</legend>
			
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						{{ Form::label('remuneration[profit_chargeable]', 'Profit Chargeble to Corporation Tax', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $profit_chargeable = isset($remuneration['profit_chargeable']) ? $remuneration['profit_chargeable'] : ''; ?>
							{{ 
								Form::text('remuneration[profit_chargeable]', $profit_chargeable, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'A', 
									'ng-init' 	=> "A='{$profit_chargeable}'",
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('remuneration[profit_chargeable]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[corporate_tax_rate]', 'Corporation Tax Rate', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $corporate_tax_rate = isset($remuneration['corporate_tax_rate']) ? $remuneration['corporate_tax_rate'] : ''; ?>
							{{ 
								Form::text('remuneration[corporate_tax_rate]', $corporate_tax_rate, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'B', 
									'ng-init' 	=> "B='{$corporate_tax_rate}'",
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required',
									'style'     => 'width: 80%; float: left;'
								)) 
							}}
							<span class="input-group-addon" style="display: inline; border: 0; padding: 0 0 0 7px;">%</span>
							{{ $errors->first('remuneration[corporate_tax_rate]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[amount_to_distribute]', 'Amount to Distribute', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $amount_to_distribute = isset($remuneration['amount_to_distribute']) ? $remuneration['amount_to_distribute'] : ''; ?>
							{{ 
								Form::text('remuneration[amount_to_distribute]', $amount_to_distribute, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'C', 
									'ng-init' 	=> "C='{$amount_to_distribute}'",
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('remuneration[amount_to_distribute]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[directors_salary]', 'Directors Salary', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $directors_salary = isset($remuneration['directors_salary']) ? $remuneration['directors_salary'] : ''; ?>
							{{ 
								Form::text('remuneration[directors_salary]', $directors_salary, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'D', 
									'ng-init' 	=> "D='{$directors_salary}'",
									'numbers-only'	=> 'numbers-only',
									'required'	=> 'required',
									'id' => 'remuneration_directors_salary'
								)) 
							}}
							{{ $errors->first('remuneration[directors_salary]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[number_of_director_shareholders]', 'Number of Director Shareholders', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::select(
									'remuneration[number_of_director_shareholders]', 
									array_combine($number_of_directors, $number_of_directors), 
									$directors ? count($directors) : 1, 
									array('class' => 'form-control', 'id' => 'remuneration_number_of_director_shareholders')
								) 
							}}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[number_of_associated_companies]', 'Number of Associated Companies', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $number_of_associated_companies = isset($remuneration['number_of_associated_companies']) ? $remuneration['number_of_associated_companies'] : ''; ?>
							{{ 
								Form::text('remuneration[number_of_associated_companies]', $number_of_associated_companies, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'F', 
									'ng-init' 	=> "F='{$number_of_associated_companies}'",
									'numbers-only'	=> 'numbers-only'
								)) 
							}}
							{{ $errors->first('remuneration[number_of_associated_companies]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[claim_ct_deduction]', 'Do you want to claim a CT deduction', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::select('remuneration[claim_ct_deduction]', array('' => '', '1' => 'Yes', '2' => 'No'),isset($remuneration['claim_ct_deduction']) ? $remuneration['claim_ct_deduction'] : '', array(
									'class' => 'form-control'
								)) 
							}}
							{{ $errors->first('remuneration[claim_ct_deduction]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[from_year]', 'Financial Year (From)', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $from_year = isset($remuneration['from_year']) ? $remuneration['from_year'] : ''; ?>
							{{ 
								Form::text('remuneration[from_year]', $from_year, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'H', 
									'ng-init' 	=> "H='{$from_year}'",
									'numbers-only'	=> 'numbers-only'
								)) 
							}}
							{{ $errors->first('remuneration[from_year]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('remuneration[to_year]', 'Financial Year (To)', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							<?php $to_year = isset($remuneration['to_year']) ? $remuneration['to_year'] : ''; ?>
							{{ 
								Form::text('remuneration[to_year]', $to_year, array(
									'class' => 'form-control', 
									'ng-model' 	=> 'I', 
									'ng-init' 	=> "I='{$to_year}'",
									'numbers-only'	=> 'numbers-only'
								)) 
							}}
							{{ $errors->first('remuneration[to_year]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
				</div> {{-- .col-lg-9 --}}
			</div>{{-- .row --}}
			</div>
			
			<div class="well">
			<legend>Directors Details</legend>
			
			<div class="row">
				<div class="col-lg-12">
					<table class="table">
						<thead>
							<tr>
								<th style="border-style: none;" class="col-lg-3"></th>
								<th style="border-style: none;">Director 1</th>
								<th style="border-style: none;">Director 2</th>
								<th style="border-style: none;">Director 3</th>
								<th style="border-style: none;">Director 4</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$rows = array(
									array('Percentages of Shares'),
									array('Salary already paid in present financial Year'),
									array('Other taxable income in present financial year'),
									array('Balance on Directors Loan Account'),
								);
								
								for ($i = 0; $i < 4; $i++) {
									$has_value = $directors && isset($directors[$i]);
									$shares  = $has_value ? $directors[$i]['percentage_of_shares'] : '';
									$salary  = $has_value ? $directors[$i]['salary_paid'] : '';
									$taxable = $has_value ? $directors[$i]['other_taxable_income'] : '';
									$balance = $has_value ? $directors[$i]['balance_on_directors_loan_account'] : '';
									$prefix  = $i + 1;
									
									$field_name  = "directors[{$i}][percentage_of_shares]";
									$rows[0][$i + 1] = sprintf(
										'<div class="input-group" style="%s">%s%s</div>',
										'width: 95%; float: left;',
										Form::text($field_name, Input::old($field_name, $shares), array(
											'class'        => 'form-control',
											'ng-model' 	=> "DA{$prefix}", 
											'ng-init' 	=> "DA{$prefix}='{$shares}'",
											'numbers-only' => 'numbers-only',
											'id'		   => "directors_percentage_of_shares_{$prefix}",
											'style'        => 'width: 80%; float: left;'
										)),
										'<span class="input-group-addon" style="display: inline; padding: 0 0 0 7px; border: 0;">%</span>'
									);
									
									$field_name  = "directors[{$i}][salary_paid]";
									$rows[1][$i + 1] = sprintf(
										'<div class="input-group">%s</div>',
										Form::text($field_name, Input::old($field_name, $salary), array(
											'class'        => 'form-control',
											'numbers-only' => 'numbers-only',
											'ng-model' 	=> "DB{$prefix}", 
											'ng-init' 	=> "DB{$prefix}='{$salary}'",
											'id'		   => "directors_salary_paid_{$prefix}"
										)) 
									);
									
									$field_name  = "directors[{$i}][other_taxable_income]";
									$rows[2][$i + 1] = sprintf(
										'<div class="input-group">%s</div>',
										Form::text($field_name, Input::old($field_name, $taxable), array(
											'class'        => 'form-control',
											'numbers-only' => 'numbers-only',
											'ng-model' 	=> "DC{$prefix}", 
											'ng-init' 	=> "DC{$prefix}='{$taxable}'",
											'id'		   => "directors_other_taxable_income_{$prefix}"
										)) 
									);
									
									$field_name  = "directors[{$i}][balance_on_directors_loan_account]";
									$rows[3][$i + 1] = sprintf(
										'<div class="input-group">%s</div>',
										Form::text($field_name, Input::old($field_name, $balance), array(
											'class'        => 'form-control',
											'numbers-only' => 'numbers-only',
											'ng-model' 	=> "DD{$prefix}", 
											'ng-init' 	=> "DD{$prefix}='{$balance}'",
											'id'		   => "directors_balance_on_directors_loan_account_{$prefix}"
										)) 
									);
								}
								
								$html = "";
								
								foreach ($rows as $columns) {
									$html .= "<tr>";
									
									foreach ($columns as $item) {
										$html .= sprintf("<td>%s</td>", $item);
									}
									
									$html .= "</tr>";
								}
								
								echo $html;
							?>
						</tbody>
					</table>
				</div>{{-- .col-lg-12 --}}
			</div>{{-- .row --}}
			</div>
			
			<div class="well">
			<legend style="margin-bottom: 5px;">Accountant Details</legend>
			<div style="margin-bottom: 21px;" class="success">These details will be presented on the front cover of the report. </div>
			
			<div class="row">
				<div class="col-lg-8">
					<div class="form-group">
						{{ Form::label('accountant[practice_name]', 'Practice Name', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[practice_name]', $accountant ? $accountant['practice_name'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('accountant[practice_name]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[address]', 'Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[address]', $accountant ? $accountant['address'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('accountant[address]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[telephone_number]', 'Telephone Number', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[telephone_number]', $accountant ? $accountant['telephone_number'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('accountant[telephone_number]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[email]', 'Email Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[email]', $accountant ? $accountant['email'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('accountant[email]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[website]', 'Website Address', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[website]', $accountant ? $accountant['website'] : '', array(
									'class' => 'form-control'
								)) 
							}}
							{{ $errors->first('accountant[website]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[contact_name]', 'Contact Name', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[contact_name]', $accountant ? $accountant['contact_name'] : '', array(
									'class' => 'form-control', 
									'required'	=> 'required'
								)) 
							}}
							{{ $errors->first('accountant[contact_name]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('accountant[contact_telephone_number]', 'Contact Telephone Number (if not same as above)', array('class' => 'col-lg-3 control-label')) }}
						<div class="col-lg-5">
							{{ 
								Form::text('accountant[contact_telephone_number]', $accountant ? $accountant['contact_telephone_number'] : '', array(
									'class' => 'form-control'
								)) 
							}}
							{{ $errors->first('accountant[contact_telephone_number]', '<span class="help-block">:message</span>') }}
						</div>
					</div>
				</div> {{-- .col-lg-9 --}}
			</div>{{-- .row --}}
			</div>
			
			<hr>
			
			<div class="well">
			<div class="row">
				<div class="col-lg-1" style="width: 120px;">
					<input type="submit" class="btn btn-primary" style="width: 100px;" value="Save"/>
				</div>
				<div class="col-lg-1">
					<a class="btn btn-default" style="width: 100px;" href="{{ $cancel_route }}">Cancel</a>
				</div>
			</div> {{-- .row --}}
			</div>
		{{ Form::close() }}
	</div>
</div>

@stop

