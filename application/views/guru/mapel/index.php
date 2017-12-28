<script type="text/javascript">
	$(document).ready(function() {
		$('.main-container').html('<?php echo $this->load->view('guru/mapel/main_view', '', TRUE); ?>');

		refreshPilihanKelas();

		$('#tabel-nilai-siswa').DataTable();

		refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
	});

	function refreshPilihanKelas() {
		$.ajax({
			url: '<?php echo base_url('kelas/getAllKelas'); ?>',
			type: 'GET',
			dataType: 'json',
			success: function(r) {
				html = '<option value="">-Pilih kelas-</option>';
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

	function updateSemester() {
		refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
	}

	function updateKelas() {
		idKelas = $('#kelas').val();
	}

	function refreshTabelKD(semester,idMapel) {
		$.ajax({
			url: '<?php echo base_url('kd/getKD'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'semester='+semester+'&id_mapel='+idMapel,
			success: function(r) {
				if (r.length == 0) {
					$('#tabel-kd thead').html('<strong class="text-danger">KD belum ada, segera tambahkan!</strong>');
					$('#tabel-kd tbody tr').html('');
					return;
				}

				htmlHead = ''; htmlBody = '';
				$.each(r, function(i, data) {
					htmlHead += '<th>'+(++i)+'. '+data.nama_kd+'</th>';
					htmlBody += '<td class="py-2">\
						<div style="width: 100px;">\
							<div class="d-flex justify-content-center align-items-center">\
								<button onclick="moveLeftKD()" class="btn mr-1"><i class="fa fa-caret-left"></i></button>\
								<button onclick="moveRightKD()" class="btn"><i class="fa fa-caret-right"></i></button>\
							</div>\
							<div class="mt-1 d-flex justify-content-center align-items-center">\
								<button onclick="showModalEditKD('+data.id_kd+')" class="btn btn-primary mr-1" data-target="#modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>\
								<button onclick="showModalDeleteKD('+data.id_kd+')" class="btn btn-danger" data-target="#modal" data-toggle="modal"><i class="fa fa-trash"></i></button>\
							</div>\
						</div>\
					</td>';
				});
				$('#tabel-kd thead').html(htmlHead);
				$('#tabel-kd tbody tr').html(htmlBody);
			}
		});
	}

	function showModalAddKD(idMapel) {
		body = '<?php echo $this->load->view('guru/kd/modal_body', '', TRUE); ?>';
		updateModal('Tambah KD', body, '<?php echo base_url('kd/addKD'); ?>', 'addKD', idMapel, 'md', 'success');

		$('#semester_kd').val($('#semester').val());
	}

	function showModalEditKD(idKD) {
		body = '<?php echo $this->load->view('guru/kd/modal_body', '', TRUE); ?>';
		updateModal('Edit KD', body, '<?php echo base_url('kd/editKD'); ?>', 'editKD', idKD, 'md', 'primary');

		$.ajax({
			url: '<?php echo base_url('kd/getKDById'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'id_kd='+idKD,
			success: function(r) {
				$('#semester_kd').val(r.semester);
				$('#nama_kd').val(r.nama_kd);
			}
		});
	}

	function addKD(idMapel) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kd/addKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_mapel='+idMapel,
			success: function(r) {
				if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data KD berhasil ditambahkan");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}

	function editKD(idKD) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('kd/editKD'); ?>',
			type: 'POST',
			dataType: 'json',
			data: $('.modal-form').serialize()+'&id_kd='+idKD+'&id_mapel='+<?php echo $this->uri->segment(3); ?>,
			success: function(r) {
				if (r.status) {
			    	toastr.remove();
			      	toastr["success"]("Data KD berhasil diedit");
			      	refreshTabelKD($('#semester').val(), <?php echo $this->uri->segment(3); ?>);
			      	$('.modal').modal('hide');
			    } else {
			      	toastr.remove();
			     	toastr["error"](r.error);
			    }
			}
		});
	}
</script>