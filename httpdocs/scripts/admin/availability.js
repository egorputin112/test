	var loader = '<tr class="loader"><td><img src="/images/ajax-loader.gif"/></td></tr>';
	var pretty_photo_type = '';
	$(document).ready(function(){
		populate_data(weekly_data, false);
		populate_data(monthly_data, true);
		
		$("#weekly .next").click(function(){
			$("#weekly-availability").html(loader);
			ajax_call("offset=1&date="+weekly_data.dates[weekly_data.dates.length-1].date,false);
		});
		
		$("#weekly .prev").click(function(){
			$("#weekly-availability").html(loader);
			ajax_call("offset=0&date="+weekly_data.dates[0].date,false);
		});
		
		$("#monthly .next").click(function(){
			$("#monthly-availability").html(loader);
			ajax_call("offset=1&monthly=1&date="+monthly_data.dates[monthly_data.dates.length-1].date,true);
		});
		
		$("#monthly .prev").click(function(){
			$("#monthly-availability").html(loader);
			ajax_call("offset=0&monthly=1&date="+monthly_data.dates[0].date,true);
		});
		
		$("#availability-tabs").tabs();
		$("a[rel='prettyphoto']").prettyPhoto({social_tools:false});
		$(".empty-slot").live({mouseenter:function(){$(this).addClass('empty-slot-hover');},mouseleave:function(){$(this).removeClass('empty-slot-hover');}});
			
		$(".empty-slot a").click(function(){
			pretty_photo_type = $(this).parents().find(".browse").attr('id');
		});
	});
	
	function ajax_call(post_data,monthly){
		if(monthly){
				last_call_data[0] = post_data;
		}else{
				last_call_data[1] = post_data;
		}
		$.ajax({
				url: base_url + "admin/availability/fetch_data",	
				type: "POST",
				data: post_data,		
				cache: false,
				success: function (json) {
					if(monthly){
						monthly_data = eval_json(json);
						populate_data(monthly_data,true);
					}else{
						weekly_data = eval_json(json);
						populate_data(weekly_data,false);
					}
					$("a[rel='prettyphoto']").prettyPhoto({social_tools:false});
				}
		});
	}
	
	function eval_json(json){
		json = eval('['+json+']');
		return json[0];
	}
	
	function populate_data(data, monthly){
		var i=0;
		var buffer = '<tr><td></td>';
		for(i=0; i<data.dates.length; i++){
			if(monthly)
				buffer += '<th>'+(i+1)+'</th>';
			else
				buffer += '<th>'+data.dates[i].date+'<br>'+data.dates[i].day+'</th>';
		}
		buffer += '</tr>';
		rows=0;
		$.each(data.models, function(index,value){
			$.each(value.vehicles, function(subindex,subvalue){
				buffer += ((rows%2) == 0)? '<tr class="even">':'<tr class="odd">';
				buffer += '<td class="bold">'+value.title+" "+subvalue+'</td>';
				for(i=0; i<data.dates.length; i++){
					var slot = false;
					if(data.orders.hasOwnProperty(data.dates[i].date)){
						if(data.orders[data.dates[i].date].hasOwnProperty(subvalue)){
							var date = data.dates[i].date;
							buffer += '<td><a href="/index.php/admin/reservations/view/'+data.orders[date][subvalue].id+'?iframe=true&width=700&height=400" rel="prettyphoto">';
							buffer += (data.orders[date][subvalue].is_admin == 1) ? '<img src="/images/admin.png" />':'';
							buffer += data.orders[date][subvalue].name+'</a></td>';
							slot = true;
						}
					}
					if(!slot)
						buffer += '<td class="empty-slot vtip" title="Click here to add new reservation order for <b>'+value.title+'</b> on <b>'+data.dates[i].date+'</b>"><a rel="prettyphoto" href="/index.php/admin/reservations/add?date='+data.dates[i].date+'&model='+index+'&iframe=true&width=700&height=580" rel="prettyphoto">&nbsp;</a></td>';
				}
				buffer += '</tr>';
				rows++;
			})
		});
		if(monthly){
			$('#monthly-availability').html(buffer);
			$('#monthly .title').html(data.title);
			$('#monthly .export').attr('href','/index.php/admin/availability/export/'+data.dates[0].date+'/1');
		}else{
			$('#weekly-availability').html(buffer);
			$('#weekly .title').html(data.title);
			$('#weekly .export').attr('href','/index.php/admin/availability/export/'+data.dates[0].date);	
		}
	}
	