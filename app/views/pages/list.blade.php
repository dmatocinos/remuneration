@section('content')
<div style="padding: 30px;">
	 @if (Session::get('message'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <b>{{ Session::get('message') }}</b>
    </div>
    @endif
    <div class="panel-heading" style="margin-top: 10px;">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> My Remunerations</h3>
	 </div>
	 <div class="panel-body">
		<div class="remunerations-list-div">
			<table id="remunerations-list" class="table table-striped table-bordered" style="float: left; width: 100%; display: none;">
				<thead>
					<tr>
						<th>Remuneration Name</th>
						<th>Company Name</th>
						<th>Date Created</th>
                        <th style="width: 50px;">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($remunerations as $item)
						<tr style="">
							<td>{{ $item->name . ':::' . url('/edit/' . $item->id) }}</td>
							<td>{{ $item->company->name }}</td>
							<td>{{ $item->created_at }}</td>
                            <td><a href="{{ url('delete/' . $item->id) }}" class="delete-item" style="width: 45px;">
                                <i class="fa fa-times"></i>
                            </a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
