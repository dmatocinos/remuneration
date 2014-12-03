@section('title')
Client Details
@stop

@section('page_title')
Client Details
@stop

@section('content')
<nav id="data-entry-nav" class="navbar navbar-default " role="navigation">
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="data-entry-collapse-bar">
	<ul class="nav navbar-nav">
	  <li class="active"><a href="#">Client Details</a></li>
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

        if (isset($client_data['id'])) {
			$route = 'update_client';
			$client_data['period_start_date'] =  $client_data['period_start_date'] ? date('d/m/Y', strtotime($client_data['period_start_date'])) : '';
			$client_data['period_end_date'] =  $client_data['period_end_date'] ? date('d/m/Y', strtotime($client_data['period_end_date'])) : '';
			$country = $client_data['country'];
		}
		else {
			$client_data['period_start_date'] = '';
			$client_data['period_end_date'] = '';
			$route = 'create_client';
			$country = 'United Kingdom';
		}
		
	?>
				
	<div ng-app="BvApp" id="bv-content" class="">
		{{ Form::open(array('route' => $route, 'method' => 'PUT', 'class' => 'form-horizontal')) }}
			{{ Form::hidden('remuneration_id', isset($data['remuneration_id']) ? $data['remuneration_id'] : 'new') }}
			{{ Form::hidden('company_id', $company && isset($company['id']) ? $company['id'] : 'new') }}
			{{ Form::hidden('accountant_id', $accountant && isset($accountant['id']) ? $accountant['id'] : 'new') }}

		<div class="row">	
			<div class="col-lg-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    <i class="fa fa-money fa-fw"></i> Remuneration
				</div>
				<div class="panel-body">
					
				    <fieldset>
						<div class="form-group">
							{{ Form::label('remuneration[name]', 'Remuneration Name', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ 
									Form::text('remuneration[name]', isset($remuneration['name']) ? $remuneration['name'] : '', array(
										'class' => 'form-control input-sm', 
										'required'	=> 'required'
									)) 
								}}
								{{ $errors->first('remuneration[name]', '<span class="help-block">:message</span>') }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('remuneration[profit_chargeable]', 'Profit Chargeable to Corporation Tax', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<?php $profit_chargeable = isset($remuneration['profit_chargeable']) ? $remuneration['profit_chargeable'] : ''; ?>
								{{ 
									Form::text('remuneration[profit_chargeable]', $profit_chargeable, array(
										'class' => 'form-control input-sm', 
										'numbers-only'	=> 'numbers-only',
										'required'	=> 'required',
                                        'ng-init' => "profit_chargeable=" . ($profit_chargeable ? $profit_chargeable : "''"),
                                        'ng-model' => 'profit_chargeable'
									)) 
								}}
								{{ $errors->first('remuneration[profit_chargeable]', '<span class="help-block">:message</span>') }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('remuneration[corporate_tax_rate]', 'Corporation Tax Rate', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<div class="col-lg-10" style="padding: 0px;">
                                    <?php $corporate_tax_rate = isset($remuneration['corporate_tax_rate']) ? $remuneration['corporate_tax_rate'] : '20'; ?>
                                    {{ 
                                        Form::text('remuneration[corporate_tax_rate]', $corporate_tax_rate, array(
                                            'class' => 'form-control input-sm', 
                                            'numbers-only'	=> 'numbers-only',
                                            'ng-model' => 'corporate_tax_rate',
                                            'ng-init' => "corporate_tax_rate=" . ($corporate_tax_rate ? $corporate_tax_rate : "'20'"),
                                            'required'	=> 'required'
                                        )) 
                                    }}
                                </div>
								<span class="input-group-addon input-sm">%</span>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('remuneration[amount_to_distribute]', 'Amount to Distribute', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<?php $amount_to_distribute = isset($remuneration['amount_to_distribute']) ? $remuneration['amount_to_distribute'] : ''; ?>
								{{ 
									Form::text('remuneration[amount_to_distribute]', $amount_to_distribute, array(
										'class' => 'form-control input-sm', 
										'numbers-only'	=> 'numbers-only',
                                        'ng-model' => 'amount_to_distribute',
                                        'ng-init' => "amount_to_distribute=" . ($amount_to_distribute ? $amount_to_distribute : "''"),
										'required'	=> 'required'
									)) 
								}}
								{{ $errors->first('remuneration[amount_to_distribute]', '<span class="help-block">:message</span>') }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('remuneration[directors_salary]', 'Directors Salary', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								<?php $directors_salary = isset($remuneration['directors_salary']) ? $remuneration['directors_salary'] : ''; ?>
								{{ 
									Form::text('remuneration[directors_salary]', $directors_salary, array(
										'class' => 'form-control input-sm', 
										'numbers-only'	=> 'numbers-only',
										'required'	=> 'required',
                                        'ng-model' => 'directors_salary',
                                        'ng-init' => "directors_salary=" . ($directors_salary ? $directors_salary : "''"),
										'id' => 'remuneration_directors_salary'
									)) 
								}}
								{{ $errors->first('remuneration[directors_salary]', '<span class="help-block">:message</span>') }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('remuneration[number_of_director_shareholders]', 'Number of Director Shareholders', array('class' => 'col-sm-3 control-label')) }}
							<div class="col-sm-6">
								{{ 
									Form::select(
										'remuneration[number_of_director_shareholders]', 
										array_combine($number_of_directors, $number_of_directors), 
										$directors ? count($directors) : 1, 
										array('class' => 'form-control input-sm', 'id' => 'remuneration_number_of_director_shareholders')
									) 
								}}
							</div>
						</div>

					</fieldset>
				   </div>
			     </div>
		       </div>
		</div>
		
		<div class="row">	
			<div class="col-lg-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    <i class="fa fa-group fa-fw"></i> Directors Details
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th style="border-style: none;" class="col-sm-3"></th>
								<th style="border-style: none;">Director 1</th>
								<th style="border-style: none;">Director 2</th>
								<th style="border-style: none;">Director 3</th>
								<th style="border-style: none;">Director 4</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$rows = array(
									array('<div style="width: 100%; text-align: right;" class="col-sm-3"><label class="control-label">Percentages of Shares</label></div>'),
									array('<div style="width: 100%; text-align: right;" class="col-sm-3"><label class="control-label">Salary already paid in present financial Year</label></div>'),
									array('<div style="width: 100%; text-align: right;" class="col-sm-3"><label class="control-label">Other taxable income in present financial year</label></div>'),
									array('<div style="width: 100%; text-align: right;" class="col-sm-3"><label class="control-label">Balance on Directors Loan Account</label></div>'),
								);
								
								for ($i = 0; $i < 4; $i++) {
									$has_value = $directors && isset($directors[$i]);
									$shares  = $has_value ? $directors[$i]['percentage_of_shares'] : '';
									$salary  = $has_value ? $directors[$i]['salary_paid'] : '';
									$taxable = $has_value ? $directors[$i]['other_taxable_income'] : '';
									$balance = $has_value ? $directors[$i]['balance_on_directors_loan_account'] : '';
									$prefix  = $i + 1;
									
									$field_name  = "directors[{$i}][percentage_of_shares]";
                                    $val = isset($old_data[$field_name]) ? $old_data[$field_name] : $shares;
									$rows[0][$i + 1] = sprintf(
										'<div class="col-sm-12" style="padding-left: 0px;"><div class="col-sm-10" style="padding: 0px;">%s</div>%s</div>',
                                            Form::text($field_name, $val, array(
                                                'class'        => 'form-control input-sm',
                                                'numbers-only' => 'numbers-only',
                                                'ng-model'     => "directors_percentage_of_shares_{$prefix}",
                                                'ng-init'      => "directors_percentage_of_shares_{$prefix}=" . ($val ? $val : "''"),
                                                'id'		   => "directors_percentage_of_shares_{$prefix}"
                                            )),
										'<span class="input-group-addon input-sm">%</span>'
									);

									$field_name  = "directors[{$i}][salary_paid]";
                                    $val = isset($old_data[$field_name]) ? $old_data[$field_name] : $salary;
									$rows[1][$i + 1] = sprintf(
										'<div class="col-sm-12" style="padding-left: 0px;">%s</div>',
										Form::text($field_name, $val, array(
											'class'        => 'form-control input-sm',
											'numbers-only' => 'numbers-only',
                                            'ng-model'     => "directors_salary_paid_{$prefix}",
                                            'ng-init'      => "directors_salary_paid_{$prefix}=" . ($val ? $val : "''"),
											'id'		   => "directors_salary_paid_{$prefix}"
										)) 
									);
									
									$field_name  = "directors[{$i}][other_taxable_income]";
                                    $val = isset($old_data[$field_name]) ? $old_data[$field_name] : $taxable;
									$rows[2][$i + 1] = sprintf(
										'<div class="col-sm-12" style="padding-left: 0px;">%s</div>',
										Form::text($field_name, $val, array(
											'class'        => 'form-control input-sm',
											'numbers-only' => 'numbers-only',
                                            'ng-model'     => "directors_other_taxable_income_{$prefix}",
                                            'ng-init'      => "directors_other_taxable_income_{$prefix}=" . ($val ? $val : "''"),
											'id'		   => "directors_other_taxable_income_{$prefix}"
										)) 
									);
									
									$field_name  = "directors[{$i}][balance_on_directors_loan_account]";
                                    $val = isset($old_data[$field_name]) ? $old_data[$field_name] : $balance;
									$rows[3][$i + 1] = sprintf(
										'<div class="col-sm-12" style="padding-left: 0px;">%s</div>',
										Form::text($field_name, $val, array(
											'class'        => 'form-control input-sm',
											'numbers-only' => 'numbers-only',
                                            'ng-model'     => "directors_balance_on_directors_loan_account_{$prefix}",
                                            'ng-init'      => "directors_balance_on_directors_loan_account_{$prefix}=" . ($val ? $val : "''"),
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
				 </div>
			   </div>
		     </div>
		</div>

		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Client Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
					@if(isset($client_data['id']))
					<input type="hidden" name="id" value="{{ $client_data['id'] }}">
					@endif
				    	<label for="business_name" class="col-sm-3 control-label">Business Name</label>
					<div class="col-sm-6">
						{{ 
							Form::text('business_name', $client_data['business_name'], array(
								'class' => 'form-control input-sm',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("business_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-3 control-label">Contact Name</label>
					<div class="col-sm-6">
						{{ 
							Form::text('contact_name', $client_data['contact_name'], array(
								'class' => 'form-control input-sm',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("contact_name"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="contact_name" class="col-sm-3 control-label">Accounting Period</label>
					<div class="col-sm-6">
					    <div class="row">
						<span class="col-sm-6">
							{{ 
								Form::text('period_start_date', $client_data['period_start_date'], array(
									'class' => 'form-control input-sm', 
									'id' => 'period_start_date',
									'placeholder' => 'Period Start'
								)) 
							}}
						</span>
						<span style="position: absolute;">
							<b>_</b>
						</span>
						<span class="col-sm-6">
							{{ 
								Form::text('period_end_date', $client_data['period_end_date'], array(
									'class' => 'form-control input-sm', 
									'id' => 'period_end_date',
									'placeholder' => 'Period End'
								)) 
							}}
						</span>
					    </div>
				    	</div>
				    </div>

				</fieldset>

			</div>
		    </div>
		</div>
		</div>

		<div class="row">	
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-suitcase fa-fw"></i> Business Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				  <div class="form-group">
				    	<label for="year_end" class="col-sm-3 control-label">Year End</label>
					<div class="col-sm-6">
						{{ 
							Form::text('year_end', $client_data['year_end'], array(
								'class' => 'form-control input-sm', 
								'id' => 'year_end', 
								'placeholder' => 'day, Month',
							))
						}}
						@if ($error = $errors->first("year_end"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="business_status" class="col-sm-3 control-label">Business Status</label>
					<div class="col-sm-6">
						{{ 
							Form::select(
								'business_status', ['' => '', 'Trading' => 'Trading', 'Investment' => 'Investment'], 
								$client_data['business_status'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="business_type" class="col-sm-3 control-label">Business Type</label>
					<div class="col-sm-6">
						{{ 
							Form::select(
								'business_type', 
								[
									'Limited Company' => 'Limited Company', 
									'Partnership' => 'Partnership', 
									'Sole Trader' => 'Sole Trader', 
									'LLP' => 'LLP'
								], 
								$client_data['business_type'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="industry_sector" class="col-sm-3 control-label">Industry Sector</label>
					<div class="col-sm-6">
						{{ 
							Form::select(
								'industry_sector', 
								[
									'' => '', 
									'Accounting Practice' => 'Accounting Practice',
									'Banking' => 'Banking',
									'Business Services' => 'Business Services',
									'Construction' => 'Construction',
									'Education/Training' => 'Education/Training',
									'Financial Services' => 'Financial Services',
									'Health' => 'Health',
									'Insurance' => 'Insurance',
									'IT/Telecomms' => 'IT/Telecomms',
									'Law' => 'Law',
									'Logistics' => 'Logistics',
									'Management Consultancy' => 'Management Consultancy',
									'Manufacturing/Engineering' => 'Manufacturing/Engineering',
									'Marketing/PR' => 'Marketing/PR',
									'Media/Entertainment' => 'Media/Entertainment',
									'Oil, Gas, Mining' => 'Oil, Gas, Mining',
									'Other' => 'Other',
									'Property' => 'Property',
									'Public Sector/Charity' => 'Public Sector/Charity',
									'Retail/Wholesale' => 'Retail/Wholesale',
									'Utilities' => 'Utilities'
								],
								$client_data['industry_sector'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("business_status"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>

				  <div class="form-group">
				    	<label for="currency" class="col-sm-3 control-label">Currency</label>
					<div class="col-sm-6">
						{{ 
							Form::select(
								'currency', $currencies, 
								$client_data['currency'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("currency"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				  </div>


				</fieldset>

			</div>
		    </div>
		</div>
		</div>

		<div class="row">	
  		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-home fa-fw"></i> Contact Details
                        </div>
                        <div class="panel-body">
				
			    <fieldset>

				    <div class="form-group">
				    	<label for="address_1" class="col-sm-3 control-label">Street Address</label>
					<div class="col-sm-6">
						{{ 
							Form::text('address_1', $client_data['address_1'], array(
								'class' => 'form-control input-sm',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("address_1"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="city" class="col-sm-3 control-label">Town/City</label>
					<div class="col-sm-6">
						{{ 
							Form::text('city', $client_data['city'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("city"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="countty" class="col-sm-3 control-label">County</label>
					<div class="col-sm-6">
						{{ 
							Form::select('county', $counties,
								$client_data['county'],
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("county"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="country" class="col-sm-3 control-label">Country</label>
					<div class="col-sm-6">
						{{ 
							Form::select('country', $countries,
								$country,
								array(
									'class' => 'form-control input-sm', 
							)) 
						}}
						@if ($error = $errors->first("country"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="postcode" class="col-sm-3 control-label">Postcode</label>
					<div class="col-sm-6">
						{{ 
							Form::text('postcode', $client_data['postcode'], array(
								'class' => 'form-control input-sm',
							)) 
						}}
						@if ($error = $errors->first("postcode"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="phone_number" class="col-sm-3 control-label">Phone Number</label>
					<div class="col-sm-6">
						{{ 
							Form::text('phone_number', $client_data['phone_number'], array(
								'class' => 'form-control input-sm',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("phone_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="mobile_number" class="col-sm-3 control-label">Mobile Number</label>
					<div class="col-sm-6">
						{{ 
							Form::text('mobile_number', $client_data['mobile_number'], array(
								'class' => 'form-control input-sm',
							)) 
						}}
						@if ($error = $errors->first("mobile_number"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-6">
						{{ 
							Form::text('email', $client_data['email'], array(
								'class' => 'form-control input-sm',
								'required' => 'required'
							)) 
						}}
						@if ($error = $errors->first("email"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="website" class="col-sm-3 control-label">Website</label>
					<div class="col-sm-6">
						{{ 
							Form::text('website', $client_data['website'], array(
								'class' => 'form-control input-sm',
							)) 
						}}
						@if ($error = $errors->first("website"))
						<div class="alert alert-danger">
							{{ $error }}
						</div>
						@endif
				    	</div>
				    </div>


				</fieldset>

				</div>
			    </div>
			</div>

                </div>

		
		<div class="col-lg-12 pull-right well">
			<div class="pull-right">
				<button  class="btn btn-primary btn-save" type="submit" name="save_next_page" id="save_next_page" >&nbsp;<i class="fa fa-save"></i> Save & Next </button>
				<button  class="btn btn-primary btn-save" type="submit" name="save_page" id="save_page">&nbsp;<i class="fa fa-save"></i> Save </button>
			</div>
		</div>
	{{ Form::close() }}
	</div>
</div>

@stop

