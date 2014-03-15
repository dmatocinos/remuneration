<div class="report-container">
	<h2>Remuneration Strategies - Tax Saving Report</h2>
	<div><h2>Contents</h2></div>
	<table class="clear-border" style="font-size: 18px;" cellspacing="0" cellpadding="5">
		<tbody class="clear-border">
		<tr>
			<td class="clear-border text-left" colspan="2"><b>Section</b> </td>
			<td class="clear-border text-right" colspan="2"><b>Page</b></td>
		</tr>
		@foreach($pages as $page_key => $page)
		<tr>
			<td class="clear-border text-left" colspan="4"></td>
		</tr>
		<tr>
			<td class="text-left clear-border" colspan="2">
			{{ $page['section'] }} &nbsp;&nbsp;{{ $page['title'] }}
			</td>
			<td class="text-right clear-border" colspan="2">{{ $page_key }}</td>
		</tr>
		@endforeach
		</tbody>
	</table>

</div>
