$(document).ready(function() {
	var dataObj;
	var currentYears;
	$.getJSON('api.php?get_makes',function(data) {
		dataObj = data;
		initMakes(data.makes);
	});
	
	var currentMake;
	var currentModel;
	var currentFromYear;
	var currentToYear;
	
	// pre init if we have parameter at link
	var raw_data = $('.cnt-data').html();
	eval('var page_data = ' + raw_data);
	if (typeof(page_data) != 'undefined') {
		if (typeof(page_data.make) == 'string') {
			currentMake = page_data.make;
			currentModel = page_data.model;
			
			// set zip
			if (page_data.zip != null && page_data.zip != '') {
				$('#txtZipCode').val(page_data.zip);
			}
		}
	}
	
	$('.yearOptions').stop(true,true).hide();
	
	$('.yearValueContainer').click(function() {
		$(this).find('.yearOptions').stop(true,true).show();
	});
	$('.yearValueContainer').hover(function() {
		$(this).find('.yearOptions').stop(true,true).show();
	}, function() {
		$(this).find('.yearOptions').stop(true,true).hide();
	});
	
	$('#btnYearNext').click(yearNextClicked);
	
	$('#priceValue').find('input').keyup(priceValueChanged);
	
	$('#btnPriceNext').click(priceNextClicked);
	
	$('#anythingElseNext').click(anythingElseNextClicked);
	
	$('#doneButton').click(doneButtonClicked);
	
	$("#paymentFrame").load(paymentFrameLoaded);
	
	$('.btnGoBack').click(goBackClicked);
	
	//Format the Phone Number text box as "(###)###-####"
	$("#txtPhone").mask("(999) 999-9999", {placeholder:" "});
	
	$("input[name=contactMethod]:radio").change(onRadioClicked);
	
	function initMakes(makes) {
		var niceName = '';
		$('#makeOptionItems').empty();
		for (var i = 0; i < makes.length; i++) {
			var makeOption = $('<div class="makeOption">'+ makes[i].name +'</div>');
			makeOption.attr('data-value', makes[i].niceName);
			makeOption.attr('data-id', makes[i].id);
			makeOption.click(makeOptionClicked);
			$('#makeOptionItems').append(makeOption);
			
			// set value if exist
			if (page_data.set_data) {
				var make_lower = page_data.make.toLowerCase();
				var make_check_lower = makes[i].name.toLowerCase();
				if (make_lower == make_check_lower) {
					niceName = makes[i].niceName;
				}
			}
			
		}
		$('.makeOption').animate({'opacity':1},200);
		
		// set value if exist
		if (niceName != '') {
			$('[data-value="' + niceName + '"]').click();
		}
	}
	
	function initModels(make) {
		var niceName = '';
		var makes = dataObj.makes;
		$('.modelContainer').empty();
		
		for (var i = 0; i < makes.length; i++) {
			if (makes[i].niceName == make) {
				var models = makes[i].models;
				for (var i = 0; i < models.length; i++) {
					var newModel = $('<div class="model">' + models[i].name + "</div>");
					
					newModel.attr('data-id',models[i].id);
					newModel.attr('data-value',models[i].niceName);
					
					$('.modelContainer').append(newModel);
					newModel.click(modelOptionClicked);
					
					// set value if exist
					if (page_data.set_data) {
						var model_lower = page_data.model.toLowerCase();
						var model_check_lower = models[i].name.toLowerCase();
						
						if (model_lower == model_check_lower) {
							niceName = models[i].niceName;
						}
					}
				}
				break;
			}
		}
		
		// set value if exist
		if (niceName != '') {
			$('[data-value="' + niceName + '"]').click();
		}
	}
	
	function initYears() {
		var makes = dataObj.makes;
		for(var i = 0; i < makes.length; i++)
		{
			if(makes[i].niceName == currentMake)
			{
				var models = makes[i].models;
				for(var i = 0; i < models.length; i++)
				{
					if(models[i].niceName == currentModel)
					{
						var years = currentYears = models[i].years;
						$('#fromYearOptions').empty();
						$('#toYearOptions').empty();
						$('#fromYearValue').text(years[0].year);
						$('#toYearValue').text(years[years.length - 1].year);
						for(var i = 0; i < years.length; i++)
						{
							var fromYear = $('<div class="yearOption">' + years[i].year + '</div>');
							var toYear = $('<div class="yearOption">' + years[i].year + '</div>');
							fromYear.click(yearOptionClicked);
							toYear.click(yearOptionClicked);
							$('#fromYearOptions').append(fromYear);
							$('#toYearOptions').append(toYear);
						}
						break;
					}
				}
				break;
			}
		}
	}
	
	function initPrice() {
		for(var i = 1; i <= 4; i++)
		{
			$('#tmvYear'+i).text('');
			$('#tmvTradeIn'+i).text('');
			$('#tmvPrivateParty'+i).text('');
			$('#tmvDealerRetail'+i).text('');
		}
			
		var yearsToGet = "";
		
		var yearDiff = currentToYear - currentFromYear;
		
		if(yearDiff >= 4)
			yearDiff = 4;
		
		for(var year = currentToYear; year >= currentToYear - yearDiff; year--)
			yearsToGet += year + ",";
		
		$.getJSON("/api.php?get_tmv&make="+ currentMake +"&model="+ currentModel +"&years=" + yearsToGet,function(data) {
			
			var sortedYearData = new Array();
			for(var i in data) {
				data[i].year = i;
				sortedYearData.push(data[i]);
			}
			
			sortedYearData.sort(function(a , b) {
				var aVal = parseInt(a.year);
				var bVal = parseInt(b.year);
				return aVal - bVal;
			});
			
			for (var i = 1; i <= sortedYearData.length; i++) {
				// year
				var _year = '';
				if (sortedYearData[i-1] != null) {
					if (sortedYearData[i-1].year != null) {
						_year = sortedYearData[i-1].year;
					}
				}
				
				// trade in
				var _trade_in = '';
				if (sortedYearData[i-1] != null) {
					if (sortedYearData[i-1].tmv != null) {
						if (sortedYearData[i-1].tmv.nationalBasePrice != null) {
							if (sortedYearData[i-1].tmv.nationalBasePrice.usedTradeIn != null) {
								_trade_in = money_format(sortedYearData[i-1].tmv.nationalBasePrice.usedTradeIn);
							}
						}
					}
				}
				
				// private party
				var _private_party = '';
				if (sortedYearData[i-1] != null) {
					if (sortedYearData[i-1].tmv != null) {
						if (sortedYearData[i-1].tmv.nationalBasePrice != null) {
							if (sortedYearData[i-1].tmv.nationalBasePrice.usedPrivateParty != null) {
								_private_party = money_format(sortedYearData[i-1].tmv.nationalBasePrice.usedPrivateParty);
							}
						}
					}
				}
				
				// dealer retail
				var _dealer_retail = '';
				if (sortedYearData[i-1] != null) {
					if (sortedYearData[i-1].tmv != null) {
						if (sortedYearData[i-1].tmv.nationalBasePrice != null) {
							if (sortedYearData[i-1].tmv.nationalBasePrice.usedTmvRetail != null) {
								_dealer_retail = money_format(sortedYearData[i-1].tmv.nationalBasePrice.usedTmvRetail);
							}
						}
					}
				}
				
				$('#tmvYear'+i).text(_year);
				$('#tmvTradeIn'+i).text(_trade_in);
				$('#tmvPrivateParty'+i).text(_private_party);
				$('#tmvDealerRetail'+i).text(_dealer_retail);
			}
			
			
			
		});
	}
	
	function yearOptionClicked(e) {
	
		e.stopPropagation();
		e.stopImmediatePropagation();
		
		var yearValueElement = $(this).parent().parent().find('.yearValue');
		yearValueElement.text($(this).text());
		$(this).parent().hide();
		
		if(yearValueElement.attr('id') == "toYearValue" && parseInt(yearValueElement.text()) < parseInt($('#fromYearValue').text()))
		{
			alert('Sorry! The beginning year cannot be earlier than the ending year.');
		}
		else if(yearValueElement.attr('id') == "fromYearValue" && parseInt(yearValueElement.text()) > parseInt($('#toYearValue').text()))
		{
			alert('Sorry! The beginning year cannot be earlier than the ending year.');
		}
		
		
	}
	
	function makeOptionClicked() {
		$('.makeSelected').removeClass('makeSelected');
		$(this).addClass('makeSelected');
		$('#modelSection').show();
		$('#modelSection').animate({'opacity':1});
		$.scrollTo('#modelSection',500);
		$('.makeChoosen').text($(this).text());
		currentMake = $(this).attr('data-value');
		initModels($(this).attr('data-value'));
	}
	
	function modelOptionClicked()
	{
		$('.modelSelected').removeClass('modelSelected');
		$(this).addClass('modelSelected');
		$('#yearSection').show();
		$('#yearSection').animate({'opacity':1});
		$.scrollTo('#yearSection',500);
		currentModel = $(this).attr('data-value');
		$('.modelChoosen').text($(this).text());
		initYears();
	}
	
	function yearNextClicked()
	{
	
		if(parseInt($('#toYearValue').text()) < parseInt($('#fromYearValue').text()))
		{
			alert('Sorry! The beginning year cannot be earlier than the ending year.');
		}
		else
		{
		
			currentFromYear = $('#fromYearValue').text();
			currentToYear = $('#toYearValue').text();
			$('#priceSection').show();
			$('#priceSection').animate({'opacity':1});
			$.scrollTo('#priceSection',500);
			$('.choosenYear').text(currentFromYear + "-" +currentToYear);
			initPrice();
		}
	}
	
	function priceNextClicked()
	{
		$('#priceForm').validate();
		if($('#priceValue input').valid())
		{
			$('#anythingElseSection').show();
			$('#anythingElseSection').animate({'opacity':1});
			$.scrollTo('#anythingElseSection',500);
		}
	}
	
	function anythingElseNextClicked()
	{
		$('#contactSection').show();
		$('#contactSection').animate({'opacity':1});
		$.scrollTo('#contactSection',500);
	}
	
	function goBackClicked()
	{
		var container = $(this).parent().parent();
		container.animate({'opacity':0});
		container.hide();
		$.scrollTo(container.prev(),500);
	}
	
	function doneButtonClicked()
	{
		$('#cForm').validate();
//		if($('#txtFN').valid() && $('#txtLN').valid() && $('#txtPhone').valid() && $('#txtEmail').valid())
//		{
//			$('#paymentSection').show();
//			$('#paymentSection').animate({'opacity':1});
//			$.scrollTo('#paymentSection',500);
			
//			$.get('checkout.php',{ data: {
//				'make': $('.makeSelected').text(),
//				'model': $('.modelSelected').text(),
//				'fromYear': $('#fromYearValue').text(),
//				'toYear': $('#toYearValue').text(),
//				'price': $('#priceValue input').val(),
//				'comments': $('#anythingElseBox textarea').val(),
//				'firstName': $('#txtFN').val(),
//				'lastName' : $('#txtLN').val(),
//				'phoneNumber' : $('#txtPhone').val(),
//				'email' : $('#txtEmail').val()
//			}},function(data) {
//				$("#paymentFrame").attr('src',data);
//			});
//		}
		
		if ($('#txtHidden').valid())
		{
			if ($('input[name=contactMethod]:checked').val() == "1")
			{
				$('#txtPhone').removeAttr("required");
			}
		}
		
		if($('#txtFN').valid() && $('#txtLN').valid() && $('#txtPhone').valid() && $('#txtEmail').valid() && $('#txtEmail').valid() && $('#txtZipCode').valid() && $('#txtHidden').valid())
		{
			var make = ($('.makeSelected').text() == '') ? page_data.make : $('.makeSelected').text();
			var model = ($('.modelSelected').text() == '') ? page_data.model : $('.modelSelected').text();
			
//			$('#paymentSection').show();
//			$('#paymentSection').animate({'opacity':1});
//			$.scrollTo('#paymentSection',500);
			$('#doneButtonContainer span').text('Sending...');
			$('#doneButton').css('width', '258px');
			$.get('thankyou.php',{ data: {
				'make': make,
				'model': model,
				'fromYear': $('#fromYearValue').text(),
				'toYear': $('#toYearValue').text(),
				'price': $('#priceValue input').val(),
				'comments': $('#anythingElseBox textarea').val(),
				'firstName': $('#txtFN').val(),
				'lastName' : $('#txtLN').val(),
				'phoneNumber' : $('#txtPhone').val(),
				'email' : $('#txtEmail').val(),
				'zip_code' : $('#txtZipCode').val(),
				'contactMethod' : $('input[name=contactMethod]:checked').val(),
			}},function(data) {
				window.location="thankyou.php";
			});
		}

		/*$('#thanksSection').show();
		$('#thanksSection').animate({'opacity':1});
		$.scrollTo('#thanksSection',500);*/
	}
	
	function onRadioClicked()
	{
		$('#txtHidden').val("a");
	}
	
	function paymentFrameLoaded()
	{
		console.log($("#paymentFrame").attr('src'));
	}
	
	function priceValueChanged()
	{
		var intVal = parseInt($(this).val().trim().replace("$","").replace(/,/g,""));
		if(!isNaN(intVal))
		{
			var moneyFormat = money_format(intVal);
			$(this).val(moneyFormat);
			$('.choosenPrice').text(moneyFormat);
		}
		else
		{
			$(this).val("$12,000");
			$('.choosenPrice').text("$12,000");
		}
		
	}
	
	// Returns a random integer between min (included) and max (excluded)
	// Using Math.round() will give you a non-uniform distribution!
	function randomInt(min,max)
	{
		console.log(min,max);
		return Math.floor(Math.random()*(max-(min+1))+(min+1));
	}

	
	function money_format(n) {
	
		if(n == null)
		{
			return null;
		}	
		n += '';
		x = n.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';

		var r=/(\d+)(\d{3})/;

		while (r.test(x1)) {
		x1 = x1.replace(r, '$1' + ',' + '$2');
		}

		x2 = Number(x2).toFixed(0);

		return '$' + x1 + x2.substr(1);
	}



	$(".model").each(function(){
	  if($(this).attr("data-id") == $("#default_model").val()) $(this).addClass("modelSelected");
	});

	$(".make").each(function(){
	  if($(this).attr("data-id") == $("#default_make").val()) $(this).addClass("makeSelected");
	});

	$(".txtZipCode").val($("#default_zip_code").val());
	
	
	// init after loaded
	if (typeof(page_data) != 'undefined') {
		if (typeof(page_data.make) == 'string') {
			/*	
			aa = page_data;
			page_data = aa;
			
			$('#makeOptionItems').css('display', 'none');
			$('.makeChoosen').html(page_data.make);
			$('.modelChoosen').html(page_data.model);
			$('.choosenYear').html(currentFromYear + '-' + currentToYear);
			$('#btnYearNext').click();
			/*	*/
		}
	}
});