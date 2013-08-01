jQuery(
	function($)
	{
		$('#tbl').dataTable(
			{
				bJQueryUI       : true,
				bFilter         : true,
				bInfo           : false,
				bSort           : true,
				bPaginate       : false,
				bStateSave      : true,
				sCookiePrefix   : 'd',
				aoColumnDefs : [
					{ sType : 'string', aTargets : [0, 1, 2, 3, 4,5] },
					{ bSortable : false, aTargets : [6] }
				]
			}
		);
	}
);