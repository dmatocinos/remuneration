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
		  <li><a href="{{ url("edit/{$data_entry['id']}")}}">Data Entry</a></li>
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
	<legend><span class="text-left">Report Summary</span><span style="margin-top: -15px;" class="pull-right text-right"><a href="{{ url('/report/download/' . $data_entry['id']) }}" class="btn btn-info">Download Tax Saving Report</a></span></legend>

    </div>
    <div class="row" style="padding: 0 20px;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Summary of Results
                </div>
                <div class="panel-body">
			<table class="" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
				<tr>
					<td style="width: 30%;" class="text-left"></td>
					<td style="" ><b>Do Nothing</b></td>
					<td style="" ><b>Salary/Bonus</b></td>
					<td style="" ><b>Dividend</b></td>
					<td style="" ><b>Darwin</b></td>
				</tr>
				<tr>
					<td style="" class="text-left"></td>
					<td style="" ><b>£</b></td>
					<td style="" ><b>£</b></td>
					<td style="" ><b>£</b></td>
					<td style="" ><b>£</b></td>
				</tr>
				<tr>
					<td style="" class="text-left val">Profit before directors' salary</td>
					<td style="">{{ NumFormatter::money($calc->c6, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e6, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g6, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i6, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Directors' salary</td>
					<td style="">{{ NumFormatter::money($calc->c8, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e8, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g8, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i8, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Employers NIC was</td>
					<td style="">{{ NumFormatter::money($calc->c10, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e10, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g10, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i10, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val">Existing profit chargeable to corporation tax</td>
					<td style="">{{ NumFormatter::money($calc->c12, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e12, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g12, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i12, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Bonus</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->e14, '£') }}</td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Employees NIC was</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->e15, '£') }}</td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Third party fees (12%)</td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->i17, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left">Less: Darwin bonus payment</td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->i19, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val">Revised profit chargeable to corporation tax</td>
					<td style="">{{ NumFormatter::money($calc->c21, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e21, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g21, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i21, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td style="" class="text-left">Corporation tax</td>
					<td style="">{{ NumFormatter::money($calc->c23, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e23, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g23, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i23, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left">Dividend</td>
					<td style=""></td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->g25, '£') }}</td>
					<td style=""></td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val">Retained profit</td>
					<td style="">{{ NumFormatter::money($calc->c28, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e28, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g28, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i28, '£') }}</td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val" colspan="5">Personal tax</td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td style="" class="text-left">Additional employees NIC</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->e33, '£') }}</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->i33, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left">Additional income tax</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::money($calc->e34, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g34, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i34, '£') }}</td>
				</tr>
				<tr>
					<td style="" class="text-left">Personal fees</td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
					<td style=""></td>
				</tr>
				<tr>
					<td style="" class="text-left" colspan="5">&nbsp; </td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val">Net amount received</td>
					<td style="">{{ NumFormatter::money($calc->c38, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->e38, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->g38, '£') }}</td>
					<td style="">{{ NumFormatter::money($calc->i38, '£') }}</td>
				</tr>
				<tr>
					<td></td>
					<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
				</tr>
				<tr style="font-weight: bold;">
					<td style="" class="text-left val">Effective tax rate on extraction (incl fees)</td>
					<td style=""></td>
					<td style="">{{ NumFormatter::percent($calc->e41 * 100) }}</td>
					<td style="">{{ NumFormatter::percent($calc->g41 * 100) }}</td>
					<td style="">{{ NumFormatter::percent($calc->i41 * 100) }}</td>
				</tr>
			</table>
		</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                    <div class="col-md-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    Tax and Costs and Benefits
				</div>
				<div class="panel-body">
					<table class="" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
						<tr>
							<td style="width: 30%;" class="text-left"></td>
							<td style="" ><b>Do Nothing</b></td>
							<td style="" ><b>Salary/Bonus</b></td>
							<td style="" ><b>Dividend</b></td>
							<td style="" ><b>Darwin</b></td>
						</tr>
						<tr>
							<td style="" class="text-left"></td>
							<td style="" ><b>£</b></td>
							<td style="" ><b>£</b></td>
							<td style="" ><b>£</b></td>
							<td style="" ><b>£</b></td>
						</tr>
						<tr>
							<td style="" class="text-left;"><b>Total Tax and Costs</b></td>
							<td style="" class="text-left" colspan="5"></td>
						</tr>
						<tr>
							<td style="" class="val">Company</td>
							<td style="">{{ NumFormatter::money($calc->c23, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->e15 + $calc->e23, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->g15 + $calc->g23, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->i17 + $calc->i23, '£') }}</td>
						</tr>
						<tr>
							<td style="" class="val">Personally</td>
							<td style="">{{ NumFormatter::money(0, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->e33 + $calc->e34, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->g34, '£') }}</td>
							<td style=""></td>
						</tr>
						<tr>
							<td style="" class="text-left" colspan="5">&nbsp; </td>
						</tr>
						<tr>
							<td></td>
							<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
						</tr>
						<tr>
							<td style="" class="">Total Tax and Costs</td>
							<td style="">{{ NumFormatter::money($calc->c23, '£') }}</td>
							<td style="">{{ NumFormatter::money(($calc->e15 + $calc->e23) + ($calc->e33 + $calc->e34), '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->g15 + $calc->g23 + $calc->g34, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->i17 + $calc->i23, '£') }}</td>
						</tr>
						<tr>
							<td style="" class="text-left" colspan="5">&nbsp; </td>
						</tr>
						<tr>
							<td></td>
							<td style="color: #691515; font-sie: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
						</tr>
						<tr>
							<td style="" class="text-left;"><b>Extra tax/costs on distribution</b></td>
							<td style="">{{ NumFormatter::money(0, '£') }}</td>
							<td style="">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23), '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->g34, '£') }}</td>
							<td style="">{{ NumFormatter::money(($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23), '£') }}</td>
						</tr>
						<tr>
							<td style="" class="text-left" colspan="5">&nbsp; </td>
						</tr>
						<tr>
							<td style="" class="text-left;"><b>Amount available to spend personally</b></td>
							<td style="">{{ NumFormatter::money($calc->c38, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->e38, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->g38, '£') }}</td>
							<td style="">{{ NumFormatter::money($calc->i38, '£') }}</td>
						</tr>
						<tr>
							<td style="" class="text-left" colspan="5">&nbsp; </td>
						</tr>
						<tr>
							<td style="" class="text-left;"><b>Tax/costs saved against bonus option</b></td>
							<td style="">{{ NumFormatter::money(0, '£') }}</td>
							<td style="">{{ NumFormatter::money(0, '£') }}</td>
							<td style="">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23 - $calc->g34), '£') }}</td>
							<td style="">{{ NumFormatter::money(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23) - ($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23), '£') }}</td>
						</tr>
					</tr>
					</table>
					
				</div>
			    </div>
                    </div>
                    <div class="col-md-12">
			    <div class="panel panel-default">
				<div class="panel-heading">
				    Total costs and Net personally receivable under each option
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<table class="table table-bordered" cellspacing="1" cellpadding="4" style="font-size 12px; width: 100%;">
								<tr>
									<td style="width: 30%;" class="text-left"></td>
									<td style="" ><b>Net Personally Receivable</b></td>
									<td style="" ><b>Tax and Costs</b></td>
								</tr>
								<tr>
									<td style="" ><b>Do Nothing</b></td>
									<td style="" >{{ NumFormatter::number($calc->c23) }}</td>
									<td style="" >{{ NumFormatter::number($calc->c38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Salary/Bonus</b></td>
									<td style="" >{{ NumFormatter::number(($calc->e15 + $calc->e23) + ($calc->e33 + $calc->e34)) }}</td>
									<td style="" >{{ NumFormatter::number($calc->e38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Dividend</b></td>
									<td style="" >{{ NumFormatter::number($calc->g15 + $calc->g23 + $calc->g34) }}</td>
									<td style="" >{{ NumFormatter::number($calc->g38) }}</td>
								</tr>
								<tr>
									<td style="" ><b>Darwin</b></td>
									<td style="" >{{ NumFormatter::number($calc->i17 + $calc->i23) }}</td>
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
