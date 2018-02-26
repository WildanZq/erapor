<script type="text/javascript">
$(document).ready(function() {
		manageAdmin();
	});

	function manageAdmin() {
		$('.main-container').html('<?php echo $this->load->view('admin/admin/table', '', TRUE); ?>');
		refreshTabelAdmin();
	}

	function refreshTabelAdmin() {
		$('#tabel-admin').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('admin/getAllAdmin'); ?>',
			deferRender: true,
	 		columns: [
		  		{ data: 'username' },
		  		{ data: 'nama_admin' },
			],
			columnDefs: [
				{
			  		targets: 2,
			  		data: 'id_admin',
			  		render: function(data, type, full) {
			  			if (data == <?php echo $this->session->userdata('userid'); ?>) {return '<span class="text-muted"><em>This is you</em></span>';}
			    		return '<div class="d-flex">\
			  				<button onclick="showModalDeleteAdmin('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
			  			</div>';
			  		}
				}
			]
		});
	}

	function showModalAddAdmin(){
		body = '<?php echo $this->load->view('admin/admin/modal_body', '', TRUE); ?>';
		updateModal('Tambah Admin', body, '<?php echo base_url('admin/addAdmin'); ?>', 'addAdmin', null, 'md', 'success');
	}

	function showModalDeleteAdmin(idAdmin) {
		updateModal('Delete Admin?', '', '<?php echo base_url('admin/deleteAdmin'); ?>', 'deleteAdmin', idAdmin, 'sm', 'danger', 'Yes');
	}

	function addAdmin(event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: $('.modal-form').attr('action'),
		    type: 'POST',
		    dataType: 'json',
		    data: $('.modal-form').serialize(),
		    success: function(r) {
		    	ladda.stop();
		    	if (r.status) {
		        	toastr.remove();
		        	toastr["success"]("Data admin berhasil ditambahkan");
		        	refreshTabelAdmin();
			        $('.modal').modal('hide');
		    	} else {
		        	toastr.remove();
		        	toastr["error"](r.error);
		    	}
		    }
		});
	}

	function deleteAdmin(idAdmin,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: '<?php echo base_url('admin/deleteAdmin'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idAdmin,
	      	success: function(r) {
	      		ladda.stop();
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data Admin berhasil dihapus");
		          	refreshTabelAdmin();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}
</script>