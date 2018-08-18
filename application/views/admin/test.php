<head>
	<link href="<?php echo base_url('assets/datatables/css/jquery.dataTables.min.css') ?>" rel="stylesheet" />

<!-- jQuery -->
<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js') ?>"></script>

<!-- DataTables JS -->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
</head>
<body>
<table id="dataTables-example">
	<thead>
        <tr>
            <th>No</th>
            <th>Category</th>
            <th>Description</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
</body>
<script type="text/javascript">
	$(document).ready( function () {
		$('#dataTables-example').DataTable({
			"processing": true,
            "serverSide": true,
            "ajax":{
		    "url": "<?php echo base_url('admin/test/category_ajax') ?>",
		    "dataType": "json",
		    "type": "POST",
		    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    	"columns": [
	          	{ "data": "id" },
	          	{ "data": "name" },
	          	{ "data": "description" },
	          	{ "data": "created_at" },
		       	]	 

		});
	});
</script>
