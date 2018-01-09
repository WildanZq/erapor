<script type="text/javascript">
	$(document).ready(function() {
		manageKelas();
	});

	function manageKelas() {
		$('.main-container').html('<?php echo $this->load->view('admin/kelas/table', '', TRUE); ?>');
		refreshTabelKelas();
		refreshTabelKelompokKelas();
	}

	function refreshTabelKelas() {
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
			}]
		});
	}

	function refreshPilihanMapel(id) {
		$.ajax({
			url: '<?php echo base_url('mapel/getAllMapel'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				r = groupBy(r.data,'nama_jenis_mapel');
				$.each(r, function(key,data) {
					html += '<optgroup label="'+key+'">';
					$.each(data, function(key,data) {
						html += '<option value="'+data.id_mapel+'">'+data.nama_mapel+'</option>';
					});
					html += '</optgroup>';
				});
				$('#mapel').html(html);
				$('.select2').select2();
  				$('.select2').css('width','100%');

  				$.ajax({
  					url: '<?php echo base_url('mapel_kelas/getMapelByKelasId') ?>',
  					type: 'GET',
  					dataType: 'json',
  					data: 'id='+id,
  					success: function(r) {
  						val = [];
  						$.each(r, function(key,data) {
  							val.push(data.id_mapel);
  						});
  						$('#mapel').val(val).trigger('change');
  					}
  				});
			}
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

	function refreshPilihanKelompokKelas(idKelas) {
		$.ajax({
			url: '<?php echo base_url('kelompok_kelas/getAllKelompokKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Jurusan-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kelompok_kelas+'">'+data.nama_kelompok_kelas+'</option>';
				});
				$('#kelompok_kelas').html(html);

				if (idKelas) {
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
				}
			}
		});
	}

	function showModalEditKelas(idKelas) {
		body = '<?php echo $this->load->view('admin/kelas/modal_body', '', TRUE); ?>';
		updateModal('Edit Kelas', body, '<?php echo base_url('kelas/editKelas'); ?>', 'editKelas', idKelas, 'md', 'primary');

		refreshPilihanKelompokKelas(idKelas);
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

	function refreshTabelKelompokKelas() { 
		$('#tabel-kelompokkelas').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('kelompok_kelas/getAllKelompokKelas'); ?>',
			deferRender: true,
		 	columns: [
		  	{ data: 'nama_kelompok_kelas' },
			],
			columnDefs: [
				{
					targets: 1,
					data: 'id_kelompok_kelas',
					render: function(data, type, full) {
						return '<button onclick="showModalMapelKelompokKelas('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-warning"><i class="fa fa-eye"></i>&nbsp;Lihat</button>';
					}
				},{
			  		targets: 2,
			  		data: 'id_kelompok_kelas',
			  		render: function(data, type, full) {
			    		return '<div class="d-flex">\
			  				<button onclick="showModalEditKelompokKelas('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
			  				<button onclick="showModalDeleteKelompokKelas('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
			  			</div>';
			  		}
				}
			]
		});
	}

	function showModalMapelKelompokKelas(id) {
		body = '<div class="row">\
				  <div class="col-sm-12">\
				    <div class="form-group">\
				      <select name="mapel[]" class="form-control select2" multiple="multiple" id="mapel"></select>\
				    </div>\
				  </div>\
				</div>';
		updateModal('List Mapel', body, '<?php echo base_url('mapel_kelompokkelas/editMapel'); ?>', 'editMapelKelompokKelas', id, 'md', 'warning');

		refreshPilihanMapel(id);
	}

	function editMapelKelompokKelas(id) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id='+id,
			success: function(r) {
				if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data mapel berhasil diedit");
			      	refreshTabelKelompokKelas();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}

	function refreshPilihanMapel(id) {
		$.ajax({
			url: '<?php echo base_url('mapel/getAllMapel'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				r = groupBy(r.data,'nama_jenis_mapel');
				$.each(r, function(key,data) {
					html += '<optgroup label="'+key+'">';
					$.each(data, function(key,data) {
						html += '<option value="'+data.id_mapel+'">'+data.nama_mapel+'</option>';
					});
					html += '</optgroup>';
				});
				$('#mapel').html(html);
				$('.select2').select2();
  				$('.select2').css('width','100%');

  				$.ajax({
  					url: '<?php echo base_url('mapel_kelompokkelas/getMapelByKelompokKelasId') ?>',
  					type: 'GET',
  					dataType: 'json',
  					data: 'id='+id,
  					success: function(r) {
  						val = [];
  						$.each(r, function(key,data) {
  							val.push(data.id_mapel);
  						});
  						$('#mapel').val(val).trigger('change');
  					}
  				});
			}
		});
	}

	function showModalAddKelompokKelas() {
			body = '<?php echo $this->load->view('admin/kelas/modal_body_kelompokkelas', '', TRUE); ?>';
			updateModal('Tambah Kelompok Kelas', body, '<?php echo base_url('kelompok_kelas/addKelompokKelas'); ?>', 'addKelompokKelas', null, 'md', 'success');
	}

	function addKelompokKelas(){
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	    	type: 'POST',
	    	dataType: 'json',
	    	data: $('.modal-form').serialize(),
	    	success: function(r) {
			    if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data kelompok kelas berhasil ditambahkan");
			      	refreshTabelKelompokKelas();
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
	      	}
		});
	}

	function showModalEditKelompokKelas(idKelompokKelas) {
		body = '<?php echo $this->load->view('admin/kelas/modal_body_kelompokkelas', '', TRUE); ?>';
		updateModal('Edit Jurusan', body, '<?php echo base_url('kelompok_kelas/editKelompokKelas'); ?>', 'editKelompokKelas', idKelompokKelas, 'md', 'primary');
		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('kelompok_kelas/getKelompokKelasById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idKelompokKelas,
				success: function(r) {
					$('#nama_kelompok_kelas').val(r.nama_kelompok_kelas);
				}
			});
		},100);
	}

	function editKelompokKelas(idKelompokKelas) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idKelompokKelas,
		  	success: function(r) {
			    if (r.status) {
			      toastr.remove();
			      toastr["success"]("Data jurusan berhasil diedit");
			      refreshTabelKelompokKelas();
			      refreshTabelKelas();
			      $('.modal').modal('hide');
			    } else {
			      toastr.remove();
			      toastr["error"](r.error);
			    }
	 		}
		});
	}

	function showModalDeleteKelompokKelas(idKelompokKelas) {
		updateModal('Delete Jurusan?', '', '<?php echo base_url('kelompok_kelas/deleteKelompokKelas'); ?>', 'deleteKelompokKelas', idKelompokKelas, 'sm', 'danger', 'Yes');
	}

	function deleteKelompokKelas(idKelompokKelas) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kelompok_kelas/deleteKelompokKelas'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idKelompokKelas,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data jurusan berhasil dihapus");
		          	refreshTabelKelompokKelas();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

</script>