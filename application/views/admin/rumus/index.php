<script type="text/javascript">
	$(document).ready(function() {
		manageRumus();
	});

	function manageRumus() {
		$('.main-container').html('<?php echo $this->load->view('admin/rumus/table', '', TRUE); ?>');
		refreshTabelRumus();
	}

	function refreshTabelRumus() { //lihat
		$('#tabel-rumus').DataTable({
			destroy: true,
			ajax: '<?php echo base_url('rumus/getAllRumus'); ?>',
			deferRender: true,
	 	columns: [
	  	{ data: 'nilai_kd' },
	  	{ data: 'nilai_uts' },
	  	{ data: 'nilai_uas' }
			],
			columnDefs: [
			{
	  		targets: 3,
	  		data: 'nilai_kd',
	  		render: function(data, type, full) {
	    		return '<div class="d-flex">\
	  				<button onclick="showModalEditRumus('+data+')" data-target="#modal" data-toggle="modal" class="btn btn-primary text-white mr-1"><i class="fa fa-pencil"></i>&nbsp;Edit</button>\
	  			</div>';
	  		}
			}
		]
		});
	}

	function showModalEditRumus(rumus) {
		body = '<?php echo $this->load->view('admin/rumus/modal_body', '', TRUE); ?>';
		updateModal('Edit Rumus (%)', body, '<?php echo base_url('rumus/editRumus'); ?>', 'editRumus', rumus, 'md', 'primary');

		refreshTabelRumus();  

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