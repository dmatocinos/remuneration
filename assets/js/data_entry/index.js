var app = angular.module('BvApp',[]);

app.directive('numbersOnly', function() {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
			if (inputValue == undefined) return '';
			
			var arr = String(inputValue).split("");
			var transformedInput = inputValue;
			
			if (arr.length === 1 && arr[0] == '-') return '';
			
			if (arr.length === 2 && inputValue == '00') {
				// do not allow user to type more than 1 zero
				transformedInput = "0";
			}
			else if (arr.length === 2 && inputValue == '-0') {
				// a negative number should not start with 0
				transformedInput = "-";
			}
			else {
				var zer = false;
				var neg = (arr.length > 1 && arr[0] == '-') ? true : false;
				
				if (arr.length === 2 && arr[0] == '0' && arr[1] != '.') {
					testValue = arr[1];
					zer = true;
				}
				else {
					testValue = inputValue;
				}
				
				transformedInput = (neg == true ? '-' : '') + testValue.replace(/[^\.0-9]/g, '');
				
				if (transformedInput === '' && zer == true) {
					transformedInput = '0';
				}
			}
			
			if (transformedInput!=inputValue) {
				modelCtrl.$setViewValue(transformedInput);
				modelCtrl.$render();
			}         

           return transformedInput;         
       });
     }
   };
});

$(document).ready(function () {
	$("#remuneration_number_of_director_shareholders").change(function() {
		enableDirectors($(this).val());
		readOnlyPercentageShare();
	});
	
	$("#remuneration_directors_salary").change(function() {
		enableDirectors($("#remuneration_number_of_director_shareholders").val());
	});
	
	$("#remuneration_directors_salary").keyup(function() {
		enableDirectors($("#remuneration_number_of_director_shareholders").val());
	});
	
	enableDirectors($("#remuneration_number_of_director_shareholders").val());
});

function readOnlyPercentageShare()
{
	var val = $("#remuneration_number_of_director_shareholders").val();
	
	if (val == '1') {
		$('#directors_percentage_of_shares_1')
			.val('100')
			.prop('readonly', true);
	}
	else {
		$('#directors_percentage_of_shares_1')
			.val('')
			.prop('readonly', false);
	}
}

function enableDirectors(i) {
	var val = $("#remuneration_directors_salary").val();
	var shareholders = $("#remuneration_number_of_director_shareholders").val();
	

	for (j = parseInt(shareholders) + 1; j <= 4; j++) {
		$("#directors_percentage_of_shares_" + j).attr('disabled', 'disabled');
		$("#directors_salary_paid_" + j).attr('disabled', 'disabled');
		$("#directors_salary_paid_" + j).val('');
		$("#directors_other_taxable_income_" + j).attr('disabled', 'disabled');
		$("#directors_balance_on_directors_loan_account_" + j).attr('disabled', 'disabled');
		$('#directors_percentage_of_shares_' + j).val('');
	}
	
	for (i = parseInt(shareholders); i >= 1; i--) {
		$("#directors_percentage_of_shares_" + i).removeAttr('disabled');
		$("#directors_salary_paid_" + i).removeAttr('disabled');
		$("#directors_salary_paid_" + i).val(val);
		$("#directors_other_taxable_income_" + i).removeAttr('disabled');
		$("#directors_balance_on_directors_loan_account_" + i).removeAttr('disabled');
	}
}
