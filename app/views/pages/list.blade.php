@section('content')
<div style="padding: 30px;">
	<div class="panel-heading" style="margin-top: 10px;">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> My Remunerations</h3>
	 </div>
	 <div class="panel-body">
		<div class="remunerations-list-div">
			<table id="remunerations-list" style="float: left; width: 100%; display: none;">
				<thead>
					<tr>
						<th>Remuneration Name</th>
						<th>Company Name</th>
						<th>Date Created</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($remunerations as $item)
						<tr style="">
							<td>{{ $item->name . ':::' . url('/edit/' . $item->id) }}</td>
							<td>{{ $item->company_name }}</td>
							<td>{{ $item->created_at }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop