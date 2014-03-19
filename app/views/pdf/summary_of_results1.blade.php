	<h2>2. Summary of Results</h2>
	<table class="clear-border" cellpadding="10">
		<tr>
			<td class="text-left" style="width: 7%;">2.1</td>
			<td style="width: 93%;">
				For business owners there can often be the question of whether to take money out of the company for personal use or leave the money in for business purposes. Taking too much money out of the business can have a serious impact on the cash available to run it. 
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.2</td>
			<td style="width: 93%;">
				What level of funding should be left in the business will very much depend upon the company’s cash flow and what funds are required to meet the business expenses and liabilities.
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.3</td>
			<td style="width: 93%;">
				Given that extracting the funds from the company will often lead to a tax charge, then unless the funds are required personally there may be little point taking money out of the company.
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.4</td>
			<td style="width: 93%;">
				However, if too much money is retained in the company then this may jeopardise the Inheritance Tax position of the shareholders. Unfortunately what would be considered excessive is very subjective. 
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.5</td>
			<td style="width: 93%;">
				Whilst considering how much to take out of the business is a commercial and personal decision, the above tax issues should be borne in mind.
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.6</td>
			<td style="width: 93%;">
				There are a number of ways to consider extracting funds from the company. Each method has its own tax costs and benefits.
			</td>
		</tr>
		<tr>
			<td class="text-left" style="width: 7%;">2.7</td>
			<td style="width: 93%;">
				The amounts shown in figure 1 are based upon distributing {{ $amount_to_distribute }}.
			</td>
		</tr>
	</table>
	<p class="report-header">Figure 1</p>
	<table class="table" cellspacing="1" cellpadding="4" style="background-color: #FAF9E8; font-size 12px;">
		<tr>
			<td style="width: 30%;" class="text-left"></td>
			<td style="width: 17.5%;">Do Nothing</td>
			<td style="width: 17.5%;">Salary/Bonus</td>
			<td style="width: 17.5%;">Dividend</td>
			<td style="width: 17.5%;">Darwin</td>
		</tr>
		<tr>
			<td style="width: 30%;" class="text-left">Total Tax and Costs</td>
			<td style="width: 17.5%;">£</td>
			<td style="width: 17.5%;">£</td>
			<td style="width: 17.5%;">£</td>
			<td style="width: 17.5%;">£</td>
		</tr>
		<tr>
			<td style="width: 30%;" class="text-left">Company</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->c23), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e15 + $calc->e23), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->g15 + $calc->g23), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->i17 + $calc->i23), '£') }}</td>
		</tr>
		<tr>
			<td style="width: 30%;" class="text-left">Personally</td>
			<td style="width: 17.5%;"></td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e33 + $calc->e34), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->g34), '£') }}</td>
			<td style="width: 17.5%;"></td>
		</tr>
		<tr>
			<td style="width: 30%;" class="text-left">Total Tax and Costs</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->c23), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e15 + $calc->e23 + $calc->e33 + $calc->e34), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->g15 + $calc->g23 + $calc->g34), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->i17 + $calc->i23), '£') }}</td>
		</tr>
		<tr>
			<td style="width: 30%;" class="text-left">Extra tax/costs on distribution</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(0, '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->g34), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23), '£') }}</td>
		</tr>
		<tr>
			<td style="width: 30%;"  class="text-left">Amount available to spend personally</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->c38), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e38), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->g38), '£') }}</td>
			<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->i38), '£') }}</td>
		</tr>
		<tr>
			<td style="width: 30%;"  class="text-left">Tax/costs saved against bonus option</td>
				<td style="width: 17.5%;">-</td>
				<td style="width: 17.5%;">-</td>
				<td style="width: 17.5%;">{{ NumFormatter::money(round($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23 - $calc->g34), '£') }}</td>
				<td style="width: 17.5%;">{{ NumFormatter::money(round(($calc->e34 + $calc->e33 + $calc->e15 - $calc->c23 + $calc->e23) - ($calc->i34 + $calc->i33 + $calc->i17 - $calc->g23 + $calc->i23)), '£') }}</td>
		</tr>
	</table>
