<script type="text/javascript">
	$(document).ready(function() {
		manageRumus();
	});

	function manageRumus() {
		$('.main-container').html('<?php echo $this->load->view('admin/rumus/table', '', TRUE); ?>');
		refreshTabelRumus();
	}

	function refreshTabelRumus(rumus) { 
		$.ajax({
			url: '<?php echo base_url('rumus/getAllRumus'); ?>',
			type: 'GET',
			dataType: 'json',
			data: 'nilai_kd='+rumus,
			success: function(r) {
				htmlHead = ''; htmlBody = '';
				$.each(r.data, function(i, data) {
				htmlHead += '<th>Nilai KD (%)</th>';
				htmlHead += '<th>Nilai UTS (%)</th>';
				htmlHead += '<th>Nilai UAS (%)</th>';
				htmlHead += '<th></th>';
				htmlBody += '<td>'+data.nilai_kd+'</td>';
				htmlBody += '<td>'+data.nilai_uts+'</td>';
				htmlBody += '<td>'+data.nilai_uas+'</td>';
				htmlBody += '<td class="py-2">\
					<div style="width: 100px;">\
						<div class="mt-1 d-flex justify-content-center align-items-center">\
							<button onclick="showModalEditRumus('+data.nilai_kd+')" class="btn btn-primary mr-1" data-target="#modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>\
						</div>\
					</div>\
				</td>';
				});
				$('#tabel-rumus thead').html(htmlHead);
				$('#tabel-rumus tbody tr').html(htmlBody);
			}
		});
	}

	function showModalEditRumus(rumus) {
		body = '<?php echo $this->load->view('admin/rumus/modal_body', '', TRUE); ?>';
		updateModal('Edit Rumus (%)', body, '<?php echo base_url('rumus/editRumus'); ?>', 'editRumus', rumus, 'md', 'primary');
		setTimeout(function() {
			$.ajax({
				url: '<?php echo base_url('rumus/getRumus'); ?>',
				type: 'GET',
				dataType: 'json',
				data: 'id='+rumus,
				success: function(r) {
					$('#nilai_kd').val(r.nilai_kd);
					$('#nilai_uts').val(r.nilai_uts);
					$('#nilai_uas').val(r.nilai_uas);
				}
			});
		},100);
	}

	function editRumus(rumus) {
		event.preventDefault();
		$.ajax({
		url: $('.modal-form').attr('action'),
		  type: 'POST',
		  dataType: 'json',
		  data: $('.modal-form').serialize()+'&id='+rumus,
		  success: function(r) {
		    if (r.status) {
		      toastr.remove();
		      toastr["success"]("Data rumus berhasil diedit");
		      refreshTabelRumus();
		      $('.modal').modal('hide');
		    } else {
		      toastr.remove();
		      toastr["error"](r.error);
		    }
		  }
		});
	}
</script>