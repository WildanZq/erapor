
<script type="text/javascript">
$(document).ready(function() {
		manageMapel();
	});

	function manageMapel() {
		$('.main-container').html('<?php echo $this->load->view('admin/mapel/table', '', TRUE); ?>');
		refreshTabelMapel();
		refreshTabelKurikulum();
		refreshTabelJenisMapel();
	}

	//MAPEL

	function addMapel(){
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	    	type: 'POST',
	    	dataType: 'json',
	    	data: $('.modal-form').serialize(),
	    	success: function(r) {
			    if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data mapel berhasil ditambahkan");
			      	refreshTabelMapel();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
	      	}
		});
	}

	function showModalAddMapel() {
			body = '<?php echo $this->load->view('admin/mapel/modal_body', '', TRUE); ?>';
			updateModal('Tambah Mapel', body, '<?php echo base_url('mapel/addMapel'); ?>', 'addMapel', null, 'md', 'success');

			refreshPilihanKurikulum();
			refreshPilihanJenisMapel();
	}

	function refreshTabelMapel() { //fix
		$('#tabel-mapel').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('mapel/getAllMapel'); ?>',
			deferRender: true,
	 	columns: [
	  	{ data: 'nama_kurikulum' },
	  	{ data: 'nama_jenis_mapel' },
	  	{ data: 'nama_mapel' },
	  	{ data: 'kkm' }
			],
			columnDefs: [
			{
	  		targets: 4,
	  		data: 'id_mapel',
	  		render: function(data, type, full) {
	    		return '<div class="d-flex">\
	  				<button onclick="showModalEditMapel('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
	  				<button onclick="showModalDeleteMapel('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
	  			</div>';
	  		}
			}
		]
		});
	}

	function refreshPilihanKurikulum() {
		$.ajax({
			url: '<?php echo base_url('kurikulum/getAllKurikulum'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Kurikulum-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kurikulum+'">'+data.nama_kurikulum+'</option>';
				});
				$('#kurikulum').html(html);
			}
		});
	}

	function refreshPilihanJenisMapel() {
		$.ajax({
			url: '<?php echo base_url('jenis_mapel/getAllJenisMapel'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Jenis Mapel-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_jenis_mapel+'">'+data.nama_jenis_mapel+'</option>';
				});
				$('#jenis_mapel').html(html);
			}
		});
	}

	function showModalEditMapel(idMapel) {
		body = '<?php echo $this->load->view('admin/mapel/modal_body', '', TRUE); ?>';
		updateModal('Edit Mapel', body, '<?php echo base_url('mapel/editMapel'); ?>', 'editMapel', idMapel, 'md', 'primary');

		refreshPilihanKurikulum(); 
		refreshPilihanJenisMapel(); 

		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('mapel/getMapelById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idMapel,
				success: function(r) {
					$('#kurikulum').val(r.id_kurikulum).trigger('change');
					$('#jenis_mapel').val(r.id_jenis_mapel).trigger('change');
					$('#nama_mapel').val(r.nama_mapel);
					$('#kkm').val(r.kkm);
				}
			});
		},100);
	}

	function editMapel(idMapel) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idMapel,
		  	success: function(r) {
			    if (r.status) {
			      toastr.remove();
			      toastr["success"]("Data mapel berhasil diedit");
			      refreshTabelMapel();
			      $('.modal').modal('hide');
			    } else {
			      toastr.remove();
			      toastr["error"](r.error);
			    }
	 		}
		});
	}

	function showModalDeleteMapel(idMapel) {
		updateModal('Delete Mapel?', '', '<?php echo base_url('mapel/deleteMapel'); ?>', 'deleteMapel', idMapel, 'sm', 'danger', 'Yes');
	}

	function deleteMapel(idMapel) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('mapel/deleteMapel'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idMapel,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data mapel berhasil dihapus");
		          	refreshTabelMapel();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

	//KURIKULUM

	function refreshTabelKurikulum() { 
		$('#tabel-kurikulum').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('kurikulum/getAllKurikulum'); ?>',
			deferRender: true,
	 	columns: [
	  	{ data: 'nama_kurikulum' },
			],
			columnDefs: [
			{
	  		targets: 1,
	  		data: 'id_kurikulum',
	  		render: function(data, type, full) {
	    		return '<div class="d-flex">\
	  				<button onclick="showModalEditKurikulum('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
	  				<button onclick="showModalDeleteKurikulum('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
	  			</div>';
	  		}
			}
		]
		});
	}

	function showModalAddKurikulum() {
			body = '<?php echo $this->load->view('admin/mapel/modal_body_kurikulum', '', TRUE); ?>';
			updateModal('Tambah Kurikulum', body, '<?php echo base_url('kurikulum/addKurikulum'); ?>', 'addKurikulum', null, 'md', 'success');
	}

	function addKurikulum(){
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	    	type: 'POST',
	    	dataType: 'json',
	    	data: $('.modal-form').serialize(),
	    	success: function(r) {
			    if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data kurikulum berhasil ditambahkan");
			      	refreshTabelKurikulum();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
	      	}
		});
	}

	function showModalEditKurikulum(idKurikulum) {
		body = '<?php echo $this->load->view('admin/mapel/modal_body_kurikulum', '', TRUE); ?>';
		updateModal('Edit Kurikulum', body, '<?php echo base_url('kurikulum/editKurikulum'); ?>', 'editKurikulum', idKurikulum, 'md', 'primary');
		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('kurikulum/getKurikulumById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idKurikulum,
				success: function(r) {
					$('#nama_kurikulum').val(r.nama_kurikulum);
				}
			});
		},100);
	}

	function editKurikulum(idKurikulum) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idKurikulum,
		  	success: function(r) {
			    if (r.status) {
			      toastr.remove();
			      toastr["success"]("Data kurikulum berhasil diedit");
			      refreshTabelKurikulum();
			      refreshTabelMapel();
			      $('.modal').modal('hide');
			    } else {
			      toastr.remove();
			      toastr["error"](r.error);
			    }
	 		}
		});
	}

	function showModalDeleteKurikulum(idKurikulum) {
		updateModal('Delete Kurikulum?', '', '<?php echo base_url('kurikulum/deleteKurikulum'); ?>', 'deleteKurikulum', idKurikulum, 'sm', 'danger', 'Yes');
	}

	function deleteKurikulum(idKurikulum) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kurikulum/deleteKurikulum'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idKurikulum,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data kurikulum berhasil dihapus");
		          	refreshTabelKurikulum();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

	//JENIS MATA PELAJARAN

	function refreshTabelJenisMapel() { 
		$('#tabel-jenismapel').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('jenis_mapel/getAllJenisMapel'); ?>',
			deferRender: true,
	 	columns: [
	  	{ data: 'nama_jenis_mapel' },
			],
			columnDefs: [
			{
	  		targets: 1,
	  		data: 'id_jenis_mapel',
	  		render: function(data, type, full) {
	    		return '<div class="d-flex">\
	  				<button onclick="showModalEditJenisMapel('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
	  				<button onclick="showModalDeleteJenisMapel('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
	  			</div>';
	  		}
			}
		]
		});
	}

	function showModalAddJenisMapel() {
			body = '<?php echo $this->load->view('admin/mapel/modal_body_jenismapel', '', TRUE); ?>';
			updateModal('Tambah Jenis Mapel', body, '<?php echo base_url('jenis_mapel/addJenisMapel'); ?>', 'addJenisMapel', null, 'md', 'success');
	}

	function addJenisMapel(){
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	    	type: 'POST',
	    	dataType: 'json',
	    	data: $('.modal-form').serialize(),
	    	success: function(r) {
			    if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data jenis mapel berhasil ditambahkan");
			      	refreshTabelJenisMapel();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
	      	}
		});
	}

	function showModalEditJenisMapel(idJenisMapel) {
		body = '<?php echo $this->load->view('admin/mapel/modal_body_jenismapel', '', TRUE); ?>';
		updateModal('Edit Jenis Mapel', body, '<?php echo base_url('jenis_mapel/editJenisMapel'); ?>', 'editJenisMapel', idJenisMapel, 'md', 'primary');
		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('jenis_mapel/getJenisMapelById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idJenisMapel,
				success: function(r) {
					$('#nama_jenis_mapel').val(r.nama_jenis_mapel);
				}
			});
		},100);
	}

	function editJenisMapel(idJenisMapel) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idJenisMapel,
		  	success: function(r) {
			    if (r.status) {
			      toastr.remove();
			      toastr["success"]("Data jenis mapel berhasil diedit");
			      refreshTabelJenisMapel();
			      refreshTabelMapel();
			      $('.modal').modal('hide');
			    } else {
			      toastr.remove();
			      toastr["error"](r.error);
			    }
	 		}
		});
	}

	function showModalDeleteJenisMapel(idJenisMapel) {
		updateModal('Delete Jenis Mapel?', '', '<?php echo base_url('jenis_mapel/deleteJenisMapel'); ?>', 'deleteJenisMapel', idJenisMapel, 'sm', 'danger', 'Yes');
	}

	function deleteJenisMapel(idJenisMapel) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('jenis_mapel/deleteJenisMapel'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idJenisMapel,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data jenis mapel berhasil dihapus");
		          	refreshTabelJenisMapel();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

</script>