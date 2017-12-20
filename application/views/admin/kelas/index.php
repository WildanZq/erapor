<script type="text/javascript">
	$(document).ready(function() {
		manageKelas();
	});

	function manageKelas() {
		$('.main-container').html('<?php echo $this->load->view('admin/kelas/table', '', TRUE); ?>');
		refreshTabelKelas();
	}

	function refreshTabelKelas() { //lihat
		$('#tabel-kelas').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('kelas/getAllKelas'); ?>',
			deferRender: true,
	 	columns: [
	  	{ data: 'nama_kelompok_kelas' },
	  	{ data: 'nama_kelas' }
			],
			columnDefs: [
			{
	  		targets: 2,
	  		data: 'id_kelas',
	  		render: function(data, type, full) {
	    		return '<div class="d-flex">\
	  				<button onclick="showModalEditKelas('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
	  				<button onclick="showModalDeleteKelas('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
	  			</div>';
	  		}
			}
		]
		});
	}

	function addKelas(){
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	    	type: 'POST',
	    	dataType: 'json',
	    	data: $('.modal-form').serialize(),
	    	success: function(r) {
			    if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data kelas berhasil ditambahkan");
			      	refreshTabelKelas();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
	      	}
		});
	}

	function showModalAddKelas() { 
			body = '<?php echo $this->load->view('admin/kelas/modal_body', '', TRUE); ?>';
			updateModal('Tambah Kelas', body, '<?php echo base_url('kelas/addKelas'); ?>', 'addKelas', null, 'md', 'success');

			refreshPilihanKelompokKelas();
	}

	function refreshPilihanKelompokKelas() { //select
		$.ajax({
			url: '<?php echo base_url('kelompok_kelas/getAllKelompokKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Kelompok Kelas-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kelompok_kelas+'">'+data.nama_kelompok_kelas+'</option>';
				});
				$('#kelompok_kelas').html(html);
			}
		});
	}

	function showModalEditKelas(idKelas) {
		body = '<?php echo $this->load->view('admin/kelas/modal_body', '', TRUE); ?>';
		updateModal('Edit Kelas', body, '<?php echo base_url('kelas/editKelas'); ?>', 'editKelas', idKelas, 'md', 'primary');

		refreshPilihanKelompokKelas();  

		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('kelas/getKelasById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idKelas,
				success: function(r) {
					$('#kelompok_kelas').val(r.id_kelompok_kelas).trigger('change');
					$('#nama_kelas').val(r.nama_kelas);
				}
			});
		},100);
	}

	function editKelas(idKelas) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	  type: 'POST',
	  dataType: 'json',
	  data: $('.modal-form').serialize()+'&id='+idKelas,
	  success: function(r) {
	    if (r.status) {
	      toastr.remove();
	      toastr["success"]("Data kelas berhasil diedit");
	      refreshTabelKelas();
	      $('.modal').modal('hide');
	    } else {
	      toastr.remove();
	      toastr["error"](r.error);
	    }
	  }
		});
	}

	function showModalDeleteKelas(idKelas) {
		updateModal('Delete Kelas?', '', '<?php echo base_url('kelas/deleteKelas'); ?>', 'deleteKelas', idKelas, 'sm', 'danger', 'Yes');
	}

	function deleteKelas(idKelas) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kelas/deleteKelas'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idKelas,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data kelas berhasil dihapus");
		          	refreshTabelKelas();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

</script>