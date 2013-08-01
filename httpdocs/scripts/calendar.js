jQuery(
	function($)
	{
		$('#datepicker').DatePicker({
			flat: true,
			date: '',
			calendars: 1,
			mode: 'range',
			starts: 0,
			prev : '«',
			next : '»',
			format: 'm/d/Y',
			onRender : function(d)
			{
				var now = new Date();
				var s = this.date[0];
				var e = this.date[1];
				var c = '';

				if (!isNaN(s) && !isNaN(e)) {
					if (d.valueOf() == s) {
						c = 'pickup';
					}

					if (d.valueOf() == e || d.valueOf() == e - 86399000) {
						c += ' return';
					}
				}

				return {
					disabled  : d.valueOf() < now.valueOf(),
					className : c
				};
			},
			onChange : function(e)
			{
				$('#pickup-date').html(e[0].replace(/-/g, '/'));
				$('#return-date').html(e[1].replace(/-/g, '/'));
				$('#pickup').val(e[0]);
				$('#return').val(e[1]);
			}
		});

		$('#ResetButton').click(
			function()
			{
				$('#datepicker').DatePickerClear();
				$('#pickup, #return').val('');
				$('#pickup-date, #return-date').html('--/--/--');
				return false;
			}
		);

		$('.dpform').submit(
			function()
			{
				if (!$('#pickup').val() || !$('#return').val()) {
					alert('You must specify pickup and return date!');
					return false;
				}

				return true;
			}
		);
	}
);
