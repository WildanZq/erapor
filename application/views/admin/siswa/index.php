<script type="text/javascript">
	$(document).ready(function() {
		manageSiswa();
	});

	function manageSiswa() {
		$('.main-container').html('<?php echo $this->load->view('admin/siswa/table', '', TRUE); ?>');
		refreshTabelSiswa();
	}

	function refreshTabelSiswa() {
		$('#tabel-siswa').DataTable({
			destroy: true,
	  		ajax: '<?php echo base_url('siswa/getAllSiswa'); ?>',
	  		deferRender: true,
		    columns: [
		      	{ data: 'nama_siswa' },
		      	{ data: 'nisn' },
		      	{ data: 'nis' },
		      	{ data: 'tempat_lahir' },
		      	{ data: 'tgl_lahir' },
		      	{ data: 'jk' }
  			],
	  		columnDefs: [
	  			{
	    			targets: 4,
	    			render: function(data, type, full) {
	    				date = new Date(data);
	    				return date.getDate()+'-'+monthShort[date.getMonth()]+'-'+date.getFullYear();
	    			}
	    		},
	    		{
	    			targets: 5,
	    			render: function(data, type, full) {
	    				return jk[data];
	    			}
	    		},{
					data:'id_siswa',
					targets: 6,
					render: function(data, type, full) {
					return '<button onclick="showModalKelasSiswa('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-warning"><i class="fa fa-eye"></i>&nbsp;Lihat</button>';
					}
				},
	  			{
		      		targets: 7,
		      		data: 'id_siswa',
		      		render: function(data, type, full) {
		        		return '<div class="d-flex">\
		      				<button onclick="showModalEditSiswa('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
		      				<button onclick="showModalDeleteSiswa('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
		      			</div>';
		      		}
	    		}
	    	]
		});
	}

	function refreshTabelKelasSiswa(id) {
		$.ajax({
			url: '<?php echo base_url('kelas_siswa/getAllKelasSiswa'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_siswa='+id,
			success: function(r) {
				htmlHead = ''; htmlBody = '';
				htmlHead += '<th>Tahun Ajar</th><th>Kelas</th><th></th>';
				$('#tabel-kelas-siswa thead').html(htmlHead);
				$.each(r.data, function(i, data) {
				htmlBody += '<tr><td>'+data.th_ajar+'/'+(parseInt(data.th_ajar)+1)+'</td>';
				htmlBody += '<td>'+data.nama_kelas+'</td>';
				htmlBody += '<td class="py-2">\
					<div style="width: 100px;">\
						<div class="mt-1 d-flex justify-content-center align-items-center">\
							<button onclick="deleteKelasSiswa('+data.id_kelas_siswa+','+data.id_siswa+')" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
						</div>\
					</div>\
				</td></tr>';
				});
				$('#tabel-kelas-siswa tbody').html(htmlBody);
			}
		});
	}

	function deleteKelasSiswa(id,idSiswa) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kelas_siswa/deleteKelasSiswa'); ?>',
			type: 'POST',
			dataType: 'json',
			data: 'id='+id,
			success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data siswa berhasil dihapus");
		          	refreshTabelKelasSiswa(idSiswa);
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

	function showModalKelasSiswa(id) {
		body = '<?php echo $this->load->view('admin/siswa/kelas_siswa_modal', '', TRUE); ?>';
		updateModal('List Kelas', body, '', 'addKelasSiswa', id, 'md', 'warning', '<i class="fa fa-plus"></i> Tambah Kelas');

		refreshTabelKelasSiswa(id);
		refreshPilihanKelasSiswa(id);
		refreshPilihanThAjar();

		curYear = new Date().getFullYear();
		$('#th_ajar').val(curYear);
		$('#th').html('/ '+(curYear+1));
	}

	function changeThAjar() {
		thAjar = parseInt($('#th_ajar').val());
		$('#th').html('/ '+(thAjar+1));
	}

	function refreshPilihanKelasSiswa(id) {
		$.ajax({
			url: '<?php echo base_url('kelas/getAllKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				r = groupBy(r.data,'nama_kelompok_kelas');
				$.each(r, function(key,data) {
					html += '<optgroup label="'+key+'">';
					$.each(data, function(key,data) {
						html += '<option value="'+data.id_kelas+'">'+data.nama_kelas+'</option>';
					});
					html += '</optgroup>';
				});
				$('#kelas').html(html);
				$('.select2').select2();
  				$('.select2').css('width','100%');
			}
		});
	}

	function refreshPilihanThAjar() {
		$.ajax({
			url: '<?php echo base_url('kelas_siswa/getThAjar'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '';
				$.each(r, function(key,data) {
					html += '<option value="'+data.th_ajar+'">'+data.th_ajar+'/'+(parseInt(data.th_ajar)+1)+'</option>';
				});
				$('#th_ajar').html(html);
			}
		});
	}

	function addKelasSiswa(id){
		event.preventDefault();
		$.ajax({
			url : '<?php echo base_url('kelas_siswa/addKelasSiswa')?>',
			type: 'POST',
			dataType: 'json',
			data: 'th_ajar='+$('#th_ajar').val()+'&id_kelas='+$('#kelas').val()+'&id_siswa='+id,
			success: function(r) {
		    	if (r.status) {
		        	toastr.remove();
		        	toastr["success"]("Data kelas siswa berhasil ditambahkan");
		        	refreshTabelKelasSiswa(id);
		    	} else {
		        	toastr.remove();
		        	toastr["error"](r.error);
		    	}
		    }
		});
	}

	function showModalAddSiswa() {
		body = '<?php echo $this->load->view('admin/siswa/modal_body', '', TRUE); ?>';
		updateModal('Tambah Siswa', body, '<?php echo base_url('siswa/addSiswa'); ?>', 'addSiswa', null, 'lg', 'success');

		refreshPilihanGuru();
	}

	function showModalEditSiswa(idSiswa) {
		body = '<?php echo $this->load->view('admin/siswa/modal_body', '', TRUE); ?>';
		updateModal('Edit Siswa', body, '<?php echo base_url('siswa/editSiswa'); ?>', 'editSiswa', idSiswa, 'lg', 'primary');

		refreshPilihanGuru(idSiswa);

		$.ajax({
			url: '<?php echo base_url('siswa/getSiswaById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id='+idSiswa,
			success: function(r) {
				$('#nisn').val(r.nisn);
				$('#nis').val(r.nis);
				$('#nama').val(r.nama_siswa);
				$('#jk').val(r.jk);
				$('#tempat_lahir').val(r.tempat_lahir);
				$('#tgl_lahir').val(r.tgl_lahir);
				$('#guru').val(r.id_guru).trigger('change');
			}
		});
	}

	function showModalDeleteSiswa(idSiswa) {
		updateModal('Delete Siswa?', '', '<?php echo base_url('siswa/deleteSiswa'); ?>', 'deleteSiswa', idSiswa, 'sm', 'danger', 'Yes');
	}

	function refreshPilihanGuru(idSiswa) {
		$.ajax({
			url: '<?php echo base_url('guru/getAllGuru'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih guru-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_guru+'">'+data.nama_guru+'</option>';
				});
				$('#guru').html(html);

				if (idSiswa) {
					$.ajax({
						url: '<?php echo base_url('siswa/getSiswaById'); ?>',
						type: 'GET',
						dataType: 'json',
						data: 'id='+idSiswa,
						success: function(r) {
							$('#guru').val(r.id_guru).trigger('change');
						}
					});
				}
			}
		});
	}

	function addSiswa() {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
		    type: 'POST',
		    dataType: 'json',
		    data: $('.modal-form').serialize(),
		    success: function(r) {
		    	if (r.status) {
		        	toastr.remove();
		        	toastr["success"]("Data siswa berhasil ditambahkan");
		        	refreshTabelSiswa();
			        $('.modal').modal('hide');
		    	} else {
		        	toastr.remove();
		        	toastr["error"](r.error);
		    	}
		    }
		});
	}

	function editSiswa(idSiswa) {
		event.preventDefault();
		$.ajax({
			url: $('.modal-form').attr('action'),
	      	type: 'POST',
	      	dataType: 'json',
	      	data: $('.modal-form').serialize()+'&id='+idSiswa,
	      	success: function(r) {
	        	if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data siswa berhasil diedit");
		          	refreshTabelSiswa();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

	function deleteSiswa(idSiswa) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('siswa/deleteSiswa'); ?>',
	      	type: 'POST',
	      	dataType: 'json',
	      	data: 'id='+idSiswa,
	      	success: function(r) {
		        if (r.status) {
		          	toastr.remove();
		          	toastr["success"]("Data siswa berhasil dihapus");
		          	refreshTabelSiswa();
		          	$('.modal').modal('hide');
	        	} else {
		          	toastr.remove();
		          	toastr["error"](r.error);
	        	}
	      	}
		});
	}

</script>