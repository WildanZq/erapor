<div class="main-container"></div>
<script type="text/javascript">
$(document).ready(function() {
		manageMapel();
	});

function manageMapel() {
	$('.main-container').html('<?php echo $this->load->view('admin/mapel/table', '', TRUE); ?>');
	refreshTabelMapel();
}

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
		updateModal('Tambah Mapel', body, '<?php echo base_url('mapel/addMapel'); ?>', 'addMapel', null, 'lg', 'success');

		refreshPilihanKurikulum();
}

function refreshTabelMapel() {
	$('#tabel-mapel').DataTable({
		destroy: true,
		ajax: '<?php echo base_url('mapel/getAllMapel'); ?>',
		deferRender: true,
 	columns: [
  	{ data: 'id_kurikulum' },
  	{ data: 'nama_mapel' },
  	{ data: 'kkm' }
		],
		columnDefs: [
		{
  		targets: 3,
  		data: 'id_mapel',
  		render: function(data, type, full) {
    		return '<div class="d-flex">\
  				<button onclick="showModalEditMapel('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
  				<button onclick="#" class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>\
  			</div>';
  		}
		}
	]
	});
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

function refreshPilihanKurikulum() {
	$.ajax({
		url: '<?php echo base_url('kurikulum/getAllKurikulum'); ?>',
		type: 'GET',
		dataType: 'json',
		success: function(r) {
			html = '<option value="">-Pilih kurikulum-</option>';
			$.each(r.data, function(i, data) {
				html += '<option value="'+data.id_kurikulum+'">'+data.nama_kurikulum+'</option>';
			});
			$('#kurikulum').html(html);
		}
	});
}

function showModalEditMapel(idMapel) {
		body = '<?php echo $this->load->view('admin/mapel/modal_body', '', TRUE); ?>';
		updateModal('Edit Mapel', body, '<?php echo base_url('mapel/editMapel'); ?>', 'editMapel', idMapel, 'lg', 'primary');

		refreshPilihanKurikulum(); 

		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('mapel/getMapelById'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+idMapel,
				success: function(r) {
					$('#kurikulum').val(r.id_kurikulum).trigger('change');
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
</script>