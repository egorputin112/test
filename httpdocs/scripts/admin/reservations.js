
	var models = '';
	$(document).ready(function(){
		$(".datepicker").datepicker({dateFormat:'yy-mm-dd'});
		$(".datepicker").change(function(){
			fetch_vehicles('');
		});
		$('[name^=accessory]').change(function(){
			populate_total();
		});
		$('[name^=model]').change(function(){
			populate_total();
		});
		fetch_vehicles(models);
		populate_total();
	});
	
	function fetch_vehicles(data_models){
			var from = $.trim($('#from').val());
			var till = $.trim($('#till').val());
			
			if(from != '' && till != ''){
				if(till >= from){
					var data = 'from=' + from + '&till=' + till;
					if(data_models == ''){
						var selections = $('#models select');
						if(selections.length > 0){
							for(var i=0; i<selections.length; i++){
								data += '&'+$(selections[i]).attr('name')+'='+$(selections[i]).val();
							}
						}
					}else
						data += '&' + data_models;
					$.ajax({
						url: base_url + "admin/reservations/fetch_vehicles",	
						type: "POST",
						data: data,		
						cache: false,
						success: function (json) {
							json = eval('['+json+']');
							html = '<table>';
							html += '<tr class="bold"><td>Model</td><td>Price</td><td>Quantity</td></tr>';
							for(var i=0; i<json[0].model.length; i++){
								html += '<tr><td>'+json[0].model[i].title+'</td><td>$'+json[0].model[i].price+'</td><td>'+json[0].model[i].dropdown+'</td></tr>';
							}
							html += '</table>';
							$('#models').html(html);
							$('[name^=model]').change(function(){
								populate_total();
							});
							populate_total();
						}		
					});
				}else{
					alert('Return date should be greater or equal to the pickup date.');
				}
			}
	}
  
	function populate_total(){
		var accessory = $('[name^=accessory]');
		var model = $('[name^=model]');
		var total = 0;
		var one_time_total = 0;
		for(var i=0; i<accessory.length; i++){ 
			if($(accessory[i]).val() != ''){
				if(parseInt($(accessory[i]).attr('rel')) == 1)
					one_time_total += parseInt($(accessory[i]).val()) * parseInt($(accessory[i]).parent().prev().html().replace('$','')); 
				else
					total += parseInt($(accessory[i]).val()) * parseInt($(accessory[i]).parent().prev().html().replace('$','')); 
			}
		}
		for(var i=0; i<model.length; i++){
			if($(model[i]).val() != ''){ 
				total += parseInt($(model[i]).val()) * parseInt($(model[i]).parent().prev().html().replace('$','')); 
			}
		}
		var from = $.trim($('#from').val());
		var till = $.trim($('#till').val());
		if(from != '' && till != ''){
			from = from.split('-');
			till = till.split('-');
			date1 = new Date(from[1]+"/"+from[2]+"/"+from[0]);
			date2 = new Date(till[1]+"/"+till[2]+"/"+till[0]);
			days = Math.round((date2-date1)/86400000);
			if(days > 0){
				days += 1;
				total *= days; 
			}
		}
		//total += total * 0.10725;
		total += one_time_total;
		total = Math.round(total,2);
		$('#total').val(total);
	}