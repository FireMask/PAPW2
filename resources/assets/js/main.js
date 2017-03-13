define(['jquery', 'datatables-bs'],  function($, DataTable) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});
	});
});
