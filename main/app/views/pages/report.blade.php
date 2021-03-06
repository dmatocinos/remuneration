@section('title')
Report Summary
@stop

@section('page_title')
Report Summary
@stop
@section('content')
    <nav id="data-entry-nav" class="navbar navbar-default " role="navigation">
	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse" id="data-entry-collapse-bar">
		<ul class="nav navbar-nav">
		  <li><a href="{{ url("edit/{$data_entry['id']}")}}">Client Details</a></li>
		  <li class="active"><a href="{{ url("report/{$data_entry['id']}")}}">Report Summary</a></li>
		</ul>
	  </div><!-- /.navbar-collapse -->
    </nav>
  
    <div style="padding: 20px;">
	@if ($errors->any())
	<div class="row">
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Error</h4>
			{{ Session::get('message') }}
		</div>
	</div>
	@endif
	@if (Session::get('message'))
		<div class="row">
			<div class="alert alert-info alert-block">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				{{ Session::get('message') }}
			</div>
		</div>
	@endif

	
	<legend><span class="text-left">Report Summary</span><span style="margin-top: -15px;" class="pull-right text-right"><a href="{{ url('/report/download/' . $data_entry['id']) }}" class="btn btn-info">Download Tax Saving Report</a></span></legend>

    </div>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12 panel-default">
            <div class="panel-heading">
                <label>Summary of Results</label>
            </div>
            <table class="table table-striped table-bordered" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 30%;" class="text-left">&nbsp;</th>
                        <th style="" class="text-center"><b>Salary</b></th>
                        <th style="" class="text-center"><b>Salary vs Bonus</b></th>
                        <th style="" class="text-center"><b>Salary vs Dividend</b></th>
                        <th style="" class="text-center"><b>Salary vs Darwin</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="" class="text-left val">Profit before directors' salary</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->c6, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->e6, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->g6, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->i6, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Directors' salary</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c8, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e8, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g8, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i8, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Employers NIC</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c10, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e10, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g10, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i10, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left val">Existing profit chargeable to corporation tax</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->c12, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->e12, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->g12, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->i12, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Bonus</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e14, '£') }}</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Employers NIC</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e15, '£') }}</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Third party fees (12%)</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i17, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Less: Darwin bonus payment</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i19, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left val">Revised profit chargeable to corporation tax</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->c21, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->e21, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->g21, '£') }}</td>
                        <td style="" class="text-right border-top-2">{{ NumFormatter::money($calc->i21, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Corporation tax</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i23, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Dividend</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g25, '£') }}</td>
                        <td style="" class="text-right"></td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left val">Retained profit</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c28, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e28, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g28, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i28, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left val" colspan="5">Personal tax</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Additional employees NIC</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e33, '£') }}</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i33, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left">Additional income tax</td>
                        <td style="" class="text-right"></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i34, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left val">Net amount received</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i38, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td style="" class="text-left"><b>Effective  tax rate on extraction (inc fees)</b></td>
                        <td style="" class="text-right">{{ NumFormatter::percent(0, 2) }}</td>
                        <td style="" class="text-right">{{ NumFormatter::percent($calc->e41 * 100, 2) }}</td>
                        <td style="" class="text-right">{{ NumFormatter::percent($calc->g41 * 100, 2) }}</td>
                        <td style="" class="text-right">{{ NumFormatter::percent($calc->i41 * 100, 2) }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                </tbody>
            </table>
		</div>
        <div class="col-md-12 panel-default">
            <div class="panel-heading">
                <label>Total Tax, NIC and Costs and Benefits</label>
            </div>
            <table class="table table-striped table-bordered" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 30%;" class="text-left"></th>
                        <th style="" class="text-center"><b>Salary</b></th>
                        <th style="" class="text-center"><b>Salary vs Bonus</b></th>
                        <th style="" class="text-center"><b>Salary vs Dividend</b></th>
                        <th style="" class="text-center"><b>Salary vs Darwin</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="" class="text-left;"><b>Total Tax and Costs</b></td>
                        <td style="" class="text-left border-top-2" colspan="4"></td>
                    </tr>
                    <tr>
                        <td style="" class="val">Company</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e15 + $calc->e23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g15 + $calc->g23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i17 + $calc->i23, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="val">Personally</td>
                        <td style="" class="text-right">{{ NumFormatter::money(0, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e33 + $calc->e34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i33 + $calc->i34, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="">Total Tax and Costs</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c23, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(($calc->e15 + $calc->e23) + ($calc->e33 + $calc->e34), '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g15 + $calc->g23 + $calc->g34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i17 + $calc->i23 + $calc->i33 + $calc->i34, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="1">&nbsp; </td>
                        <td style="" class="text-left border-top-2" colspan="4">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left;"><b>Extra tax/costs on distribution</b></td>
                        <td style="" class="text-right">{{ NumFormatter::money(0, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23), '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g34, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23), '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left;"><b>Amount available to spend personally</b></td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->c38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->e38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->g38, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money($calc->i38, '£') }}</td>
                    </tr>
                    <tr>
                        <td style="" class="text-left" colspan="5">&nbsp; </td>
                    </tr>
                    <tr>
                        <td style="" class="text-left;"><b>Tax/costs saved against bonus option</b></td>
                        <td style="" class="text-right">{{ NumFormatter::money(0, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(0, '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23 - $calc->g34), '£') }}</td>
                        <td style="" class="text-right">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23) - ($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23), '£') }}</td>
                    </tr>
                </tbody>
            </table>
					
		</div>
                    <div class="col-md-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    <label>Total costs and Net personally receivable under each option</label>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<table class="table table-bordered" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
								<tr>
									<td style="width: 30%;" class="text-left"></td>
									<td style="" ><b>Tax and Costs</b></td>
									<td style="" ><b>Net Personally Receivable</b></td>
								</tr>
								<tr>
									<td style="" ><b>Salary</b></td>
									<td style="" >{{ NumFormatter::number($calc->c23) }}</td>
									<td style="" >{{ NumFormatter::number($calc->c38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Salary vs Bonus</b></td>
									<td style="" >{{ NumFormatter::number(($calc->e15 + $calc->e23) + ($calc->e33 + $calc->e34)) }}</td>
									<td style="" >{{ NumFormatter::number($calc->e38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Salary vs Dividend</b></td>
									<td style="" >{{ NumFormatter::number($calc->g15 + $calc->g23 + $calc->g34) }}</td>
									<td style="" >{{ NumFormatter::number($calc->g38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Salary vs Darwin</b></td>
									<td style="" >{{ NumFormatter::number($calc->i17 + $calc->i23 + $calc->i33 + $calc->i34) }}</td>
									<td style="" >{{ NumFormatter::number($calc->i38) }}</td>
								</tr>
							</table>
						</div>
						<div class="col-md-7">
							<img src="{{ asset($graph) }}" class="img-thumbnail"/>
						</div>
					</div>
				</div>
			    </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@stop
