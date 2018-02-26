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

	function refreshTabelMapel() {
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

	function addMapel(event){
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
			updateModal('Tambah Mapel', '<p class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span><p>', '', 'addMapel', null, 'md', 'success');

			refreshPilihanKurikulum();
	}

	function refreshPilihanKurikulum(idMapel) {
		$.ajax({
			url: '<?php echo base_url('kurikulum/getAllKurikulum'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Kurikulum-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kurikulum+'">'+data.nama_kurikulum+'</option>';
				});

				if (idMapel) {
					$.ajax({
						url: '<?php echo base_url('mapel/getMapelById'); ?>',
						type: 'GET',
						dataType: 'json',
						data: 'id='+idMapel,
						success: function(r) {
							refreshPilihanJenisMapel(html, idMapel, r.id_kurikulum);
						}
					});
				} else {
					refreshPilihanJenisMapel(html);
				}
			}
		});
	}

	function refreshPilihanJenisMapel(kurikulum, idMapel, kurikulumVal) {
		$.ajax({
			url: '<?php echo base_url('jenis_mapel/getAllJenisMapel'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih Jenis Mapel-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_jenis_mapel+'">'+data.nama_jenis_mapel+'</option>';
				});

				if (idMapel) {
					$.ajax({
						url: '<?php echo base_url('mapel/getMapelById'); ?>',
						type: 'GET',
						dataType: 'json',
						data: 'id='+idMapel,
						success: function(rm) {
							$.ajax({
								url: '<?php echo base_url('mapel/getMapelById'); ?>',
								type: 'GET',
								dataType: 'json',
								data: 'id='+idMapel,
								success: function(r) {
									body = '<?php echo $this->load->view('admin/mapel/modal_body', '', TRUE); ?>';
									updateModal('Edit Mapel', body, '<?php echo base_url('mapel/editMapel'); ?>', 'editMapel', idMapel, 'md', 'primary');

									$('#kurikulum').html(kurikulum);
									$('#kurikulum').val(kurikulumVal).trigger('change');
									$('#jenis_mapel').html(html);
									$('#jenis_mapel').val(rm.id_jenis_mapel).trigger('change');

									$('#nama_mapel').val(r.nama_mapel);
									$('#kkm').val(r.kkm);
								}
							});
						}
					});
				} else {
					body = '<?php echo $this->load->view('admin/mapel/modal_body', '', TRUE); ?>';
					updateModal('Tambah Mapel', body, '<?php echo base_url('mapel/addMapel'); ?>', 'addMapel', null, 'md', 'success');

					$('#kurikulum').html(kurikulum);
					$('#jenis_mapel').html(html);
				}
			}
		});
	}

	function showModalEditMapel(idMapel) {
		updateModal('Edit Mapel', '<p class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span><p>', '', 'editMapel', null, 'md', 'primary');

		refreshPilihanKurikulum(idMapel);
	}

	function editMapel(idMapel,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idMapel,
		  	success: function(r) {
		  		ladda.stop();
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

	function deleteMapel(idMapel,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: '<?php echo base_url('mapel/deleteMapel'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idMapel,
	      	success: function(r) {
	      		ladda.stop();
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

	function addKurikulum(event){
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
		updateModal('Edit Kurikulum', '<p class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span><p>', '', 'editKurikulum', null, 'md', 'primary');

		$.ajax({
			url: '<?php echo base_url('kurikulum/getKurikulumById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+idKurikulum,
			success: function(r) {
				body = '<?php echo $this->load->view('admin/mapel/modal_body_kurikulum', '', TRUE); ?>';
				updateModal('Edit Kurikulum', body, '<?php echo base_url('kurikulum/editKurikulum'); ?>', 'editKurikulum', idKurikulum, 'md', 'primary');

				$('#nama_kurikulum').val(r.nama_kurikulum);
			}
		});
	}

	function editKurikulum(idKurikulum,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idKurikulum,
		  	success: function(r) {
		  		ladda.stop();
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

	function deleteKurikulum(idKurikulum,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: '<?php echo base_url('kurikulum/deleteKurikulum'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idKurikulum,
	      	success: function(r) {
	      		ladda.stop();
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

	function addJenisMapel(event){
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
		updateModal('Edit Jenis Mapel', '<p class="text-center"><i class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span><p>', '', 'editJenisMapel', null, 'md', 'primary');

		$.ajax({
			url: '<?php echo base_url('jenis_mapel/getJenisMapelById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+idJenisMapel,
			success: function(r) {
				body = '<?php echo $this->load->view('admin/mapel/modal_body_jenismapel', '', TRUE); ?>';
				updateModal('Edit Jenis Mapel', body, '<?php echo base_url('jenis_mapel/editJenisMapel'); ?>', 'editJenisMapel', idJenisMapel, 'md', 'primary');

				$('#nama_jenis_mapel').val(r.nama_jenis_mapel);
			}
		});
	}

	function editJenisMapel(idJenisMapel,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: $('.modal-form').attr('action'),
		  	type: 'POST',
		 	dataType: 'json',
		  	data: $('.modal-form').serialize()+'&id='+idJenisMapel,
		  	success: function(r) {
		  		ladda.stop();
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

	function deleteJenisMapel(idJenisMapel,event) {
		event.preventDefault();
		ladda.start();
		$.ajax({
			url: '<?php echo base_url('jenis_mapel/deleteJenisMapel'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idJenisMapel,
	      	success: function(r) {
	      		ladda.stop();
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