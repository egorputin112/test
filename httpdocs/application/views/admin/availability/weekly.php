<script>
	var weekly_data=eval_json('<?php echo ($weekly_data)?>');
	var monthly_data=eval_json('<?php echo ($monthly_data)?>');
	$(document).ready(function(){
		populate_data(weekly_data, false);
		populate_data(monthly_data, true);
		
		$("#weekly .next").click(function(){
			ajax_call("offset=1&date="+weekly_data.dates[weekly_data.dates.length-1].date,false);
		});
		
		$("#weekly .prev").click(function(){
			ajax_call("offset=0&date="+weekly_data.dates[0].date,false);
		});
		
		$("#monthly .next").click(function(){
			ajax_call("offset=1&monthly=1&date="+monthly_data.dates[monthly_data.dates.length-1].date,true);
		});
		
		$("#monthly .prev").click(function(){
			ajax_call("offset=0&monthly=1&date="+monthly_data.dates[0].date,true);
		});
		
		$("#availability-tabs").tabs();
	});
	
	function ajax_call(post_data,monthly){
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
							buffer += '<td>'+data.orders[data.dates[i].date][subvalue].name+'</td>';
							slot = true;
						}
					}
					if(!slot)
						buffer += '<td></td>';
				}
				buffer += '</tr>';
				rows++;
			})
		});
		if(monthly){
			$('#monthly-availability').html(buffer);
			$('#monthly .title').html(data.title);
		}else{
			$('#weekly-availability').html(buffer);
			$('#weekly .title').html(data.title);	
		}
	}
	
</script>
<div id="availability-tabs">
	<ul>
		<li><a href="#monthly">Monthly</a></li>
		<li><a href="#weekly">Weekly</a></li>
	</ul>
	<div id="monthly">
		<div class="ui-widget-header navigation-header">
			<a class="prev" href="#" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a>
			<span class="title"></span>
			<a class="next" href="#" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a>
		</div>
		<div class="clear"></div>
		<table id="monthly-availability" class="browse">
			
		</table>
	</div>
	<div id="weekly">
		<div class="ui-widget-header navigation-header">
			<a class="prev" href="#" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a>
			<span class="title"></span>
			<a class="next" href="#" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a>
		</div>
		<div class="clear"></div>
		<table id="weekly-availability" class="browse">
			
		</table>
	</div>
</div>