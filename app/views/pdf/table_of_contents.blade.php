<table class="table" cellspacing="3" cellpadding="5">
	<tr style="font-size: 12px; color: black;">
		<td class="text-left" colspan="2">Section </td>
		<td class="text-right"></td>
		<td class="text-right">Page</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td></td>
		<td></td>
	</tr>
	@foreach($pages as $page_key => $page)
	<tr style="font-size: 12px; color: black;">
		<td class="text-left" colspan="2">
		{{ $page['section'] }} &nbsp;&nbsp;{{ $page['title'] }}
		</td>
		<td class="text-right"></td>
		<td class="text-right">{{ $page_key }}</td>
	</tr>
	@endforeach
</table>
