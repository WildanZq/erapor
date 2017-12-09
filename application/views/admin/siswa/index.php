<div class="main-container"></div>
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
      	{ data: 'jk' },
      	{ data: 'nama_kelas' }
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

	function showModalAddSiswa() {
		body = '<?php echo $this->load->view('admin/siswa/modal_body', '', TRUE); ?>';
		updateModal('Tambah Siswa', body, '<?php echo base_url('siswa/addSiswa'); ?>', 'addSiswa', null, 'lg', 'success');

		refreshPilihanKelas();
		refreshPilihanGuru();
	}

	function showModalEditSiswa(idSiswa) {
		body = '<?php echo $this->load->view('admin/siswa/modal_body', '', TRUE); ?>';
		updateModal('Edit Siswa', body, '<?php echo base_url('siswa/editSiswa'); ?>', 'editSiswa', idSiswa, 'lg', 'primary');

		refreshPilihanKelas(); refreshPilihanGuru();

		setTimeout(function() {
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
					$('#kelas').val(r.id_kelas).trigger('change');
					$('#guru').val(r.id_guru).trigger('change');
				}
			});
		},100);
	}

	function showModalDeleteSiswa(idSiswa) {
		updateModal('Delete Siswa?', '', '<?php echo base_url('siswa/deleteSiswa'); ?>', 'deleteSiswa', idSiswa, 'sm', 'danger', 'Yes');
	}

	function refreshPilihanKelas() {
		$.ajax({
			url: '<?php echo base_url('kelas/getAllKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih kelas-</option>';
				$.each(r.data, function(i, data) {
					html += '<option value="'+data.id_kelas+'">'+data.nama_kelas+'</option>';
				});
				$('#kelas').html(html);
			}
		});
	}

	function refreshPilihanGuru() {
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