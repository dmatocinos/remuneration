	<h2>Appendix 1 - Summary of Results</h2>
	<table class="clear-border" cellspacing="1" cellpadding="4" style="font-size 12px;">
		<tr>
			<td style="width: 42%;" class="text-left"></td>
			<td style="width: 14.5%;" class="val">Salary</td>
			<td style="width: 14.5%;" class="val"><b>Salary/Bonus</b></td>
			<td style="width: 14.5%;" class="val"><b>Salary/Dividend</b></td>
			<td style="width: 14.5%;" class="val"><b>Salary/Darwin</b></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left"></td>
			<td style="width: 14.5%;" class="val"><b>£</b></td>
			<td style="width: 14.5%;" class="val"><b>£</b></td>
			<td style="width: 14.5%;" class="val"><b>£</b></td>
			<td style="width: 14.5%;" class="val"><b>£</b></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val">Profit before directors' salary</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c6, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e6, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g6, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i6, '£') }}</td>
		</tr>
		<tr>
			<td style="" class="text-left" colspan="5"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Directors' salary</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c8, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e8, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g8, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i8, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Employees NIC was</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c10, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e10, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g10, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i10, '£') }}</td>
		</tr>
		<tr>
			<td></td>
			<td style="color: #691515; font-size: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
		</tr>
		<tr style="font-weight: bold;">
			<td style="width: 42%;" class="text-left val">Existing profit chargeable to corporation tax</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c12, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e12, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g12, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i12, '£') }}</td>
		</tr>
		<tr>
			<td class="text-left" colspan="5"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Bonus</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e14, '£') }}</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Employees NIC was</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e15, '£') }}</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Third party fees (12%)</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i17, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Less: Darwin bonus payment</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i19, '£') }}</td>
		</tr>
		<tr>
			<td></td>
			<td style="color: #691515; font-size: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val">Revised profit chargeable to corporation tax</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c21, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e21, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g21, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i21, '£') }}</td>
		</tr>
		<tr>
			<td style="" class="text-left" colspan="5"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Corporation tax</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c23, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e23, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g23, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i23, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Dividend</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g25, '£') }}</td>
			<td style="width: 14.5%;"></td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val">Retained profit</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c28, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e28, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g28, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i28, '£') }}</td>
		</tr>
		<tr>
			<td></td>
			<td style="color: #691515; font-size: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val" colspan="5">Personal tax</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Additional employees NIC</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e33, '£') }}</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i33, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Additional income tax</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e34, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g34, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i34, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left">Personal fees</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;"></td>
		</tr>
		<tr>
			<td></td>
			<td style="color: #691515; font-size: 10px;" class="text-left" colspan="4">\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val">Net amount received</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->c38, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->e38, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->g38, '£') }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::money($calc->i38, '£') }}</td>
		</tr>
		<tr>
			<td style="width: 42%;" class="text-left val">Effective tax rate on extraction (incl fees)</td>
			<td style="width: 14.5%;"></td>
			<td style="width: 14.5%;">{{ NumFormatter::percent($calc->e41 * 100, 2) }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::percent($calc->g41 * 100, 2) }}</td>
			<td style="width: 14.5%;">{{ NumFormatter::percent($calc->i41 * 100, 2) }}</td>
		</tr>
	</table>
	
