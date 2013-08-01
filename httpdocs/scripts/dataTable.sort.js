jQuery.fn.dataTableExt.oSort['html-num-asc'] = function(x, y)
{
	x = x.replace(/<.*?>/g, "");
	y = y.replace(/<.*?>/g, "");
	return parseFloat(x) - parseFloat(y);
}

jQuery.fn.dataTableExt.oSort['html-num-desc'] = function(x, y)
{
	x = x.replace(/<.*?>/g, "");
	y = y.replace(/<.*?>/g, "");
	return parseFloat(y) - parseFloat(x);
}

jQuery.fn.dataTableExt.oSort['formatted-num-asc'] = function(x, y)
{
	x = x.replace(/<.*?>/g, "");
	y = y.replace(/<.*?>/g, "");
	x = x.replace(/,/g, '');
	y = y.replace(/,/g, '');
	return parseFloat(x) - parseFloat(y);
}

jQuery.fn.dataTableExt.oSort['formatted-num-desc'] = function(x, y)
{
	x = x.replace(/<.*?>/g, "");
	y = y.replace(/<.*?>/g, "");
	x = x.replace(/,/g, '');
	y = y.replace(/,/g, '');
	return parseFloat(y) - parseFloat(x);
}

jQuery.fn.dataTableExt.oSort['ip-address-asc']  = function(a, b)
{
	a = a.replace(/<.*?>/g, "");
	b = b.replace(/<.*?>/g, "");

	var m = a.split("."), x = "";
	var n = b.split("."), y = "";
	var i, item;

	for (i=0; i<m.length; ++i) {
		item = m[i];
		if (item.length == 1) {
			x += "00" + item;
		}
		else if (item.length == 2) {
			x += "0" + item;
		}
		else {
			x += item;
		}

		item = n[i];
		if (item.length == 1) {
			y += "00" + item;
		}
		else if (item.length == 2) {
			y += "0" + item;
		}
		else {
			y += item;
		}
	}

	return (x < y) ? -1 : (x > y ? 1 : 0);
};

jQuery.fn.dataTableExt.oSort['ip-address-desc']  = function(a, b)
{
	a = a.replace(/<.*?>/g, "");
	b = b.replace(/<.*?>/g, "");

	var m = a.split("."), x = "";
	var n = b.split("."), y = "";
	var i, item;

	for (i=0; i<m.length; ++i) {
		item = m[i];
		if (item.length == 1) {
			x += "00" + item;
		}
		else if (item.length == 2) {
			x += "0" + item;
		}
		else {
			x += item;
		}

		item = n[i];
		if (item.length == 1) {
			y += "00" + item;
		}
		else if (item.length == 2) {
			y += "0" + item;
		}
		else {
			y += item;
		}
	}

	return (x < y) ? 1 : (x > y ? -1 : 0);
};
