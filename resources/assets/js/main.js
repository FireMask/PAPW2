define(['jquery', 'datatables', 'bootstrap-checkbox'],  function($, DataTable, Checkbox) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});
        $(":checkbox").checkboxpicker();
	});
});
